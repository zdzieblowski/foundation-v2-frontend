<?php
$miners_current = getData('http://localhost:3001/api/v2/evrmore/current/miners');
$workers_current = getData('http://localhost:3001/api/v2/evrmore/current/workers');
?>
<div class="text_header">Miners</div>
<div class="text_normal">List of miners and workers.</div>
<hr />
<div class="list_wrap">
  <?php
  foreach ($miners_current as $miner) {
    ?>
    <a onclick="revealContent('<?php echo $miner['id']; ?>');" style="cursor: pointer;">
      <div class="small_box_long_content bg_verylightgrey_orangeborder reveal_button">
        <div>Miner: <b><?php echo privacyFilter($miner['miner']); ?></b></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
      </div>
    </a>
    <div id="<?php echo $miner['id']; ?>" style="margin-top: -4px;" class="hidden">
      <div class="list_wrap small_gap">
        <div class="three_columns small_gap">
          <div class="small_box bg_orange">
            <div>Hashrate</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['hashrate'], $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit']; ?>
            </div>
          </div>
          <div class="small_box bg_lightgrey">
            <div>Efficency</div>
            <div class="text_heavy text_right">
              <?php echo round($miner['efficiency'], $frontend_configuration['math_precision']); ?>%</div>
          </div>
          <div class="small_box bg_lightgrey">
            <div>Effort</div>
            <div class="text_heavy text_right">
              <?php echo round($miner['effort'], $frontend_configuration['math_precision']); ?>%</div>
          </div>
        </div>
        <div class="three_columns small_gap">
          <div class="small_box bg_darkgrey">
            <div>Balance</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['balance'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
          </div>
          <div class="small_box bg_lightgrey">
            <div>Immature</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['immature'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
          </div>
          <div class="small_box bg_orange">
            <div>Paid</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['paid'], $frontend_configuration['math_precision']) . $server_configuration['symbol']; ?>
            </div>
          </div>
        </div>
        <div class="wrap bg_verylightgrey small_gap">
          <div class="three_columns small_gap">
            <div class="small_box bg_darkgrey">
              <div>Valid shares</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($miner['valid'], $frontend_configuration['math_precision']); ?></div>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Stale shares</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($miner['stale'], $frontend_configuration['math_precision']); ?></div>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Invalid shares</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($miner['invalid'], $frontend_configuration['math_precision']); ?></div>
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
                  <a onclick="revealContent('<?php echo $miner['id'] . $worker['id']; ?>');" style="cursor: pointer;">
                    <div class="small_box bg_verylightgrey_darkgreyborder">
                      <div>Worker: <b><?php echo $worker_name; ?></b></div>
                      <div class="text_right reveal_button">
                        &nbsp;
                        <span class="material-symbols-outlined">unfold_more</span>
                      </div>
                    </div>
                  </a>
                  <div id="<?php echo $miner['id'] . $worker['id']; ?>" class="hidden">
                    <div class="list_wrap small_gap">
                      <div class="two_columns small_gap">
                        <div class="small_box bg_darkgrey">
                          <div>Hashrate</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['hashrate'], $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit']; ?>
                          </div>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Worker type</div>
                          <div class="text_heavy text_right"><?php echo ($worker['solo'] ? 'SOLO' : 'SHARED'); ?></div>
                        </div>
                      </div>
                      <div class="two_columns small_gap">
                        <div class="small_box bg_lightgrey">
                          <div>Efficiency</div>
                          <div class="text_heavy text_right">
                            <?php echo round($worker['efficiency'], $frontend_configuration['math_precision']); ?>%</div>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Effort</div>
                          <div class="text_heavy text_right">
                            <?php echo round($worker['effort'], $frontend_configuration['math_precision']); ?>%</div>
                        </div>
                      </div>
                      <div class="three_columns small_gap">
                        <div class="small_box bg_darkgrey">
                          <div>Valid shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['valid'], $frontend_configuration['math_precision']); ?>
                          </div>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Stale shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['stale'], $frontend_configuration['math_precision']); ?>
                          </div>
                        </div>
                        <div class="small_box bg_lightgrey">
                          <div>Invalid shares</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['invalid'], $frontend_configuration['math_precision']); ?>
                          </div>
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
      <hr class="inner_hr list_hr" />
      <?php
    }
  }
  ?>
</div>
