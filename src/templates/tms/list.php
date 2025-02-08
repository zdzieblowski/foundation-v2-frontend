<div class="text_header" class="color_verydark">Available pools</div>
<div class="text_normal">Choose a pool from the list below.</div>
<hr>
<div class="pool_list">
  <?php
  if ($directory = opendir(directory: 'configurations')) {
    $filelist = listFiles(directory: $directory, blacklist: array('.', '..'));
    foreach ($filelist as $file) {
      if (is_dir(filename: 'configurations/' . $file)) {
        require('configurations/' . $file . '/configuration.php');
        $metadata_current = getData(data_url: 'http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/metadata');
        $network_current = getData(data_url: 'http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/network');
        ?>
        <style>
          a.<?php echo $file; ?> {
            background-color:
              <?php echo $pool_configuration['color']; ?>
            ;
            border-bottom: 4px solid #888;
            border-radius: 8px;
          }

          a.<?php echo $file; ?>:hover {
            background-color: #666;
            border-bottom: 4px solid
              <?php echo $pool_configuration['color']; ?>
            ;
          }

          a.<?php echo $file; ?>:active {
            background-color: #444;
            border-bottom: 4px solid
              <?php echo $pool_configuration['color']; ?>
            ;
          }
        </style>
        <a href="?pool=<?php echo $file; ?>" class="list_button <?php echo $file; ?>">
          <div class="box_long_content bg_pool pool_list_wrap">
            <img src="configurations/<?php echo $file; ?>/logo.svg" height="50" width="50" class="pool_list_img" alt>
            <div>
              <div class="text_large text_left"><?php echo $server_configuration['name']; ?></div>
              <div class="pool_list_infos">
                <div class="info_box">
                  <span class="material-symbols-outlined list_small_icon" title="HASHRATE">speed</span>
                  <?php echo formatLargeNumbers(number: $metadata_current[0]['hashrate'], precision: $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
                </div>
                <div class="info_box">
                  <span class="material-symbols-outlined list_small_icon" title="ALGORITHM">regular_expression</span>
                  <?php echo $server_configuration['algorithm']; ?>
                </div>
                <div class="info_box">
                  <span class="material-symbols-outlined list_small_icon" title="MINERS">dns</span>
                  <?php echo $metadata_current[0]['miners']; ?>&nbsp;<span class="material-symbols-outlined list_small_icon"
                    title="WORKERS">memory</span>
                  <?php echo $metadata_current[0]['workers']; ?>
                </div>
                <div class="info_box">
                  <span class="material-symbols-outlined list_small_icon" title="BLOCKS">deployed_code</span>
                  <?php echo $metadata_current[0]['blocks']; ?>
                </div>
                <div class="info_box">
                  <span class="material-symbols-outlined list_small_icon" title="EFFORT">clock_loader_20</span>
                  <?php echo formatPercents(number: $metadata_current[0]['effort'], precision: $pool_configuration['math_precision']); ?>
                </div>
                <div class="info_box">
                  <span class="material-symbols-outlined list_small_icon" title="NETWORK HASHRATE">share</span>
                  <?php if ($pool_configuration['network_hashrate_multiplier'] != 1) { ?>
                    <span class="material-symbols-outlined list_small_icon"
                      title="Warning! This value is estimated">warning</span>
                  <?php }
                  echo formatLargeNumbers(number: ($network_current[0]['hashrate'] * $pool_configuration['network_hashrate_multiplier']), precision: $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit'];
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
    closedir(dir_handle: $directory);
  }
  ?>
</div>
