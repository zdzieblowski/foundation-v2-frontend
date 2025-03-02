<?php
$miners_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/miners?limit=10&order=hashrate&direction=descending');
$workers_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/workers?order=hashrate&direction=descending');
?>
<div class="text_header">Miners</div>
<div class="text_normal">List of miners and workers.</div>
<hr>
<div class="list_wrap">
  <?php
  foreach ($miners_current as $miner) {
    ?>
    <a onclick="revealContent('miner_<?php echo $miner['id']; ?>');" class="cursor_pointer">
      <div class="box_small_long_content bg_vlight_bdr_pool reveal_button">
        <div class="text_reveal_button"><span class="material-symbols-outlined margin_right_b">dns</span><div>Miner: <b><?php echo privacyFilter($miner['miner']); ?></b></div></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
        <?php debugData($miner['miner'], $page_configuration['debug_mode']); ?>
      </div>
    </a>
    <div id="miner_<?php echo $miner['id']; ?>" class="margin_top_a hidden">
      <div class="list_wrap gap_small">
        <div class="columns_three gap_small">
          <div class="box_small bg_pool">
            <div>Hashrate</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['hashrate'], $pool_configuration['math_precision']).$pool_configuration['hashrate_unit']; ?>
            </div>
            <?php debugData($miner['hashrate'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="box_small bg_light">
            <div>Efficency</div>
            <div class="text_heavy text_right">
              <?php echo formatPercents($miner['efficiency'], $pool_configuration['math_precision']); ?>
            </div>
            <?php debugData($miner['efficiency'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="box_small bg_light">
            <div>Effort</div>
            <div class="text_heavy text_right">
              <?php echo formatPercents($miner['effort'], $pool_configuration['math_precision']); ?>
            </div>
            <?php debugData($miner['effort'], $page_configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="columns_three gap_small">
          <div class="box_small bg_dark">
            <div>Balance</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['balance'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['balance'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="box_small bg_light">
            <div>Immature</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['immature'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['immature'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="box_small bg_pool">
            <div>Paid</div>
            <div class="text_heavy text_right">
              <?php echo formatLargeNumbers($miner['paid'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
            </div>
            <?php debugData($miner['paid'], $page_configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="wrap bg_vlight gap_small">
          <div class="columns_three gap_small">
            <div class="box_small bg_dark">
              <div>Valid shares</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($miner['valid'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['valid'], $page_configuration['debug_mode']); ?>
            </div>
            <div class="box_small bg_light">
              <div>Stale shares</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($miner['stale'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($miner['stale'], $page_configuration['debug_mode']); ?>
            </div>
            <div class="box_small bg_light">
              <div>Invalid shares</div>
              <div class="text_heavy text_right">
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
                  <a onclick="revealContent('minwor_<?php echo $miner['id'].$worker['id']; ?>');" class="cursor_pointer">
                    <div class="box_small bg_vlight_bdr_dark">
                      <div class="text_reveal_button"><span class="material-symbols-outlined margin_right_b">memory</span><div>Worker: <b><?php echo $worker_name; ?></b></div></div>
                      <div class="text_right reveal_button">
                        &nbsp;
                        <span class="material-symbols-outlined">unfold_more</span>
                      </div>
                    </div>
                  </a>
                  <div id="minwor_<?php echo $miner['id'].$worker['id']; ?>" class="hidden">
                    <div class="list_wrap gap_small">
                      <div class="columns_two gap_small">
                        <div class="box_small bg_dark">
                          <div>Hashrate</div>
                          <div class="text_heavy text_right">
                            <?php echo formatLargeNumbers($worker['hashrate'], $pool_configuration['math_precision']).$pool_configuration['hashrate_unit']; ?>
                          </div>
                          <?php debugData($worker['hashrate'], $page_configuration['debug_mode']); ?>
                        </div>
                        <div class="box_small bg_light">
                          <div>Worker type</div>
                          <div class="text_heavy text_right"><?php echo ($worker['solo'] ? 'SOLO' : 'SHARED'); ?></div>
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
      </div>
    </div>
    <?php if ($miner != end($miners_current)) { ?>
      <hr class="hr_inner hr_list">
    <?php
    }
  }
  ?>
</div>
