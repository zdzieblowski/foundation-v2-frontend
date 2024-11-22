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
    <div class="text_normal">Enter wallet address to see your statistics.</div>
  <?php else: ?>
    <?php
      $wallet_found = False;
      $blocks_found = False;
      $payments_found = False;
      foreach($miners_current as $miner){
        if($miner['miner'] == $_COOKIE['address']) {
          $wallet_found = True;
    ?>
    <div class="text_normal">Statistics for wallet address: <b><?php echo $_COOKIE['address']; ?></b></div>
    <hr/>
    <div class="text_subheader">Miner information</div>
    <div class="box_long_content bg_darkgrey">
      <div>Wallet address</div>
      <div class="text_large"><?php echo $miner['miner']; ?></div>
    </div>
    <div class="three_columns mt-8px">
      <div class="box bg_orange">
        <div>Hashrate</div>
        <div class="text_large"><?php echo formatLargeNumbers(round($miner['hashrate'], $frontend_configuration['page_precision'])).$frontend_configuration['pool_hashrate_unit']; ?></div>
      </div>
      <div class="box bg_lightgrey">
        <div>Efficency</div>
        <div class="text_large"><?php echo round($miner['efficiency'], $frontend_configuration['page_precision']); ?> %</div>
      </div>
      <div class="box bg_lightgrey">
        <div>Effort</div>
        <div class="text_large"><?php echo round($miner['effort'], $frontend_configuration['page_precision']); ?> %</div>
      </div>
    </div>
    <div class="three_columns mt-8px">
      <div class="box bg_darkgrey">
        <div>Balance</div>
        <div class="text_large"><?php echo formatLargeNumbers(round($miner['balance'], $frontend_configuration['page_precision'])).$server_configuration['symbol']; ?></div>
      </div>
      <div class="box bg_lightgrey">
        <div>Immature</div>
        <div class="text_large"><?php echo formatLargeNumbers(round($miner['immature'], $frontend_configuration['page_precision'])).$server_configuration['symbol']; ?></div>
      </div>
      <div class="box bg_orange">
        <div>Paid</div>
        <div class="text_large"><?php echo formatLargeNumbers(round($miner['paid'], $frontend_configuration['page_precision'])).$server_configuration['symbol']; ?></div>
      </div>
    </div>
    <div class="wrap bg_verylightgrey mt-8px">
      <div class="three_columns">
        <div class="box bg_darkgrey">
          <div>Valid shares</div>
          <div class="text_large"><?php echo formatLargeNumbers($miner['valid']); ?></div>
        </div>
        <div class="box bg_lightgrey">
          <div>Stale shares</div>
          <div class="text_large"><?php echo formatLargeNumbers($miner['stale']); ?></div>
        </div>
        <div class="box bg_lightgrey">
          <div>Invalid shares</div>
          <div class="text_large"><?php echo formatLargeNumbers($miner['invalid']); ?></div>
        </div>
      </div>
      <hr/>
      <div class="list_wrap">
      <?php
        foreach($workers_current as $worker){
          if($worker['miner'] == $miner['miner']) {
            $worker_name = explode('.', $worker['worker'], 2)[1];
            $worker_name = $worker_name ? $worker_name : 'UNNAMED';
      ?>
        <div class="list_wrap small_gap">
          <div class="small_box bg_darkgrey_orangeborder">
            <div>Worker name</div>
            <div class="text_heavy text_right"><?php echo $worker_name; ?></div>
          </div>
          <div class="two_columns small_gap">
            <div class="small_box bg_orange">
              <div>Hashrate</div>
              <div class="text_heavy text_right"><?php echo formatLargeNumbers(round($worker['hashrate'], $frontend_configuration['page_precision'])).$frontend_configuration['pool_hashrate_unit']; ?></div>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Worker type</div>
              <div class="text_heavy text_right"><?php echo ($worker['solo'] ? 'SOLO' : 'POOL'); ?></div>
            </div>
          </div>
          <div class="two_columns small_gap">
            <div class="small_box bg_lightgrey">
              <div>Efficiency</div>
              <div class="text_heavy text_right"><?php echo round($worker['efficiency'], $frontend_configuration['page_precision']); ?> %</div>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Effort</div>
              <div class="text_heavy text_right"><?php echo round($worker['effort'], $frontend_configuration['page_precision']); ?> %</div>
            </div>
          </div>
          <div class="three_columns small_gap">
            <div class="small_box bg_darkgrey">
              <div>Valid shares</div>
              <div class="text_heavy text_right"><?php echo formatLargeNumbers($worker['valid']); ?></div>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Stale shares</div>
              <div class="text_heavy text_right"><?php echo formatLargeNumbers($worker['stale']); ?></div>
            </div>
            <div class="small_box bg_lightgrey">
              <div>Invalid shares</div>
              <div class="text_heavy text_right"><?php echo formatLargeNumbers($worker['invalid']); ?></div>
            </div>
          </div>
        </div>
      <?php
          }
        }
      ?>
      </div>
    </div>
    <hr/>
    <div class="text_subheader">Blocks</div>
    <?php
      foreach($blocks_combined as $block){
        if($block['miner'] == $_COOKIE['address']) {
          $blocks_found = True;
    ?>
    <?php
              echo 'submitted: '.formatDateTime($block['submitted']).' / confirmed: '.formatDateTime($block['timestamp']).' / type: '.($block['solo'] ? 'SOLO' : 'POOL');
              echo '<br>';
              echo 'round: '.$block['round'];
              echo '<br>';
              echo 'hash: '.$block['hash'];
              echo '<br>';
              echo 'height: '.$block['height'].' / difficulty: '.round($block['difficulty'], $frontend_configuration['page_precision']).' / luck: '.round($block['luck'], $frontend_configuration['page_precision']).' %';
              echo '<br>';
              echo 'transaction: '.$block['transaction'];
              echo '<br>';
              echo 'reward: '.formatLargeNumbers(round($block['reward'], $frontend_configuration['page_precision'])).$server_configuration['symbol'];

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
              echo 'amount: '.formatLargeNumbers(round($payment['amount'], $frontend_configuration['page_precision'])).$server_configuration['symbol'];
            }
          }
          if(!$payments_found) {
            echo '<div class="text_normal">No payments to <b>'.$_COOKIE['address'].'</b> were found.</div>';
          }
        }
      }
      if(!$wallet_found) {
        echo '<div class="text_normal">Miner <b>'.$_COOKIE['address'].'</b> was not found.</div>';
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
