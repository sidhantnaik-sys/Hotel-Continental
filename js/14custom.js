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


document.querySelector('.hamburger-menu').addEventListener('click', function () {
  this.classList.toggle('active');
});



//header mega menu
document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".hamburger-menu");
  const menu = document.querySelector(".mega-menu");

  hamburger.addEventListener("click", () => {
    menu.classList.toggle("active");
    hamburger.classList.toggle("open");
  });
});


document.addEventListener("DOMContentLoaded", function () {
  const mainItems = document.querySelectorAll(".main-menu .menu-item-has-children > a");
  const submenuPanel = document.querySelector(".submenu-list");
  const submenuImage = document.querySelector(".submenu-image img");

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

    // ✅ Desktop hover
    parentLi.addEventListener("mouseenter", function () {
      if (window.innerWidth > 767.98) {
        cancelClose();
        document.querySelectorAll(".main-menu li").forEach(li => li.classList.remove("open", "active"));
        submenuPanel.innerHTML = submenu.outerHTML;
        parentLi.classList.add("open", "active");
        activeParent = parentLi;

        submenuPanel.querySelectorAll("a").forEach(item => {
          item.addEventListener("mouseenter", function () {
            const summerImg = this.dataset.summer;
            const winterImg = this.dataset.winter;
            if (summerImg) {
              submenuImage.src = summerImg;
              submenuImage.style.opacity = "1";
            } else if (winterImg) {
              submenuImage.src = winterImg;
              submenuImage.style.opacity = "1";
            }
          });

          item.addEventListener("mouseleave", function () {
            submenuImage.src = "";
            submenuImage.style.opacity = "0";
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
          if (li !== parentLi) {
            li.classList.remove("open");
          }
        });


        parentLi.classList.toggle("open");
      }
    });
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

document.addEventListener("DOMContentLoaded", function () {
  const pdfLinks = document.querySelectorAll('a[href$=".pdf"]');

  pdfLinks.forEach(link => {
    link.setAttribute('target', '_blank');
    link.setAttribute('rel', 'noopener noreferrer'); // security
  });
});

//
(function () {
  let lastScrollTop = 0;

  // This array holds all your container configs
  const switcherConfigs = [
    { selector: '.header-container', top: '0px', right: '-12px' },
    { selector: '.header-container-annen', top: '0px', right: '-12px' },
    { selector: '.header-container-barboman', top: '0px', right: '-12px' },
    { selector: '.language-nav1', top: '-9px', right: '-1px' },
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


