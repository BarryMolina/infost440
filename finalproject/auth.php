<?php
// Start session and initialize auth variables
session_start();
// User authorization
$logged_in = isset($_SESSION['user_id']);
$current_user_id = $logged_in ? $_SESSION['user_id'] : '';
$is_admin = $current_user_id == 1;
