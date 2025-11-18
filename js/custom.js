document.querySelectorAll(".tooltip-email").forEach(emailLink => {
  const wrapper = document.createElement("span");
  wrapper.classList.add("email-wrapper");

  // Wrap email link
  emailLink.parentNode.insertBefore(wrapper, emailLink);
  wrapper.appendChild(emailLink);

  // Tooltip
  const tooltip = document.createElement("div");
  tooltip.classList.add("email-tooltip");

  // Display only first 20 characters + "…"
  const displayEmail = emailLink.dataset.email.length > 20
    ? emailLink.dataset.email.slice(0, 20) + "…"
    : emailLink.dataset.email;

  tooltip.innerHTML = `
  <button type="button" class="copy-btn">📧 Copy ${displayEmail}</button>
  <button type="button" class="send-btn">Send mail</button>
`;

  wrapper.appendChild(tooltip);

  // Copy full email on click
  tooltip.querySelector(".copy-btn").addEventListener("click", () => {
    navigator.clipboard.writeText(emailLink.dataset.email).then(() => {
      const btn = tooltip.querySelector(".copy-btn");
      btn.textContent = `✅ Copied!`;
      setTimeout(() => {
        btn.textContent = `📧 Copy ${displayEmail}`; // revert back to truncated display
      }, 2000);
    });
  });

  // Send
  tooltip.querySelector(".send-btn").addEventListener("click", () => {
    window.location.href = `mailto:${emailLink.dataset.email}`;
  });
});


//tooltip link
document.querySelectorAll(".tooltip-page").forEach(emailLink => {
  const wrapper = document.createElement("span");
  wrapper.classList.add("email-wrapper");

  // Wrap email link
  emailLink.parentNode.insertBefore(wrapper, emailLink);
  wrapper.appendChild(emailLink);

  // Tooltip
  const tooltip = document.createElement("div");
  tooltip.classList.add("email-tooltip");

  // Get display text without http/https/www
  let displayText = emailLink.getAttribute("href").replace(/^https?:\/\/(www\.)?/, '');

  // Limit to 20 characters
  const shortText = displayText.length > 20
    ? displayText.slice(0, 20) + "..."
    : displayText;

  tooltip.innerHTML = `
    <button type="button" class="copy-btn">🔗 Open ${shortText}</button>
  `;

  wrapper.appendChild(tooltip);

  // Open URL from the link's href
  tooltip.querySelector(".copy-btn").addEventListener("click", () => {
    const url = emailLink.getAttribute("href"); // full URL
    window.open(url, "_blank"); // open in a new tab

    // Optional: change button text temporarily
    const btn = tooltip.querySelector(".copy-btn");
    btn.textContent = `🌐 Opening...`;
    setTimeout(() => {
      btn.textContent = `🔗 Open ${shortText}`;
    }, 2000);
  });
});

//
const currentDomain = window.location.hostname;

document.querySelectorAll("a").forEach(link => {
  // Check if the link is external
  if (link.hostname && link.hostname !== currentDomain) {
    link.setAttribute("target", "_blank");
    link.setAttribute("rel", "noopener noreferrer"); // security best practice
  }
});


const hamburger = document.querySelector('.hamburger-menu');
if (hamburger) {
  hamburger.addEventListener('click', function () {
    this.classList.toggle('active');
  });

}



//header mega menu
document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".hamburger-menu");
  const menu = document.querySelector(".mega-menu");

  if (hamburger && menu) {
    hamburger.addEventListener("click", () => {
      menu.classList.toggle("active");
      hamburger.classList.toggle("open");
    });
  }
});


