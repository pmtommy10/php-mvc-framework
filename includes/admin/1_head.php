<?php use App\Controllers\AdminController; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/img/logo.png" type="image/x-icon">
    <!-- <base href="/grandtour/" target="_self"> -->
    <link rel="shortcut icon" href="//easyweb-thailand.com/assets/img/easyweb_thailand_logo_v3.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="//easyweb-thailand.com/assets/img/easyweb_thailand_logo_v3.png">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <link rel="stylesheet" href="/assets/css/admin-style.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/assets/css/color.css?v=0.1">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/fc-3.2.5/fh-3.1.4/r-2.2.2/sl-1.3.0/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/css/lity.min.css">
    <title><?= $pageHeader['pageTitle'] ?? null ?> :: ระบบจัดการข้อมูลเว็บไซต์</title>
</head>

<body style="background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);">