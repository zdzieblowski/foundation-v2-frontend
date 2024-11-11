<?php require_once('common/configuration.php'); ?>

<html>
  <head>
    <title><?php echo($configuration['page_title']);?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo($configuration['page_stylesheet']);?>"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=dashboard,group,home,payments,star_rate" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="header">
      <div class="width_limit header_grid">
        <div class="header_top">
          <img src="img/zp.svg" height="24" />
          <div class="header_top_right">
            <div class="header_info"><?php echo($configuration['pool_name']);?></div>
            <div><a class="header_navi_item" href="/"><span class="material-symbols-outlined">home</span></a></div>
          </div>
        </div>
        <div class="header_navi">
          <a class="header_navi_item header_navi_item_text" href="/?page=dashboard&address=<?php ?>"><span class="material-symbols-outlined">dashboard</span>dashboard</a>
          <a class="header_navi_item header_navi_item_text" href="/?page=miners"><span class="material-symbols-outlined">group</span>miners</a>
          <a class="header_navi_item header_navi_item_text" href="/?page=blocks"><span class="material-symbols-outlined">star_rate</span>blocks</a>
          <a class="header_navi_item header_navi_item_text" href="/?page=payments"><span class="material-symbols-outlined">payments</span>payments</a>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="width_limit">
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
            default:
              echo 'między cztery pcha się zero - fatalny error';
              break;
          }
        ?>
      </div>
    </div>

    <div class="footer">
      <div class="width_limit">
        <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="img/github.svg" height="24" /></a>
      </div>
    </div>
  </body>
</html>
