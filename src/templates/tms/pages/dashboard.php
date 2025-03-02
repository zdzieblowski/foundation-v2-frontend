<?php
$workers_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/workers');
$blocks_combined = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/combined/blocks?limit=5&order=timestamp&direction=descending');
$payments_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/historical/payments?limit=10&order=timestamp&direction=descending');
?>
<div class="text_header">Dashboard</div>
<?php
if (isset($_POST['save_address'])) {
  setcookie('address_'.$pool, $_POST['save_address']);
  header('Refresh:0; url=?pool='.$pool.'&page=dashboard');
} else {
  if (!isset($_COOKIE['address_'.$pool])) {
  ?>
    <div class="text_normal">Enter wallet address to see your statistics.</div>
    <?php } else {
      $wallet_found = False;
      $blocks_found = False;
      $payments_found = False;
      $miner = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/miners?miner='.$_COOKIE['address_'.$pool])[0];

      if ($miner['miner'] == $_COOKIE['address_'.$pool]) {
        $wallet_found = True;
        ?>
      <div class="text_normal">Statistics for wallet address: <b class="text_break_all"><?php echo $_COOKIE['address_'.$pool]; ?></b></div>
      <hr>
      <div class="text_subheader">Miner information</div>
      <div class="box_long_content bg_dark">
        <div>Wallet address</div>
        <div class="text_large"><?php echo $miner['miner']; ?></div>
      </div>
      <div class="columns_three margin_top_b">
        <div class="box bg_pool">
          <div>Hashrate</div>
          <div class="text_large">
            <?php echo formatLargeNumbers($miner['hashrate'], $pool_configuration['math_precision']).$pool_configuration['hashrate_unit']; ?>
          </div>
          <?php debugData($miner['hashrate'], $page_configuration['debug_mode']); ?>
        </div>
        <div class="box bg_light">
          <div>Efficency</div>
          <div class="text_large"><?php echo formatPercents($miner['efficiency'], $pool_configuration['math_precision']); ?></div>
          <?php debugData($miner['efficiency'], $page_configuration['debug_mode']); ?>
        </div>
        <div class="box bg_light">
          <div>Effort</div>
          <div class="text_large"><?php echo formatPercents($miner['effort'], $pool_configuration['math_precision']); ?></div>
          <?php debugData($miner['effort'], $page_configuration['debug_mode']); ?>
        </div>
      </div>
      <div class="columns_three margin_top_b">
        <div class="box bg_dark">
          <div>Balance</div>
          <div class="text_large">
            <?php echo formatLargeNumbers($miner['balance'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
          </div>
          <?php debugData($miner['balance'], $page_configuration['debug_mode']); ?>
        </div>
        <div class="box bg_light">
          <div>Immature</div>
          <div class="text_large">
            <?php echo formatLargeNumbers($miner['immature'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
          </div>
          <?php debugData($miner['immature'], $page_configuration['debug_mode']); ?>
        </div>
        <div class="box bg_pool">
          <div>Paid</div>
          <div class="text_large">
            <?php echo formatLargeNumbers($miner['paid'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
          </div>
          <?php debugData($miner['paid'], $page_configuration['debug_mode']); ?>
        </div>
      </div>
      <div class="wrap bg_vlight margin_top_b">
        <div class="columns_three">
          <div class="box bg_dark">
            <div>Valid shares</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['valid'], $pool_configuration['math_precision']); ?>
            </div>
            <?php debugData($miner['valid'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="box bg_light">
            <div>Stale shares</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['stale'], $pool_configuration['math_precision']); ?>
            </div>
            <?php debugData($miner['stale'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="box bg_light">
            <div>Invalid shares</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['invalid'], $pool_configuration['math_precision']); ?>
            </div>
            <?php debugData($miner['invalid'], $page_configuration['debug_mode']); ?>
          </div>
        </div>
        <hr class="hr_inner hr_wrap">
        <div class="list_wrap">
          <?php
          foreach ($workers_current as $worker) {
            if ($worker['miner'] == $miner['miner']) {
              $worker_name = getWorkerName($worker['worker']);
              ?>
              <div class="list_wrap gap_small">
                <a onclick="revealContent('worker_<?php echo $worker['id']; ?>');" class="cursor_pointer">
                  <div class="box_small bg_vlight_bdr_pool">
                    <div class="text_reveal_button"><span class="material-symbols-outlined margin_right_b">memory</span>Worker</div>
                    <div class="text_heavy text_right reveal_button">
                      <?php echo $worker_name; ?>
                      <span class="material-symbols-outlined">unfold_more</span>
                    </div>
                  </div>
                </a>
                <div id="worker_<?php echo $worker['id']; ?>" class="hidden">
                  <div class="list_wrap gap_small">
                    <div class="columns_two gap_small">
                      <div class="box_small bg_pool">
                        <div>Hashrate</div>
                        <div class="text_heavy text_right">
                          <?php echo formatLargeNumbers($worker['hashrate'], $pool_configuration['math_precision']).$pool_configuration['hashrate_unit']; ?>
                        </div>
                        <?php debugData($worker['hashrate'], $page_configuration['debug_mode']); ?>
                      </div>
                      <div class="box_small bg_light">
                        <div>Worker type</div>
                        <div class="text_heavy text_right"><?php echo $worker['solo'] ? 'SOLO' : 'SHARED'; ?></div>
                        <?php debugData($worker['solo'] ? 'true' : 'false', $page_configuration['debug_mode']); ?>
                      </div>
                    </div>
                    <div class="columns_two gap_small">
                      <div class="box_small bg_light">
                        <div>Efficiency</div>
                        <div class="text_heavy text_right">
                          <?php echo formatPercents($worker['efficiency'], $pool_configuration['math_precision']); ?>
                        </div>
                        <?php debugData($worker['efficiency'], $page_configuration['debug_mode']); ?>
                      </div>
                      <div class="box_small bg_light">
                        <div>Effort</div>
                        <div class="text_heavy text_right">
                          <?php echo formatPercents($worker['effort'], $pool_configuration['math_precision']); ?>
                        </div>
                        <?php debugData($worker['effort'], $page_configuration['debug_mode']); ?>
                      </div>
                    </div>
                    <div class="columns_three gap_small">
                      <div class="box_small bg_dark">
                        <div>Valid shares</div>
                        <div class="text_heavy text_right">
                          <?php echo formatLargeNumbers($worker['valid'], $pool_configuration['math_precision']); ?>
                        </div>
                        <?php debugData($worker['valid'], $page_configuration['debug_mode']); ?>
                      </div>
                      <div class="box_small bg_light">
                        <div>Stale shares</div>
                        <div class="text_heavy text_right">
                          <?php echo formatLargeNumbers($worker['stale'], $pool_configuration['math_precision']); ?>
                        </div>
                        <?php debugData($worker['stale'], $page_configuration['debug_mode']); ?>
                      </div>
                      <div class="box_small bg_light">
                        <div>Invalid shares</div>
                        <div class="text_heavy text_right">
                          <?php echo formatLargeNumbers($worker['invalid'], $pool_configuration['math_precision']); ?>
                        </div>
                        <?php debugData($worker['invalid'], $page_configuration['debug_mode']); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
      </div>
      <hr>
      <div class="text_subheader">Blocks</div>
      <div class="list_wrap">
        <?php
        foreach ($blocks_combined as $block) {
          if ($block['miner'] == $_COOKIE['address_'.$pool]) {
            $blocks_found = True;
            ?>
            <div class="list_wrap gap_small">
              <a onclick="revealContent('block_<?php echo $block['id']; ?>');" class="cursor_pointer">
                <div class="box_small_long_content bg_vlight_bdr_pool">
                  <div class="text_reveal_button"><span class="material-symbols-outlined margin_right_b">deployed_code</span>Hash</div>
                  <div class="text_heavy text_right reveal_button">
                    <?php echo $block['hash']; ?>
                    <span class="material-symbols-outlined">unfold_more</span>
                  </div>
                </div>
              </a>
              <div id="block_<?php echo $block['id']; ?>" class="hidden">
                <div class="list_wrap gap_small">
                  <div class="box_small_long_content bg_light">
                    <div>Round</div>
                    <div class="text_heavy text_right"><?php echo $block['round']; ?></div>
                  </div>
                  <div class="columns_two gap_small">
                    <div class="box_small bg_light">
                      <div>Submitted</div>
                      <div class="text_heavy text_right"><?php echo formatDateTime($block['submitted']); ?></div>
                      <?php debugData($block['submitted'], $page_configuration['debug_mode']); ?>
                    </div>
                    <div class="box_small bg_dark">
                      <div>Confirmed</div>
                      <div class="text_heavy text_right"><?php echo formatDateTime($block['timestamp']); ?></div>
                      <?php debugData($block['timestamp'], $page_configuration['debug_mode']); ?>
                    </div>
                  </div>
                  <div class="box_small_long_content bg_light">
                    <div>Transaction</div>
                    <div class="text_heavy text_right"><?php echo $block['transaction']; ?></div>
                  </div>
                  <div class="columns_three gap_small">
                    <div class="box_small bg_light">
                      <div>Height</div>
                      <div class="text_heavy text_right"><?php echo $block['height']; ?></div>
                      <?php debugData($block['height'], $page_configuration['debug_mode']); ?>
                    </div>
                    <div class="box_small bg_light">
                      <div>Difficulty</div>
                      <div class="text_heavy text_right">
                        <?php echo formatLargeNumbers($block['difficulty'], $pool_configuration['math_precision']); ?></div>
                      <?php debugData($block['difficulty'], $page_configuration['debug_mode']); ?>
                    </div>
                    <div class="box_small bg_dark">
                      <div>Luck</div>
                      <div class="text_heavy text_right">
                        <?php echo formatPercents($block['luck'], $pool_configuration['math_precision']); ?>
                      </div>
                      <?php debugData($block['luck'], $page_configuration['debug_mode']); ?>
                    </div>
                  </div>
                  <div class="columns_two gap_small">
                    <div class="box_small bg_light">
                      <div>Block type</div>
                      <div class="text_heavy text_right"><?php echo $block['solo'] ? 'SOLO' : 'SHARED'; ?></div>
                      <?php debugData($block['solo'] ? 'true' : 'false', $page_configuration['debug_mode']); ?>
                  </div>
                    <div class="box_small bg_pool">
                      <div>Reward</div>
                      <div class="text_heavy text_right">
                        <?php echo formatLargeNumbers($block['reward'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
                      </div>
                      <?php debugData($block['reward'], $page_configuration['debug_mode']); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
        }
        ?>
      </div>
      <?php
      if (!$blocks_found) {
      ?>
        <div class="text_normal">
          No blocks mined by <b><?php echo $_COOKIE['address_'.$pool]; ?></b> were found.
        </div>
      <?php
      }
      ?>
      <hr>
      <div class="text_subheader">Payments</div>
      <div class="list_wrap">
        <?php
        foreach ($payments_current as $payment) {
          if ($payment['miner'] == $_COOKIE['address_'.$pool]) {
            $payments_found = True;
            ?>
            <div class="list_wrap gap_small">
              <div class="box_small_long_content bg_vlight_bdr_pool">
                <div class="text_reveal_button"><span class="material-symbols-outlined margin_right_b">send_money</span>Transaction</div>
                <div class="text_heavy text_right">
                  <?php echo $payment['transaction']; ?>
                </div>
              </div>
              <div class="columns_two">
                <div class="box_small bg_light">
                  <div>Date</div>
                  <div class="text_heavy text_right"><?php echo formatDateTime($payment['timestamp']); ?></div>
                  <?php debugData($payment['timestamp'], $page_configuration['debug_mode']); ?>
                </div>
                <div class="box_small bg_pool">
                  <div>Amount</div>
                  <div class="text_heavy text_right">
                    <?php echo formatLargeNumbers($payment['amount'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
                  </div>
                  <?php debugData($payment['amount'], $page_configuration['debug_mode']); ?>
                </div>
              </div>
            </div>
          <?php
          }
        }
        ?>
      </div>
      <?php
      if (!$payments_found) {
      ?>
        <div class="text_normal">No payments to <b><?php echo $_COOKIE['address_'.$pool]; ?></b> were found.</div>
      <?php
      }
    }
    if (!$wallet_found) {
    ?>
      <div class="text_normal">Miner <b><?php echo $_COOKIE['address_'.$pool]; ?></b> was not found.</div>
    <?php } ?>
    <hr>
  <?php } ?>
  <form action="<?php echo '?pool='.$pool.'&page=dashboard'; ?>" method="post">
    <div class="wallet_address">
      <input type="text" name="save_address" value="<?php echo $_COOKIE['address_'.$pool]; ?>">
      <input type="submit" value="Submit">
    </div>
  </form>
<?php } ?>