document.addEventListener("DOMContentLoaded", function () {
  const mainItems = document.querySelectorAll(".main-menu .menu-item-has-children > a");
  const submenuPanel = document.querySelector(".submenu-list");
  const submenuImage = document.querySelector(".submenu-image img");
  const submenuImageWrapper = document.querySelector(".submenu-image");

  let activeParent = null;
  let closeTimeout;

  function closeSubmenu(parentLi) {
    closeTimeout = setTimeout(() => {
      if (
        (!parentLi || !parentLi.matches(":hover")) &&
        !submenuPanel.matches(":hover")
      ) {
        submenuPanel.innerHTML = "";
        submenuImage.src = "";
        submenuImage.style.opacity = "0";
        submenuImageWrapper.style.visibility = "hidden"; // keep layout, hide visually
        if (parentLi) parentLi.classList.remove("open", "active");
        activeParent = null;
      }
    }, 300);
  }

  function cancelClose() {
    clearTimeout(closeTimeout);
  }

  mainItems.forEach(link => {
    const parentLi = link.parentElement;
    const submenu = parentLi.querySelector(".sub-menu");
    if (!submenu) return;

    parentLi.addEventListener("mouseenter", function () {
      if (window.innerWidth > 767.98) {
        cancelClose();
        document.querySelectorAll(".main-menu li").forEach(li => li.classList.remove("open", "active"));
        submenuPanel.innerHTML = submenu.outerHTML;
        parentLi.classList.add("open", "active");
        activeParent = parentLi;

        submenuPanel.querySelectorAll("a").forEach(item => {
          // open pdf links in a new tab
          const href = item.getAttribute("href");
          if (href && href.endsWith(".pdf")) {
            item.setAttribute("target", "_blank");
          }

          // image hover effect
          item.addEventListener("mouseenter", function () {
            

            const summerImg = this.dataset.summer;
            const winterImg = this.dataset.winter;
            const greenImg = this.dataset.green;
            const roomImg = this.dataset.room;
            const sectionImg = this.dataset.section;
            

            // Hero images pulled from Site 6 (added by PHP)
            const heroSummerImg = this.dataset.herosummer;
            const heroWinterImg = this.dataset.herowinter;
            console.log(heroSummerImg);

            // Priority order
            const imgSrc =
              sectionImg ||
              summerImg ||
              winterImg ||
              greenImg ||
              heroSummerImg ||
              heroWinterImg ||
              roomImg;

            if (imgSrc) {
              submenuImage.src = imgSrc;
              submenuImage.style.opacity = "1";
              submenuImageWrapper.style.visibility = "visible";
            } else {
              submenuImage.src = "";
              submenuImage.style.opacity = "0";
              submenuImageWrapper.style.visibility = "hidden";
            }
          });



          item.addEventListener("mouseleave", function () {
            submenuImage.src = "";
            submenuImage.style.opacity = "0";
            submenuImageWrapper.style.visibility = "hidden";
          });
        });
      }
    });

    parentLi.addEventListener("mouseleave", function () {
      if (window.innerWidth > 767.98) {
        closeSubmenu(parentLi);
      }
    });

    submenuPanel.addEventListener("mouseenter", cancelClose);
    submenuPanel.addEventListener("mouseleave", function () {
      if (activeParent && window.innerWidth > 767.98) closeSubmenu(activeParent);
    });

    link.addEventListener("click", function (e) {
      if (window.innerWidth <= 767.98) {
        e.preventDefault();
        document.querySelectorAll(".main-menu .menu-item-has-children").forEach(li => {
          if (li !== parentLi) li.classList.remove("open");
        });
        parentLi.classList.toggle("open");
      }
    });
  });

  // Also make sure any PDF links outside submenus open in new tab
  document.querySelectorAll('a[href$=".pdf"]').forEach(link => {
    link.setAttribute("target", "_blank");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const mainItems = document.querySelectorAll(".main-menu .menu-item-has-children > a");

  mainItems.forEach(link => {
    const parentLi = link.parentElement;

    // Open submenu on hover/tap
    parentLi.addEventListener("mouseenter", () => {
      // Close others first
      document.querySelectorAll(".main-menu .menu-item-has-children").forEach(li => {
        li.classList.remove("open");
      });
      parentLi.classList.add("open");
    });

    // Close submenu on leave
    parentLi.addEventListener("mouseleave", () => {
      parentLi.classList.remove("open");
    });
  });

  // Extra: close submenu if user taps outside menu on mobile
  document.addEventListener("click", function (e) {
    if (!e.target.closest(".main-menu")) {
      document.querySelectorAll(".main-menu .menu-item-has-children").forEach(li => {
        li.classList.remove("open");
      });
    }
  });
});


//

// document.addEventListener("DOMContentLoaded", function () {
//   const pdfLinks = document.querySelectorAll('a[href$=".pdf"]');

//   pdfLinks.forEach(link => {
//     link.setAttribute('target', '_blank');
//     link.setAttribute('rel', 'noopener noreferrer'); // security
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  const pdfLinks = document.querySelectorAll('a[href$=".pdf"]');
  const modal = document.getElementById('pdfModal');
  const modalIframe = modal.querySelector('iframe');
  const closeBtn = modal.querySelector('.pdf-close');

  pdfLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault(); // prevent default link behavior
      modalIframe.src = this.href; // set PDF URL in iframe
      modal.style.display = 'block';
    });
  });

  // Close modal
  closeBtn.addEventListener('click', function () {
    modal.style.display = 'none';
    modalIframe.src = ''; // clear iframe
  });

  // Close modal on click outside content
  window.addEventListener('click', function (e) {
    if (e.target === modal) {
      modal.style.display = 'none';
      modalIframe.src = '';
    }
  });
});




