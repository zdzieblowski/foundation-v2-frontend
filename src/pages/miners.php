<?php
  $miners_current = getData('http://localhost:3001/api/v2/evrmore/current/miners');
  $workers_current = getData('http://localhost:3001/api/v2/evrmore/current/workers');
?>

<div class="text_header">Miners & workers</div>
<div class="text_normal">List of miners and workers.</div>
<hr/>
<?php
  foreach($miners_current as $miner){
    echo 'miner: '.minerPrivacyFilter($miner['miner']).' / hashrate: '.formatLargeNumbers($miner['hashrate']).$frontend_configuration['pool_hashrate_unit'];
    echo '<br>';
    echo 'efficiency: '.$miner['efficiency'].' % / effort: '.$miner['effort'].' %';
    echo '<br>';
    echo 'balance: '.$miner['balance'].' '.$server_configuration['symbol'].' / immature: '.$miner['immature'].' '.$server_configuration['symbol'].' / paid: '.$miner['paid'].' '.$server_configuration['symbol'];
    echo '<br>';
    echo 'work: '.$miner['work'].' / valid: '.$miner['valid'].' / stale: '.$miner['stale'].' / invalid: '.$miner['invalid'];
    echo '<br>';
    foreach($workers_current as $worker){
      if($worker['miner'] == $miner['miner']) {
        $worker_name = explode('.', $worker['worker'], 2)[1];
        $worker_name = $worker_name ? $worker_name : 'UNNAMED';
        echo '- worker: '.$worker_name.' / hashrate: '.formatLargeNumbers($worker['hashrate']).$frontend_configuration['pool_hashrate_unit'].' / type: '.($worker['solo'] ? 'SOLO' : 'SHARED');
        echo '<br>';
        echo '&nbsp;&nbsp;efficiency: '.$worker['efficiency'].' % / effort: '.$worker['effort'].' %';
        echo '<br>';
        echo '&nbsp;&nbsp;work: '.$worker['work'].' / valid: '.$worker['valid'].' / stale: '.$worker['stale'].' / invalid: '.$worker['invalid'];
        echo '<br>';
      }
    }
    echo '<br>';
  }
?>
