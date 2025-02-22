<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '5001',
  'name' => 'peercoin',

  'title' => 'Peercoin',

  'math_precision' => 2,

  'color' => '#3cb054',
  'donation_currency' => 'Peercoin',

  'donation_wallet' => 'PBSa1ZPHLQCryfu8d8y9rsXCfS2AVs22Lp',
  'donation_explorer_link' => 'https://chainz.cryptoid.info/ppc/address.dws?PBSa1ZPHLQCryfu8d8y9rsXCfS2AVs22Lp.htm',

  'network_hashrate_multiplier' => 283196872,
  'network_difficulty_multiplier' => 283196872,
  'hashrate_unit' => 'H/s',

  'suggested_platform_gpu' => False,
  'suggested_platform_asic' => True,
  
  'suggested_software' => '',
  'suggested_software_linux' => '&lt;miner&gt;',
  'suggested_software_windows' => '&lt;miner&gt;',
  'suggested_command_algo' => ' -algo ',
  'suggested_command_open' => ' -server ',
  'suggested_command_wallet' => ' -user ',
  'suggested_command_worker' => '',
  'suggested_software_link' => ''
];

$server_configuration = getServerConfiguration($pool_configuration);

?>
