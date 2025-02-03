<?php
include 'templates/'.$configuration['page_template'].'/head.php';
?>
  <div class="header">
    <div class="width_limit header_grid">
      <div class="header_top">
        <div style="display: grid; grid-template-columns: min-content min-content; gap: 16px; align-items: center;">
          <div>
            <a class="header_navi_item <?php if(!$_GET['page']) {echo 'header_navi_item_select';}?>" href="<?php echo '?pool='.$pool; ?>">
              <span class="material-symbols-outlined">home</span>
            </a>
          </div>
          <div style="width: min-content;">
            <svg xmlns="http://www.w3.org/2000/svg" id="logo" version="1.1" viewBox="0 0 622.2 329.2" style="height: 33px;">
              <defs>
                <style>
                  .st0 {
                    fill: <?php echo $pool_configuration['color'];?>;
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
            <div><b style="color: var(--color-pool);"><?php echo ($server_configuration['symbol']); ?></b></div>
          </div>
          <div>
            <a class="header_navi_item" href="/">
              <span class="material-symbols-outlined">logout</span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_navi">
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'dashboard') {echo 'header_navi_item_select';}?>" href="?pool=<?php echo $pool; ?>&page=dashboard">
          <span class="material-symbols-outlined">dashboard</span>
          Dashboard
        </a>
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'miners') {echo 'header_navi_item_select';}?>" href="?pool=<?php echo $pool; ?>&page=miners">
          <span class="material-symbols-outlined">group</span>
          Miners
        </a>
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'rounds') {echo 'header_navi_item_select';}?>" href="?pool=<?php echo $pool; ?>&page=rounds">
          <span class="material-symbols-outlined">cached</span>
          Rounds
        </a>
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'blocks') {echo 'header_navi_item_select';}?>" href="?pool=<?php echo $pool; ?>&page=blocks">
          <span class="material-symbols-outlined">star_rate</span>
          Blocks
        </a>
        <a class="header_navi_item header_navi_item_text <?php if($_GET['page'] == 'transactions') {echo 'header_navi_item_select';}?>" href="?pool=<?php echo $pool; ?>&page=transactions">
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
          case 'rounds':
            include('pages/rounds.php');
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
        2024+ &copy; <?php echo $_SERVER['SERVER_NAME'].'/';?><a href="<?php echo '?pool='.$pool; ?>"><?php echo $server_configuration['symbol']; ?></a>
        <br>
        <pre style="margin: unset; padding: unset; font-family: inherit; color: #666;">        VERSION <b><?php echo $configuration['version']; ?></b></pre>
      </div>
      <div class="footer_content_right">
        <div>
          <a href="?pool=<?php echo $pool; ?>&page=donate"><span class="material-symbols-outlined">volunteer_activism</span></a>
        </div>
        <div>
          <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="common/assets/github.svg" height="24" alt></a>
        </div>
      </div>
    </div>
  </div>
