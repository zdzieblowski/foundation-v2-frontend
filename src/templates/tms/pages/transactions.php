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
      <div class="box_small_long_content bg_vlight_bdr_pool reveal_button">
        <div class="reveal_button_text"><span class="material-symbols-outlined margin_right_b">send_money</span><div>Transaction: <b><?php echo privacyFilter($transaction['transaction'], 21); ?></b></div></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
        <?php debugData($transaction['transaction'], $page_configuration['debug_mode']); ?>
      </div>
    </a>
    <div id="tx_<?php echo $transaction['id']; ?>" class="margin_top_a hidden">
      <div class="list_wrap gap_small">
        <div class="columns_two gap_small">
          <div class="box_small bg_light">
            <div>Submitted</div>
            <div class="text_heavy text_right"><?php echo formatDateTime($transaction['timestamp']); ?></div>
            <?php debugData($transaction['timestamp'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="box_small bg_pool">
            <div>Amount</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($transaction['amount'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($transaction['amount'], $page_configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="wrap bg_vlight">
          <div class="list_wrap gap_small">
            <?php
            foreach ($payments_current as $payment) {
              if ($payment['transaction'] == $transaction['transaction']) {
                ?>
                <div class="box_small_long_content bg_dark">
                  <div>Miner</div>
                  <div class="text_heavy text_right"><?php echo privacyFilter($payment['miner']); ?></div>
                  <?php debugData($payment['miner'], $page_configuration['debug_mode']); ?>
                </div>
                <div class="columns_two gap_small">
                  <div class="box_small bg_light">
                    <div>Date</div>
                    <div class="text_heavy text_right"><?php echo formatDateTime($payment['timestamp']); ?></div>
                    <?php debugData($payment['timestamp'], $page_configuration['debug_mode']); ?>
                  </div>
                  <div class="box_small bg_light">
                    <div>Amount</div>
                    <div class="text_heavy text_right">
                      <?php echo formatLargeNumbers($payment['amount'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
                    </div>
                    <?php debugData($payment['amount'], $page_configuration['debug_mode']); ?>
                  </div>
                </div>
                <?php if ($payment != end($payments_current)) { ?>
                  <hr class="hr_inner hr_wrap hr_wlist">
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
      <hr class="hr_inner hr_list">
      <?php
    }
  }
  ?>
</div>
