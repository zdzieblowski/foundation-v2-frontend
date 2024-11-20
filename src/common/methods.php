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

function formatLargeNumbers($number) { 
  $units = array('', 'k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y', 'R', 'Q'); 
  $pow = floor(($number ? log($number) : 0) / log(1000));
  $pow = min($pow, count($units) - 1);
  $number /= pow(1000, $pow);
  return round($number, 2).' '.$units[$pow];
}

function formatDateTime($timestamp) {
  return date('Y-m-d H:i:s', $timestamp / 1000);
}

function minerPrivacyFilter($wallet) {
  return substr($wallet, 0, 12).'**********'.substr($wallet, -12, 12);
}

?>
