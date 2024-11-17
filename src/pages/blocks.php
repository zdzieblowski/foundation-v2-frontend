<div class="text_header">Blocks & rounds</div>
<div class="text_normal">List of mined blocks and rounds.</div>
<hr/>
<div class="text_subheader">Blocks</div>
<?php
  $blocks = getData('http://localhost:3001/api/v2/evrmore/combined/blocks');
  var_dump($blocks);
?>
<hr/>
<div class="text_subheader">Rounds</div>
<?php
  $rounds = getData('http://localhost:3001/api/v2/evrmore/combined/rounds');
  var_dump($rounds);
?>
