<?php
date_default_timezone_set("Asia/Jakarta");
session_start();

$connect = new PDO("mysql:host=localhost;dbname=latihan_chat;port=3306;charset=utf8mb4", "root", "");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);