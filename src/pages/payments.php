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
    var_dump($payment);
    echo '<br><br>';
  }
?>
<hr/>
<div class="text_subheader">Transactions</div>
<?php
  foreach($transactions_current as $transaction){
    var_dump($transaction);
    echo '<br><br>';
  }
?>
