<?php

$frontend_configuration = [
  'version' => '0.2.9',

  'page_title' => 'The Mining Site: Peercoin',
  'page_subfolder' => '/PPC/',
  'page_theme_path' => 'themes/tms/',
  'page_stylesheet' => 'styles.css',
  'page_debugmode' => False,

  'math_precision' => 2,

  'pool_color' => '#3cb054',
  'pool_donation_currency' => 'Peercoin',

  'pool_donation_wallet' => 'PBSa1ZPHLQCryfu8d8y9rsXCfS2AVs22Lp',
  'pool_donation_explorer_link' => 'https://chainz.cryptoid.info/ppc/address.dws?PBSa1ZPHLQCryfu8d8y9rsXCfS2AVs22Lp.htm',

  'pool_network_hashrate_multiplier' => 283196872,
  'pool_network_difficulty_multiplier' => 283196872,
  'pool_hashrate_unit' => 'H/s',
  'pool_ip' => '127.0.0.1',

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

$server_configuration = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/configuration')[0];

?>
