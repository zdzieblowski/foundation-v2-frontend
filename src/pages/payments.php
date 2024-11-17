<div class="text_header">Payments</div>
<div class="text_normal">List of payments.</div>
<hr/>
<div class="text_subheader">Payments</div>
<?php
  $payments_current = getData('http://localhost:3001/api/v2/evrmore/historical/payments');
  var_dump($payments_current);
?>
<hr/>
<div class="text_subheader">Transactions</div>
<?php
  $transactions_current = getData('http://localhost:3001/api/v2/evrmore/historical/transactions');
  var_dump($transactions_current);
?>
