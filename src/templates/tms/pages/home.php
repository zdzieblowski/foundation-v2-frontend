<?php
$ports_current = getData('http://'.$pool_configuration['pool_ip'].':'.$pool_configuration['pool_port'].'/api/v2/'.$pool_configuration['pool_name'].'/current/ports');
$metadata_current = getData('http://'.$pool_configuration['pool_ip'].':'.$pool_configuration['pool_port'].'/api/v2/'.$pool_configuration['pool_name'].'/current/metadata');
$network_current = getData('http://'.$pool_configuration['pool_ip'].':'.$pool_configuration['pool_port'].'/api/v2/'.$pool_configuration['pool_name'].'/current/network');
?>
<div class="three_columns">
  <div class="box bg_orange two_columns" style="grid-template-columns: min-content auto; align-items: center;">
    <img src="configurations/<?php echo $pool; ?>/logo.svg" height="37" width="37">
    <div>
      <div>Currency</div>
      <div class="text_large"><?php echo $server_configuration['name']; ?></div>
      <?php debugData($server_configuration['name'], $configuration['debug_mode']); ?>
    </div>
  </div>
  <div class="box bg_lightgrey">
    <div>Symbol</div>
    <div class="text_large"><?php echo $server_configuration['symbol']; ?></div>
    <?php debugData($server_configuration['symbol'], $configuration['debug_mode']); ?>
  </div>
  <div class="box bg_lightgrey">
    <div>Algorithm</div>
    <div class="text_large"><?php echo $server_configuration['algorithm']; ?></div>
    <?php debugData($server_configuration['algorithm'], $configuration['debug_mode']); ?>
  </div>
