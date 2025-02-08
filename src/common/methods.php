<?php
function getData($data_url): mixed
{
  $data_source = curl_init();
  curl_setopt(handle: $data_source, option: CURLOPT_URL, value: $data_url);
  curl_setopt(handle: $data_source, option: CURLOPT_RETURNTRANSFER, value: true);
  $data_json = curl_exec(handle: $data_source);
  curl_close(handle: $data_source);
  $data = json_decode(json: $data_json, associative: true);
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
    echo '<div class="debug_box">' . $data . '</div>';
  }
}

function getWorkerName($miner): string
{
  $worker_name = explode(separator: '.', string: $miner, limit: 2)[1];
  $worker_name = $worker_name ? $worker_name : 'UNNAMED';
  return $worker_name;
}

function getRandomEmote(): string
{
  $emotes = ['favorite', 'mood', 'person_celebrate', 'sentiment_very_satisfied', 'emoticon', 'taunt', 'cheer', 'raven', 'sentiment_excited', 'sentiment_calm', 'skull', 'sentiment_satisfied', 'sentiment_neutral', 'sentiment_stressed', 'pets', 'sunny', 'diamond', 'potted_plant', 'bomb', 'comedy_mask', 'sword_rose', 'owl', 'crown', 'celebration', 'savings', 'local_florist', 'park', 'flag_2', 'imagesearch_roller', 'flight', 'sailing', 'moped', 'snowmobile', 'motorcycle', 'pedal_bike', 'cake', 'hiking', 'science', 'fertile', 'smart_toy', 'dark_mode', 'spa', 'cottage', 'lunch_dining', 'beach_access', 'fitness_center', 'local_bar', 'pool', 'liquor', 'bakery_dining', 'ramen_dining', 'icecream', 'grass', 'ac_unit', 'child_care', 'outlet', 'smart_outlet', 'nature', 'forest', 'emoji_nature', 'landscape', 'water_drop', 'rocket', 'hive', 'emoji_events', 'globe', 'nutrition', 'kid_star', 'anchor', 'healing', 'restaurant', 'handyman', 'fastfood', 'pest_control_rodent', 'pet_supplies', 'theater_comedy', 'takeout_dining', 'cloud', 'music_note', 'self_improvement', 'headphones', 'joystick', 'brunch_dining', 'bento', 'golf_course', 'cabin', 'bungalow', 'concierge', 'trip', 'chair', 'coffee', 'kitchen', 'coffee_maker', 'umbrella', 'mode_heat', 'table_lamp', 'wall_lamp', 'rocket_launch', 'workspace_premium', 'candle'];
  return $emotes[array_rand(array: $emotes)];
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
  return round(num: $number, precision: $precision) . '%';
}

function formatLargeNumbers($number, $precision): string
{
  if ($number > 1) {
    $units = array('', 'k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y', 'R', 'Q');
    $pow = floor(num: ($number ? log(num: $number) : 0) / log(num: 1000));
    $pow = min(value: $pow, values: count(value: $units) - 1);
    $number /= pow(num: 1000, exponent: $pow);
  } elseif ($number < 0) {
    $number = 0;
  }
  return round(num: $number, precision: $precision) . '' . $units[$pow];
}

function formatDateTime($timestamp): string
{
  return date(format: 'Y-m-d H:i:s', timestamp: $timestamp / 1000);
}

function privacyFilter($input, $size = 12): string
{
  return substr(string: $input, offset: 0, length: $size) . str_repeat(string: '*', times: (strlen(string: $input) - $size * 2)) . substr(string: $input, offset: -$size, length: $size);
}

function listFiles($directory, $blacklist): array
{
  $files = array();
  while (false !== ($file = readdir(dir_handle: $directory))) {
    if (!in_array(needle: $file, haystack: $blacklist)) {
      array_push(array: $files, values: $file);
    }
  }
  sort(array: $files);
  return $files;
}
?>
