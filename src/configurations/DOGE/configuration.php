<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '2501',
  'name' => 'dogecoin',

  'title' => 'Dogecoin',

  'math_precision' => 2,

  'color' => '#b39f57',
  'donation_currency' => 'Dogecoin',

  'donation_wallet' => 'DMatnZJEo1UQE72UswofEHH61uQhPhBYDw',
  'donation_explorer_link' => 'https://dogechain.info/address/DMatnZJEo1UQE72UswofEHH61uQhPhBYDw',

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
