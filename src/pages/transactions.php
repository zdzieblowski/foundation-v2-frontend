<?php
$transactions_current = getData('http://localhost:3001/api/v2/evrmore/historical/transactions');
$payments_current = getData('http://localhost:3001/api/v2/evrmore/historical/payments');
?>
<div class="text_header">Transactions</div>
<div class="text_normal">List of payment transactions.</div>
<hr />
<div class="list_wrap">
  <?php
  foreach ($transactions_current as $transaction) {
    ?>
    <a onclick="revealContent('<?php echo $transaction['id']; ?>');" style="cursor: pointer;">
      <div class="small_box_long_content bg_verylightgrey_orangeborder reveal_button">
        <div>Transaction: <b><?php echo privacyFilter($transaction['transaction'], 21); ?></b></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
      </div>
    </a>
    <div id="<?php echo $transaction['id']; ?>" style="margin-top: -4px;" class="hidden">
      <div class="list_wrap small_gap">
        <div class="two_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Submitted</div>
            <div class="text_heavy text_right"><?php echo formatDateTime($transaction['timestamp']); ?></div>
          </div>
          <div class="small_box bg_orange">
            <div>Amount</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($transaction['amount'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
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
                </div>
                <div class="two_columns small_gap">
                  <div class="small_box bg_lightgrey">
                    <div>Date</div>
                    <div class="text_heavy text_right"><?php echo formatDateTime($payment['timestamp']); ?></div>
                  </div>
                  <div class="small_box bg_lightgrey">
                    <div>Amount</div>
                    <div class="text_heavy text_right">
                      <?php echo formatLargeNumbers($payment['amount'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
                    </div>
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