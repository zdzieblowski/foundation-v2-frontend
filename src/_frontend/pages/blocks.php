<?php
$blocks_combined = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/combined/blocks?limit=5&order=height&direction=descending');
$rounds_combined = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/combined/rounds');
?>
<div class="text_header">Blocks</div>
<div class="text_normal">List of mined blocks and rounds.</div>
<hr />
<div class="list_wrap">
  <?php
  foreach ($blocks_combined as $block) {
    ?>
    <div class="list_wrap small_gap">
      <a onclick="revealContent('block_<?php echo $block['id']; ?>');" style="cursor: pointer;">
        <div class="small_box_long_content bg_verylightgrey_orangeborder">
          <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">deployed_code</span><div>Block: <b><?php echo privacyFilter($block['hash'], 21); ?></b></div></div>
          <div class="text_heavy text_right reveal_button">
            &nbsp;
            <span class="material-symbols-outlined">unfold_more</span>
          </div>
          <?php debugData($block['hash'], $page_configuration['page_debugmode']); ?>
        </div>
      </a>
      <div id="block_<?php echo $block['id']; ?>" class="hidden">
        <div class="list_wrap small_gap">
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
          <div class="three_columns small_gap">
            <div class="small_box bg_lightgrey">
              <div>Height</div>
              <div class="text_heavy text_right"><?php echo $block['height']; ?></div>
              <?php debugData($block['height'], $page_configuration['page_debugmode']); ?>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Difficulty</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($block['difficulty'], $frontend_configuration['math_precision']); ?>
              </div>
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
          <div class="wrap bg_verylightgrey">
            <div class="list_wrap small_gap">
              <div class="small_box_long_content bg_lightgrey">
                <div>Winner</div>
                <div class="text_heavy text_right">
                  <?php echo privacyFilter($block['miner']) . '.' . getWorkerName($block['worker']); ?>
                </div>
                <?php debugData($block['worker'], $page_configuration['page_debugmode']); ?>
              </div>
              <div class="small_box_long_content bg_lightgrey">
                <div>Transaction</div>
                <div class="text_heavy text_right"><?php echo privacyFilter($block['transaction'], 21); ?></div>
                <?php debugData($block['transaction'], $page_configuration['page_debugmode']); ?>
              </div>
            </div>
          </div>
          <div class="wrap bg_verylightgrey">
            <div class="list_wrap small_gap">
              <a onclick="revealContent('<?php echo $block['round']; ?>');" style="cursor: pointer;">
                <div class="small_box_long_content bg_verylightgrey_darkgreyborder">
                  <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">cached</span>Round</div>
                  <div class="text_heavy text_right reveal_button">
                    <?php echo $block['round']; ?>
                    <span class="material-symbols-outlined">unfold_more</span>
                  </div>
                </div>
              </a>
              <div id="<?php echo $block['round']; ?>" class="hidden">
                <div class="list_wrap small_gap">
                  <?php
                  foreach ($rounds_combined as $round) {
                    if ($round['round'] == $block['round']) {
                      ?>
                      <div class="list_wrap small_gap">
                        <div class="small_box_long_content bg_lightgrey">
                          <div>Worker</div>
                          <div class="text_heavy text_right">
                            <?php echo privacyFilter($round['miner']) . '.' . getWorkerName($round['worker']); ?>
                          </div>
                          <?php debugData($round['worker'], $page_configuration['page_debugmode']); ?>
                        </div>
                        <div class="three_columns small_gap">
                          <div class="small_box bg_darkgrey">
                            <div>Valid shares</div>
                            <div class="text_heavy text_right">
                              <?php echo formatLargeNumbers($round['valid'], $frontend_configuration['math_precision']); ?>
                            </div>
                            <?php debugData($round['valid'], $page_configuration['page_debugmode']); ?>
                          </div>
                          <div class="small_box bg_lightgrey">
                            <div>Stale shares</div>
                            <div class="text_heavy text_right">
                              <?php echo formatLargeNumbers($round['stale'], $frontend_configuration['math_precision']); ?>
                            </div>
                            <?php debugData($round['stale'], $page_configuration['page_debugmode']); ?>
                          </div>
                          <div class="small_box bg_lightgrey">
                            <div>Invalid shares</div>
                            <div class="text_heavy text_right">
                              <?php echo formatLargeNumbers($round['invalid'], $frontend_configuration['math_precision']); ?>
                            </div>
                            <?php debugData($round['invalid'], $page_configuration['page_debugmode']); ?>
                          </div>
                        </div>
                      </div>
                      <?php if ($round != end($rounds_combined)) { ?>
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
          <div class="two_columns small_gap">
            <div class="small_box bg_lightgrey">
              <div>Block type</div>
              <div class="text_heavy text_right"><?php echo ($block['solo'] ? 'SOLO' : 'SHARED'); ?></div>
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
    <?php if ($block != end($blocks_combined)) { ?>
      <hr class="inner_hr list_hr" />
      <?php
    }
  } ?>
</div>
