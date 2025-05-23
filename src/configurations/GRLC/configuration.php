<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '4001',
  'name' => 'garlicoin',

  'title' => 'Garlicoin',

  'math_precision' => 2,

  'color' => '#daab1f',
  'donation_currency' => 'Garlicoin',

  'donation_wallet' => 'MPN8raVpYSGVdow1Pv9wR2mPEbV4qBCX3N',
  'donation_explorer_link' => 'https://explorer.grlc.eu/get.php?q=MPN8raVpYSGVdow1Pv9wR2mPEbV4qBCX3N',

  'network_difficulty_multiplier' => 1,
  'network_hashrate_multiplier' => 1,
  'hashrate_unit' => 'H/s',

  'suggested_platform_gpu' => True,
  'suggested_platform_asic' => False,
  
  'suggested_software' => 'ccminer',
  'suggested_software_linux' => 'ccminer',
  'suggested_software_windows' => 'ccminer.exe',
  'suggested_command_algo' => ' -a ',
  'suggested_command_open' => ' -o ',
  'suggested_command_wallet' => ' -u ',
  'suggested_command_worker' => '',
  'suggested_software_link' => 'https://github.com/fancyIX/ccminer/releases/'
];

$server_configuration = getServerConfiguration($pool_configuration);

?>