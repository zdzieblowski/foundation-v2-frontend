<?php
  if(!empty($pool)) {
?>

  <div class="footer">
    <div class="width_limit footer_content">
      <div class="footer_content_left">
        2024+ &copy; <?php echo $_SERVER['SERVER_NAME'].'/';?><a href="<?php echo '?pool='.$pool; ?>"><?php echo $server_configuration['symbol']; ?></a>
        <br>
        <pre style="margin: unset; padding: unset; font-family: inherit; color: #666;">        VERSION <b><?php echo $configuration['version']; ?></b></pre>
      </div>
      <div class="footer_content_right">
        <div>
          <a href="?pool=<?php echo $pool; ?>&page=donate"><span class="material-symbols-outlined">volunteer_activism</span></a>
        </div>
        <div>
          <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="common/assets/github.svg" height="24" alt></a>
        </div>
      </div>
    </div>
  </div>

<?php
  } else {
?>

  <div class="footer">
    <div class="width_limit footer_content">
      <div class="footer_content_left">
        2024+ &copy; <?php echo getServerVariable('SERVER_NAME'); ?>/
        <br>
        <pre style="margin: unset; padding: unset; font-family: inherit; color: #666;">        VERSION <b><?php echo $configuration['version']; ?></b></pre>
      </div>
      <div class="footer_content_right">
        <div></div>
        <div>
          <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="common/assets/github.svg" height="24" alt></a>
        </div>
      </div>
    </div>
  </div>

<?php
  }
?>