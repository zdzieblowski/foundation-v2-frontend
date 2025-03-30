<?php
$workers_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/workers?order=hashrate');
$blocks_combined = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/combined/blocks?limit=5&order=timestamp&direction=descending');
$payments_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/historical/payments?limit=10&order=timestamp&direction=descending');
?>
<h2>Dashboard</h2>
<?php
if (isset($_POST['save_address'])) {
  setcookie('address_' . $pool, $_POST['save_address']);
  header('Refresh:0; url=?pool=' . $pool . '&page=dashboard');
} else {
  if (!isset($_COOKIE['address_' . $pool])) {
    ?>
    <h4>Enter wallet address to see your statistics.</h4>
    <hr>
  <?php } else {
    $wallet_found = False;
    $blocks_found = False;
    $payments_found = False;
    $miner = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/miners?miner=' . $_COOKIE['address_' . $pool])[0];

    if ($miner['miner'] == $_COOKIE['address_' . $pool]) {
      $wallet_found = True;
      ?>
      <h4>Statistics for wallet address: <b class="text_break_all"><?php echo $_COOKIE['address_' . $pool]; ?></b></h4>
      <hr>
      <h2><u>Miner information</u></h2>
      <br>
      <h4>Wallet address</h4>
      <h2><?php echo $miner['miner']; ?></h2>
      <br>
      <h4>Hashrate</h4>
      <h2><?php echo formatLargeNumbers($miner['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?></h2>
      <?php debugData($miner['hashrate'], $page_configuration['debug_mode']); ?>
      <br>
      <h4>Efficency</h4>
      <h2><?php echo formatPercents($miner['efficiency'], $pool_configuration['math_precision']); ?></h2>
      <?php debugData($miner['efficiency'], $page_configuration['debug_mode']); ?>
      <br>
      <h4>Effort</h4>
      <h2><?php echo formatPercents($miner['effort'], $pool_configuration['math_precision']); ?></h2>
      <?php debugData($miner['effort'], $page_configuration['debug_mode']); ?>
      <br>
      <h4>Balance</h4>
      <h2><?php echo formatLargeNumbers($miner['balance'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?></h2>
      <?php debugData($miner['balance'], $page_configuration['debug_mode']); ?>
      <br>
      <h4>Immature</h4>
      <h2><?php echo formatLargeNumbers($miner['immature'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?></h2>
      <?php debugData($miner['immature'], $page_configuration['debug_mode']); ?>
      <br>
      <h4>Paid</h4>
      <h2><?php echo formatLargeNumbers($miner['paid'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?></h2>
      <?php debugData($miner['paid'], $page_configuration['debug_mode']); ?>
      <br>
      <h4>Valid shares</h4>
      <h2><?php echo formatLargeNumbers($miner['valid'], $pool_configuration['math_precision']); ?></h2>
      <?php debugData($miner['valid'], $page_configuration['debug_mode']); ?>
      <br>
      <h4>Stale shares</h4>
      <h2><?php echo formatLargeNumbers($miner['stale'], $pool_configuration['math_precision']); ?></h2>
      <?php debugData($miner['stale'], $page_configuration['debug_mode']); ?>
      <br>
      <h4>Invalid shares</h4>
      <h2><?php echo formatLargeNumbers($miner['invalid'], $pool_configuration['math_precision']); ?></h2>
      <?php debugData($miner['invalid'], $page_configuration['debug_mode']); ?>
      <hr>
      <h2><u>Workers</u></h2>
      <br>
      <?php
      foreach ($workers_current as $worker) {
        if ($worker['miner'] == $miner['miner']) {
          $worker_name = getWorkerName($worker['worker']);
          ?>
          <h2><?php echo $worker_name; ?></h2>
          Hashrate:
          <?php echo formatLargeNumbers($worker['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
          |
          Worker type: <?php echo $worker['solo'] ? 'SOLO' : 'SHARED'; ?> |
          Efficiency: <?php echo formatPercents($worker['efficiency'], $pool_configuration['math_precision']); ?> |
          Effort: <?php echo formatPercents($worker['effort'], $pool_configuration['math_precision']); ?> |
          Valid shares: <?php echo formatLargeNumbers($worker['valid'], $pool_configuration['math_precision']); ?> |
          Stale shares: <?php echo formatLargeNumbers($worker['stale'], $pool_configuration['math_precision']); ?> |
          Invalid shares: <?php echo formatLargeNumbers($worker['invalid'], $pool_configuration['math_precision']); ?>
          <br>
          <?php debugData($worker['hashrate'] . ' | ' . ($worker['solo'] ? 'true' : 'false') . ' | ' . $worker['efficiency'] . ' | ' . $worker['effort'] . ' | ' . $worker['valid'] . ' | ' . $worker['stale'] . ' | ' . $worker['invalid'], $page_configuration['debug_mode']); ?>
          <br>
          <?php
        }
      }
      ?>
      <hr>
      <h2><u>Blocks</u></h2>
      <br>
      <?php
      foreach ($blocks_combined as $block) {
        if ($block['miner'] == $_COOKIE['address_' . $pool]) {
          $blocks_found = True;
          ?>
          <h2><?php echo $block['hash']; ?></h2>
          Round: <?php echo $block['round']; ?> |
          Submitted: <?php echo formatDateTime($block['submitted']); ?> |
          Confirmed: <?php echo formatDateTime($block['timestamp']); ?> |
          Transaction: <?php echo $block['transaction']; ?> |
          Height: <?php echo $block['height']; ?> |
          Difficulty: <?php echo formatLargeNumbers($block['difficulty'], $pool_configuration['math_precision']); ?> |
          Luck: <?php echo formatPercents($block['luck'], $pool_configuration['math_precision']); ?> |
          Block type: <?php echo $block['solo'] ? 'SOLO' : 'SHARED'; ?> |
          Reward: <?php echo formatLargeNumbers($block['reward'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
          <br>
          <?php debugData('* | ' . $block['submitted'] . ' | ' . $block['timestamp'] . ' | * | ' . $block['height'] . ' | ' . $block['difficulty'] . ' | ' . $block['luck'] . ' | ' . ($block['solo'] ? 'true' : 'false') . ' | ' . $block['reward'], $page_configuration['debug_mode']); ?>
          <br>
          <?php
        }
      }
      ?>

      <?php
      if (!$blocks_found) {
        ?>
        <h4>No blocks mined by <b><?php echo $_COOKIE['address_' . $pool]; ?></b> were found.</h4>
        <?php
      }
      ?>
      <hr>
      <h2><u>Payments</u></h2>
      <br>
      <?php
      foreach ($payments_current as $payment) {
        if ($payment['miner'] == $_COOKIE['address_' . $pool]) {
          $payments_found = True;
          ?>
          <h2><?php echo $payment['transaction']; ?></h2>
          Date: <?php echo formatDateTime($payment['timestamp']); ?> |
          Amount: <?php echo formatLargeNumbers($payment['amount'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
          <br>
          <?php debugData($payment['timestamp'] . ' | ' . $payment['amount'], $page_configuration['debug_mode']); ?>
          <br>
          <?php
        }
      }
      if (!$payments_found) { ?>
        <h4>No payments to <b><?php echo $_COOKIE['address_' . $pool]; ?></b> were found.</h4>
        <?php
      }
    }
    if (!$wallet_found) { ?>
      <h4>Miner <b><?php echo $_COOKIE['address_' . $pool]; ?></b> was not found.</h4>
    <?php } ?>
    <hr>
  <?php } ?>
  <form action="<?php echo '?pool=' . $pool . '&page=dashboard'; ?>" method="post">
    <input type="text" name="save_address" value="<?php echo $_COOKIE['address_' . $pool]; ?>">
    <input type="submit" value="Submit">
  </form>
<?php } ?>
