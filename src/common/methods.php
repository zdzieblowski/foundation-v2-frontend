<?php

function getData($data_url) {
  $data_source = curl_init();
  curl_setopt($data_source, CURLOPT_URL, $data_url);
  curl_setopt($data_source, CURLOPT_RETURNTRANSFER, true);
  $data_json = curl_exec($data_source);
  curl_close($data_source);
  $data = json_decode($data_json, true);
  if($data['statusCode'] == 200) {
    $result = $data['body'];
  } else {
    $result = [];
  }
  return $result;
}

function parseDate($date) {
  return 'parsed date';
}

function parseBigNumbers($number, $float_precision) {
  return 'parsed number';
}

function parseWallets($wallet, $output_length) {
  return 'parsed wallet';
}

?>
