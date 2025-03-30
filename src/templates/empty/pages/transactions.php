<?php
$transactions_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/historical/transactions?limit=10&order=timestamp&direction=descending');
$payments_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/historical/payments');
?>
<h2>Transactions</h2>
<h4>List of transactions and payment amounts.</h4>
<hr>
<?php
foreach ($transactions_current as $transaction) {
  ?>
  <h2><?php echo privacyFilter($transaction['transaction'], 21); ?></h2>
  Submitted: <?php echo formatDateTime($transaction['timestamp']); ?>
  Amount:
  <?php echo formatLargeNumbers($transaction['amount'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
  <br>
  <?php debugData($transaction['transaction'] . ' | ' . $transaction['timestamp'] . ' | ' . $transaction['amount'], $page_configuration['debug_mode']); ?>
  <div class="wrap">
    <?php
    $count = 0;
    foreach ($payments_current as $payment) {
      if ($payment['transaction'] == $transaction['transaction']) {
        ?>
        <h2><?php echo privacyFilter($payment['miner']); ?></h2>
        Date: <?php echo formatDateTime($payment['timestamp']); ?> |
        Amount:
        <?php echo formatLargeNumbers($payment['amount'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
        <br>
        <?php debugData($payment['miner'] . ' | ' . $payment['timestamp'] . ' | ' . $payment['amount'], $page_configuration['debug_mode']); ?>
        <?php
        $count = $count + 1;
      }
    }
    ?>
  </div>
  <?php if ($transaction != end($transactions_current)) { ?>
    <hr class="hr_inner hr_list">
    <?php
  }
}
?>