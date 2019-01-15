<?php
header("content-type:text.html;charset=utf8");

$hostname = "localhost";
$uname = "root";
$pwd = "";
$hname = "";

$conn = new mysqli($hostname, $uname, $pwd, $hname);


if ($coon->connect_error) {
    die("连接失败" . $conn->connect_error);
}

$conn->query("set names utf8");





?>