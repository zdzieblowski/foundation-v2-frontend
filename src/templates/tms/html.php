<head>
  <link rel="stylesheet" type="text/css" href="templates/<?php echo $configuration['page_template']; ?>/css/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

  <link rel="shortcut icon" href="templates/<?php echo $configuration['page_template']; ?>/assets/favicon.ico">
  <link rel="icon" type="image/svg+xml" href="templates/<?php echo $configuration['page_template']; ?>/assets/favicon.svg">
  <link rel="icon" type="image/png" href="templates/<?php echo $configuration['page_template']; ?>/assets/favicon-96x96.png" sizes="96x96">

  <link rel="manifest" href="templates/<?php echo $configuration['page_template']; ?>/assets/site.webmanifest">

  <meta name="apple-mobile-web-app-title" content="<?php echo $configuration['page_short_title']; ?>">
  <link rel="apple-touch-icon" href="templates/<?php echo $configuration['page_template']; ?>/assets/apple-touch-icon.png" sizes="180x180">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">

  <?php
  if (!empty($pool)) {
    $page_title = $configuration['page_title'] . ': ' . $pool_configuration['title'];
  ?>
  <script src="common/methods.js"></script>
  <style>
    :root {
      --color-pool:
        <?php echo $pool_configuration['color']; ?>
      ;
    }
  </style>
  <?php
  } else {
    $page_title = $configuration['page_title'];
  }
  ?>

  <title><?php echo $page_title; ?></title>
</head>
