<?php

$pool_configuration = [
  'ip' => '127.0.0.1',
  'port' => '4501',
  'name' => 'litecoin',

  'title' => 'Litecoin',

  'math_precision' => 2,

  'color' => '#406ab3',
  'donation_currency' => 'Litecoin',

  'donation_wallet' => 'ltc1qpg82c03up0rngasps4tju89e0wfmr2ls7r9q09',
  'donation_explorer_link' => 'https://litecoinspace.org/address/ltc1qpg82c03up0rngasps4tju89e0wfmr2ls7r9q09',

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