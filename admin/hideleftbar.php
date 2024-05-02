<?php
// Set a cookie to indicate the sidebar should be hidden
setcookie("hide_sidebar", "true", time() + (86400 * 30), "/"); // 86400 = 1 day

// Redirect back to the previous page or any specific page
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
