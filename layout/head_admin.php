<!DOCTYPE html>
<!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1" />

        <title><?= $title; ?> - Quản trị viên</title>

        <!-- include common vendor stylesheets & fontawesome -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/jquery_3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">

        <!-- include fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">

        <!-- ace.css -->
        <link rel="stylesheet" type="text/css" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/admin/dist/css/admin.css?<?= time(); ?>" />
        <link rel="stylesheet" type="text/css" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/admin/dist/css/ace.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/fc-3.3.3/fh-3.1.9/r-2.2.9/sc-2.0.4/sb-1.1.0/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/fc-3.3.3/fh-3.1.9/r-2.2.9/sc-2.0.4/sb-1.1.0/datatables.min.js" defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
        <!-- favicon -->
        <link rel="icon" type="image/png" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/admin/assets/favicon.png" />

    </head>