<?php
$rounds_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/rounds?round=current&order=timestamp&direction=descending');
//$payments_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/payments');
?>
<div class="text_header">Rounds</div>
<div class="text_normal">List of current rounds.</div>
<hr>
<div class="list_wrap">
  <?php
  foreach ($rounds_current as $round) {
    ?>
    <a onclick="revealContent('tx_<?php echo $round['id']; ?>');" style="cursor: pointer;">
      <div class="small_box_long_content bg_verylightgrey_poolborder reveal_button"><div>
        <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">cached</span><div>Round: <b><?php echo $round['id']; ?></b></div></div>
        <div style="display: grid; grid-template-columns: min-content auto; align-items: center;"><span class="material-symbols-outlined" style="margin-right: 8px;">memory</span><div>Worker: <b><?php echo privacyFilter($round['miner']) . '.' . getWorkerName($round['worker']); ?></b></div></div></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
        <?php debugData($round['worker'], $configuration['debug_mode']); ?>
      </div>
    </a>
    <div id="tx_<?php echo $round['id']; ?>" style="margin-top: -4px;" class="hidden">
      <div class="list_wrap small_gap">
        <div class="two_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Submitted</div>
            <div class="text_heavy text_right"><?php echo formatDateTime($round['submitted']); ?></div>
            <?php debugData($round['submitted'], $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_darkgrey">
            <div>Confirmed</div>
            <div class="text_heavy text_right"><?php echo formatDateTime($round['timestamp']); ?></div>
            <?php debugData($round['timestamp'], $configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="three_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Invalid shares</div>
            <div class="text_heavy text_right"><?php echo $round['invalid']; ?></div>
            <?php debugData($round['invalid'], $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_lightgrey">
            <div>Stale shares</div>
            <div class="text_heavy text_right"><?php echo $round['stale']; ?></div>
            <?php debugData($round['stale'], $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_darkgrey">
            <div>Valid shares</div>
            <div class="text_heavy text_right"><?php echo $round['valid']; ?></div>
            <?php debugData($round['valid'], $configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="three_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Time</div>
            <div class="text_heavy text_right"><?php echo formatLargeNumbers($round['times'], $pool_configuration['math_precision']); ?></div>
            <?php debugData($round['times'], $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_darkgrey">
            <div>Work type</div>
            <div class="text_heavy text_right"><?php echo ($round['solo'] ? 'SOLO' : 'SHARED'); ?></div>
            <?php debugData($round['solo'] ? 'true' : 'false', $configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_pool">
            <div>Work ammount</div>
            <div class="text_heavy text_right"><?php echo formatLargeNumbers($round['work'], $pool_configuration['math_precision']); ?></div>
            <?php debugData($round['work'], $configuration['debug_mode']); ?>
          </div>
        </div>
      </div>
    </div>
    <?php if ($round != end($rounds_current)) { ?>
      <hr class="inner_hr list_hr">
      <?php
    }
  }
  ?>
</div>
