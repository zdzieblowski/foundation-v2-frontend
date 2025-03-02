<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '3501',
  'name' => 'firocoin',

  'title' => 'Firocoin',

  'math_precision' => 2,

  'color' => '#B61936',
  'donation_currency' => 'Firocoin',

  'donation_wallet' => 'EXXLj9DRfd1gZQqpn1NCyYHXd3xq8aBCZSmC',
  'donation_explorer_link' => 'https://explorer.firo.org/address/EXXLj9DRfd1gZQqpn1NCyYHXd3xq8aBCZSmC',

  'network_difficulty_multiplier' => 1,
  'network_hashrate_multiplier' => 1,
  'hashrate_unit' => 'H/s',

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

$server_configuration = getServerConfiguration($pool_configuration);

?>