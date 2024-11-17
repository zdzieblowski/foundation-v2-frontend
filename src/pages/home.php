<?php
  $configuration_current = getData('http://localhost:3001/api/v2/evrmore/current/configuration');
  var_dump($configuration_current);
?>
<hr/>
<?php
  $hashrate_current = getData('http://localhost:3001/api/v2/evrmore/current/hashrate');
  var_dump($hashrate_current);
?>
<hr/>
<?php
  $ports_current = getData('http://localhost:3001/api/v2/evrmore/current/ports');
  var_dump($ports_current);
?>
<hr/>
<?php
  $metadata_current = getData('http://localhost:3001/api/v2/evrmore/current/metadata');
  var_dump($metadata_current);
?>
<hr/>
<?php
  $network_current = getData('http://localhost:3001/api/v2/evrmore/current/network');
  var_dump($network_current);
?>
