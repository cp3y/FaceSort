<?php
session_cache_limiter('private, must-revalidate');
session_start();

if (!isset($_SESSION["USERID"])) {
    header("Location: loginexe.php");
    exit;
}