<?php
$miners_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/miners');
$workers_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/workers');
$blocks_combined = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/combined/blocks?limit=5&order=timestamp&direction=descending');
$payments_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/historical/payments?limit=10&order=timestamp&direction=descending');
?>
<div class="text_header">Dashboard</div>
<?php if (isset($_POST['save_address'])): ?>
  <?php
  setcookie('address_'.$pool, $_POST['save_address']);
  header('Refresh:0; url=?coin='.$pool.'&page=dashboard');
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
        <hr />
        <div class="text_subheader">Miner information</div>
        <div class="box_long_content bg_darkgrey">
          <div>Wallet address</div>
          <div class="text_large"><?php echo $miner['miner']; ?></div>
        </div>
        <div class="three_columns mt-8px">
          <div class="box bg_orange">
            <div>Hashrate</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['hashrate'], $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit']; ?>
            </div>
            <?php debugData($miner['hashrate'], $page_configuration['page_debugmode']); ?>
          </div>
          <div class="box bg_lightgrey">
            <div>Efficency</div>
            <div class="text_large"><?php echo formatPercents($miner['efficiency'], $frontend_configuration['math_precision']); ?></div>
            <?php debugData($miner['efficiency'], $page_configuration['page_debugmode']); ?>
          </div>
          <div class="box bg_lightgrey">
            <div>Effort</div>
            <div class="text_large"><?php echo formatPercents($miner['effort'], $frontend_configuration['math_precision']); ?></div>
            <?php debugData($miner['effort'], $page_configuration['page_debugmode']); ?>
          </div>
        </div>
        <div class="three_columns mt-8px">
          <div class="box bg_darkgrey">
            <div>Balance</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['balance'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['balance'], $page_configuration['page_debugmode']); ?>
          </div>
          <div class="box bg_lightgrey">
            <div>Immature</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['immature'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['immature'], $page_configuration['page_debugmode']); ?>
          </div>
          <div class="box bg_orange">
            <div>Paid</div>
            <div class="text_large">
              <?php echo formatLargeNumbers($miner['paid'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['paid'], $page_configuration['page_debugmode']); ?>
          </div>
        </div>
        <div class="wrap bg_verylightgrey mt-8px">
          <div class="three_columns">
            <div class="box bg_darkgrey">
              <div>Valid shares</div>
              <div class="text_large">
                <?php echo formatLargeNumbers($miner['valid'], $frontend_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['valid'], $page_configuration['page_debugmode']); ?>
            </div>
            <div class="box bg_lightgrey">
              <div>Stale shares</div>
              <div class="text_large">
                <?php echo formatLargeNumbers($miner['stale'], $frontend_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['stale'], $page_configuration['page_debugmode']); ?>
            </div>
            <div class="box bg_lightgrey">
              <div>Invalid shares</div>
              <div class="text_large">
                <?php echo formatLargeNumbers($miner['invalid'], $frontend_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['invalid'], $page_configuration['page_debugmode']); ?>
            </div>
          </div>
          <hr class="inner_hr wrap_hr" />
          <div class="list_wrap">
            <?php
            foreach ($workers_current as $worker) {
              if ($worker['miner'] == $miner['miner']) {
                $worker_name = explode('.', $worker['worker'], 2)[1];
                $worker_name = $worker_name ? $worker_name : 'UNNAMED';
                ?>
                <div class="list_wrap small_gap">
                  <a onclick="revealContent('worker_<?php echo $worker['id']; ?>');" style="cursor: pointer;">
                    <div class="small_box bg_verylightgrey_orangeborder">
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
                        <div class="small_box bg_orange">
                          <div>Hashrate</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['hashrate'], $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit']; ?>
                          </div>
                          <?php debugData($worker['hashrate'], $page_configuration['page_debugmode']); ?>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Worker type</div>
                          <div class="text_heavy text_right"><?php echo ($worker['solo'] ? 'SOLO' : 'SHARED'); ?></div>
                          <?php debugData($worker['solo'] ? 'true' : 'false', $page_configuration['page_debugmode']); ?>
                        </div>
                      </div>
                      <div class="two_columns small_gap">
                        <div class="small_box bg_lightgrey">
                          <div>Efficiency</div>
                          <div class="text_heavy text_right">
                            <?php echo formatPercents($worker['efficiency'], $frontend_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['efficiency'], $page_configuration['page_debugmode']); ?>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Effort</div>
                          <div class="text_heavy text_right">
                            <?php echo formatPercents($worker['effort'], $frontend_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['effort'], $page_configuration['page_debugmode']); ?>
                        </div>
                      </div>
                      <div class="three_columns small_gap">
                        <div class="small_box bg_darkgrey">
                          <div>Valid shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['valid'], $frontend_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['valid'], $page_configuration['page_debugmode']); ?>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Stale shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['stale'], $frontend_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['stale'], $page_configuration['page_debugmode']); ?>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Invalid shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['invalid'], $frontend_configuration['math_precision']); ?>
                          </div>
                          <?php debugData($worker['invalid'], $page_configuration['page_debugmode']); ?>
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
        <hr />
        <div class="text_subheader">Blocks</div>
        <div class="list_wrap">
          <?php
          foreach ($blocks_combined as $block) {
            if ($block['miner'] == $_COOKIE['address_'.$pool]) {
              $blocks_found = True;
              ?>
              <div class="list_wrap small_gap">
                <a onclick="revealContent('block_<?php echo $block['id']; ?>');" style="cursor: pointer;">
                  <div class="small_box_long_content bg_verylightgrey_orangeborder">
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
                        <?php debugData($block['submitted'], $page_configuration['page_debugmode']); ?>
                      </div>
                      <div class="small_box bg_darkgrey">
                        <div>Confirmed</div>
                        <div class="text_heavy text_right"><?php echo formatDateTime($block['timestamp']); ?></div>
                        <?php debugData($block['timestamp'], $page_configuration['page_debugmode']); ?>
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
                        <?php debugData($block['height'], $page_configuration['page_debugmode']); ?>
                      </div>
                      <div class="small_box bg_lightgrey">
                        <div>Difficulty</div>
                        <div class="text_heavy text_right">
                          <?php echo formatLargeNumbers($block['difficulty'], $frontend_configuration['math_precision']); ?></div>
                        <?php debugData($block['difficulty'], $page_configuration['page_debugmode']); ?>
                      </div>
                      <div class="small_box bg_darkgrey">
                        <div>Luck</div>
                        <div class="text_heavy text_right">
                          <?php echo formatPercents($block['luck'], $frontend_configuration['math_precision']); ?>
                        </div>
                        <?php debugData($block['luck'], $page_configuration['page_debugmode']); ?>
                      </div>
                    </div>
                    <div class="two_columns small_gap">
                      <div class="small_box bg_lightgrey">
                        <div>Block type</div>
                        <div class="text_heavy text_right"><?php echo $block['solo'] ? 'SOLO' : 'SHARED'; ?></div>
                        <?php debugData($block['solo'] ? 'true' : 'false', $page_configuration['page_debugmode']); ?>
                    </div>
                      <div class="small_box bg_orange">
                        <div>Reward</div>
                        <div class="text_heavy text_right">
                          <?php echo formatLargeNumbers($block['reward'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
                        </div>
                        <?php debugData($block['reward'], $page_configuration['page_debugmode']); ?>
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
        <hr />
        <div class="text_subheader">Payments</div>
        <div class="list_wrap">
          <?php
          foreach ($payments_current as $payment) {
            if ($payment['miner'] == $_COOKIE['address_'.$pool]) {
              $payments_found = True;
              ?>
              <div class="list_wrap small_gap">
                <div class="small_box_long_content bg_verylightgrey_orangeborder">
                  <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">send_money</span>Transaction</div>
                  <div class="text_heavy text_right">
                    <?php echo $payment['transaction']; ?>
                  </div>
                </div>
                <div class="two_columns">
                  <div class="small_box bg_lightgrey">
                    <div>Date</div>
                    <div class="text_heavy text_right"><?php echo formatDateTime($payment['timestamp']); ?></div>
                    <?php debugData($payment['timestamp'], $page_configuration['page_debugmode']); ?>
                  </div>
                  <div class="small_box bg_orange">
                    <div>Amount</div>
                    <div class="text_heavy text_right">
                      <?php echo formatLargeNumbers($payment['amount'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
                    </div>
                    <?php debugData($payment['amount'], $page_configuration['page_debugmode']); ?>
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
    <hr />
  <?php endif ?>
  <form action="<?php echo '?coin='.$pool.'&page=dashboard'; ?>" method="post">
    <div class="wallet_address">
      <input type="text" name="save_address" value="<?php echo $_COOKIE['address_'.$pool]; ?>" />
      <input type="submit" value="Submit" />
    </div>
  </form>
<?php endif ?>
