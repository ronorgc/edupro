<?php
// Layout wrapper: header + sidebar + content + footer
require __DIR__ . '/header.php';
require __DIR__ . '/sidebar.php';
// Absolute path to the specific content view is provided by the controller
require $contentViewPath;
require __DIR__ . '/footer.php';
?>
