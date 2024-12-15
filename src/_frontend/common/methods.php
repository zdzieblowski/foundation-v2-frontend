<?php
function getData($data_url)
{
  $data_source = curl_init();
  curl_setopt($data_source, CURLOPT_URL, $data_url);
  curl_setopt($data_source, CURLOPT_RETURNTRANSFER, true);
  $data_json = curl_exec($data_source);
  curl_close($data_source);
  $data = json_decode($data_json, true);
  if ($data['statusCode'] == 200) {
    $result = $data['body'];
  } else {
    $result = [];
  }
  return $result;
}

function debugData($data, $in_debug_mode)
{
  if($in_debug_mode){
    echo '<div class="debug_box">'.$data.'</div>';
  }
}

function getWorkerName($miner)
{
  $worker_name = explode('.', $miner, 2)[1];
  $worker_name = $worker_name ? $worker_name : 'UNNAMED';
  return $worker_name;
}

function formatLargeNumbers($number, $precision)
{
  if($number > 1) {
    $units = array('', 'k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y', 'R', 'Q');
    $pow = floor(($number ? log($number) : 0) / log(1000));
    $pow = min($pow, count($units) - 1);
    $number /= pow(1000, $pow);
  }
  elseif($number < 0) {
    $number = 0;
  }
  return round($number, $precision) . '' . $units[$pow];
}

function formatDateTime($timestamp)
{
  return date('Y-m-d H:i:s', $timestamp / 1000);
}

function privacyFilter($input, $size = 12)
{
  return substr($input, 0, $size) . str_repeat('*', (strlen($input) - $size * 2)) . substr($input, -$size, $size);
}
?>
