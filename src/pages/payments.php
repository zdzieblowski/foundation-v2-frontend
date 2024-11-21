<?php
  $payments_current = getData('http://localhost:3001/api/v2/evrmore/historical/payments');
  $transactions_current = getData('http://localhost:3001/api/v2/evrmore/historical/transactions');
?>

<div class="text_header">Payments</div>
<div class="text_normal">List of payments.</div>
<hr/>
<div class="text_subheader">Payments</div>
<?php
  foreach($payments_current as $payment){
    echo 'date: '.formatDateTime($payment['timestamp']);
    echo '<br>';
    echo 'transaction: '.privacyFilter($payment['transaction'], 21);
    echo '<br>';
    echo 'miner: '.privacyFilter($payment['miner']);
    echo '<br>';
    echo 'amount: '.round($payment['amount'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'];
    echo '<br><br>';
  }
?>
<hr/>
<div class="text_subheader">Transactions</div>
<?php
  foreach($transactions_current as $transaction){
    echo 'date: '.formatDateTime($transaction['timestamp']);
    echo '<br>';
    echo 'transaction: '.privacyFilter($transaction['transaction'], 21);
    echo '<br>';
    echo 'amount: '.round($transaction['amount'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'];
    echo '<br><br>';
  }
?>
