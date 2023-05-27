<?php
   
   header("Content-Type: application/json");
   header("Access-Control-Allow-Methods: PUT,PATCH");
   include('config/config.php');

   $config = new Config();

   

   if($_SERVER['REQUEST_METHOD'] == 'PUT'  || $_SERVER['REQUEST_METHOD'] == 'PATCH'){
     
       parse_str(file_get_contents("php://input"), $_PUT_PATCH); //string
    
       $name = $_PUT_PATCH['name'];
       $id = $_PUT_PATCH['id'];

    
     $res = $config->update($name, $id);


     if($res){

        $data['msg'] = "Record update successfully....";

     } else{
        $data['msg'] = "Record updation failed....";
     }
     
    }
     else {

        $data['msg'] = "Only PUT or PATCH method is allowed....";
     }


    echo json_encode($data);

?>