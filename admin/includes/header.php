<?php
    header('Content-Type: text/html; charset=ISO-8859-1');
    session_start();
?>
<?php include("db.php"); ?>
<?php include("admin/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog CMS</title>

    <link href="favicon_.ico" rel="icon" type="image/x-icon" />

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/styles.css" rel="stylesheet">

  </head>

  <body>

  <button id="goToTop" title="Go to top"><span></span></button>

