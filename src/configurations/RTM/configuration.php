<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '5501',
  'name' => 'raptoreum',

  'title' => 'Raptoreum',

  'math_precision' => 2,

  'color' => '#B64225',
  'donation_currency' => 'Raptoreum',

  'donation_wallet' => 'RQRm1eaSEXs2c5panSf2ziSoVHbThbweTs',
  'donation_explorer_link' => 'https://explorer.rtm-1.zelcore.io/address/RQRm1eaSEXs2c5panSf2ziSoVHbThbweTs',

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