<?php
session_start();
require_once ('inc/fonctions.inc.php');
$msg = '';
$pdo = new PDO("mysql:host=localhost;dbname=tchat", 'root' , '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
