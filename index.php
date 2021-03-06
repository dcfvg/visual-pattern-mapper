<?php
  include 'lib/functions.php';
  $assets = "assets";
  
  if(!isset($_GET["map_name"])){
    $maps_path = glob("$assets/maps/*/");
    foreach ($maps_path as $id => $map_path) { 
      $img_count = count(glob($map_path."*/*.jpg"));
      $maps_list .=  '<a class="list-group-item" href="?map_name='.basename($map_path).'"><span class="badge">'.$img_count.'</span>'.basename($map_path).'</a>';

    }
    $page_class = "home";
    $maps_list = '<p class="lead">choose a grid</p><div class="list-group">'.$maps_list.'</div>';
  }else{
    $map_name   = $_GET["map_name"];
    $map_stacks = glob("$assets/maps/$map_name/");
    $lines = construct_grid($map_stacks);
    
    $html = '<div id="table-container"><table class="table table-hover"><tbody>';
    foreach ($lines as $id_row => $cells) {
      $html .= '<tr id="row'.$id_row.'" class="row">';
      foreach ($cells as $id_cell => $images) {
        
        $count = count($images);
        
        if($count == 0) $color = "danger";
        else $color = "success";

        $dir = "$assets/maps/".$_GET["map_name"]."/$id_row-$id_cell";
        
        // get top of stack image from param file
        $pic_id =  file_get_contents($dir.'/pic_id.md');
        if(!$pic_id) $pic_id = 0;
        
        $html .= '<td id="row'.$id_row.'"  class="cell '.$color.'" pic="'.$pic_id.'" dir="'.$dir.'">';
          foreach ($images as $img) {
            $html .= '<img height="80"src="'.$img.'" alt="">';
          }
        $html .= "</td>";
      }
      $html .= "</tr>";  
    }
    $html .= '<tr></tr></tbody></table></div>';
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="lib/bootstrap-3.1.1-dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="lib/bootstrap-3.1.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
    <link rel="stylesheet" href="css/screen.css">
  </head>
  <body class="<?php echo $page_class; ?>" >
    <div class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">visual pattern mapper</a>
            </div>
          </div>
    </div>
    <div id="preview">
        <p><img src="" alt=""></p>
      
        <h2><?php echo $map_name ?></h2>
        <hr>
        <div id="filters" >
          <button type="button" class="btn btn-primary " filter="desaturate">
            <span class="glyphicon glyphicon-picture"></span> b&w
          </button>

          <button type="button" class="btn btn-primary " filter="contrast">
            <span class="glyphicon glyphicon-adjust"></span> contrast
          </button>

          <button type="button" class="btn btn-primary " filter="negative">
            <span class="glyphicon glyphicon-eye-close"></span> invert
          </button>
          
          <button type="button" class="btn btn-primary " filter="blur">
            <span class="glyphicon glyphicon glyphicon-unchecked"></span> blur
          </button>
          <hr>
           <button type="button" class="btn btn-primary " filter="crop">
               <span class="glyphicon glyphicon glyphicon-fullscreen"></span> crop
          </button>
          <button type="button" class="btn btn-primary " filter="none">
             <span class="glyphicon glyphicon glyphicon-remove-circle"></span> reset filters
           </button>

           <a class="btn btn-danger " href="/">
              <span class="glyphicon glyphicon glyphicon-remove-circle"></span> back to grid list
            </a>
        </div>
        <hr>      
    </div>
    <?php         echo $html;?>
    <div class="container">
      <?php // print_r($grid); ?>
      <?php 
        echo $maps_list;
      ?>      
    </div>
      <script src="lib/jquery-2.1.0.min.js"></script>
      <script src="lib/jquery-mousewheel/jquery.mousewheel.js"></script>
      <script src="lib/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
      <script src="js/vpm.js"></script>
      
  </body>
  
</html>