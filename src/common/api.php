<?php
header('Content-type: application/json');

$api_request = $_GET['api'];

$api_response = (object)[];
$api_response->request = $api_request;

$pool_configuration_file = $page_configuration['directory_configurations'].'/'.$api_request.'/configuration.php';

if (file_exists($pool_configuration_file)) {
  require_once($pool_configuration_file);

  $server_api_url = 'http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'];

  $api_response->success = True;
  $api_response->message = 'Data retrieval successful';

  $mtdt = getData($server_api_url.'/current/metadata')[0];
  $conf = getData($server_api_url.'/current/configuration')[0];
  $ntwk = getData($server_api_url.'/current/network')[0];

  $prts = getData($server_api_url.'/current/ports');
  $blks = getData($server_api_url.'/combined/blocks?limit=100&order=height&direction=descending&confirmations=le10000');

  $api_response->data = (object)[
    'timestamp' => $mtdt['timestamp'],
    'pool' => (object)[
      'configuration' => (object)[
        'name' => $conf['name'],
        'symbol' => $conf['symbol'],
        'algorithm' => $conf['algorithm'],
        'minimum_payment' => $conf['minimumPayment'],
        'fee_percentage' => $conf['recipientFee']*100,
        'ports' => filterData($prts, array('port','type'))
      ],
      'status' => (object)[
        'height' => $ntwk['height'],
        'difficulty' => $ntwk['difficulty'],
        'miners' => $mtdt['miners'],
        'workers' => $mtdt['workers'],
        'blocks' => $mtdt['blocks'],
        'efficiency' => $mtdt['efficiency'],
        'effort' => $mtdt['effort'],
        'hashrate' => $mtdt['hashrate'],
        'work' => $mtdt['work'],
        'shares' => (object)[
          'valid' => $mtdt['valid'],
          'stale' => $mtdt['stale'],
          'invalid' => $mtdt['invalid']
        ]
      ],
      'blocks' => filterData($blks, array('submitted', 'height', 'confirmations', 'hash', 'solo', 'difficulty', 'luck', 'reward'))
    ]
  ];

} else {
  $api_response->success = False;
  $api_response->message = 'Data retrieval unsuccessful';
}

echo json_encode($api_response);
?>
