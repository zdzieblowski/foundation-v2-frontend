<?php
  $miners_current = getData('http://localhost:3001/api/v2/evrmore/current/miners');
  $workers_current = getData('http://localhost:3001/api/v2/evrmore/current/workers');
?>
<div class="text_header">Miners & workers</div>
<div class="text_normal">List of miners and workers.</div>
<hr/>
<?php
  foreach($miners_current as $miner){
    echo 'miner: '.privacyFilter($miner['miner']).' / hashrate: '.formatLargeNumbers(round($miner['hashrate'], $frontend_configuration['page_precision'])).$frontend_configuration['pool_hashrate_unit'];
    echo '<br>';
    echo 'efficiency: '.round($miner['efficiency'], $frontend_configuration['page_precision']).' % / effort: '.round($miner['effort'], $frontend_configuration['page_precision']).' %';
    echo '<br>';
    echo 'balance: '.round($miner['balance'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'].' / immature: '.round($miner['immature'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'].' / paid: '.round($miner['paid'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'];
    echo '<br>';
    echo 'work: '.$miner['work'].' / valid: '.$miner['valid'].' / stale: '.$miner['stale'].' / invalid: '.$miner['invalid'];
    echo '<br>';
    foreach($workers_current as $worker){
      if($worker['miner'] == $miner['miner']) {
        $worker_name = getWorkerName($worker['worker']);
        echo '- worker: '.$worker_name.' / hashrate: '.formatLargeNumbers(round($worker['hashrate'], $frontend_configuration['page_precision'])).$frontend_configuration['pool_hashrate_unit'].' / type: '.($worker['solo'] ? 'SOLO' : 'SHARED');
        echo '<br>';
        echo '&nbsp;&nbsp;efficiency: '.round($worker['efficiency'], $frontend_configuration['page_precision']).' % / effort: '.round($worker['effort'], $frontend_configuration['page_precision']).' %';
        echo '<br>';
        echo '&nbsp;&nbsp;work: '.$worker['work'].' / valid: '.$worker['valid'].' / stale: '.$worker['stale'].' / invalid: '.$worker['invalid'];
        echo '<br>';
      }
    }
    echo '<br>';
  }
?>