//
(function () {
  let lastScrollTop = 0;

  // This array holds all your container configs
  const switcherConfigs = [
    { selector: '.header-container', top: '0px', right: '-4px' },
    { selector: '.header-container-annen', top: '0px', right: '0px' },
    { selector: '.header-container-barboman', top: '24px', right: '0px' },
    { selector: '.header-container-casbar', top: '24px', right: '0px' },
    { selector: '.language-nav1', top: '-14px', right: '8px' },
    { selector: '.suites', top: '0', left: '0' }
  ];

  function moveSwitcher() {
    const switcher = document.querySelector('.trp-switcher-position-top.trp-floating-switcher');
    if (!switcher || window.innerWidth < 1024) return false;

    let moved = false;

    switcherConfigs.forEach(config => {
      const container = document.querySelector(config.selector);
      if (container) {
        container.style.position = "relative";
        container.appendChild(switcher);

        if (config.top) switcher.style.setProperty('top', config.top, 'important');
        if (config.right) switcher.style.setProperty('right', config.right, 'important');
        if (config.left) switcher.style.setProperty('left', config.left, 'important');

        switcher.style.setProperty('position', 'absolute', 'important');
        switcher.style.zIndex = "9999";
        switcher.style.transition = "opacity 0.3s ease, transform 0.3s ease";

        moved = true;
      }
    });

    return moved;
  }

  function handleScroll() {
    const switcher = document.querySelector('.trp-switcher-position-top.trp-floating-switcher');
    if (!switcher) return;

    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop && scrollTop > 50) {
      switcher.style.opacity = "0";
      switcher.style.transform = "translateY(-20px)";
    } else {
      switcher.style.opacity = "1";
      switcher.style.transform = "translateY(0)";
    }

    if (scrollTop <= 50) {
      switcher.style.opacity = "1";
      switcher.style.transform = "translateY(0)";
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  }

  window.addEventListener("DOMContentLoaded", function () {
    if (!moveSwitcher()) {
      setTimeout(moveSwitcher, 500);
    }
    window.addEventListener("scroll", handleScroll);
  });

  // Expose globally if needed
  window.moveSwitcher = moveSwitcher;
})();



