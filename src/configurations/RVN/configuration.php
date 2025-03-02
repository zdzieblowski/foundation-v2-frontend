<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '6001',
  'name' => 'ravencoin',

  'title' => 'Ravencoin',

  'math_precision' => 2,

  'color' => '#f15b22',
  'donation_currency' => 'Ravencoin',

  'donation_wallet' => 'RGm3K9n64am3CQMTUXHu2P4gPRNoQ5MTMy',
  'donation_explorer_link' => 'https://rvn.cryptoscope.io/address/?address=RGm3K9n64am3CQMTUXHu2P4gPRNoQ5MTMy',

  'network_difficulty_multiplier' => 1,
  'network_hashrate_multiplier' => 1,
  'hashrate_unit' => 'H/s',

  'suggested_platform_gpu' => True,
  'suggested_platform_asic' => False,
  
  'suggested_software' => 'WildRig Multi',
  'suggested_software_linux' => 'wildrig-multi',
  'suggested_software_windows' => 'wildrig.exe',
  'suggested_command_algo' => ' -a ',
  'suggested_command_open' => ' -o ',
  'suggested_command_wallet' => ' -u ',
  'suggested_command_worker' => ' -w ',
  'suggested_software_link' => 'https://github.com/andru-kun/wildrig-multi/releases'
];

$server_configuration = getServerConfiguration($pool_configuration);

?>