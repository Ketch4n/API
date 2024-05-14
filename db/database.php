<?php
include("header.php");

$HostName = "localhost";
$DatabaseName = "attendance_monitoring";
$HostUser = "root";
$HostPass = "";

// $HostName = "srv1151.hstgr.io";
// $DatabaseName = "u880981518_attendance";
// $HostUser = "u880981518_nmscst";
// $HostPass = "NMsCST@2023";

$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