(function () {
  let lastScrollTop = 0;

  // Function to move the switcher into Casbar header
  function moveSwitcher() {
    const switcher = document.querySelector('.trp-language-switcher.trp-floating-switcher.trp-ls-inline.trp-switcher-position-top');
    const container = document.querySelector('.header-container-casbar');

    if (!switcher || !container || window.innerWidth < 1024) return false;

    container.style.position = "relative";
    container.appendChild(switcher);

    switcher.style.position = "absolute";
    switcher.style.zIndex = "9999";
    switcher.style.transition = "opacity 0.3s ease, transform 0.3s ease";

    switcher.style.setProperty('top', '24px', 'important');
    switcher.style.setProperty('right', '0px', 'important');

    console.log("✅ Switcher moved into .header-container-casbar");
    return true;
  }

  // Scroll animation
  function handleScroll() {
    const switcher = document.querySelector('.trp-language-switcher.trp-floating-switcher.trp-ls-inline.trp-switcher-position-top');
    if (!switcher) return;

    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop && scrollTop > 50) {
      switcher.style.opacity = "0";
      switcher.style.transform = "translateY(-20px)";
    } else {
      switcher.style.opacity = "1";
      switcher.style.transform = "translateY(0)";
    }

    if (scrollTop <= 50) {
      switcher.style.opacity = "1";
      switcher.style.transform = "translateY(0)";
    }

    lastScrollTop = Math.max(scrollTop, 0);
  }

  // Wait until the switcher is injected
  window.addEventListener("DOMContentLoaded", function () {
    const observer = new MutationObserver(() => {
      const switcher = document.querySelector('.trp-language-switcher.trp-floating-switcher.trp-ls-inline.trp-switcher-position-top');
      const container = document.querySelector('.header-container-casbar');

      if (switcher && container) {
        moveSwitcher();
        observer.disconnect();
      }
    });

    observer.observe(document.body, { childList: true, subtree: true });
    window.addEventListener("scroll", handleScroll);
  });

})();

//

(function () {
  let lastScrollTop = 0;

  function moveSwitcher() {
    const switcher = document.querySelector('.trp-language-switcher.trp-floating-switcher.trp-ls-inline.trp-switcher-position-top');
    const container = document.querySelector('.header-container-barboman');

    if (!switcher) {
      console.warn("Switcher NOT found on Barboman page");
      return false;
    } else {
      console.log("Switcher found:", switcher);
    }

    if (!container) {
      console.warn("Container .header-container-barboman NOT found!");
      return false;
    } else {
      console.log("Container found:", container);
    }

    if (window.innerWidth < 1024) {
      console.log("Window width < 1024px, skipping move");
      return false;
    }

    container.style.position = "relative";
    container.appendChild(switcher);

    switcher.style.position = "absolute";
    switcher.style.zIndex = "9999";
    switcher.style.transition = "opacity 0.3s ease, transform 0.3s ease";

    // Update CSS variables to override TranslatePress inline styles
    switcher.style.setProperty('top', '24px', 'important');
    switcher.style.setProperty('right', '0px', 'important');

    console.log("✅ Switcher moved into .header-container-barboman with CSS variables");
    return true;
  }

  function handleScroll() {
    const switcher = document.querySelector('.trp-language-switcher.trp-floating-switcher.trp-ls-inline.trp-switcher-position-top');
    if (!switcher) return;

    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop && scrollTop > 50) {
      switcher.style.opacity = "0";
      switcher.style.transform = "translateY(-20px)";
    } else {
      switcher.style.opacity = "1";
      switcher.style.transform = "translateY(0)";
    }

    if (scrollTop <= 50) {
      switcher.style.opacity = "1";
      switcher.style.transform = "translateY(0)";
    }

    lastScrollTop = Math.max(scrollTop, 0);
  }

  window.addEventListener("DOMContentLoaded", function () {
    console.log("DOM loaded — starting observer for Barboman switcher");

    const observer = new MutationObserver(() => {
      const switcher = document.querySelector('.trp-language-switcher.trp-floating-switcher.trp-ls-inline.trp-switcher-position-top');
      const container = document.querySelector('.header-container-barboman');

      if (switcher && container) {
        console.log("Switcher and container detected by observer");
        moveSwitcher();
        observer.disconnect();
      } else {
        if (!switcher) console.log("Observer: Switcher not yet in DOM");
        if (!container) console.log("Observer: Container not yet in DOM");
      }
    });

    observer.observe(document.body, { childList: true, subtree: true });
    window.addEventListener("scroll", handleScroll);
  });

})();


// document.addEventListener("DOMContentLoaded", function () {
//     const downloadBtn = document.querySelector(".download-btn");

//     if (downloadBtn) {
//         downloadBtn.addEventListener("click", async function (e) {
//             e.preventDefault();

