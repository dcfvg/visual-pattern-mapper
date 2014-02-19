<?php
  include 'lib/functions.php';
  $assets = "assets";
  
  if(!isset($_GET["map_name"])){
    $maps_path = glob("$assets/maps/*/");
    foreach ($maps_path as $id => $map_path) { 
      $maps_list .=  '<li><a href="?map_name='.basename($map_path).'">'.basename($map_path).'</a></li>';
    }
    $maps_list = "<h1>choose a map</h1><ul>$maps_list</ul>";
  }else{
    $map_name   = $_GET["map_name="];
    $map_stacks = glob("$assets/maps/$map_name/*");
    $grid = construct_grid($map_stacks);
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <pre> 
      <?php print_r($grid); ?>
    </pre>

      <?php 
        echo $maps_list;
      ?>
  </body>
  
</html>