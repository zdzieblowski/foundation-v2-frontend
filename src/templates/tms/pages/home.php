<?php
$ports_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/ports');
$metadata_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/metadata');
$network_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/network');
?>
<div class="three_columns">
  <div class="box bg_pool reveal_button_text">
    <img src="configurations/<?php echo $pool; ?>/logo.svg" height="37" width="37" alt>
    <div>
      <div>Currency</div>
      <div class="text_large"><?php echo $server_configuration['name']; ?></div>
      <?php debugData($server_configuration['name'], $page_configuration['debug_mode']); ?>
    </div>
  </div>
  <div class="box bg_light">
    <div>Symbol</div>
    <div class="text_large"><?php echo $server_configuration['symbol']; ?></div>
    <?php debugData($server_configuration['symbol'], $page_configuration['debug_mode']); ?>
  </div>
  <div class="box bg_light">
    <div>Algorithm</div>
    <div class="text_large"><?php echo $server_configuration['algorithm']; ?></div>
    <?php debugData($server_configuration['algorithm'], $page_configuration['debug_mode']); ?>
  </div>
</div>
<div class="two_columns margin_top_b">
  <div class="box bg_dark">
    <div>Minimal payout</div>
    <div class="text_large">
      <?php echo formatLargeNumbers($server_configuration['minimumPayment'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
    </div>
    <?php debugData($server_configuration['minimumPayment'], $page_configuration['debug_mode']); ?>
  </div>
  <div class="box bg_dark">
    <div>Pool fee</div>
    <div class="text_large">
      <?php echo formatPercents($server_configuration['recipientFee'] * 100, $pool_configuration['math_precision']); ?>
    </div>
    <?php debugData($server_configuration['recipientFee'], $page_configuration['debug_mode']); ?>
  </div>
</div>
<hr>
<div class="text_subheader">Pool statistics</div>
<div class="three_columns">
  <div class="box bg_dark">
    <div>Blocks mined</div>
    <div class="text_large"><?php echo $metadata_current[0]['blocks']; ?></div>
    <?php debugData($metadata_current[0]['blocks'], $page_configuration['debug_mode']); ?>
  </div>
  <div class="box bg_light">
    <div>Effort</div>
    <div class="text_large">
      <?php echo formatPercents($metadata_current[0]['effort'], $pool_configuration['math_precision']); ?>
    </div>
    <?php debugData($metadata_current[0]['effort'], $page_configuration['debug_mode']); ?>
  </div>
  <div class="box bg_light">
    <div>Efficiency</div>
    <div class="text_large">
      <?php echo formatPercents($metadata_current[0]['efficiency'], $pool_configuration['math_precision']); ?>
    </div>
    <?php debugData($metadata_current[0]['efficiency'], $page_configuration['debug_mode']); ?>
  </div>
</div>
<div class="three_columns margin_top_b">
  <div class="box bg_dark">
    <div>Hashrate</div>
    <div class="text_large">
      <?php echo formatLargeNumbers($metadata_current[0]['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
    </div>
    <?php debugData($metadata_current[0]['hashrate'], $page_configuration['debug_mode']); ?>
  </div>
  <div class="box bg_light">
    <div>Miners</div>
    <div class="text_large"><?php echo $metadata_current[0]['miners']; ?></div>
    <?php debugData($metadata_current[0]['miners'], $page_configuration['debug_mode']); ?>
  </div>
  <div class="box bg_light">
    <div>Workers</div>
    <div class="text_large"><?php echo $metadata_current[0]['workers']; ?></div>
    <?php debugData($metadata_current[0]['workers'], $page_configuration['debug_mode']); ?>
  </div>
</div>
<hr>
<div class="text_subheader">Network statistics</div>
<div class="three_columns">
  <div class="box bg_light">
    <div>Hashrate</div>
    <div class="text_large">
      <?php if ($pool_configuration['network_hashrate_multiplier'] != 1) { ?>
        <span class="material-symbols-outlined text_inherit_fontsize margin_right_a" title="Warning! This value is estimated">warning</span>
      <?php }
      echo formatLargeNumbers($network_current[0]['hashrate'] * $pool_configuration['network_hashrate_multiplier'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
    </div>
    <?php debugData($network_current[0]['hashrate'], $page_configuration['debug_mode']); ?>
  </div>
  <div class="box bg_light">
    <div>Block height</div>
    <div class="text_large"><?php echo $network_current[0]['height']; ?></div>
    <?php debugData($network_current[0]['height'], $page_configuration['debug_mode']); ?>
  </div>
  <div class="box bg_light">
    <div>Difficulty</div>
    <div class="text_large">
      <?php if ($pool_configuration['network_difficulty_multiplier'] != 1) { ?>
        <span class="material-symbols-outlined text_inherit_fontsize margin_right_a" title="Warning! This value is estimated">warning</span>
      <?php }
      echo formatLargeNumbers($network_current[0]['difficulty'] * $pool_configuration['network_difficulty_multiplier'], $pool_configuration['math_precision']); ?>
    </div>
    <?php debugData($network_current[0]['difficulty'], $page_configuration['debug_mode']); ?>
  </div>
</div>
<hr>
<div class="text_subheader">Getting started</div>
<?php if($pool_configuration['suggested_software'] != '') {?>
<div class="text_normal">Download the mining software - we suggest <b><?php echo $pool_configuration['suggested_software']; ?></b> for the <b><?php echo $server_configuration['algorithm']; ?></b> algorithm.</div>
<a class="header_navi_item header_navi_item_text margin_bottom_c" href="<?php echo $pool_configuration['suggested_software_link']; ?>" target="_blank">
  <span class="material-symbols-outlined">download</span>
  <div>Download <b><?php echo $pool_configuration['suggested_software']; ?></b></div>
</a>
<?php } ?>
<div class="text_normal">Use one of following commands to connect to the pool.</div>
<div class="home_ports">
  <?php
  foreach ($ports_current as $port) {
  ?>
  <div class="home_port">
    <?php if($pool_configuration['suggested_platform_gpu']) { ?>
      <div class="home_port_type">
        <div class="reveal_button_text"><span class="material-symbols-outlined icon_small">terminal</span><?php echo $port['type']; ?> LINUX:</div>
      </div>
      <div class="home_port_command">
        <strong>./<?php echo $pool_configuration['suggested_software_linux']; ?></strong><?php echo $pool_configuration['suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
        <?php if ($pool_configuration['suggested_command_worker'] != '') { echo ''.$pool_configuration['suggested_command_worker'].'<b>&lt;WORKER&gt;</b>';} ?>
      </div>
      <hr class="hr_list">
      <div class="home_port_type">
        <div class="reveal_button_text"><span class="material-symbols-outlined icon_small">terminal</span><?php echo $port['type']; ?> WINDOWS:</div>
      </div>
      <div class="home_port_command">
        <strong><?php echo $pool_configuration['suggested_software_windows']; ?></strong><?php echo $pool_configuration['suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
        <?php if ($pool_configuration['suggested_command_worker'] != '') { echo ''.$pool_configuration['suggested_command_worker'].'<b>&lt;WORKER&gt;</b>';} ?>
      </div>
    <?php }
    if($pool_configuration['suggested_platform_asic']) { ?>
      <div class="home_port_type">
<div class="reveal_button_text"><span class="material-symbols-outlined icon_small">terminal</span><?php echo $port['type']; ?>:</div>
      </div>
      <div class="home_port_command">
        <strong><?php echo $pool_configuration['suggested_software_windows']; ?></strong><?php echo $pool_configuration['suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
        <?php if ($pool_configuration['suggested_command_worker'] != '') { echo ''.$pool_configuration['suggested_command_worker'].'<b>&lt;WORKER&gt;</b>';} ?>
      </div>
    <?php } ?>
    </div>
  <?php
  }
  ?>
</div>
