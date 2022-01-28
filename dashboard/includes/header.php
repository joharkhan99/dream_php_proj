<?php
if (empty($_COOKIE["_uacct_"]) || !isset($_COOKIE["_uacct_"])) {
  header("Location: ../login.php");
  die();
} elseif (isset($_COOKIE["_uacct_"])) {
  include "../ajax/functions.php";
  if (!userKeyExists($_COOKIE["_uacct_"])) {
    header("Location: ../login.php");
    die();
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sb-admin-2.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <title>Dashboard</title>
</head>

<body id="page-top">