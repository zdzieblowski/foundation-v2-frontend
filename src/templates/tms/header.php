<div class="header">
  <div class="width_max header_content">
    <div class="header_top">
      <div class="header_top_left">
        <?php if (empty($pool)) { ?>
        <div>
          <a class="header_navi_item">
            <span class="material-symbols-outlined">
              <?php echo getRandomEmote(); ?>
            </span>
          </a>
        </div>
        <?php } else { ?>
        <div>
          <a class="header_navi_item <?php if (!$_GET['page']) { echo 'header_navi_item_select'; } ?>" href="<?php echo '?pool=' . $pool; ?>">
            <span class="material-symbols-outlined">home</span>
          </a>
        </div>
        <?php } ?>

        <div class="width_min">
          <svg xmlns="http://www.w3.org/2000/svg" id="logo" version="1.1" viewBox="0 0 622.2 329.2" class="logo_height">
            <defs>
              <style>
                .st0 {
                  fill: <?php echo empty($pool) ? '#eee' : $pool_configuration['color']; ?>;
                }
              </style>
            </defs>
            <polygon class="st0" points="353 328 622.2 328 500.2 159.4 542.3 0 26 0 0 100 68.3 100 8.6 329.2 112 329.2 171.7 100 240.1 100 180.4 329.2 283.7 329.2 343.4 100 412.5 100 398.2 153.9 391.5 179.8 426.4 228 379 228 353 328" />
          </svg>
        </div>
      </div>
      <div class="header_top_right">
        <div class="header_info">
          <div><?php echo getServerVariable('SERVER_NAME'); ?>/</div>

    <?php if(empty($pool)) { ?>

        </div>
        <div>
          <a class="header_navi_item" href="/">
            <span class="material-symbols-outlined">refresh</span>
          </a>
        </div>
      </div>
    </div>

    <?php } else { ?>

          <div><b class="color_pool"><?php echo $server_configuration['symbol']; ?></b></div>
        </div>
        <div>
          <a class="header_navi_item" href="/">
            <span class="material-symbols-outlined">logout</span>
          </a>
        </div>
      </div>
    </div>
    <div class="header_navi">
        <a class="header_navi_item header_navi_item_text <?php if ($_GET['page'] == 'dashboard') { echo 'header_navi_item_select'; } ?>" href="?pool=<?php echo $pool; ?>&page=dashboard">
          <span class="material-symbols-outlined">dashboard</span>
          Dashboard
        </a>
        <a class="header_navi_item header_navi_item_text <?php if ($_GET['page'] == 'miners') { echo 'header_navi_item_select'; } ?>" href="?pool=<?php echo $pool; ?>&page=miners">
          <span class="material-symbols-outlined">group</span>
          Miners
        </a>
        <a class="header_navi_item header_navi_item_text <?php if ($_GET['page'] == 'rounds') { echo 'header_navi_item_select'; } ?>" href="?pool=<?php echo $pool; ?>&page=rounds">
          <span class="material-symbols-outlined">cached</span>
          Rounds
        </a>
        <a class="header_navi_item header_navi_item_text <?php if ($_GET['page'] == 'blocks') { echo 'header_navi_item_select'; } ?>" href="?pool=<?php echo $pool; ?>&page=blocks">
          <span class="material-symbols-outlined">star_rate</span>
          Blocks
        </a>
        <a class="header_navi_item header_navi_item_text <?php if ($_GET['page'] == 'transactions') { echo 'header_navi_item_select'; } ?>" href="?pool=<?php echo $pool; ?>&page=transactions">
          <span class="material-symbols-outlined">payments</span>
          Transactions
        </a>
      </div>
        
    <?php } ?>
      
  </div>
</div>





