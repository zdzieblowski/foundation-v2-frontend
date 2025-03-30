<?php
$blocks_combined = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/combined/blocks?limit=10&order=height&direction=descending&confirmations=le10000');
$rounds_combined = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/combined/rounds');
?>
<h2>Blocks</h2>
<h4>List of mined blocks and corresponding rounds.</h4>
<hr>
<?php
foreach ($blocks_combined as $block) {
  ?>
  <h2><?php echo privacyFilter($block['hash'], 21); ?></h2>
  Submitted: <?php echo formatDateTime($block['submitted']); ?> |
  Confirmed: <?php echo formatDateTime($block['timestamp']); ?> |
  Height: <?php echo $block['height']; ?> |
  Difficulty: <?php echo formatLargeNumbers($block['difficulty'], $pool_configuration['math_precision']); ?> |
  Luck: <?php echo formatPercents($block['luck'], $pool_configuration['math_precision']); ?> |
  Winner: <?php echo privacyFilter($block['miner']) . '.' . getWorkerName($block['worker']); ?> |
  Transaction: <?php echo privacyFilter($block['transaction'], 21); ?>
  <?php debugData($block['hash'] . ' | ' . $block['submitted'] . ' | ' . $block['timestamp'] . ' | ' . $block['height'] . ' | ' . $block['difficulty'] . ' | ' . $block['luck'] . ' | ' . $block['worker'] . ' | ' . $block['transaction'], $page_configuration['debug_mode']); ?>
  <div class="wrap">
    <h2><?php echo $block['round']; ?></h2>
    <?php
    $count = 0;
    foreach ($rounds_combined as $round) {
      if ($round['round'] == $block['round']) { 
        if ($count > 0) {        
        ?>
          <br>
        <?php } ?>
        Worker: <?php echo privacyFilter($round['miner']) . '.' . getWorkerName($round['worker']); ?> |
        Valid shares: <?php echo formatLargeNumbers($round['valid'], $pool_configuration['math_precision']); ?> |
        Stale shares: <?php echo formatLargeNumbers($round['stale'], $pool_configuration['math_precision']); ?> |
        Invalid shares: <?php echo formatLargeNumbers($round['invalid'], $pool_configuration['math_precision']); ?>
        <br>
        <?php debugData($round['worker'] . ' | ' . $round['valid'] . ' | ' . $round['stale'] . ' | ' . $round['invalid'], $page_configuration['debug_mode']);
        $count ++;
      }
    }
    ?>
  </div>
  Block type: <?php echo ($block['solo'] ? 'SOLO' : 'SHARED'); ?> |
  Reward:
  <?php echo formatLargeNumbers($block['reward'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
  <br>
  <?php
  debugData(($block['solo'] ? 'true' : 'false') . ' | ' . $block['reward'], $page_configuration['debug_mode']);
  if ($block != end($blocks_combined)) { ?>
    <hr class="hr_inner hr_list">
  <?php }
} ?>
