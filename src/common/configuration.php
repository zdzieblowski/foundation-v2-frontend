<?php
  $server_configuration = getData('http://localhost:3001/api/v2/evrmore/current/configuration')[0];

  $frontend_configuration = [
    'page_title' => 'themining.site',
    'page_theme_path' => '/themes/tms/',
    'page_stylesheet' => 'styles.css',
    'page_logotype' => 'logo.svg',

    'math_precision' => 2,

    'pool_name' => 'evrmore',
    'pool_hashrate_unit' => 'H/s',
    'pool_donation_currency' => 'Evrmore',
    'pool_donation_wallet' => 'EKD6T8CKqTmebBFnpjmHFRCY2jWs117wPS',
    'pool_donation_explorer_link' => 'https://evr.cryptoscope.io/address/?address=EKD6T8CKqTmebBFnpjmHFRCY2jWs117wPS'
  ];
?>
