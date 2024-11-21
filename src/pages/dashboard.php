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
      $wallet_found = False;
      $blocks_found = False;
      $payments_found = False;
      foreach($miners_current as $miner){
        if($miner['miner'] == $_COOKIE['address']) {
          $wallet_found = True;
          echo '<div class="text_normal">Statistics for wallet: <b>'.$_COOKIE['address'].'</b></div><hr/><div class="text_subheader">Miner information</div>';
          echo 'miner: '.$miner['miner'].' / hashrate: '.formatLargeNumbers(round($miner['hashrate'], $frontend_configuration['page_precision'])).$frontend_configuration['pool_hashrate_unit'];
          echo '<br>';
          echo 'efficiency: '.round($miner['efficiency'], $frontend_configuration['page_precision']).' % / effort: '.round($miner['effort'], $frontend_configuration['page_precision']).' %';
          echo '<br>';
          echo 'balance: '.round($miner['balance'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'].' / immature: '.round($miner['immature'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'].' / paid: '.round($miner['paid'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'];
          echo '<br>';
          echo 'work: '.$miner['work'].' / valid: '.$miner['valid'].' / stale: '.$miner['stale'].' / invalid: '.$miner['invalid'];
          echo '<br>';
          foreach($workers_current as $worker){
            if($worker['miner'] == $miner['miner']) {
              $worker_name = explode('.', $worker['worker'], 2)[1];
              $worker_name = $worker_name ? $worker_name : 'UNNAMED';
              echo '- worker: '.$worker_name.' / hashrate: '.formatLargeNumbers(round($worker['hashrate'], $frontend_configuration['page_precision'])).$frontend_configuration['pool_hashrate_unit'].' / type: '.($worker['solo'] ? 'SOLO' : 'SHARED');
              echo '<br>';
              echo '&nbsp;&nbsp;efficiency: '.round($worker['efficiency'], $frontend_configuration['page_precision']).' % / effort: '.round($worker['effort'], $frontend_configuration['page_precision']).' %';
              echo '<br>';
              echo '&nbsp;&nbsp;work: '.$worker['work'].' / valid: '.$worker['valid'].' / stale: '.$worker['stale'].' / invalid: '.$worker['invalid'];
              echo '<br>';
            }
          }
          echo '<hr/><div class="text_subheader">Blocks</div>';
          foreach($blocks_combined as $block){
            if($block['miner'] == $_COOKIE['address']) {
              $blocks_found = True;
              echo 'submitted: '.formatDateTime($block['submitted']).' / confirmed: '.formatDateTime($block['timestamp']).' / type: '.($block['solo'] ? 'SOLO' : 'SHARED');
              echo '<br>';
              echo 'round: '.$block['round'];
              echo '<br>';
              echo 'hash: '.$block['hash'];
              echo '<br>';
              echo 'height: '.$block['height'].' / difficulty: '.round($block['difficulty'], $frontend_configuration['page_precision']).' / luck: '.round($block['luck'], $frontend_configuration['page_precision']).' %';
              echo '<br>';
              echo 'transaction: '.$block['transaction'];
              echo '<br>';
              echo 'reward: '.round($block['reward'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'];

            }
          }
          if(!$blocks_found) {
            echo '<div class="text_normal">No blocks mined by <b>'.$_COOKIE['address'].'</b> were found.</div>';
          }
          echo '<hr/><div class="text_subheader">Payments</div>';
          foreach($payments_current as $payment){
            if($payment['miner'] == $_COOKIE['address']) {
              $payments_found = True;
              echo 'submitted: '.formatDateTime($payment['timestamp']);
              echo '<br>';
              echo 'transaction: '.$payment['transaction'];
              echo '<br>';
              echo 'amount: '.round($payment['amount'], $frontend_configuration['page_precision']).$frontend_configuration['pool_currency_symbol'];
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
