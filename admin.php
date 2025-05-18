<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: admin_login.php");
  exit;
}
 /* Admin login + dashboard with filters */ ?><?php /* Admin login + dashboard with filters */ ?>