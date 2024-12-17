<?php

$frontend_configuration = [
  'page_title' => 'The Mining Site: Garlicoin',
  'page_subfolder' => '/GRLC/',
  'page_theme_path' => 'themes/tms/',
  'page_stylesheet' => 'styles.css',
  'page_debugmode' => True,

  'math_precision' => 2,

  'pool_color' => '#daab1f',
  'pool_donation_currency' => 'Garlicoin',

  'pool_donation_wallet' => 'MPN8raVpYSGVdow1Pv9wR2mPEbV4qBCX3N',
  'pool_donation_explorer_link' => 'https://explorer.grlc.eu/get.php?q=MPN8raVpYSGVdow1Pv9wR2mPEbV4qBCX3N',

  'pool_hashrate_unit' => 'H/s',
  'pool_ip' => '127.0.0.1',

  'pool_name' => 'garlic',

  'pool_suggested_platform_gpu' => True,
  'pool_suggested_platform_asic' => False,
  'pool_suggested_software' => 'ccminer',
  'pool_suggested_software_linux' => 'ccminer',
  'pool_suggested_software_windows' => 'ccminer.exe',
  'pool_suggested_command_algo' => ' -a ',
  'pool_suggested_command_open' => ' -o ',
  'pool_suggested_command_wallet' => ' -u ',
  'pool_suggested_command_worker' => '',
  'pool_suggested_software_link' => 'https://github.com/fancyIX/ccminer/releases/'
];

$server_configuration = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/configuration')[0];

?>
