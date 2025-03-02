<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '1501',
  'name' => 'bitcoin',

  'title' => 'Bitcoin',

  'math_precision' => 2,

  'color' => '#F7931A',
  'donation_currency' => 'Bitcoin',

  'donation_wallet' => 'bc1q02p4rlplj9xcaq3wp4xlhmppl3u5wscvqfzjwr',
  'donation_explorer_link' => 'https://www.blockchain.com/explorer/addresses/btc/bc1q02p4rlplj9xcaq3wp4xlhmppl3u5wscvqfzjwr',

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