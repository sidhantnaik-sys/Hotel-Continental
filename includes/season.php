<?php
$month = date('n');
$GLOBALS['season'] = in_array($month, [4, 5, 6, 7]) ? 'summer' : 'winter';
?>