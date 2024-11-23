<?php require_once('common/methods.php'); ?>
<?php require_once('common/configuration.php'); ?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo($frontend_configuration['page_title']); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $frontend_configuration['page_theme_path'].$frontend_configuration['page_stylesheet'];?>"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="<?php echo $frontend_configuration['page_theme_path']; ?>favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?php echo $frontend_configuration['page_theme_path']; ?>favicon.svg" />
    <link rel="shortcut icon" href="<?php echo $frontend_configuration['page_theme_path']; ?>favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $frontend_configuration['page_theme_path']; ?>apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="TMS" />
    <link rel="manifest" href="<?php echo $frontend_configuration['page_theme_path']; ?>site.webmanifest" />
    <script>
      function revealContent(elementId) {
        if (document.getElementById(elementId).classList.contains('hidden')) {
          document.getElementById(elementId).classList.toggle('shown');
        }
      };
    </script>
  </head>
  <body>
    <div class="header">
      <div class="width_limit header_grid">
        <div class="header_top">
          <img src="<?php echo $frontend_configuration['page_theme_path'].$frontend_configuration['page_logotype']; ?>" height="33"/>
          <div class="header_top_right">
            <div class="header_info"><?php echo($_SERVER['SERVER_NAME']); ?>/<?php echo($server_configuration['symbol']); ?></div>
            <div><a class="header_navi_item" href="/"><span class="material-symbols-outlined">home</span></a></div>
          </div>
        </div>
        <div class="header_navi">
          <a class="header_navi_item header_navi_item_text" href="/?page=dashboard"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
          <a class="header_navi_item header_navi_item_text" href="/?page=miners"><span class="material-symbols-outlined">group</span>Miners & workers</a>
          <a class="header_navi_item header_navi_item_text" href="/?page=blocks"><span class="material-symbols-outlined">star_rate</span>Blocks & rounds</a>
          <a class="header_navi_item header_navi_item_text" href="/?page=payments"><span class="material-symbols-outlined">payments</span>Payments</a>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="width_limit">
        <div class="content_content">
          <?php
            switch($_GET['page']) {
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
              case 'payments':
                include('pages/payments.php');
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
          2024+ &copy; <a href="/"><?php echo($_SERVER['SERVER_NAME']); ?></a>
        </div>
        <div class="footer_content_right">
          <div><a href="/?page=donate"><span class="material-symbols-outlined">volunteer_activism</span></a></div>
          <div><a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="common/img/github.svg" height="24"/></a></div>
        </div>
      </div>
    </div>
  </body>
</html>

