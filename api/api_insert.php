
<?php
   
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
include('config/Config.php');

$config = new Config();



if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $name = $_POST['name'];
 
  $res = $config->insert($name);


  if($res){

     $data['msg'] = "Record inserted successfully....";
     http_response_code(201);

  } 
  else{
     $data['msg'] = "Record insertion failed....";
  }
  
  
  
 }
  else {

     $data['msg'] = "Only POST method is allowed....";
  }


 echo json_encode($data);


?>