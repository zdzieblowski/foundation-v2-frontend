<div class="footer">
    <div class="width_limit footer_content">
      <div class="footer_content_left">
<?php
  if(!empty($pool)) {
?>
        2024+ &copy; <?php echo $_SERVER['SERVER_NAME'].'/';?><a href="<?php echo '?pool='.$pool; ?>"><?php echo $server_configuration['symbol']; ?></a>
<?php
  } else {
?>
        2024+ &copy; <?php echo getServerVariable('SERVER_NAME'); ?>/
<?php
  }
?>
        <br>
        <pre class="pre_version">        VERSION <b><?php echo $configuration['version']; ?></b></pre>
      </div>
      <div class="footer_content_right">
        <div>
<?php
  if(!empty($pool)) {
?>
          <a href="?pool=<?php echo $pool; ?>&page=donate"><span class="material-symbols-outlined">volunteer_activism</span></a>
<?php
  }
?>
        </div>
        <div>
          <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="common/assets/github.svg" height="24" alt></a>
        </div>
      </div>
    </div>
  </div>
