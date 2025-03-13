<?php
function getData($data_url): mixed
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

function debugData($data, $debug_mode): void
{
  if ($debug_mode) {
    echo '<div class="box_debug">'.$data.'</div>';
  }
}

function filterData($input, $filters): array
{
  $output = array();
  $count = 0;

  foreach($input as $item){
    $output[$count]=(object)[];
    foreach($filters as $filter) {
      $output[$count]->$filter = $item[$filter];
    }
    $count = $count+1;
  }

  return $output;
}

function getWorkerName($miner): string
{
  $worker_name = explode('.', $miner, 2)[1];
  $worker_name = $worker_name ? $worker_name : 'UNNAMED';
  return $worker_name;
}

function getRandomEmote(): string
{
  $emotes = ['favorite', 'mood', 'person_celebrate', 'sentiment_very_satisfied', 'emoticon', 'taunt', 'cheer', 'raven', 'sentiment_excited', 'sentiment_calm', 'skull', 'sentiment_satisfied', 'sentiment_neutral', 'sentiment_stressed', 'pets', 'sunny', 'diamond', 'potted_plant', 'bomb', 'comedy_mask', 'sword_rose', 'owl', 'crown', 'celebration', 'savings', 'local_florist', 'park', 'flag_2', 'imagesearch_roller', 'flight', 'sailing', 'moped', 'snowmobile', 'motorcycle', 'pedal_bike', 'cake', 'hiking', 'science', 'fertile', 'smart_toy', 'dark_mode', 'spa', 'cottage', 'lunch_dining', 'beach_access', 'fitness_center', 'local_bar', 'pool', 'liquor', 'bakery_dining', 'ramen_dining', 'icecream', 'grass', 'ac_unit', 'child_care', 'outlet', 'smart_outlet', 'nature', 'forest', 'emoji_nature', 'landscape', 'water_drop', 'rocket', 'hive', 'emoji_events', 'globe', 'nutrition', 'kid_star', 'anchor', 'healing', 'restaurant', 'handyman', 'fastfood', 'pest_control_rodent', 'pet_supplies', 'theater_comedy', 'takeout_dining', 'cloud', 'music_note', 'self_improvement', 'headphones', 'joystick', 'brunch_dining', 'bento', 'golf_course', 'cabin', 'bungalow', 'concierge', 'trip', 'chair', 'coffee', 'kitchen', 'coffee_maker', 'umbrella', 'mode_heat', 'table_lamp', 'wall_lamp', 'rocket_launch', 'workspace_premium', 'candle'];
  return $emotes[array_rand($emotes)];
}

function getServerConfiguration($configuration): mixed {
  return getData('http://'.$configuration['ip'].':'.$configuration['port'].'/api/v2/'.$configuration['name'].'/current/configuration')[0];
}

function getServerVariable($variable_name): mixed
{
  return $_SERVER[$variable_name];
}

function formatPercents($number, $precision): string
{
  if ($number < 0) {
    $number = 0;
  }
  return round($number, $precision).'%';
}

function formatLargeNumbers($number, $precision): string
{
  if ($number > 1) {
    $units = array('', 'k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y', 'R', 'Q');
    $pow = min(floor(log($number)/log(1000)), count($units)-1);
    $number /= pow(1000, $pow);
  } elseif ($number < 0) {
    $number = 0;
  }
  return round($number, $precision).''.$units[$pow];
}

function formatDateTime($timestamp): string
{
  return date('Y-m-d H:i:s', $timestamp/1000);
}

function privacyFilter($input, $size = 12): string
{
  return substr($input, 0, $size).str_repeat('*', (strlen($input)-$size*2)).substr($input, -$size, $size);
}

function listFiles($directory, $blacklist): array
{
  $files = array();
  while (false !== ($file = readdir($directory))) {
    if (!in_array($file, $blacklist)) {
      array_push($files, $file);
    }
  }
  sort($files);
  return $files;
}

?>