//             const zip = new JSZip();
//             const galleryImages = document.querySelectorAll(".image-gallery-section img");

//             if (galleryImages.length === 0) {
//                 alert("No images found to download.");
//                 return;
//             }

//             let count = 0;

//             galleryImages.forEach(async (img, index) => {
//                 try {
//                     const url = img.src;
//                     const response = await fetch(url);
//                     const blob = await response.blob();
//                     zip.file("image-" + (index + 1) + ".jpg", blob);
//                     count++;

//                     if (count === galleryImages.length) {
//                         zip.generateAsync({ type: "blob" }).then(function (content) {
//                             const link = document.createElement("a");
//                             link.href = URL.createObjectURL(content);
//                             link.download = "gallery-images.zip";
//                             link.click();
//                         });
//                     }
//                 } catch (err) {
//                     console.error("Error downloading image:", img.src, err);
//                 }
//             });
//         });
//     }
// });


document.addEventListener("DOMContentLoaded", function () {
  const downloadBtn = document.getElementById("hc-gallery");

  if (downloadBtn) {
    downloadBtn.addEventListener("click", async function (e) {
      e.preventDefault();

      const zip = new JSZip();
      const galleryImages = document.querySelectorAll(".image-gallery-section img");

      if (galleryImages.length === 0) {
        alert("No images found to download.");
        return;
      }

      let count = 0;

      galleryImages.forEach(async (img, index) => {
        try {
          const url = img.src;
          const response = await fetch(url);
          const blob = await response.blob();
          zip.file("image-" + (index + 1) + ".jpg", blob);
          count++;

          if (count === galleryImages.length) {
            zip.generateAsync({ type: "blob" }).then(function (content) {
              const link = document.createElement("a");
              link.href = URL.createObjectURL(content);
              link.download = "gallery-images.zip";
              link.click();
            });
          }
        } catch (err) {
          console.error("Error downloading image:", img.src, err);
        }
      });
    });
  }
});




// 
// document.addEventListener("DOMContentLoaded", function() {
//   const langItems = document.querySelectorAll(".trp-language-item-name");

//   langItems.forEach(item => {
//     item.style.setProperty("font-size", "16px", "important");
//     item.style.setProperty("font-family", "Instrument Sans", "important");
//     item.style.setProperty("font-weight", "600", "important"); // optional
//   });
// });


// 
document.addEventListener("DOMContentLoaded", function () {
  const switcher = document.querySelector(".trp-language-switcher-inner");
  if (!switcher) return;

  const items = switcher.querySelectorAll(".trp-language-item");

  // Only add separator if there are at least two items
  if (items.length > 1) {
    // Loop through all except the last item
    items.forEach((item, index) => {
      if (index < items.length - 1) {
        const separator = document.createElement("span");
        separator.textContent = " / ";
        separator.classList.add("trp-lang-separator");
        separator.style.cssText = "margin: 0 4px; font-weight: 400; color: #fff; ";
        item.after(separator);
      }
    });
  }
});

//
document.addEventListener("DOMContentLoaded", function () {
  const langItems = document.querySelectorAll(".trp-language-item");

  langItems.forEach(item => {
    item.style.setProperty("padding", "7px 3px", "important");
    item.style.setProperty("align-items", "flex-start", "important");
  });
});

// 
document.addEventListener("DOMContentLoaded", function () {
  const items = document.querySelectorAll(".trp-language-item");

  items.forEach(item => {
    const name = item.querySelector(".trp-language-item-name");
    if (!name) return;

    if (item.classList.contains("trp-language-item__current")) {
      // Active language
      name.style.setProperty("color", "#fff", "important");
      name.style.setProperty("font-weight", "600", "important");
    } else {
      // Non-active languages
      name.style.setProperty("color", "#FFFFFFCC", "important");
    }

    // Optional shared styles
    name.style.setProperty("font-size", "13px", "important");
    name.style.setProperty("font-family", '"Instrument Sans", sans-serif', "important");
    // name.style.setProperty("font-weight", "600", "important");
  });
});
