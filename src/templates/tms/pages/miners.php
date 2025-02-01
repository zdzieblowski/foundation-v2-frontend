<?php
$miners_current = getData('http://'.$pool_configuration['pool_ip'].':'.$pool_configuration['pool_port'].'/api/v2/'.$pool_configuration['pool_name'].'/current/miners?limit=10&order=hashrate&direction=descending');
$workers_current = getData('http://'.$pool_configuration['pool_ip'].':'.$pool_configuration['pool_port'].'/api/v2/'.$pool_configuration['pool_name'].'/current/workers?order=hashrate&direction=descending');
?>
<div class="text_header">Miners</div>
<div class="text_normal">List of miners and workers.</div>
<hr>
<div class="list_wrap">
  <?php
  foreach ($miners_current as $miner) {
    ?>
    <a onclick="revealContent('miner_<?php echo $miner['id']; ?>');" style="cursor: pointer;">
      <div class="small_box_long_content bg_verylightgrey_orangeborder reveal_button">
        <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">dns</span><div>Miner: <b><?php echo privacyFilter($miner['miner']); ?></b></div></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
        <?php debugData($miner['miner'], $configuration['debug_mode']); ?>
      </div>
    </a>
    <div id="miner_<?php echo $miner['id']; ?>" style="margin-top: -4px;" class="hidden">
      <div class="list_wrap small_gap">
        <div class="three_columns small_gap">
          <div class="small_box bg_orange">
            <div>Hashrate</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['pool_hashrate_unit']; ?>
            </div>
            <?php debugData($miner['hashrate'], $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_lightgrey">
            <div>Efficency</div>
            <div class="text_heavy text_right">
              <?php echo formatPercents($miner['efficiency'], $pool_configuration['math_precision']); ?>
            </div>
            <?php debugData($miner['efficiency'], $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_lightgrey">
            <div>Effort</div>
            <div class="text_heavy text_right">
              <?php echo formatPercents($miner['effort'], $pool_configuration['math_precision']); ?>
            </div>
            <?php debugData($miner['effort'], $configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="three_columns small_gap">
          <div class="small_box bg_darkgrey">
            <div>Balance</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['balance'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['balance'], $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_lightgrey">
            <div>Immature</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['immature'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['immature'], $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_orange">
            <div>Paid</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['paid'], $pool_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['paid'], $configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="wrap bg_verylightgrey small_gap">
          <div class="three_columns small_gap">
            <div class="small_box bg_darkgrey">
              <div>Valid shares</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($miner['valid'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['valid'], $configuration['debug_mode']); ?>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Stale shares</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($miner['stale'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['stale'], $configuration['debug_mode']); ?>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Invalid shares</div>
              <div class="text_heavy text_right">
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
                  <a onclick="revealContent('minwor_<?php echo $miner['id'] . $worker['id']; ?>');" style="cursor: pointer;">
                    <div class="small_box bg_verylightgrey_darkgreyborder">
                      <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">memory</span><div>Worker: <b><?php echo $worker_name; ?></b></div></div>
                      <div class="text_right reveal_button">
                        &nbsp;
                        <span class="material-symbols-outlined">unfold_more</span>
                      </div>
                    </div>
                  </a>
                  <div id="minwor_<?php echo $miner['id'] . $worker['id']; ?>" class="hidden">
                    <div class="list_wrap small_gap">
                      <div class="two_columns small_gap">
                        <div class="small_box bg_darkgrey">
                          <div>Hashrate</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['pool_hashrate_unit']; ?>
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
      </div>
    </div>
    <?php if ($miner != end($miners_current)) { ?>
      <hr class="inner_hr list_hr">
      <?php
    }
  }
  ?>
</div>
