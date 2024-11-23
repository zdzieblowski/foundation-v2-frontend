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
        <div class="text_large"><?php echo formatLargeNumbers($miner['hashrate'], $frontend_configuration['math_precision']).$frontend_configuration['pool_hashrate_unit']; ?></div>
      </div>
      <div class="box bg_lightgrey">
        <div>Efficency</div>
        <div class="text_large"><?php echo round($miner['efficiency'], $frontend_configuration['math_precision']); ?>%</div>
      </div>
      <div class="box bg_lightgrey">
        <div>Effort</div>
        <div class="text_large"><?php echo round($miner['effort'], $frontend_configuration['math_precision']); ?>%</div>
      </div>
    </div>
    <div class="three_columns mt-8px">
      <div class="box bg_darkgrey">
        <div>Balance</div>
        <div class="text_large"><?php echo formatLargeNumbers($miner['balance'], $frontend_configuration['math_precision']).$server_configuration['symbol']; ?></div>
      </div>
      <div class="box bg_lightgrey">
        <div>Immature</div>
        <div class="text_large"><?php echo formatLargeNumbers($miner['immature'], $frontend_configuration['math_precision']).$server_configuration['symbol']; ?></div>
      </div>
      <div class="box bg_orange">
        <div>Paid</div>
        <div class="text_large"><?php echo formatLargeNumbers($miner['paid'], $frontend_configuration['math_precision']).$server_configuration['symbol']; ?></div>
      </div>
    </div>
    <div class="wrap bg_verylightgrey mt-8px">
      <div class="three_columns">
        <div class="box bg_darkgrey">
          <div>Valid shares</div>
          <div class="text_large"><?php echo formatLargeNumbers($miner['valid'], $frontend_configuration['math_precision']); ?></div>
        </div>
        <div class="box bg_lightgrey">
          <div>Stale shares</div>
          <div class="text_large"><?php echo formatLargeNumbers($miner['stale'], $frontend_configuration['math_precision']); ?></div>
        </div>
        <div class="box bg_lightgrey">
          <div>Invalid shares</div>
          <div class="text_large"><?php echo formatLargeNumbers($miner['invalid'], $frontend_configuration['math_precision']); ?></div>
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
          <a onclick="revealContent('<?php echo $worker['id']; ?>');" style="cursor: pointer;" >
            <div class="small_box bg_verylightgrey_orangeborder">
              <div>Worker</div>
              <div class="text_heavy text_right reveal_button">
                <?php echo $worker_name; ?>
                <span class="material-symbols-outlined">unfold_more</span>
              </div>
            </div>
          </a>
          <div id="<?php echo $worker['id'];?>" class="hidden">
            <div class="list_wrap small_gap">
              <div class="two_columns small_gap">
                <div class="small_box bg_orange">
                  <div>Hashrate</div>
                  <div class="text_heavy text_right"><?php echo formatLargeNumbers($worker['hashrate'], $frontend_configuration['math_precision']).$frontend_configuration['pool_hashrate_unit']; ?></div>
                </div>
                <div class="small_box bg_lightgrey">
                  <div>Worker type</div>
                  <div class="text_heavy text_right"><?php echo ($worker['solo'] ? 'SOLO' : 'POOL'); ?></div>
                </div>
              </div>
              <div class="two_columns small_gap">
                <div class="small_box bg_lightgrey">
                  <div>Efficiency</div>
                  <div class="text_heavy text_right"><?php echo round($worker['efficiency'], $frontend_configuration['math_precision']); ?>%</div>
                </div>
                <div class="small_box bg_lightgrey">
                  <div>Effort</div>
                  <div class="text_heavy text_right"><?php echo round($worker['effort'], $frontend_configuration['math_precision']); ?>%</div>
                </div>
              </div>
              <div class="three_columns small_gap">
                <div class="small_box bg_darkgrey">
                  <div>Valid shares</div>
                  <div class="text_heavy text_right"><?php echo formatLargeNumbers($worker['valid'], $frontend_configuration['math_precision']); ?></div>
                </div>
                <div class="small_box bg_lightgrey">
                  <div>Stale shares</div>
                  <div class="text_heavy text_right"><?php echo formatLargeNumbers($worker['stale'], $frontend_configuration['math_precision']); ?></div>
                </div>
                <div class="small_box bg_lightgrey">
                  <div>Invalid shares</div>
                  <div class="text_heavy text_right"><?php echo formatLargeNumbers($worker['invalid'], $frontend_configuration['math_precision']); ?></div>
                </div>
              </div>
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
    <div class="list_wrap">
    <?php
      foreach($blocks_combined as $block){
        if($block['miner'] == $_COOKIE['address']) {
          $blocks_found = True;
    ?>
      <div class="list_wrap small_gap">
        <a onclick="revealContent('<?php echo $block['id']; ?>');" style="cursor: pointer;" >
          <div class="small_box_long_content bg_verylightgrey_orangeborder">
            <div>Hash</div>
            <div class="text_heavy text_right reveal_button">
              <?php echo $block['hash']; ?>
              <span class="material-symbols-outlined">unfold_more</span>
            </div>
          </div>
        </a>
        <div id="<?php echo $block['id'];?>" class="hidden">
          <div class="list_wrap small_gap">
            <div class="small_box_long_content bg_verylightgrey">
              <div>Round</div>
              <div class="text_heavy text_right"><?php echo $block['round']; ?></div>
            </div>
            <div class="two_columns small_gap">
              <div class="small_box bg_lightgrey">
                <div>Submitted</div>
                <div class="text_heavy text_right"><?php echo formatDateTime($block['submitted']); ?></div>
              </div>
              <div class="small_box bg_darkgrey">
                <div>Confirmed</div>
                <div class="text_heavy text_right"><?php echo formatDateTime($block['timestamp']); ?></div>
              </div>
            </div>
            <div class="small_box_long_content bg_verylightgrey">
              <div>Transaction</div>
              <div class="text_heavy text_right"><?php echo $block['transaction']; ?></div>
            </div>
            <div class="three_columns small_gap">
              <div class="small_box bg_lightgrey">
                <div>Height</div>
                <div class="text_heavy text_right"><?php echo $block['height']; ?></div>
              </div>
              <div class="small_box bg_lightgrey">
                <div>Difficulty</div>
                <div class="text_heavy text_right"><?php echo formatLargeNumbers($block['difficulty'], $frontend_configuration['math_precision']); ?></div>
              </div>
              <div class="small_box bg_darkgrey">
                <div>Luck</div>
                <div class="text_heavy text_right"><?php echo round($block['luck'], $frontend_configuration['math_precision']); ?>%</div>
              </div>
            </div>
            <div class="two_columns small_gap">
              <div class="small_box bg_lightgrey">
                <div>Block type</div>
                <div class="text_heavy text_right"><?php echo $block['solo'] ? 'SOLO' : 'POOL'; ?></div>
              </div>
              <div class="small_box bg_orange">
                <div>Reward</div>
                <div class="text_heavy text_right"><?php echo formatLargeNumbers($block['reward'], $frontend_configuration['math_precision']).$server_configuration['symbol']; ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
        }
      }
      if(!$blocks_found) {
    ?>
    <div class="text_normal">
      No blocks mined by <b><?php echo $_COOKIE['address']; ?></b> were found.
    </div>
    <?php
      }
    ?>
    <hr/>
    <div class="text_subheader">Payments</div>
    <?php
      foreach($payments_current as $payment){
        if($payment['miner'] == $_COOKIE['address']) {
          $payments_found = True;
          echo 'submitted: '.formatDateTime($payment['timestamp']);
          echo '<br>';
          echo 'transaction: '.$payment['transaction'];
          echo '<br>';
          echo 'amount: '.formatLargeNumbers($payment['amount'], $frontend_configuration['math_precision']).$server_configuration['symbol'];
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
