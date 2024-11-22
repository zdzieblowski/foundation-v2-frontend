<?php
  $blocks_combined = getData('http://localhost:3001/api/v2/evrmore/combined/blocks');
  $rounds_combined = getData('http://localhost:3001/api/v2/evrmore/combined/rounds');
?>
<div class="text_header">Blocks & rounds</div>
<div class="text_normal">List of mined blocks and rounds.</div>
<hr/>
<div class="text_subheader">Blocks</div>
<?php
  foreach($blocks_combined as $block){
    echo 'miner: '.privacyFilter($block['miner']).' / worker: '.getWorkerName($block['worker']);
    echo '<br>';
    echo 'submitted: '.formatDateTime($block['submitted']).' / confirmed: '.formatDateTime($block['timestamp']).' / type: '.($block['solo'] ? 'SOLO' : 'POOL');
    echo '<br>';
    echo 'round: '.$block['round'];
    echo '<br>';
    echo 'hash: '.privacyFilter($block['hash'], 21);
    echo '<br>';
    echo 'height: '.$block['height'].' / difficulty: '.round($block['difficulty'], $frontend_configuration['math_precision']).' / luck: '.round($block['luck'], $frontend_configuration['math_precision']).'%';
    echo '<br>';
    echo 'transaction: '.privacyFilter($block['transaction'], 21);
    echo '<br>';
    echo 'reward: '.formatLargeNumbers($block['reward'], $frontend_configuration['math_precision']).$server_configuration['symbol'];
  }
?>
<hr/>
<div class="text_subheader">Rounds</div>
<?php
  foreach($rounds_combined as $round){
    echo 'round: '.$round['round'].' / type: '.($round['solo'] ? 'SOLO' : 'POOL');
    echo '<br>';
    echo 'worker: '.privacyFilter($round['miner']).'.'.getWorkerName($round['worker']);
    echo '<br>';
    echo 'work: '.formatLargeNumbers($round['work'], $frontend_configuration['math_precision']).' / valid: '.formatLargeNumbers($round['valid'], $frontend_configuration['math_precision']).' / stale: '.formatLargeNumbers($round['stale'], $frontend_configuration['math_precision']).' / invalid: '.formatLargeNumbers($round['invalid'], $frontend_configuration['math_precision']);
    echo '<br>';
    echo 'times (???): '.round($round['times'], $frontend_configuration['math_precision']);
    echo '<br>';
    echo '<br>';
  }
?>
