<div class="footer">
  <div class="width_max footer_content">
    <div class="footer_content_left">
      2024+ &copy; <?php echo getServerVariable('SERVER_NAME').'/'.(empty($pool) ? '' : '<a href="?pool='.$pool.'">'.$server_configuration['symbol'].'</a>'); ?>
      <br>
      <pre class="footer_version">        VERSION <b><?php echo $page_configuration['version']; ?></b></pre>
    </div>
    <div class="footer_content_right">
      <?php if (!empty($pool)) { ?>
      <div>
          <a href="?pool=<?php echo $pool; ?>&page=donate"><span
              class="material-symbols-outlined">volunteer_activism</span></a>
      </div>
      <div>
          <a href="?api=<?php echo $pool; ?>" target="_blank"><span
              class="material-symbols-outlined">api</span></a>
      </div>
      <?php } ?>
     <div>
        <a href="https://github.com/zdzieblowski/foundation-v2-frontend" target="_blank"><img src="common/assets/github.svg" height="24" alt></a>
      </div>
    </div>
  </div>
</div>
