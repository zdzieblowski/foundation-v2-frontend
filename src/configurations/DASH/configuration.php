<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '2001',
  'name' => 'dashcoin',

  'title' => 'Dashcoin',

  'math_precision' => 2,

  'color' => '#008de4',
  'donation_currency' => 'Dashcoin',

  'donation_wallet' => 'Xxa8H5L7pSVwurq2WX9Un67n89dkg8cygp',
  'donation_explorer_link' => 'https://chainz.cryptoid.info/dash/search.dws?q=Xxa8H5L7pSVwurq2WX9Un67n89dkg8cygp',

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