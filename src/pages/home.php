<?php
  $ports_current = getData('http://localhost:3001/api/v2/evrmore/current/ports');
  $metadata_current = getData('http://localhost:3001/api/v2/evrmore/current/metadata');
  $network_current = getData('http://localhost:3001/api/v2/evrmore/current/network');
?>

<div class="home_three_columns">
  <div class="home_div bg_orange">
    <div>Currency</div>
    <div class="text_large"><?php echo $server_configuration['name']; ?></div>
  </div>
  <div class="home_div bg_lightgrey">
    <div>Symbol</div>
    <div class="text_large"><?php echo $frontend_configuration['pool_currency_symbol']; ?></div>
  </div>
  <div class="home_div bg_lightgrey">
    <div>Algorithm</div>
    <div class="text_large"><?php echo $server_configuration['algorithm']; ?></div>
  </div>
</div>
<div class="home_two_columns" style="margin-top: 8px;">
  <div class="home_div bg_darkgrey">
    <div>Minimal payout</div>
    <div class="text_large"><?php echo $server_configuration['minimumPayment'].$frontend_configuration['pool_currency_symbol']; ?></div>
  </div>
  <div class="home_div bg_darkgrey">
    <div>Pool fee</div>
    <div class="text_large"><?php echo round($server_configuration['recipientFee']*100, $frontend_configuration['page_precision']); ?> %</div>
  </div>
</div>
<hr/>
<div class="text_subheader">Getting started</div>
<div class="text_normal">Use one of following commands to connect to the pool.</div>
<div class="home_ports">
  <?php
    foreach($ports_current as $port){
      echo '<div class="home_port"><div class="home_port_type">'.$port['type'].'</div>';
      echo '<div class="home_port_command">./miner -a '.$server_configuration['algorithm'].' -o stratum+tcp://'.$_SERVER['SERVER_NAME'].':'.$port['port'].' -u WALLET -w WORKER</div></div>';
    }
  ?>
</div>
<hr/>
<div class="text_subheader">Pool statistics</div>
<div class="home_three_columns">
  <div class="home_div bg_darkgrey">
    <div>Blocks mined</div>
    <div class="text_large"><?php echo $metadata_current[0]['blocks']; ?></div>
  </div>
  <div class="home_div bg_lightgrey">
    <div>Effort</div>
    <div class="text_large"><?php echo round($metadata_current[0]['effort'], $frontend_configuration['page_precision']); ?> %</div>
  </div>
  <div class="home_div bg_lightgrey">
    <div>Efficiency</div>
    <div class="text_large"><?php echo round($metadata_current[0]['efficiency'], $frontend_configuration['page_precision']); ?> %</div>
  </div>
</div>
<div class="home_three_columns" style="margin-top: 8px;">
  <div class="home_div bg_darkgrey">
    <div>Hashrate</div>
    <div class="text_large"><?php echo formatLargeNumbers(round($metadata_current[0]['hashrate'], $frontend_configuration['page_precision'])).$frontend_configuration['pool_hashrate_unit']; ?></div>
  </div>
  <div class="home_div bg_lightgrey">
    <div>Miners</div>
    <div class="text_large"><?php echo $metadata_current[0]['miners']; ?></div>
  </div>
  <div class="home_div bg_lightgrey">
    <div>Workers</div>
    <div class="text_large"><?php echo $metadata_current[0]['workers']; ?></div>
  </div>
</div>
<hr/>
<div class="text_subheader">Network statistics</div>
<div class="home_three_columns">
  <div class="home_div bg_lightgrey">
    <div>Hashrate</div>
    <div class="text_large"><?php echo formatLargeNumbers(round($network_current[0]['hashrate'], $frontend_configuration['page_precision'])).$frontend_configuration['pool_hashrate_unit']; ?></div>
  </div>
  <div class="home_div bg_lightgrey">
    <div>Block height</div>
    <div class="text_large"><?php echo $network_current[0]['height']; ?></div>
  </div>
  <div class="home_div bg_lightgrey">
    <div>Difficulty</div>
    <div class="text_large"><?php echo round($network_current[0]['difficulty'], $frontend_configuration['page_precision']); ?></div>
  </div>
</div>
