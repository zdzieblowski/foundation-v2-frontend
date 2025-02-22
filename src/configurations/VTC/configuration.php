<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '6501',
  'name' => 'vertcoin',

  'title' => 'Vertcoin',

  'math_precision' => 2,

  'color' => '#198652',
  'donation_currency' => 'Vertcoin',

  'donation_wallet' => 'vtc1qad0dxqkx6y366rgvarqlm5emcjvr68akgtzkl2',
  'donation_explorer_link' => 'https://chainz.cryptoid.info/vtc/search.dws?q=vtc1qad0dxqkx6y366rgvarqlm5emcjvr68akgtzkl2',

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
