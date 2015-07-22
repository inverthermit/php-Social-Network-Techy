<?php
ob_start();
session_start();
$_SESSION=array();
header("location:index.html");
?>