<?php 

  $rep = array("hello");

  $from = $_POST["from"];
  $to   = $_POST["to"];

  $filename = basename($from);
    
  $c = copy($from, "$to/$filename");
  if($c) $u = unlink($from);
  
  $res["result"] = "$from -> $to";
  header('Content-Type: application/json');
  echo json_encode($res);
?>