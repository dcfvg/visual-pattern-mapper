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
    $lines = construct_grid($map_stacks);
    
    $html = '<table class="table table-hover"><caption>'.$map_name.'</caption><tbody>';
    foreach ($lines as $id_row => $cells) {
      $html .= '<tr id="row'.$id_row.'" class="row">';
      foreach ($cells as $id_cell => $images) {
        
        $count = count($images);
        
        if($count == 0) $color = "danger";
        else $color = "success";

        $html .= '<td id="row'.$id_row.'" class="cell '.$color.'" pic="0" count="'.$count.'">';
          foreach ($images as $img) {
            $html .= '<img height="80"src="'.$img.'" alt="">';
          }
        $html .= "</td>";
      }
      $html .= "</tr>";  
    }
    $html .= '</tbody></table>';
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="lib/bootstrap-3.1.1-dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="lib/bootstrap-3.1.1-dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/screen.css">
  </head>
  <body>
    <div>
      <?php // print_r($grid); ?>
      <?php 
        echo $maps_list;
        echo $html;
      ?>      
    </div>
      <script src="lib/jquery-2.1.0.min.js"></script>
      <script src="lib/jquery-mousewheel/jquery.mousewheel.js"></script>
      
      <script src="js/vpm.js"></script>
      
  </body>
  
</html>