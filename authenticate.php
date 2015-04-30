<?php
        session_start();
        include_once('models/Database.php');
        include_once('models/User.php');



            if(isset($_POST['index'])){

                if ($_POST['index']==0){
                    register();
                }
                elseif ($_POST['index']==1) {
                    login();
                }
                elseif ($_POST['index']==2){
                    logout();
                }
                else{
                    return false;
                }
            }

        function logout(){
            $errors=array();
            $_SESSION=array();
            session_destroy();
            $errors['statusCode']=1;
            echo json_encode($errors);
        }
        function login(){
            $errors = array();

            if(!isset($_POST['name'])||empty($_POST['name'])){
                $errors["statusCode"]=0;
                $errors["email"]="Email not entered";
            } 
            if(!isset($_POST['password'])||empty($_POST['password'])){
                $errors["statusCode"]=0;
                $errors["password"]= "Password not entered";
            }

            if(empty($errors)){
                $result = User::login($_POST['name'], $_POST['password']);
                $errors['statusCode']=1;
                $errors['set']=json_encode($_SESSION['data']);
            }
            echo json_encode($errors);
        }

        function register(){ 
            $errors = array();

            // Check for empty fields
            if(!isset($_POST['name'])||empty($_POST['name'])){
                $errors["statusCode"]=0;
                $errors["username"]= "Name not entered";
            }
            if(!isset($_POST['email'])||empty($_POST['email'])){
                $errors["statusCode"]=0;
                $errors["email"]="Email not entered";
            }     
            if(!isset($_POST['college'])||empty($_POST['college'])){
                $errors["statusCode"]=0;
                $errors["college"]= "College not entered";
            }
            if(!isset($_POST['password'])||empty($_POST['password'])){
                $errors["statusCode"]=0;
                $errors["password"]= "Password not entered";
            }
            if(empty($errors)){
                
              if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                
                try{
                   $user=new User('user_email', $_POST['email']);
                }
                catch (UserNotFoundException $e){
                    
                }

                if(!isset($user)){
                    $table_name='users';
                    $password=$_POST['password'];
            
                    $data=array('user_name'=>$_POST['name'],'user_email'=>$_POST['email'],'user_password'=>$password,'user_college'=>$_POST['college'], 'user_phone'=>$_POST['mobile']);
                    $result=Database::insert($table_name, $data);
                    $errors["statusCode"]=1;
                    print_r(json_encode($errors));
                    return;
                    #print_r(json_encode($result));
                    #return;
                }
                else{
                    $errors["statusCode"]=0;
                    $errors["already"]= "The email id you provided is already registered with us";
                }
              }
              else{
                    $errors["statusCode"]=0;
                    $errors["valid"]="That isn't a valid email";
                }
          }
          echo(json_encode($errors));

       }
 			

            

            


            
?>
