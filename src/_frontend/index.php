<?php require_once('common/methods.php'); ?>
<?php require_once('../'.$pool.'/configuration.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <title><?php echo $frontend_configuration['page_title']; ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo '../_common/'.$frontend_configuration['page_theme_path'].$frontend_configuration['page_stylesheet']; ?>" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="icon" type="image/png" href="<?php echo '../_common/'.$frontend_configuration['page_theme_path']; ?>favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="<?php echo '../_common/'.$frontend_configuration['page_theme_path']; ?>favicon.svg" />
  <link rel="shortcut icon" href="<?php echo '../_common/'.$frontend_configuration['page_theme_path']; ?>favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo '../_common/'.$frontend_configuration['page_theme_path']; ?>apple-touch-icon.png" />
  <link rel="manifest" href="<?php echo '../_common/'.$frontend_configuration['page_theme_path']; ?>site.webmanifest" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="apple-mobile-web-app-title" content="TMS" />
  <script src="../_frontend/common/methods.js"></script>
  <style>
    :root {
      --pool_color: <?php echo $frontend_configuration['pool_color']; ?>;
    }
  </style>
</head>

<body>
  <div class="header">
    <div class="width_limit header_grid">
      <div class="header_top">
        <div style="display: grid; grid-template-columns: min-content min-content; gap: 16px; align-items: center;">
          <div>
            <a class="header_navi_item <?php if(!$_GET['page']) {echo 'header_navi_item_select';}?>" href="<?php echo $frontend_configuration['page_subfolder']; ?>">
              <span class="material-symbols-outlined">home</span>
            </a>
          </div>
          <div style="width: min-content;">
            <svg xmlns="http://www.w3.org/2000/svg" id="logo" version="1.1" viewBox="0 0 622.2 329.2" style="height: 33px;"><script xmlns=""/>
              <defs>
                <style>
                  .st0 {
                    fill: <?php echo $frontend_configuration['pool_color'];?>;
                  }
                </style>
              </defs>
              <polygon class="st0" points="353 328 622.2 328 500.2 159.4 542.3 0 26 0 0 100 68.3 100 8.6 329.2 112 329.2 171.7 100 240.1 100 180.4 329.2 283.7 329.2 343.4 100 412.5 100 398.2 153.9 391.5 179.8 426.4 228 379 228 353 328"/>
            </svg>
          </div>
        </div>
        <div class="header_top_right">
          <div class="header_info">
            <div><?php echo ($_SERVER['SERVER_NAME']); ?>/</div>
            <div><b style="color: var(--pool_color);"><?php echo ($server_configuration['symbol']); ?></b></div>
          </div>
          <div>
            <a class="header_navi_item" href="/">
              <span class="material-symbols-outlined">logout</span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_navi">
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'dashboard') {echo 'header_navi_item_select';}?>" href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=dashboard">
          <span class="material-symbols-outlined">dashboard</span>
          Dashboard
        </a>
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'miners') {echo 'header_navi_item_select';}?>" href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=miners">
          <span class="material-symbols-outlined">group</span>
          Miners
        </a>
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'blocks') {echo 'header_navi_item_select';}?>" href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=blocks">
          <span class="material-symbols-outlined">star_rate</span>
          Blocks
        </a>
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'transactions') {echo 'header_navi_item_select';}?>" href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=transactions">
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
        <br>
        <pre style="margin: unset; padding: unset; font-family: inherit; color: #666;">        VERSION <b><?php echo $frontend_configuration['version']; ?></b></pre>
      </div>
      <div class="footer_content_right">
        <div>
          <a href="<?php echo $frontend_configuration['page_subfolder']; ?>?page=donate"><span class="material-symbols-outlined">volunteer_activism</span></a>
        </div>
        <div>
          <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="../_common/images/github.svg" height="24" /></a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>