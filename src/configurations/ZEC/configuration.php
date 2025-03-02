<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '7001',
  'name' => 'zcash',

  'title' => 'Zcash',

  'math_precision' => 2,

  'color' => '#f3b724',
  'donation_currency' => 'Zcash',

  'donation_wallet' => 't1cJHk4SnjFgaoNc3HrhKcSE1pFzawWmcJ5',
  'donation_explorer_link' => 'https://mainnet.zcashexplorer.app/address/t1cJHk4SnjFgaoNc3HrhKcSE1pFzawWmcJ5',

  'network_difficulty_multiplier' => 1,
  'network_hashrate_multiplier' => 1,
  'hashrate_unit' => 'H/s',

  'suggested_platform_gpu' => False,
  'suggested_platform_asic' => True,
  
  'suggested_software' => '',
  'suggested_software_linux' => '',
  'suggested_software_windows' => '',
  'suggested_command_algo' => ' -a ',
  'suggested_command_open' => ' -o ',
  'suggested_command_wallet' => ' -u ',
  'suggested_command_worker' => '',
  'suggested_software_link' => ''
];

$server_configuration = getServerConfiguration($pool_configuration);

?>