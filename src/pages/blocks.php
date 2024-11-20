<?php
  $blocks_combined = getData('http://localhost:3001/api/v2/evrmore/combined/blocks');
  $rounds_combined = getData('http://localhost:3001/api/v2/evrmore/combined/rounds');
?>

<div class="text_header">Blocks & rounds</div>
<div class="text_normal">List of mined blocks and rounds.</div>
<hr/>
<div class="text_subheader">Blocks</div>
<?php
  foreach($blocks_combined as $block){
    var_dump($block);
    echo '<br><br>';
  }
?>
<hr/>
<div class="text_subheader">Rounds</div>
<?php
  foreach($rounds_combined as $round){
    var_dump($round);
    echo '<br><br>';
  }
?>
