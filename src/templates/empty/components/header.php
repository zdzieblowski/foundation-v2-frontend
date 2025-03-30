<h1>
  <?php
  if (!empty($pool)) {
    $page_title = $page_configuration['page_title'] . ': ' . $pool_configuration['title'];
  } else {
    $page_title = $page_configuration['page_title'];
  }
  echo $page_title;
  ?>
</h1>
<?php if (!empty($pool)) { ?>
  <hr>
  <a href="/">&lt;&lt; Pools</a> ||
  <a href="?pool=<?php echo $pool; ?>">Home</a> |
  <a href="?pool=<?php echo $pool; ?>&page=dashboard">Dashboard</a> |
  <a href="?pool=<?php echo $pool; ?>&page=miners">Miners</a> |
  <a href="?pool=<?php echo $pool; ?>&page=rounds">Rounds</a> |
  <a href="?pool=<?php echo $pool; ?>&page=blocks">Blocks</a> |
  <a href="?pool=<?php echo $pool; ?>&page=transactions">Transactions</a> |
  <a href="?pool=<?php echo $pool; ?>&page=donate">Donate</a>
<?php } ?>
<hr>
<br>