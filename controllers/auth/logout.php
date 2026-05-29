<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];

session_unset();

session_destroy();

header("Location: /SiBuba/index.php?page=login");
exit;

?>