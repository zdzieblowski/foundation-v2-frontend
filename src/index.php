<?php require_once('_frontend/common/methods.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <title>The Mining Site</title>
  <link rel="stylesheet" type="text/css" href="_common/themes/tms/styles.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <link rel="icon" type="image/png" href="_common/themes/tms/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="_common/themes/tms/favicon.svg" />
  <link rel="shortcut icon" href="_common/themes/tms/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="_common/themes/tms/apple-touch-icon.png" />
  <link rel="manifest" href="_common/themes/tms/site.webmanifest" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="apple-mobile-web-app-title" content="TMS" />
</head>

<body>
  <div class="header" style="background-color: #555;">
    <div class="width_limit header_grid">
      <div class="header_top">
        <div style="display: grid; grid-template-columns: min-content min-content; gap: 16px; align-items: center;">
          <div>
            <a class="header_navi_item">
              <?php
                $emotes = ['favorite', 'mood', 'person_celebrate', 'sentiment_very_satisfied', 'emoticon', 'taunt', 'cheer', 'raven', 'sentiment_excited', 'sentiment_calm', 'skull', 'sentiment_satisfied', 'sentiment_neutral', 'sentiment_stressed', 'pets', 'sunny', 'diamond', 'potted_plant', 'bomb', 'comedy_mask', 'sword_rose', 'owl', 'crown', 'celebration', 'savings', 'local_florist', 'park', 'flag_2', 'imagesearch_roller', 'flight', 'sailing', 'moped', 'snowmobile', 'motorcycle', 'pedal_bike', 'cake', 'hiking', 'science', 'fertile', 'smart_toy', 'dark_mode', 'spa', 'cottage', 'lunch_dining', 'beach_access', 'fitness_center', 'local_bar', 'pool', 'liquor', 'bakery_dining', 'ramen_dining', 'icecream', 'grass', 'ac_unit', 'child_care', 'outlet', 'smart_outlet', 'nature', 'forest', 'emoji_nature', 'landscape', 'water_drop', 'rocket', 'hive', 'emoji_events', 'globe', 'nutrition', 'kid_star', 'anchor', 'healing', 'restaurant', 'handyman', 'fastfood', 'pest_control_rodent', 'pet_supplies', 'theater_comedy', 'takeout_dining', 'cloud', 'music_note', 'self_improvement', 'headphones', 'joystick', 'brunch_dining', 'bento', 'golf_course', 'cabin', 'bungalow', 'concierge', 'trip', 'chair', 'coffee', 'kitchen', 'coffee_maker', 'umbrella', 'mode_heat', 'table_lamp', 'wall_lamp', 'rocket_launch', 'workspace_premium', 'candle'];
                echo '<span class="material-symbols-outlined">'.$emotes[array_rand($emotes)].'</span>';
              ?>
            </a>
          </div>
          <div style="width: min-content;">
            <svg xmlns="http://www.w3.org/2000/svg" id="logo" version="1.1" viewBox="0 0 622.2 329.2" style="height: 33px;"><script xmlns=""/>
              <defs>
                <style>
                  .st0 {
                    fill: #eee;
                  }
                </style>
              </defs>
              <polygon class="st0" points="353 328 622.2 328 500.2 159.4 542.3 0 26 0 0 100 68.3 100 8.6 329.2 112 329.2 171.7 100 240.1 100 180.4 329.2 283.7 329.2 343.4 100 412.5 100 398.2 153.9 391.5 179.8 426.4 228 379 228 353 328"/>
            </svg>
          </div>
        </div>
        <div class="header_top_right">
          <div class="header_info">
            <div><?php echo ($_SERVER['SERVER_NAME']); ?>/</div>
          </div>
          <div>
            <a class="header_navi_item" href="/">
              <span class="material-symbols-outlined">refresh</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="width_limit">
      <div class="content_content">
        <div class="text_header" style="color: #444;">Available pools</div>
        <div class="text_normal">Choose a pool from the list below.</div>
        <hr/ >
        <div class="pool_list" style="display: grid; row-gap: 8px;">
        <?php
          // Part of this code was stolen from https://jasonmccreary.me/, thanks xD
          if ($handle = opendir('.')) {
            $blacklist = array('.', '..', '_common', '_frontend', 'index.php', '.index.php.swp');
            while (false !== ($file = readdir($handle))) {
              if (!in_array($file, $blacklist)) {
                require($file.'/configuration.php');
                $metadata_current = getData('http://'.$frontend_configuration['pool_ip'].':3001/api/v2/'.$frontend_configuration['pool_name'].'/current/metadata');
        ?>
          <style>
            a.<?php echo $file; ?> {
              background-color: <?php echo $frontend_configuration['pool_color']; ?>;
              border-bottom: 4px solid #888;
              border-radius: 8px;
            }
            a.<?php echo $file; ?>:hover {
              background-color: #666;
              border-bottom: 4px solid <?php echo $frontend_configuration['pool_color']; ?>;
            }
            a.<?php echo $file; ?>:active {
              background-color: #444;
              border-bottom: 4px solid <?php echo $frontend_configuration['pool_color']; ?>;
            }
          </style>
          <a href="/<?php echo $file; ?>" style="text-decoration: none; user-select: none;" class="<?php echo $file; ?>">
            <div class="box_long_content bg_orange" style="gap: 16px; display: grid; grid-template-columns: min-content auto min-content; align-items: center;">
              <img src="<?php echo $file; ?>/logo.svg" height="50" width="50">
              <div>
                <div class="text_large" style="text-align: left;"><?php echo $server_configuration['name']; ?></div>
                <div class="pool_list_infos">
                  <?php
                    echo '<div class="info_box">' . formatLargeNumbers($metadata_current[0]['hashrate'], $frontend_configuration['math_precision']) . $frontend_configuration['pool_hashrate_unit'] . '</div><div class="info_box">' . $server_configuration['algorithm'] . '</div>';
                  ?>
                </div>
              </div>
              <div style="line-height: 0;"><span class="material-symbols-outlined">arrow_forward</span></div>
            </div>
          </a>
        <?php
              }
            }
            closedir($handle);
          }
        ?>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="width_limit footer_content">
      <div class="footer_content_left">
        2024+ &copy; themining.site
      </div>
      <div>
        <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="_common/images/github.svg" height="24" /></a>
      </div>
    </div>
  </div>
</body>

</html>
