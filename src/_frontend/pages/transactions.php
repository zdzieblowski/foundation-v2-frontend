<?php
$transactions_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/historical/transactions?limit=10&order=timestamp&direction=descending');
$payments_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/historical/payments');
?>
<div class="text_header">Transactions</div>
<div class="text_normal">List of payment transactions.</div>
<hr />
<div class="list_wrap">
  <?php
  foreach ($transactions_current as $transaction) {
    ?>
    <a onclick="revealContent('tx_<?php echo $transaction['id']; ?>');" style="cursor: pointer;">
      <div class="small_box_long_content bg_verylightgrey_orangeborder reveal_button">
        <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">send_money</span><div>Transaction: <b><?php echo privacyFilter($transaction['transaction'], 21); ?></b></div></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
        <?php debugData($transaction['transaction'], $page_configuration['page_debugmode']); ?>
      </div>
    </a>
    <div id="tx_<?php echo $transaction['id']; ?>" style="margin-top: -4px;" class="hidden">
      <div class="list_wrap small_gap">
        <div class="two_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Submitted</div>
            <div class="text_heavy text_right"><?php echo formatDateTime($transaction['timestamp']); ?></div>
            <?php debugData($transaction['timestamp'], $page_configuration['page_debugmode']); ?>
          </div>
          <div class="small_box bg_orange">
            <div>Amount</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($transaction['amount'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($transaction['amount'], $page_configuration['page_debugmode']); ?>
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
                  <?php debugData($payment['miner'], $page_configuration['page_debugmode']); ?>
                </div>
                <div class="two_columns small_gap">
                  <div class="small_box bg_lightgrey">
                    <div>Date</div>
                    <div class="text_heavy text_right"><?php echo formatDateTime($payment['timestamp']); ?></div>
                    <?php debugData($payment['timestamp'], $page_configuration['page_debugmode']); ?>
                  </div>
                  <div class="small_box bg_lightgrey">
                    <div>Amount</div>
                    <div class="text_heavy text_right">
                      <?php echo formatLargeNumbers($payment['amount'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
                    </div>
                    <?php debugData($payment['amount'], $page_configuration['page_debugmode']); ?>
                  </div>
                </div>
                <?php if ($payment != end($payments_current)) { ?>
                  <hr class="inner_hr wrap_hr wrappedlist_hr" />
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
      <hr class="inner_hr list_hr" />
      <?php
    }
  }
  ?>
</div>
