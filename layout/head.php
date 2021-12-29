<!DOCTYPE html>
<!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="<?= setting('keyword'); ?>" />
    <meta name="author" content="DucThanh IT" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= setting('description'); ?>" />
    <meta property="og:title" content="<?= $title; ?>" />
    <meta property="og:description" content="<?= setting('description'); ?>" />
    <meta property="og:image" content="<?= setting('og_image'); ?>" />

    <!-- PAGE TITLE HERE -->
    <title><?= $title; ?> | <?= setting('website_name'); ?></title>

    <!-- FAVICONS ICON -->
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/jquery_3.6.0.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="<?= setting('favicon'); ?>" />
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/chartist.min.css">
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/nice-select.css" rel="stylesheet">
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <!-- Style css -->
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/style.css?<?= time(); ?>" rel="stylesheet">
    <link href="http://www.cdn.cascompany.net/web/css/icons/flaticon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/owl.carousel.min.css" rel="stylesheet">
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/owl.theme.default.min.css" rel="stylesheet">
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/js/swiper.js" ></script>

    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/animate.css" rel="stylesheet">
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/swiper.css" rel="stylesheet">
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/select2.css" rel="stylesheet">
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/select2.min.css" rel="stylesheet">
    <link href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</head>
<!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->
<style>
.container-fluid {
       position: relative;
  }
  @media (min-width: 640px) {
      .container-fluid {
          max-width: 640px;
      }
  }
  @media (min-width: 768px) {
      .container-fluid {
          max-width: 768px;
      }
  }
  @media (min-width: 1024px) {
      .container-fluid {
          max-width: 1024px;
      }
  }
  @media (min-width: 1200px) {
      .container-fluid {
          width: 1280px;
      }
  }
  @media (min-width: 1280px) {
      .container-fluid {
          max-width: 1280px;
      }
  }
  @media (min-width: 1536px) {
      .container-fluid {
          max-width: 1536px;
      }
  }

  <?php if(setting('theme_mode') == 'dark') { ?>
    label .jzon_custom .swal2-html-container {
        color: white!important;
    }
    <?php
        $mode = "color: white!important;";
    ?>
  <?php } ?>

  <?php if(setting('theme_mode') == 'light') { ?>
    .jzon_custom {
        color: black!important;
    }
    <?php
        $mode = "color: black!important;";
    ?>
  <?php } ?>
</style>

