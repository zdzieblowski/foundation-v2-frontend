<?php
  $miners_current = getData('http://localhost:3001/api/v2/evrmore/current/miners');
  $workers_current = getData('http://localhost:3001/api/v2/evrmore/current/workers');
?>
<div class="text_header">Miners & workers</div>
<div class="text_normal">List of miners and workers.</div>
<hr/>
<?php
  foreach($miners_current as $miner){
    echo 'miner: '.privacyFilter($miner['miner']).' / hashrate: '.formatLargeNumbers($miner['hashrate'], $frontend_configuration['math_precision']).$frontend_configuration['pool_hashrate_unit'];
    echo '<br>';
    echo 'efficiency: '.round($miner['efficiency'], $frontend_configuration['math_precision']).'% / effort: '.round($miner['effort'], $frontend_configuration['math_precision']).'%';
    echo '<br>';
    echo 'balance: '.formatLargeNumbers($miner['balance'], $frontend_configuration['math_precision']).$server_configuration['symbol'].' / immature: '.formatLargeNumbers($miner['immature'], $frontend_configuration['math_precision']).$server_configuration['symbol'].' / paid: '.formatLargeNumbers($miner['paid'], $frontend_configuration['math_precision']).$server_configuration['symbol'];
    echo '<br>';
    echo 'work: '.formatLargeNumbers($miner['work'], $frontend_configuration['math_precision']).' / valid: '.formatLargeNumbers($miner['valid'], $frontend_configuration['math_precision']).' / stale: '.formatLargeNumbers($miner['stale'], $frontend_configuration['math_precision']).' / invalid: '.formatLargeNumbers($miner['invalid'], $frontend_configuration['math_precision']);
    echo '<br>';
    foreach($workers_current as $worker){
      if($worker['miner'] == $miner['miner']) {
        $worker_name = getWorkerName($worker['worker']);
        echo '- worker: '.$worker_name.' / hashrate: '.formatLargeNumbers($worker['hashrate'], $frontend_configuration['math_precision']).$frontend_configuration['pool_hashrate_unit'].' / type: '.($worker['solo'] ? 'SOLO' : 'POOL');
        echo '<br>';
        echo '&nbsp;&nbsp;efficiency: '.round($worker['efficiency'], $frontend_configuration['math_precision']).'% / effort: '.round($worker['effort'], $frontend_configuration['math_precision']).'%';
        echo '<br>';
        echo '&nbsp;&nbsp;work: '.formatLargeNumbers($worker['work'], $frontend_configuration['math_precision']).' / valid: '.formatLargeNumbers($worker['valid'], $frontend_configuration['math_precision']).' / stale: '.formatLargeNumbers($worker['stale'], $frontend_configuration['math_precision']).' / invalid: '.formatLargeNumbers($worker['invalid'], $frontend_configuration['math_precision']);
        echo '<br>';
      }
    }
    echo '<br>';
  }
?>
