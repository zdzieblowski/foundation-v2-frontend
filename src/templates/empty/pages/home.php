<?php
$ports_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/ports');
$metadata_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/metadata');
$network_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/network');
?>
<h4>Currency</h4>
<h2><?php echo $server_configuration['name']; ?></h2>
<?php debugData($server_configuration['name'], $page_configuration['debug_mode']); ?>
<br>
<h4>Symbol</h4>
<h2><?php echo $server_configuration['symbol']; ?></h2>
<?php debugData($server_configuration['symbol'], $page_configuration['debug_mode']); ?>
<br>
<h4>Algorithm</h4>
<h2><?php echo $server_configuration['algorithm']; ?></h2>
<?php debugData($server_configuration['algorithm'], $page_configuration['debug_mode']); ?>
<br>
<h4>Minimal payout</h4>
<h2><?php echo formatLargeNumbers($server_configuration['minimumPayment'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?></h2>
<?php debugData($server_configuration['minimumPayment'], $page_configuration['debug_mode']); ?>
<br>
<h4>Pool fee</h4>
<h2><?php echo formatPercents($server_configuration['recipientFee'] * 100, $pool_configuration['math_precision']); ?></h2>
<?php debugData($server_configuration['recipientFee'], $page_configuration['debug_mode']); ?>
<hr>
<h2><u>Pool statistics</u></h2>
<br>
<h4>Blocks mined</h4>
<h2><?php echo $metadata_current[0]['blocks']; ?></h2>
<?php debugData($metadata_current[0]['blocks'], $page_configuration['debug_mode']); ?>
<br>
<h4>Effort</h4>
<h2><?php echo formatPercents($metadata_current[0]['effort'], $pool_configuration['math_precision']); ?></h2>
<?php debugData($metadata_current[0]['effort'], $page_configuration['debug_mode']); ?>
<br>
<h4>Efficiency</h4>
<h2><?php echo formatPercents($metadata_current[0]['efficiency'], $pool_configuration['math_precision']); ?></h2>
<?php debugData($metadata_current[0]['efficiency'], $page_configuration['debug_mode']); ?>
<br>
<h4>Hashrate</h4>
<h2><?php echo formatLargeNumbers($metadata_current[0]['hashrate'], $pool_configuration['math_precision']).$pool_configuration['hashrate_unit']; ?></h2>
<?php debugData($metadata_current[0]['hashrate'], $page_configuration['debug_mode']); ?>
<br>
<h4>Miners</h4>
<h2><?php echo $metadata_current[0]['miners']; ?></h2>
<?php debugData($metadata_current[0]['miners'], $page_configuration['debug_mode']); ?>
<br>
<h4>Workers</h4>
<h2><?php echo $metadata_current[0]['workers']; ?></h2>
<?php debugData($metadata_current[0]['workers'], $page_configuration['debug_mode']); ?>
<hr>
<h2><u>Network statistics</u></h2>
<br>
<h4>Hashrate</h4>
<h2><?php echo formatLargeNumbers($network_current[0]['hashrate'] * $pool_configuration['network_hashrate_multiplier'], $pool_configuration['math_precision']).$pool_configuration['hashrate_unit']; ?></h2>
<?php if ($pool_configuration['network_hashrate_multiplier'] != 1) { ?>
  <sub>Warning! This value is estimated</sub>
<?php } ?>
<?php debugData($network_current[0]['hashrate'], $page_configuration['debug_mode']); ?>
<br>
<h4>Block height</h4>
<h2><?php echo $network_current[0]['height']; ?></h2>
<?php debugData($network_current[0]['height'], $page_configuration['debug_mode']); ?>
<br>
<h4>Difficulty</h4>
<h2><?php echo formatLargeNumbers($network_current[0]['difficulty'] * $pool_configuration['network_difficulty_multiplier'], $pool_configuration['math_precision']); ?></h2>
<?php if ($pool_configuration['network_difficulty_multiplier'] != 1) { ?>
  <sub>Warning! This value is estimated</sub>
<?php } ?>
<?php debugData($network_current[0]['difficulty'], $page_configuration['debug_mode']); ?>
<hr>
<h2><u>Getting started</u></h2>
<?php if($pool_configuration['suggested_software'] != '') { ?>
<br>
Download the mining software - we suggest <b><?php echo $pool_configuration['suggested_software']; ?></b> for the <b><?php echo $server_configuration['algorithm']; ?></b> algorithm.
<br>
<a href="<?php echo $pool_configuration['suggested_software_link']; ?>" target="_blank">
  Download <b><?php echo $pool_configuration['suggested_software']; ?></b>
</a>
<?php } ?>
<br><br>
<h4>Use one of following commands to connect to the pool.</h4>
<br>
<?php
foreach ($ports_current as $port) {
  if($pool_configuration['suggested_platform_gpu']) { ?>
    <h3><?php echo $port['type']; ?> LINUX:</h3>
    <code class="command"><strong>./<?php echo $pool_configuration['suggested_software_linux']; ?></strong><?php echo $pool_configuration['suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
    <?php if ($pool_configuration['suggested_command_worker'] != '') { echo ''.$pool_configuration['suggested_command_worker'].'<b>&lt;WORKER&gt;</b>'; } ?></code><br>
    <h3><?php echo $port['type']; ?> WINDOWS:</h3>
    <code class="command"><strong><?php echo $pool_configuration['suggested_software_windows']; ?></strong><?php echo $pool_configuration['suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
    <?php if ($pool_configuration['suggested_command_worker'] != '') { echo ''.$pool_configuration['suggested_command_worker'].'<b>&lt;WORKER&gt;</b>'; } ?></code>
    <?php } ?>
    <?php if($pool_configuration['suggested_platform_asic']) { ?>
      <h3><?php echo $port['type']; ?>:</h3>
      <code class="command"><strong><?php echo $pool_configuration['suggested_software_windows']; ?></strong><?php echo $pool_configuration['suggested_command_algo']; ?><b><?php echo $server_configuration['algorithm']; ?></b><?php echo $pool_configuration['suggested_command_open']; ?><b>stratum+tcp://<?php echo getServerVariable('SERVER_NAME').':'.$port['port']; ?></b><?php echo $pool_configuration['suggested_command_wallet']; ?><b>&lt;WALLET&gt;</b>
      <?php if ($pool_configuration['suggested_command_worker'] != '') { echo ''.$pool_configuration['suggested_command_worker'].'<b>&lt;WORKER&gt;</b>'; } ?></code>
    <?php } ?>
<?php } ?>
