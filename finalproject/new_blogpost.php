<?php
session_start();
// Redirect if user not logged in
if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	die();
}
include('header.php');
include('functions.php');
include('mysqli_connect.php');
