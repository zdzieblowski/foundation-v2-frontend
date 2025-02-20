<?php
$transactions_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/historical/transactions?limit=10&order=timestamp&direction=descending');
$payments_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/historical/payments');
?>
<div class="text_header">Transactions</div>
<div class="text_normal">List of transactions and payment amounts.</div>
<hr>
<div class="list_wrap">
  <?php
  foreach ($transactions_current as $transaction) {
    ?>
    <a onclick="revealContent('tx_<?php echo $transaction['id']; ?>');" class="cursor_pointer">
      <div class="small_box_long_content bg_verylightgrey_poolborder reveal_button">
        <div class="reveal_button_text"><span class="material-symbols-outlined margin_right_b">send_money</span><div>Transaction: <b><?php echo privacyFilter($transaction['transaction'], 21); ?></b></div></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
        <?php debugData($transaction['transaction'], $page_configuration['debug_mode']); ?>
      </div>
    </a>
    <div id="tx_<?php echo $transaction['id']; ?>" class="margin_top_a hidden">
      <div class="list_wrap small_gap">
        <div class="two_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Submitted</div>
            <div class="text_heavy text_right"><?php echo formatDateTime($transaction['timestamp']); ?></div>
            <?php debugData($transaction['timestamp'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_pool">
            <div>Amount</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($transaction['amount'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($transaction['amount'], $page_configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="wrap bg_verylightgrey">
          <div class="list_wrap small_gap">
            <?php
            foreach ($payments_current as $payment) {
              if ($payment['transaction'] == $transaction['transaction']) {
                ?>
                <div class="small_box_long_content bg_darkgrey">
                  <div>Miner</div>
                  <div class="text_heavy text_right"><?php echo privacyFilter($payment['miner']); ?></div>
                  <?php debugData($payment['miner'], $page_configuration['debug_mode']); ?>
                </div>
                <div class="two_columns small_gap">
                  <div class="small_box bg_lightgrey">
                    <div>Date</div>
                    <div class="text_heavy text_right"><?php echo formatDateTime($payment['timestamp']); ?></div>
                    <?php debugData($payment['timestamp'], $page_configuration['debug_mode']); ?>
                  </div>
                  <div class="small_box bg_lightgrey">
                    <div>Amount</div>
                    <div class="text_heavy text_right">
                      <?php echo formatLargeNumbers($payment['amount'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
                    </div>
                    <?php debugData($payment['amount'], $page_configuration['debug_mode']); ?>
                  </div>
                </div>
                <?php if ($payment != end($payments_current)) { ?>
                  <hr class="inner_hr wrap_hr wrappedlist_hr">
                  <?php
                }
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <?php if ($transaction != end($transactions_current)) { ?>
      <hr class="inner_hr list_hr">
      <?php
    }
  }
  ?>
</div>
