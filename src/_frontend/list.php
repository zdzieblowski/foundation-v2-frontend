<!DOCTYPE html>
<html>

<head>
  <title>The Mining Site</title>
  <link rel="stylesheet" type="text/css" href="_common/themes/tms/styles.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="icon" type="image/png" href="_common/themes/tms/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="_common/themes/tms/favicon.svg" />
  <link rel="shortcut icon" href="_common/themes/tms/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="_common/themes/tms/apple-touch-icon.png" />
  <link rel="manifest" href="_common/themes/tms/site.webmanifest" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="apple-mobile-web-app-title" content="TMS" />
</head>

<body>
  <div class="header" style="background-color: #555;">
    <div class="width_limit header_grid">
      <div class="header_top">
        <div style="display: grid; grid-template-columns: min-content min-content; gap: 16px; align-items: center;">
          <div>
            <a class="header_navi_item">
              <span class="material-symbols-outlined">
                <?php echo getRandomEmote(); ?>
              </span>
            </a>
          </div>
          <div style="width: min-content;">
            <svg xmlns="http://www.w3.org/2000/svg" id="logo" version="1.1" viewBox="0 0 622.2 329.2" style="height: 33px;"><script xmlns=""/>
              <defs>
                <style>
                  .st0 {
                    fill: #eee;
                  }
                </style>
              </defs>
              <polygon class="st0" points="353 328 622.2 328 500.2 159.4 542.3 0 26 0 0 100 68.3 100 8.6 329.2 112 329.2 171.7 100 240.1 100 180.4 329.2 283.7 329.2 343.4 100 412.5 100 398.2 153.9 391.5 179.8 426.4 228 379 228 353 328"/>
            </svg>
          </div>
        </div>
        <div class="header_top_right">
          <div class="header_info">
            <div><?php echo getServerVariable('SERVER_NAME'); ?>/</div>
          </div>
          <div>
            <a class="header_navi_item" href="/">
              <span class="material-symbols-outlined">refresh</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="width_limit">
      <div class="content_content">
        <div class="text_header" style="color: #444;">Available pools</div>
        <div class="text_normal">Choose a pool from the list below.</div>
        <hr />
        <div class="pool_list" style="display: grid; row-gap: 8px;">
        <?php
          if ($directory = opendir('.')) {
            $filelist = listFiles($directory, array('.', '..', '_common', '_frontend', 'configuration'));
            foreach($filelist as $file) {
             if(is_dir($file)) {
              require($file.'/configuration.php');
              $metadata_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/metadata');
              $network_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/network');
        ?>
          <style>
            a.<?php echo $file; ?> {
              background-color: <?php echo $frontend_configuration['pool_color']; ?>;
              border-bottom: 4px solid #888;
              border-radius: 8px;
            }
            a.<?php echo $file; ?>:hover {
              background-color: #666;
              border-bottom: 4px solid <?php echo $frontend_configuration['pool_color']; ?>;
            }
            a.<?php echo $file; ?>:active {
              background-color: #444;
              border-bottom: 4px solid <?php echo $frontend_configuration['pool_color']; ?>;
            }
          </style>
          <a href="?coin=<?php echo $file; ?>" style="text-decoration: none; user-select: none;" class="<?php echo $file; ?>">
            <div class="box_long_content bg_orange pool_list_wrap">
              <img src="<?php echo $file; ?>/logo.svg" height="50" width="50" class="pool_list_img">
              <div>
                <div class="text_large" style="text-align: left;"><?php echo $server_configuration['name']; ?></div>
                <div class="pool_list_infos">
                  <div class="info_box">
                    <span class="material-symbols-outlined" style="font-size: 16px; margin-right: 4px;" title="HASHRATE">speed</span>
                    <?php echo formatLargeNumbers($metadata_current[0]['hashrate'], $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit']; ?>
                  </div>
                  <div class="info_box">
                    <span class="material-symbols-outlined" style="font-size: 16px; margin-right: 4px;" title="ALGORITHM">regular_expression</span>
                    <?php echo $server_configuration['algorithm']; ?>
                  </div>
                  <div class="info_box">
                    <span class="material-symbols-outlined" style="font-size: 16px; margin-right: 4px;" title="MINERS">group</span>
                    <?php echo $metadata_current[0]['miners']. '/' . $metadata_current[0]['workers']; ?>
                  </div>
                  <div class="info_box">
                    <span class="material-symbols-outlined" style="font-size: 16px; margin-right: 4px;" title="BLOCKS">deployed_code</span>
                    <?php echo $metadata_current[0]['blocks']; ?>
                  </div>
                  <div class="info_box">
                    <span class="material-symbols-outlined" style="font-size: 16px; margin-right: 4px;" title="EFFORT">clock_loader_20</span>
                    <?php echo formatPercents($metadata_current[0]['effort'], $frontend_configuration['math_precision']); ?>
                  </div>
                  <div class="info_box">
                    <span class="material-symbols-outlined" style="font-size: 16px; margin-right: 4px;" title="NETWORK HASHRATE">share</span>
                    <?php if ($frontend_configuration['pool_network_hashrate_multiplier'] != 1) { ?>
                       <span class="material-symbols-outlined" style="font-size: 16px; margin-right: 4px;" title="Warning! This value is estimated">warning</span>
                    <?php }
                      echo formatLargeNumbers(($network_current[0]['hashrate'] * $frontend_configuration['pool_network_hashrate_multiplier']), $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit'];
                    ?>
                  </div>
                </div>
              </div>
              <div style="line-height: 0;"><span class="material-symbols-outlined">arrow_forward</span></div>
            </div>
          </a>
        <?php
            }}
            closedir($directory);
          }
        ?>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="width_limit footer_content">
      <div class="footer_content_left">
        2024+ &copy; <?php echo getServerVariable('SERVER_NAME'); ?>/
        <br>
        <pre style="margin: unset; padding: unset; font-family: inherit; color: #666;">        VERSION <b><?php echo $page_configuration['version']; ?></b></pre>
      </div>
      <div class="footer_content_right">
        <div></div>
        <div>
          <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="../_common/images/github.svg" height="24" /></a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
