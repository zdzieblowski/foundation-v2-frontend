<?php

$frontend_configuration = [
  'page_title' => 'The Mining Site: Evrmore',
  'page_subfolder' => '/EVR/',
  'page_theme_path' => 'themes/tms/',
  'page_stylesheet' => 'styles.css',
  'page_logotype' => 'logo.svg',

  'math_precision' => 2,

  'pool_ip' => 'localhost',
  'pool_name' => 'evrmore',
  'pool_color' => '#049dcc',
  'pool_hashrate_unit' => 'H/s',
  'pool_donation_currency' => 'Evrmore',
  'pool_donation_wallet' => 'EKD6T8CKqTmebBFnpjmHFRCY2jWs117wPS',
  'pool_donation_explorer_link' => 'https://evr.cryptoscope.io/address/?address=EKD6T8CKqTmebBFnpjmHFRCY2jWs117wPS'
];

$server_configuration = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/configuration')[0];

?>
