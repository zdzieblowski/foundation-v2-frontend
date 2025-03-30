<h2>Available pools</h2>
<h4>Choose a pool from the list below.</h4>
<br>
<?php
if ($pool_directory = opendir($page_configuration['directory_configurations'])) {
  $pool_list = listFiles($pool_directory, array('.', '..'));
  foreach ($pool_list as $pool_config) {
    $pool_directory_path = $page_configuration['directory_configurations'] . '/' . $pool_config;
    if (is_dir($pool_directory_path)) {
      require($pool_directory_path . '/configuration.php');
      $metadata_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/metadata');
      $network_current = getData('http://' . $pool_configuration['ip'] . ':' . $pool_configuration['port'] . '/api/v2/' . $pool_configuration['name'] . '/current/network');
      ?>
      <hr>
      ┐<br>
      │ <a href="?pool=<?php echo $pool_config; ?>"><b><?php echo $server_configuration['name']; ?></b> &gt;&gt;</a><br>
      │<br>
      ├ <b>Speed:</b>
      <?php echo formatLargeNumbers($metadata_current[0]['hashrate'], $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
      |
      <b>Algorithm:</b> <?php echo $server_configuration['algorithm']; ?> |
      <b>Miners:</b> <?php echo $metadata_current[0]['miners']; ?> / <b>Workers:</b>
      <?php echo $metadata_current[0]['workers']; ?> |
      <b>Blocks:</b> <?php echo $metadata_current[0]['blocks']; ?> |
      <b>Effort:</b> <?php echo formatPercents($metadata_current[0]['effort'], $pool_configuration['math_precision']); ?>
      <br>
      └ <b>Network:</b>
      <?php echo formatLargeNumbers(($network_current[0]['hashrate'] * $pool_configuration['network_hashrate_multiplier']), $pool_configuration['math_precision']) . $pool_configuration['hashrate_unit']; ?>
      <?php if ($pool_configuration['network_hashrate_multiplier'] != 1) { ?>
        <sub>(Warning! This value is estimated)</sub>
      <?php } ?>
    <?php
    }
  }
}
?>