</div>
<div class="two_columns mt-8px">
  <div class="box bg_darkgrey">
    <div>Minimal payout</div>
    <div class="text_large">
      <?php echo formatLargeNumbers($server_configuration['minimumPayment'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
    </div>
    <?php debugData($server_configuration['minimumPayment'], $configuration['debug_mode']); ?>
  </div>
  <div class="box bg_darkgrey">
    <div>Pool fee</div>
    <div class="text_large">
      <?php echo formatPercents($server_configuration['recipientFee'] * 100, $pool_configuration['math_precision']); ?>
    </div>
    <?php debugData($server_configuration['recipientFee'], $configuration['debug_mode']); ?>
  </div>
</div>
<hr />
<div class="text_subheader">Pool statistics</div>
<div class="three_columns">
  <div class="box bg_darkgrey">
    <div>Blocks mined</div>
    <div class="text_large"><?php echo $metadata_current[0]['blocks']; ?></div>
    <?php debugData($metadata_current[0]['blocks'], $configuration['debug_mode']); ?>
  </div>
  <div class="box bg_lightgrey">
    <div>Effort</div>
    <div class="text_large">
      <?php echo formatPercents($metadata_current[0]['effort'], $pool_configuration['math_precision']); ?>
    </div>
    <?php debugData($metadata_current[0]['effort'], $configuration['debug_mode']); ?>
  </div>
  <div class="box bg_lightgrey">
    <div>Efficiency</div>
    <div class="text_large">
      <?php echo formatPercents($metadata_current[0]['efficiency'], $pool_configuration['math_precision']); ?>
    </div>
    <?php debugData($metadata_current[0]['efficiency'], $configuration['debug_mode']); ?>
  </div>
</div>
<div class="three_columns mt-8px">
  <div class="box bg_darkgrey">
    <div>Hashrate</div>
    <div class="text_large">
      <?php echo formatLargeNumbers($metadata_current[0]['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['pool_hashrate_unit']; ?>
    </div>
    <?php debugData($metadata_current[0]['hashrate'], $configuration['debug_mode']); ?>
  </div>
  <div class="box bg_lightgrey">
    <div>Miners</div>
    <div class="text_large"><?php echo $metadata_current[0]['miners']; ?></div>
    <?php debugData($metadata_current[0]['miners'], $configuration['debug_mode']); ?>
  </div>
  <div class="box bg_lightgrey">
    <div>Workers</div>
    <div class="text_large"><?php echo $metadata_current[0]['workers']; ?></div>
    <?php debugData($metadata_current[0]['workers'], $configuration['debug_mode']); ?>
  </div>
</div>
<hr />
<div class="text_subheader">Network statistics</div>
<div class="three_columns">
  <div class="box bg_lightgrey">
    <div>Hashrate</div>
    <div class="text_large">
      <?php if ($pool_configuration['pool_network_hashrate_multiplier'] != 1) { ?>
        <span class="material-symbols-outlined" style="font-size: inherit; margin-right: 4px;" title="Warning! This value is estimated">warning</span>
      <?php }
      echo formatLargeNumbers($network_current[0]['hashrate'] * $pool_configuration['pool_network_hashrate_multiplier'], $pool_configuration['math_precision']) . $pool_configuration['pool_hashrate_unit']; ?>
    </div>
    <?php debugData($network_current[0]['hashrate'], $configuration['debug_mode']); ?>
  </div>
  <div class="box bg_lightgrey">
    <div>Block height</div>
    <div class="text_large"><?php echo $network_current[0]['height']; ?></div>
    <?php debugData($network_current[0]['height'], $configuration['debug_mode']); ?>
  </div>
  <div class="box bg_lightgrey">
    <div>Difficulty</div>
    <div class="text_large">
      <?php if ($pool_configuration['pool_network_difficulty_multiplier'] != 1) { ?>
        <span class="material-symbols-outlined" style="font-size: inherit; margin-right: 4px;" title="Warning! This value is estimated">warning</span>
      <?php }
      echo formatLargeNumbers($network_current[0]['difficulty'] * $pool_configuration['pool_network_difficulty_multiplier'], $pool_configuration['math_precision']); ?>
    </div>
    <?php debugData($network_current[0]['difficulty'], $configuration['debug_mode']); ?>
  </div>
</div>
<hr />
<div class="text_subheader">Getting started</div>
<?php if($pool_configuration['pool_suggested_software'] != '') {?>
<div class="text_normal">Download the mining software - we suggest <b><?php echo $pool_configuration['pool_suggested_software']; ?></b> for the <b><?php echo $server_configuration['algorithm']; ?></b> algorithm.</div>
<a class="header_navi_item header_navi_item_text" href="<?php echo $pool_configuration['pool_suggested_software_link']; ?>" target="_blank" style="margin-bottom: 16px;">
  <span class="material-symbols-outlined">download</span>
  <div>Download <b><?php echo $pool_configuration['pool_suggested_software']; ?></b></div>
</a>
<?php } ?>
<div class="text_normal">Use one of following commands to connect to the pool.</div>
<div class="home_ports">
  <?php
  foreach ($ports_current as $port) {
  ?>
  <div class="home_port">
    <?php if($pool_configuration['pool_suggested_platform_gpu']) { ?>
      <div class="home_port_type">
        <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px; font-size: 20px;">terminal</span><?php echo $port['type']; ?> LINUX:</div>
      </div>
      <div class="home_port_command">
        <strong>./<?php echo $pool_configuration['pool_suggested_software_linux']; ?></strong><?php echo $pool_configuration['pool_suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['pool_suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['pool_suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
        <?php if ($pool_configuration['pool_suggested_command_worker'] != '') { echo ''.$pool_configuration['pool_suggested_command_worker'].'<b>&lt;WORKER&gt;</b>';} ?>
      </div>
      <hr class="list_hr" style="width: 100%;">
      <div class="home_port_type">
        <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px; font-size: 20px;">terminal</span><?php echo $port['type']; ?> WINDOWS:</div>
      </div>
      <div class="home_port_command">
        <strong><?php echo $pool_configuration['pool_suggested_software_windows']; ?></strong><?php echo $pool_configuration['pool_suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['pool_suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['pool_suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
        <?php if ($pool_configuration['pool_suggested_command_worker'] != '') { echo ''.$pool_configuration['pool_suggested_command_worker'].'<b>&lt;WORKER&gt;</b>';} ?>
      </div>
    <?php }
    if($pool_configuration['pool_suggested_platform_asic']) { ?>
      <div class="home_port_type">
<div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px; font-size: 20px;">terminal</span><?php echo $port['type']; ?>:</div>
      </div>
      <div class="home_port_command">
        <strong><?php echo $pool_configuration['pool_suggested_software_windows']; ?></strong><?php echo $pool_configuration['pool_suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['pool_suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['pool_suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
        <?php if ($pool_configuration['pool_suggested_command_worker'] != '') { echo ''.$pool_configuration['pool_suggested_command_worker'].'<b>&lt;WORKER&gt;</b>';} ?>
      </div>
    <?php } ?>
    </div>
  <?php
  }
  ?>
</div>
