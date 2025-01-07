<?php

$pool_configuration = [
  'pool_title' => 'Peercoin',

  'math_precision' => 2,

  'pool_color' => '#3cb054',
  'pool_donation_currency' => 'Peercoin',

  'pool_donation_wallet' => 'PBSa1ZPHLQCryfu8d8y9rsXCfS2AVs22Lp',
  'pool_donation_explorer_link' => 'https://chainz.cryptoid.info/ppc/address.dws?PBSa1ZPHLQCryfu8d8y9rsXCfS2AVs22Lp.htm',

  'pool_network_hashrate_multiplier' => 283196872,
  'pool_network_difficulty_multiplier' => 283196872,
  'pool_hashrate_unit' => 'H/s',
  'pool_ip' => '127.0.0.1',
  'pool_port' => '3001',

  'pool_name' => 'peercoin',

  'pool_suggested_platform_gpu' => False,
  'pool_suggested_platform_asic' => True,
  'pool_suggested_software' => '',
  'pool_suggested_software_linux' => '&lt;miner&gt;',
  'pool_suggested_software_windows' => '&lt;miner&gt;',
  'pool_suggested_command_algo' => ' -algo ',
  'pool_suggested_command_open' => ' -server ',
  'pool_suggested_command_wallet' => ' -user ',
  'pool_suggested_command_worker' => '',
  'pool_suggested_software_link' => ''
];

$server_configuration = getData('http://'.$pool_configuration['pool_ip'].':'.$pool_configuration['pool_port'].'/api/v2/'.$pool_configuration['pool_name'].'/current/configuration')[0];

?>
