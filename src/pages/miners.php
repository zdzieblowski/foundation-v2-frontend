<div class="text_header">Miners & workers</div>
<div class="text_normal">List of miners and workers.</div>
<hr/>
<div class="text_subheader">Miners</div>
<?php
  $miners_current = getData('http://localhost:3001/api/v2/evrmore/current/miners');
  var_dump($miners_current);
?>
<hr/>
<div class="text_subheader">Workers</div>
<?php
  $workers_current = getData('http://localhost:3001/api/v2/evrmore/current/workers');
  var_dump($workers_current);
?>
