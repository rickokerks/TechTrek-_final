<?php
session_start();
$_SESSION = [];
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', 0, '/');
}
session_destroy();
header("Location: index.html");
exit;
?>