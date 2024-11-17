<?php require_once('common/configuration.php'); ?>
<?php require_once('common/methods.php'); ?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo($configuration['page_title']);?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo($configuration['page_stylesheet']);?>"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=dashboard,explore,group,home,payments,star_rate,volunteer_activism"/>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>

    <div class="header">
      <div class="width_limit header_grid">
        <div class="header_top">
          <img src="img/zp.svg" height="24"/>
          <div class="header_top_right">
            <div class="header_info"><?php echo($configuration['pool_name']); ?></div>
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
          <a href="/"><?php echo($_SERVER['SERVER_NAME']); ?></a> / <?php echo($_GET['page']); ?>
        </div>
        <div class="footer_content_right">
          <div><a href="?page=donate"><span class="material-symbols-outlined">volunteer_activism</span></a></div>
          <div><a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="img/github.svg" height="24"/></a></div>
        </div>
      </div>
    </div>

  </body>
</html>
