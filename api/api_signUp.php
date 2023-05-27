<?php
   
   header("Content-Type: application/json");
   header("Access-Control-Allow-Methods: POST");
   include('config/config.php');

   $config = new Config();

   

   if($_SERVER['REQUEST_METHOD'] == 'POST'){    
       $email = $_POST['email'];
       $password = $_POST['password'];
       $name = $_POST['name'];
       $book_id = $_POST['book_id'];

    
     $res = $config->signUp($email, $password, $name, $book_id); //bool


     if($res){

        $data['msg'] = "User sign up successfully....";

     } else{
        $data['msg'] = "User sign up failed....";
     }
     
    }
     else {

        $data['msg'] = "Only POST method is allowed....";
     }


    echo json_encode($data);

?>