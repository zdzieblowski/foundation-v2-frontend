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
    <div class="text_normal">Statistics for wallet: <b><?php echo $_COOKIE['address']; ?></b></div>
    <hr/>
  <?php endif ?>
    <form action="/?page=dashboard" method="post">
      <div class="wallet_address">
        <input type="text" name="save_address" value="<?php echo $_COOKIE['address']; ?>"/>
        <input type="submit" value="Submit"/>
      </div>
    </form>
<?php endif ?>

