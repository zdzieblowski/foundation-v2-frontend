<?php
  $miners_current = getData('http://localhost:3001/api/v2/evrmore/current/miners');
  $workers_current = getData('http://localhost:3001/api/v2/evrmore/current/workers');
  $blocks_combined = getData('http://localhost:3001/api/v2/evrmore/combined/blocks');
  $payments_current = getData('http://localhost:3001/api/v2/evrmore/historical/payments');
?>

<div class="text_header">Dashboard</div>
<?php if(isset($_POST['save_address'])): ?>
  <?php
    setcookie('address',$_POST['save_address']);
    header("Refresh:0; url=/?page=dashboard");
  ?>
<?php else: ?>
  <?php if(!isset($_COOKIE['address'])): ?>
    <div class="text_normal">Enter wallet address to see your stats.</div>
  <?php else: ?>
    <?php
//      var_dump($miners_current);
      $wallet_found = False;
      $blocks_found = False;
      $payments_found = False;
      foreach($miners_current as $miner){
        if($miner['miner'] == $_COOKIE['address']) {
          $wallet_found = True;
          echo '<div class="text_normal">Statistics for wallet: <b>'.$_COOKIE['address'].'</b></div><hr/>';
          echo 'miner: '.$miner['miner'].' / hashrate: '.formatLargeNumbers($miner['hashrate']).$frontend_configuration['pool_hashrate_unit'];
          echo '<br>';
          echo 'efficiency: '.$miner['efficiency'].' % / effort: '.$miner['effort'].' %';
          echo '<br>';
          echo 'balance: '.$miner['balance'].' '.$server_configuration['symbol'].' / immature: '.$miner['immature'].' '.$server_configuration['symbol'].' / paid: '.$miner['paid'].' '.$server_configuration['symbol'];    echo '<br>';
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
          echo '<hr/>';
          foreach($blocks_combined as $block){
            if($block['miner'] == $_COOKIE['address']) {
              $blocks_found = True;
              var_dump($block);
            }
          }
          if(!$blocks_found) {
            echo '<div class="text_normal">No blocks mined by <b>'.$_COOKIE['address'].'</b> were found.</div>';
          }
          echo '<hr/>';
          foreach($payments_current as $payment){
            if($payment['miner'] == $_COOKIE['address']) {
              $payments_found = True;
              var_dump($payment);
            }
          }
          if(!$payments_found) {
            echo '<div class="text_normal">No payments to <b>'.$_COOKIE['address'].'</b> were found.</div>';
          }
        }
      }

      if(!$wallet_found) {
        echo '<div class="text_normal">Wallet <b>'.$_COOKIE['address'].'</b> was not found.</div>';
      }
    ?>
    <hr/>
  <?php endif ?>
    <form action="/?page=dashboard" method="post">
      <div class="wallet_address">
        <input type="text" name="save_address" value="<?php echo $_COOKIE['address']; ?>"/>
        <input type="submit" value="Submit"/>
      </div>
    </form>
<?php endif ?>
