<?php

$pool_configuration = [
  'title' => 'Evrmore',

  'math_precision' => 2,

  'color' => '#049dcc',
  'donation_currency' => 'Evrmore',

  'donation_wallet' => 'EKD6T8CKqTmebBFnpjmHFRCY2jWs117wPS',
  'donation_explorer_link' => 'https://evr.cryptoscope.io/address/?address=EKD6T8CKqTmebBFnpjmHFRCY2jWs117wPS',

  'network_difficulty_multiplier' => 1,
  'network_hashrate_multiplier' => 1,
  'hashrate_unit' => 'H/s',
  'ip' => '127.0.0.1',
  'port' => '3001',

  'name' => 'evrmore',

  'suggested_platform_gpu' => True,
  'suggested_platform_asic' => False,
  'suggested_software' => 'WildRig Multi',
  'suggested_software_linux' => 'wildrig-multi',
  'suggested_software_windows' => 'wildrig.exe',
  'suggested_command_algo' => ' -a ',
  'suggested_command_open' => ' -o ',
  'suggested_command_wallet' => ' -u ',
  'suggested_command_worker' => ' -w ',
  'suggested_software_link' => 'https://github.com/andru-kun/wildrig-multi/releases'
];

$server_configuration = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/current/configuration')[0];

?>
