<?php
$miners_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/miners');
$workers_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/workers');
$blocks_combined = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/combined/blocks?limit=5&order=timestamp&direction=descending');
$payments_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/historical/payments?limit=10&order=timestamp&direction=descending');
?>
<div class="text_header">Dashboard</div>
<?php if (isset($_POST['save_address'])): ?>
  <?php
  setcookie('address_'.$pool, $_POST['save_address']);
  header('Refresh:0; url=?pool='.$pool.'&page=dashboard');
?>
<?php else: ?>
  <?php if (!isset($_COOKIE['address_'.$pool])): ?>
    <div class="text_normal">Enter wallet address to see your statistics.</div>
  <?php else: ?>
    <?php
    $wallet_found = False;
    $blocks_found = False;
    $payments_found = False;
    foreach ($miners_current as $miner) {
      if ($miner['miner'] == $_COOKIE['address_'.$pool]) {
        $wallet_found = True;
        ?>
        <div class="text_normal">Statistics for wallet address: <b style="word-break: break-all;"><?php echo $_COOKIE['address_'.$pool]; ?></b></div>
        <hr>
        <div class="text_subheader">Miner information</div>
        <div class="box_long_content bg_darkgrey">
          <div>Wallet address</div>
          <div class="text_large"><?php echo $miner['miner']; ?></div>
        </div>
        <div class="three_columns mt-8px">
          <div class="box bg_pool">
            <div>Hashrate</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
            </div>
            <?php debugData($miner['hashrate'], $configuration['debug_mode']); ?>
          </div>
          <div class="box bg_lightgrey">
            <div>Efficency</div>
            <div class="text_large"><?php echo formatPercents($miner['efficiency'], $pool_configuration['math_precision']); ?></div>
            <?php debugData($miner['efficiency'], $configuration['debug_mode']); ?>
          </div>
          <div class="box bg_lightgrey">
            <div>Effort</div>
            <div class="text_large"><?php echo formatPercents($miner['effort'], $pool_configuration['math_precision']); ?></div>
            <?php debugData($miner['effort'], $configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="three_columns mt-8px">
          <div class="box bg_darkgrey">
            <div>Balance</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['balance'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['balance'], $configuration['debug_mode']); ?>
          </div>
          <div class="box bg_lightgrey">
            <div>Immature</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['immature'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['immature'], $configuration['debug_mode']); ?>
          </div>
          <div class="box bg_pool">
            <div>Paid</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['paid'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['paid'], $configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="wrap bg_verylightgrey mt-8px">
          <div class="three_columns">
            <div class="box bg_darkgrey">
              <div>Valid shares</div>
              <div class="text_large">
                <?php echo formatLargeNumbers($miner['valid'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['valid'], $configuration['debug_mode']); ?>
            </div>
            <div class="box bg_lightgrey">
              <div>Stale shares</div>
              <div class="text_large">
                <?php echo formatLargeNumbers($miner['stale'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['stale'], $configuration['debug_mode']); ?>
            </div>
            <div class="box bg_lightgrey">
              <div>Invalid shares</div>
              <div class="text_large">
                <?php echo formatLargeNumbers($miner['invalid'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['invalid'], $configuration['debug_mode']); ?>
            </div>
          </div>
          <hr class="inner_hr wrap_hr">
          <div class="list_wrap">
            <?php
            foreach ($workers_current as $worker) {
              if ($worker['miner'] == $miner['miner']) {
                //$worker_name = explode('.', $worker['worker'], 2)[1];
                //$worker_name = $worker_name ? $worker_name : 'UNNAMED';
                $worker_name = getWorkerName($worker['worker']);
                ?>
                <div class="list_wrap small_gap">
                  <a onclick="revealContent('worker_<?php echo $worker['id']; ?>');" style="cursor: pointer;">
                    <div class="small_box bg_verylightgrey_poolborder">
                      <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">memory</span>Worker</div>
                      <div class="text_heavy text_right reveal_button">
                        <?php echo $worker_name; ?>
                        <span class="material-symbols-outlined">unfold_more</span>
                      </div>
                    </div>
                  </a>
                  <div id="worker_<?php echo $worker['id']; ?>" class="hidden">
                    <div class="list_wrap small_gap">
                      <div class="two_columns small_gap">
                        <div class="small_box bg_pool">
                          <div>Hashrate</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
                          </div>
                          <?php debugData($worker['hashrate'], $configuration['debug_mode']); ?>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Worker type</div>
                          <div class="text_heavy text_right"><?php echo ($worker['solo'] ? 'SOLO' : 'SHARED'); ?></div>
                          <?php debugData($worker['solo'] ? 'true' : 'false', $configuration['debug_mode']); ?>
                        </div>
                      </div>
                      <div class="two_columns small_gap">
                        <div class="small_box bg_lightgrey">
                          <div>Efficiency</div>
                          <div class="text_heavy text_right">
                            <?php echo formatPercents($worker['efficiency'], $pool_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['efficiency'], $configuration['debug_mode']); ?>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Effort</div>
                          <div class="text_heavy text_right">
                            <?php echo formatPercents($worker['effort'], $pool_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['effort'], $configuration['debug_mode']); ?>
                        </div>
                      </div>
                      <div class="three_columns small_gap">
                        <div class="small_box bg_darkgrey">
                          <div>Valid shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['valid'], $pool_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['valid'], $configuration['debug_mode']); ?>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Stale shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['stale'], $pool_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['stale'], $configuration['debug_mode']); ?>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Invalid shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['invalid'], $pool_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['invalid'], $configuration['debug_mode']); ?>
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
              <div class="list_wrap small_gap">
                <a onclick="revealContent('block_<?php echo $block['id']; ?>');" style="cursor: pointer;">
                  <div class="small_box_long_content bg_verylightgrey_poolborder">
                    <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">deployed_code</span>Hash</div>
                    <div class="text_heavy text_right reveal_button">
                      <?php echo $block['hash']; ?>
                      <span class="material-symbols-outlined">unfold_more</span>
                    </div>
                  </div>
                </a>
                <div id="block_<?php echo $block['id']; ?>" class="hidden">
                  <div class="list_wrap small_gap">
                    <div class="small_box_long_content bg_lightgrey">
                      <div>Round</div>
                      <div class="text_heavy text_right"><?php echo $block['round']; ?></div>
                    </div>
                    <div class="two_columns small_gap">
                      <div class="small_box bg_lightgrey">
                        <div>Submitted</div>
                        <div class="text_heavy text_right"><?php echo formatDateTime($block['submitted']); ?></div>
                        <?php debugData($block['submitted'], $configuration['debug_mode']); ?>
                      </div>
                      <div class="small_box bg_darkgrey">
                        <div>Confirmed</div>
                        <div class="text_heavy text_right"><?php echo formatDateTime($block['timestamp']); ?></div>
                        <?php debugData($block['timestamp'], $configuration['debug_mode']); ?>
                      </div>
                    </div>
                    <div class="small_box_long_content bg_lightgrey">
                      <div>Transaction</div>
                      <div class="text_heavy text_right"><?php echo $block['transaction']; ?></div>
                    </div>
                    <div class="three_columns small_gap">
                      <div class="small_box bg_lightgrey">
                        <div>Height</div>
                        <div class="text_heavy text_right"><?php echo $block['height']; ?></div>
                        <?php debugData($block['height'], $configuration['debug_mode']); ?>
                      </div>
                      <div class="small_box bg_lightgrey">
                        <div>Difficulty</div>
                        <div class="text_heavy text_right">
                          <?php echo formatLargeNumbers($block['difficulty'], $pool_configuration['math_precision']); ?></div>
                        <?php debugData($block['difficulty'], $configuration['debug_mode']); ?>
                      </div>
                      <div class="small_box bg_darkgrey">
                        <div>Luck</div>
                        <div class="text_heavy text_right">
                          <?php echo formatPercents($block['luck'], $pool_configuration['math_precision']); ?>
                        </div>
                        <?php debugData($block['luck'], $configuration['debug_mode']); ?>
                      </div>
                    </div>
                    <div class="two_columns small_gap">
                      <div class="small_box bg_lightgrey">
                        <div>Block type</div>
                        <div class="text_heavy text_right"><?php echo $block['solo'] ? 'SOLO' : 'SHARED'; ?></div>
                        <?php debugData($block['solo'] ? 'true' : 'false', $configuration['debug_mode']); ?>
                    </div>
                      <div class="small_box bg_pool">
                        <div>Reward</div>
                        <div class="text_heavy text_right">
                          <?php echo formatLargeNumbers($block['reward'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
                        </div>
                        <?php debugData($block['reward'], $configuration['debug_mode']); ?>
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
              <div class="list_wrap small_gap">
                <div class="small_box_long_content bg_verylightgrey_poolborder">
                  <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">send_money</span>Transaction</div>
                  <div class="text_heavy text_right">
                    <?php echo $payment['transaction']; ?>
                  </div>
                </div>
                <div class="two_columns">
                  <div class="small_box bg_lightgrey">
                    <div>Date</div>
                    <div class="text_heavy text_right"><?php echo formatDateTime($payment['timestamp']); ?></div>
                    <?php debugData($payment['timestamp'], $configuration['debug_mode']); ?>
                  </div>
                  <div class="small_box bg_pool">
                    <div>Amount</div>
                    <div class="text_heavy text_right">
                      <?php echo formatLargeNumbers($payment['amount'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
                    </div>
                    <?php debugData($payment['amount'], $configuration['debug_mode']); ?>
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
    }
    if (!$wallet_found) {
      ?>
      <div class="text_normal">Miner <b><?php echo $_COOKIE['address_'.$pool]; ?></b> was not found.</div>
      <?php
    }
    ?>
    <hr>
  <?php endif ?>
  <form action="<?php echo '?pool='.$pool.'&page=dashboard'; ?>" method="post">
    <div class="wallet_address">
      <input type="text" name="save_address" value="<?php echo $_COOKIE['address_'.$pool]; ?>">
      <input type="submit" value="Submit">
    </div>
  </form>
<?php endif ?>
