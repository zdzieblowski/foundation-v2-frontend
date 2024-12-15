<?php
$ports_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/ports');
$metadata_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/metadata');
$network_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/network');
?>
<div class="three_columns">
  <div class="box bg_orange two_columns" style="grid-template-columns: min-content auto; align-items: center;">
    <img src="../<?php echo $pool; ?>/logo.svg" height="33" width="33">
    <div>
      <div>Currency</div>
      <div class="text_large"><?php echo $server_configuration['name']; ?></div>
    </div>
  </div>
  <div class="box bg_lightgrey">
    <div>Symbol</div>
    <div class="text_large"><?php echo $server_configuration['symbol']; ?></div>
  </div>
  <div class="box bg_lightgrey">
    <div>Algorithm</div>
    <div class="text_large"><?php echo $server_configuration['algorithm']; ?></div>
  </div>
</div>
<div class="two_columns mt-8px">
  <div class="box bg_darkgrey">
    <div>Minimal payout</div>
    <div class="text_large">
      <?php echo formatLargeNumbers($server_configuration['minimumPayment'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
    </div>
  </div>
  <div class="box bg_darkgrey">
    <div>Pool fee</div>
    <div class="text_large">
      <?php echo round($server_configuration['recipientFee'] * 100, $frontend_configuration['math_precision']); ?>%
    </div>
  </div>
</div>
<hr />
<div class="text_subheader">Pool statistics</div>
<div class="three_columns">
  <div class="box bg_darkgrey">
    <div>Blocks mined</div>
    <div class="text_large"><?php echo $metadata_current[0]['blocks']; ?></div>
  </div>
  <div class="box bg_lightgrey">
    <div>Effort</div>
    <div class="text_large">
      <?php echo round($metadata_current[0]['effort'], $frontend_configuration['math_precision']); ?>%
    </div>
  </div>
  <div class="box bg_lightgrey">
    <div>Efficiency</div>
    <div class="text_large">
      <?php echo round($metadata_current[0]['efficiency'], $frontend_configuration['math_precision']); ?>%
    </div>
  </div>
</div>
<div class="three_columns mt-8px">
  <div class="box bg_darkgrey">
    <div>Hashrate</div>
    <div class="text_large">
      <?php echo formatLargeNumbers($metadata_current[0]['hashrate'], $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit']; ?>
    </div>
  </div>
  <div class="box bg_lightgrey">
    <div>Miners</div>
    <div class="text_large"><?php echo $metadata_current[0]['miners']; ?></div>
  </div>
  <div class="box bg_lightgrey">
    <div>Workers</div>
    <div class="text_large"><?php echo $metadata_current[0]['workers']; ?></div>
  </div>
</div>
<hr />
<div class="text_subheader">Network statistics</div>
<div class="three_columns">
  <div class="box bg_lightgrey">
    <div>Hashrate</div>
    <div class="text_large">
      <?php echo formatLargeNumbers($network_current[0]['hashrate'], $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit']; ?>
    </div>
  </div>
  <div class="box bg_lightgrey">
    <div>Block height</div>
    <div class="text_large"><?php echo $network_current[0]['height']; ?></div>
  </div>
  <div class="box bg_lightgrey">
    <div>Difficulty</div>
    <div class="text_large">
      <?php echo formatLargeNumbers($network_current[0]['difficulty'], $frontend_configuration['math_precision']); ?>
    </div>
  </div>
</div>
<hr />
<div class="text_subheader">Getting started</div>
<div class="text_normal">Download the mining software - we suggest <b><?php echo $frontend_configuration['pool_suggested_software']; ?></b> for the <b><?php echo $server_configuration['algorithm']; ?></b> algorithm.</div>
<a class="header_navi_item header_navi_item_text" href="<?php echo $frontend_configuration['pool_suggested_software_link']; ?>" target="_blank" style="margin-bottom: 16px;">
  <span class="material-symbols-outlined">download</span>
  <div>Download <b><?php echo $frontend_configuration['pool_suggested_software']; ?></b></div>
</a>
<div class="text_normal">Use one of following commands to connect to the pool.</div>
<div class="home_ports">
  <?php
  foreach ($ports_current as $port) {
    echo '<div class="home_port"><div class="home_port_type">' . $port['type'] . ' LINUX:</div>';
    echo '<div class="home_port_command">./'.$frontend_configuration['pool_suggested_software_linux'].' '.$frontend_configuration['pool_suggested_command_algo'].' ' . $server_configuration['algorithm'] . ' '.$frontend_configuration['pool_suggested_command_open'].' stratum+tcp://' . $_SERVER['SERVER_NAME'] . ':' . $port['port'] . ' '.$frontend_configuration['pool_suggested_command_wallet'].' &lt;WALLET&gt;';
    if ($frontend_configuration['pool_suggested_command_worker'] != '') {
      echo ' '.$frontend_configuration['pool_suggested_command_worker'].' &lt;WORKER&gt;';
    }
    echo '</div>';
    echo '<hr class="list_hr" style="width: 100%;"><div class="home_port_type">' . $port['type'] . ' WINDOWS:</div>';
    echo '<div class="home_port_command">'.$frontend_configuration['pool_suggested_software_windows'].' '.$frontend_configuration['pool_suggested_command_algo'].' ' . $server_configuration['algorithm'] . ' '.$frontend_configuration['pool_suggested_command_open'].' stratum+tcp://' . $_SERVER['SERVER_NAME'] . ':' . $port['port'] . ' '.$frontend_configuration['pool_suggested_command_wallet'].' &lt;WALLET&gt;';
    if ($frontend_configuration['pool_suggested_command_worker'] != '') {
      echo ' '.$frontend_configuration['pool_suggested_command_worker'].' &lt;WORKER&gt;';
    }
    echo '</div></div>';
  }
  ?>
</div>
