<?php
  include 'helpers.php';
  
  function construct_grid($map_stacks){
    // grid [line][row][file]
    
    foreach ($map_stacks as $id => $stack) {
      foreach (glob("$stack/*") as $cell_id => $cell) {
        $coord = explode("-",basename($cell));
        $grid[$coord[0]][$coord[1]] = glob("$cell/*.jpg");
      }
    }
    return $grid;
  }
?>