<div class="text_header color_dark">Available pools</div>
<div class="text_normal">Choose a pool from the list below.</div>
<hr>
<div class="pool_list">
  <?php
  if ($pool_directory = opendir($page_configuration['directory_configurations'])) {
    $pool_list = listFiles($pool_directory, array('.', '..'));
    foreach ($pool_list as $pool_config) {
      $pool_directory_path = $page_configuration['directory_configurations'] . '/' . $pool_config;
      if (is_dir($pool_directory_path)) {
        require($pool_directory_path . '/configuration.php');
        $metadata_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/metadata');
        $network_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/network');
  ?>
        <style>
          a.<?php echo $pool_config; ?> {
            background-color:
              <?php echo $pool_configuration['color']; ?>
            ;
            border-bottom: 4px solid #888;
            border-radius: 8px;
          }

          a.<?php echo $pool_config; ?>:hover {
            background-color: #666;
            border-bottom: 4px solid
              <?php echo $pool_configuration['color']; ?>
            ;
          }

          a.<?php echo $pool_config; ?>:active {
            background-color: #444;
            border-bottom: 4px solid
              <?php echo $pool_configuration['color']; ?>
            ;
          }
        </style>
        <a href="?pool=<?php echo $pool_config; ?>" class="list_button <?php echo $pool_config; ?>">
          <div class="box_long_content bg_pool pool_list_wrap">
            <img src="configurations/<?php echo $pool_config; ?>/logo.svg" height="50" width="50" class="pool_list_icon" alt>
            <div>
              <div class="text_large text_left"><?php echo $server_configuration['name']; ?></div>
              <div class="pool_list_info">
                <div class="box_info">
                  <span class="material-symbols-outlined list_icon_medium" title="HASHRATE">speed</span>
                  <?php echo formatLargeNumbers($metadata_current[0]['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
                </div>
                <div class="box_info">
                  <span class="material-symbols-outlined list_icon_medium" title="ALGORITHM">regular_expression</span>
                  <?php echo $server_configuration['algorithm']; ?>
                </div>
                <div class="box_info">
                  <span class="material-symbols-outlined list_icon_medium" title="MINERS">dns</span>
                  <?php echo $metadata_current[0]['miners']; ?>&nbsp;<span class="material-symbols-outlined list_icon_medium"
                    title="WORKERS">memory</span>
                  <?php echo $metadata_current[0]['workers']; ?>
                </div>
                <div class="box_info">
                  <span class="material-symbols-outlined list_icon_medium" title="BLOCKS">deployed_code</span>
                  <?php echo $metadata_current[0]['blocks']; ?>
                </div>
                <div class="box_info">
                  <span class="material-symbols-outlined list_icon_medium" title="EFFORT">clock_loader_20</span>
                  <?php echo formatPercents($metadata_current[0]['effort'], $pool_configuration['math_precision']); ?>
                </div>
                <div class="box_info">
                  <span class="material-symbols-outlined list_icon_medium" title="NETWORK HASHRATE">share</span>
                  <?php if ($pool_configuration['network_hashrate_multiplier'] != 1) { ?>
                    <span class="material-symbols-outlined list_icon_medium"
                      title="Warning! This value is estimated">warning</span>
                  <?php }
                  echo formatLargeNumbers(($network_current[0]['hashrate'] * $pool_configuration['network_hashrate_multiplier']), $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit'];
                  ?>
                </div>
              </div>
            </div>
            <div class="line_height_zero">
              <span class="material-symbols-outlined">arrow_forward</span>
            </div>
          </div>
        </a>
  <?php
      }
    }
    closedir($pool_directory);
  }
  ?>
</div>
