<?php
$rounds_current = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/rounds?limit=10&order=timestamp&direction=descending');
?>
<h2>Rounds</h2>
<h4>List of current rounds.</h4>
<hr>
  <?php
  foreach ($rounds_current as $round) {
    ?>
        <h2><?php echo $round['id']; ?></h2>
        Worker: <?php echo privacyFilter($round['miner']).'.'.getWorkerName($round['worker']); ?> | 
        Submitted: <?php echo formatDateTime($round['submitted']); ?> | 
        Confirmed: <?php echo formatDateTime($round['timestamp']); ?> | 
        Invalid shares: <?php echo $round['invalid']; ?> | 
        Stale shares: <?php echo $round['stale']; ?> | 
        Valid shares: <?php echo $round['valid']; ?> | 
        Time: <?php echo formatLargeNumbers($round['times'], $pool_configuration['math_precision']); ?> | 
        Work type: <?php echo ($round['solo'] ? 'SOLO' : 'SHARED'); ?> | 
        Work ammount: <?php echo formatLargeNumbers($round['work'], $pool_configuration['math_precision']); ?>
        <br>
        <?php debugData($round['worker'].' | '.$round['submitted'].' | '.$round['timestamp'].' | '.$round['invalid'].' | '.$round['stale'].' | '.$round['valid'].' | '.$round['times'].' | '.($round['solo'] ? 'true' : 'false').' | '.$round['work'], $page_configuration['debug_mode']); ?>
    <?php if ($round != end($rounds_current)) { ?>
      <hr class="hr_inner hr_list">
    <?php
    }
  }
  ?>
