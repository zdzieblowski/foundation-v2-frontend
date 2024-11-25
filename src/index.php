<?php require_once('common/methods.php'); ?>
<?php require_once('common/configuration.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo ($frontend_configuration['page_title']); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo $frontend_configuration['page_subfolder'].$frontend_configuration['page_theme_path'].$frontend_configuration['page_stylesheet']; ?>" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="icon" type="image/png" href="<?php echo $frontend_configuration['page_subfolder'].$frontend_configuration['page_theme_path']; ?>favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="<?php echo $frontend_configuration['page_subfolder'].$frontend_configuration['page_theme_path']; ?>favicon.svg" />
  <link rel="shortcut icon" href="<?php echo $frontend_configuration['page_subfolder'].$frontend_configuration['page_theme_path']; ?>favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $frontend_configuration['page_subfolder'].$frontend_configuration['page_theme_path']; ?>apple-touch-icon.png" />
  <link rel="manifest" href="<?php echo $frontend_configuration['page_subfolder'].$frontend_configuration['page_theme_path']; ?>site.webmanifest" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="apple-mobile-web-app-title" content="TMS" />
  <script src="common/methods.js"></script>
</head>

<body>
  <div class="header">
    <div class="width_limit header_grid">
      <div class="header_top">
        <a href="/"><img src="<?php echo $frontend_configuration['page_theme_path'] . $frontend_configuration['page_logotype']; ?>" height="33" /></a>
        <div class="header_top_right">
          <div class="header_info">
            <?php echo ($_SERVER['SERVER_NAME']); ?>/<?php echo ($server_configuration['symbol']); ?>
          </div>
          <div><a class="header_navi_item" href="<?php echo $frontend_configuration['page_subfolder']; ?>"><span class="material-symbols-outlined">home</span></a></div>
        </div>
      </div>
      <div class="header_navi">
        <a class="header_navi_item header_navi_item_text" href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=dashboard">
          <span class="material-symbols-outlined">dashboard</span>
          Dashboard
        </a>
        <a class="header_navi_item header_navi_item_text" href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=miners">
          <span class="material-symbols-outlined">group</span>
          Miners
        </a>
        <a class="header_navi_item header_navi_item_text" href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=blocks">
          <span class="material-symbols-outlined">star_rate</span>
          Blocks
        </a>
        <a class="header_navi_item header_navi_item_text" href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=transactions">
          <span class="material-symbols-outlined">payments</span>
          Transactions
        </a>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="width_limit">
      <div class="content_content">
        <?php
        switch ($_GET['page']) {
          case '':
            include('pages/home.php');
            break;
          case 'dashboard':
            include('pages/dashboard.php');
            break;
          case 'miners':
            include('pages/miners.php');
            break;
          case 'blocks':
            include('pages/blocks.php');
            break;
          case 'transactions':
            include('pages/transactions.php');
            break;
          case 'donate':
            include('pages/donate.php');
            break;
          default:
            include('pages/404.php');
            break;
        }
        ?>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="width_limit footer_content">
      <div class="footer_content_left">
        2024+ &copy; <a href="<?php echo $frontend_configuration['page_subfolder']; ?>"><?php echo $_SERVER['SERVER_NAME'].'/'.$server_configuration['symbol']; ?></a>
      </div>
      <div class="footer_content_right">
        <div><a href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=donate"><span class="material-symbols-outlined">volunteer_activism</span></a></div>
        <div><a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="common/img/github.svg" height="24" /></a></div>
      </div>
    </div>
  </div>
</body>

</html>
