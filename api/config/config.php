<?php
     
      
     class Config{
        
        public $HOST = "127.0.0.1";
        public $USERNAME = "root";
        public $PASSWORD = "";
        public $DB_NAME = "vaiva"; // vaiva
        public $data;
        public $BOOKS_TABLE = "books";
        public $USERS_TABLE = "users";
        public $LIBRARIAN_TABLE = "librarian";


        public function connect(){
            $this->data = mysqli_connect($this->HOST,$this->USERNAME,$this->PASSWORD,$this->DB_NAME);
         }
 
         public function insert($name){
               $this->connect();
  
               $query = "INSERT INTO $this->BOOKS_TABLE(name) VALUES ('$name');";
              
               $res = mysqli_query($this->data, $query); 
 
               return $res;
         }



         public  function fetchAllRecords(){
            $this->connect();

           $query = "SELECT * FROM $this->BOOKS_TABLE;";

           $res = mysqli_query($this->data, $query); 

           $records = [];

           while($record = mysqli_fetch_assoc($res)){
            array_push($records , $record);
           }
           
           return $records;
         }



         public function fetchSingleRecord($id){
            $this->connect();

            
           $query = "SELECT * FROM $this->BOOKS_TABLE WHERE id=$id;";

           $res = mysqli_query($this->data, $query);
           $record = mysqli_fetch_assoc($res);

           if($record != null){
            return true;

           }else{
            
            return false;
           }
         }

         public function delete($id){
            $this->connect();

            $isRecordAvailable = $this->fetchSingleRecord($id);

            if($isRecordAvailable){
                $query = "DELETE FROM $this->BOOKS_TABLE WHERE id=$id;";

                
                $res = mysqli_query($this->data, $query);

                return true;
            } else {
                return false;
            }
         }


         public function update($name, $id){
            $this->connect();

            $query = "UPDATE $this->BOOKS_TABLE SET name='$name' WHERE id=$id;";
           
            $res = mysqli_query($this->data, $query); //bool

            return $res;
        }


        public function signUp($email, $password, $name, $book_id){
            $this->connect();

            // encrypt the password
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO $this->USERS_TABLE(email, password, name, book_id) VALUES ('$email','$encrypted_password','$name',$book_id);";
           
            $res = mysqli_query($this->data, $query); //bool

            return $res;
        }


        public function fetchUser($name){
            $this->connect();

            $query = "SELECT * FROM $this->USERS_TABLE WHERE name='$name';";
            
            $res = mysqli_query($this->data, $query);

            $record = mysqli_fetch_assoc($res);

            return $record;
        
        }





        
        public function signIn($name, $password){
            $this->connect();

              //fetch user's encrypted_password
              $fetched_user = $this->fetchUser($name);

              if($fetched_user != null){

                $encrypted_password = $fetched_user['password'];

                // verify the password
                $isPasswordVerified = password_verify($password, $encrypted_password);


                if($isPasswordVerified){

                    $query = "SELECT * FROM $this->USERS_TABLE WHERE name='$name';";

                  $res = mysqli_query($this->data, $query);  //object of mysqli_result()


                  $record = mysqli_fetch_assoc($res);

                  if($record != null)
                  {
                      return true;
                  }else{

                    return false;
                  }


                } else{

                    return false;
                }

              }else{
                return false;
              }
        }





        public function li_signUp($email, $password, $l_name){
            $this->connect();

            // encrypt the password
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO $this->LIBRARIAN_TABLE(email, password, l_name) VALUES ('$email','$encrypted_password','$l_name');";
           
            $res = mysqli_query($this->data, $query); //bool

            return $res;
        }


        public function li_fetchUser($l_name){
            $this->connect();

            $query = "SELECT * FROM $this->LIBRARIAN_TABLE WHERE name='$l_name';";
            
            $res = mysqli_query($this->data, $query);

            $record = mysqli_fetch_assoc($res);

            return $record;
        
        }





        
        public function li_signIn($l_name, $password){
            $this->connect();

              //fetch user's encrypted_password
              $fetched_user = $this->fetchUser($l_name);

              if($fetched_user != null){

                $encrypted_password = $fetched_user['password'];

                // verify the password
                $isPasswordVerified = password_verify($password, $encrypted_password);


                if($isPasswordVerified){

                    $query = "SELECT * FROM $this->LIBRARIAN_TABLE WHERE name='$l_name';";

                  $res = mysqli_query($this->data, $query);  //object of mysqli_result()


                  $record = mysqli_fetch_assoc($res);

                  if($record != null)
                  {
                      return true;
                  }else{

                    return false;
                  }


                } else{

                    return false;
                }

              }else{
                return false;
              }
        }

    

     }


?>