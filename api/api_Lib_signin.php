<?php
   
   header("Content-Type: application/json");
   header("Access-Control-Allow-Methods: POST");
   include('config/config.php');

   $config = new Config();

   

   if($_SERVER['REQUEST_METHOD'] == 'POST'){    

       $l_name = $_POST['l_name'];
       $password = $_POST['password'];
      

    
     $res = $config->li_signIn($l_name, $password); 


     if($res){

        $data['data'] = "sign in successfully....";

     } else{
        $data['data'] = "sign in failed....";
     }
     
    }
     else {

        $data['msg'] = "Only POST method is allowed....";
     }


    echo json_encode($data);

?>