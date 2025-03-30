<?php
$miners_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/miners?order=hashrate&direction=descending&hashrate=gt0');
$workers_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/workers?order=hashrate&direction=descending&hashrate=gt0');
?>
<h2>Miners</h2>
<h4>List of miners and workers.</h4>
<hr>
<?php
foreach ($miners_current as $miner) {
  ?>
  <h2><?php echo privacyFilter($miner['miner']); ?></h2>
  Hashrate: <?php echo formatLargeNumbers($miner['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?> |
  Efficency: <?php echo formatPercents($miner['efficiency'], $pool_configuration['math_precision']); ?> |
  Effort: <?php echo formatPercents($miner['effort'], $pool_configuration['math_precision']); ?> |
  Balance: <?php echo formatLargeNumbers($miner['balance'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?> |
  Immature: <?php echo formatLargeNumbers($miner['immature'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?> |
  Paid: <?php echo formatLargeNumbers($miner['paid'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?> |
  Valid shares: <?php echo formatLargeNumbers($miner['valid'], $pool_configuration['math_precision']); ?> |
  Stale shares: <?php echo formatLargeNumbers($miner['stale'], $pool_configuration['math_precision']); ?> |
  Invalid shares: <?php echo formatLargeNumbers($miner['invalid'], $pool_configuration['math_precision']); ?>
  <br>
  <?php debugData($miner['miner'] . ' | ' . $miner['hashrate'] . ' | ' . $miner['efficiency'] . ' | ' . $miner['effort'] . ' | ' . $miner['balance'] . ' | ' . $miner['immature'] . ' | ' . $miner['paid'] . ' | ' . $miner['valid'] . ' | ' . $miner['stale'] . ' | ' . $miner['invalid'], $page_configuration['debug_mode']); ?>
  <div class="wrap">
    <?php
    $count = 0;
    foreach ($workers_current as $worker) {
      if ($worker['miner'] == $miner['miner']) {
        $worker_name = getWorkerName($worker['worker']);
        if($count > 0) {
        ?>
          <br>
        <?php } ?>
        <h2><?php echo $worker_name; ?></h2>
        Hashrate: <?php echo formatLargeNumbers($worker['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?> |
        Worker type: <?php echo ($worker['solo'] ? 'SOLO' : 'SHARED'); ?> |
        Efficiency: <?php echo formatPercents($worker['efficiency'], $pool_configuration['math_precision']); ?> |
        Effort: <?php echo formatPercents($worker['effort'], $pool_configuration['math_precision']); ?> |
        Valid shares: <?php echo formatLargeNumbers($worker['valid'], $pool_configuration['math_precision']); ?> |
        Stale shares: <?php echo formatLargeNumbers($worker['stale'], $pool_configuration['math_precision']); ?> |
        Invalid shares: <?php echo formatLargeNumbers($worker['invalid'], $pool_configuration['math_precision']); ?>
        <br>
        <?php debugData($worker['hashrate'] . ' | ' . ($worker['solo'] ? 'true' : 'false') . ' | ' . $worker['efficiency'] . ' | ' . $worker['effort'] . ' | ' . $worker['valid'] . ' | ' . $worker['stale'] . ' | ' . $worker['invalid'], $page_configuration['debug_mode']);
	$count++;
      }
    }
  ?>
  </div>
  <?php if ($miner != end($miners_current)) { ?>
    <hr>
    <?php
  }
}
?>
