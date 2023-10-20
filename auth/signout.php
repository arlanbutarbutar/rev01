<?php if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION["data-user"])) {
  $_SESSION = [];
  session_unset();
  session_destroy();
  header("Location: ./");
  exit();
}
