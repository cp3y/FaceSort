<?php
require_once(dirname(__FILE__) . '/../../../lib/database.php');
include(dirname(__FILE__) . '/../common/chkLogin.php');

$sql ='UPDATE image SET good = good + 1 WHERE no = %d';
$sql2 = "UPDATE user SET good = CONCAT(good,',%d'), count = count + 1 WHERE name = '%s'";
$sql3 ='UPDATE image SET bad = bad + 1 WHERE no = %d';
$sql4 = "UPDATE user SET bad = CONCAT(bad,',%d'), count = count + 1 WHERE name = '%s'";

$access = new DBclass;

if (isset($_POST["good"])) {
    // バインド
    $sql = sprintf($sql, $_SESSION[NO]);
    $access->updateMysql($sql);
	
    // バインド
    $sql2 = sprintf($sql2, $_SESSION[NO], $_SESSION["USERID"]);
    $access->updateMysql($sql2);
}

if (isset($_POST["bad"])) {
    // バインド
    $sql3 = sprintf($sql3, $_SESSION[NO]);
    $access->updateMysql($sql3);
	
    // バインド
    $sql4 = sprintf($sql4, $_SESSION[NO], $_SESSION["USERID"]);
    $access->updateMysql($sql4);
}

header('Location: interest.php');
