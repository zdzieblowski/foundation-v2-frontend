<?php
switch ($_GET['page']) {
  case '':
    include 'pages/home.php';
    break;
  case 'dashboard':
    include 'pages/dashboard.php';
    break;
  case 'miners':
    include 'pages/miners.php';
    break;
  case 'rounds':
    include 'pages/rounds.php';
    break;
  case 'blocks':
    include 'pages/blocks.php';
    break;
  case 'transactions':
    include 'pages/transactions.php';
    break;
  case 'donate':
    include 'pages/donate.php';
    break;
  default:
    include 'pages/404.php';
    break;
}
?>