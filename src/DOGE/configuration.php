<?php

$frontend_configuration = [
  'version' => '0.2.8',

  'page_title' => 'The Mining Site: Dogecoin',
  'page_subfolder' => '/DOGE/',
  'page_theme_path' => 'themes/tms/',
  'page_stylesheet' => 'styles.css',
  'page_debugmode' => False,

  'math_precision' => 2,

  'pool_color' => '#b39f57',
  'pool_donation_currency' => 'Dogecoin',

  'pool_donation_wallet' => 'DMatnZJEo1UQE72UswofEHH61uQhPhBYDw',
  'pool_donation_explorer_link' => 'https://dogechain.info/address/DMatnZJEo1UQE72UswofEHH61uQhPhBYDw',

  'pool_network_difficulty_multiplier' => 1,
  'pool_network_hashrate_multiplier' => 1,
  'pool_hashrate_unit' => 'H/s',
  'pool_ip' => '127.0.0.1',

  'pool_name' => 'dogecoin',

  'pool_suggested_platform_gpu' => False,
  'pool_suggested_platform_asic' => True,
  'pool_suggested_software' => '',
  'pool_suggested_software_linux' => '',
  'pool_suggested_software_windows' => '',
  'pool_suggested_command_algo' => ' -a ',
  'pool_suggested_command_open' => ' -o ',
  'pool_suggested_command_wallet' => ' -u ',
  'pool_suggested_command_worker' => '',
  'pool_suggested_software_link' => ''
];

$server_configuration = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/configuration')[0];

?>
