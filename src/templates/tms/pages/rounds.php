<?php
$rounds_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/rounds?round=current&order=timestamp&direction=descending');
?>
<div class="text_header">Rounds</div>
<div class="text_normal">List of current rounds.</div>
<hr>
<div class="list_wrap">
  <?php
  foreach ($rounds_current as $round) {
    ?>
    <a onclick="revealContent('tx_<?php echo $round['id']; ?>');" class="cursor_pointer">
      <div class="small_box_long_content bg_verylightgrey_poolborder reveal_button"><div>
        <div class="reveal_button_text"><span class="material-symbols-outlined margin_right_b">cached</span><div>Round: <b><?php echo $round['id']; ?></b></div></div>
        <div class="reveal_button_text"><span class="material-symbols-outlined margin_right_b">memory</span><div>Worker: <b><?php echo privacyFilter($round['miner']) . '.' . getWorkerName($round['worker']); ?></b></div></div></div>
        <div class="text_right reveal_button">
          &nbsp;
          <span class="material-symbols-outlined">unfold_more</span>
        </div>
        <?php debugData($round['worker'], $page_configuration['debug_mode']); ?>
      </div>
    </a>
    <div id="tx_<?php echo $round['id']; ?>" class="margin_top_a hidden">
      <div class="list_wrap small_gap">
        <div class="two_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Submitted</div>
            <div class="text_heavy text_right"><?php echo formatDateTime($round['submitted']); ?></div>
            <?php debugData($round['submitted'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_darkgrey">
            <div>Confirmed</div>
            <div class="text_heavy text_right"><?php echo formatDateTime($round['timestamp']); ?></div>
            <?php debugData($round['timestamp'], $page_configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="three_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Invalid shares</div>
            <div class="text_heavy text_right"><?php echo $round['invalid']; ?></div>
            <?php debugData($round['invalid'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_lightgrey">
            <div>Stale shares</div>
            <div class="text_heavy text_right"><?php echo $round['stale']; ?></div>
            <?php debugData($round['stale'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_darkgrey">
            <div>Valid shares</div>
            <div class="text_heavy text_right"><?php echo $round['valid']; ?></div>
            <?php debugData($round['valid'], $page_configuration['debug_mode']); ?>
          </div>
        </div>
        <div class="three_columns small_gap">
          <div class="small_box bg_lightgrey">
            <div>Time</div>
            <div class="text_heavy text_right"><?php echo formatLargeNumbers($round['times'], $pool_configuration['math_precision']); ?></div>
            <?php debugData($round['times'], $page_configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_darkgrey">
            <div>Work type</div>
            <div class="text_heavy text_right"><?php echo ($round['solo'] ? 'SOLO' : 'SHARED'); ?></div>
            <?php debugData($round['solo'] ? 'true' : 'false', $page_configuration['debug_mode']); ?>
          </div>
          <div class="small_box bg_pool">
            <div>Work ammount</div>
            <div class="text_heavy text_right"><?php echo formatLargeNumbers($round['work'], $pool_configuration['math_precision']); ?></div>
            <?php debugData($round['work'], $page_configuration['debug_mode']); ?>
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
