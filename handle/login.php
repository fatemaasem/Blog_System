<?php require_once '../inc/connection.php' ?>
<?php require_once '../inc/function.php' ?>
<?php
    if(isset($_POST['login'])){
        $errors=[];
        $email='';
        $password=htmlspecialchars(trim($_POST['password']));
        //var_dump(validateString($_POST['name']));
        if(validateEmail($_POST['email'])){
            $email=validateEmail($_POST['email']);
        }
        else{
            $errors[]='Email is not valid.';
            $_SESSION['email_error']='Email is not valid.';
        }
        $userName='';
        if(empty($errors)){
            //check if is found in database..check email is found and password is found too
            //check email
            $query ="select * from users where `email`='$email' ";
            $runQuery=mysqli_query($conn,$query);
            $user=mysqli_fetch_assoc($runQuery);
            if(mysqli_num_rows($runQuery)==1){ 
                //email is found
                //check password
                if (!password_verify($password,$user['password'])) {
                   //user not found
                   $errors[]='Password not correct.';
                   $_SESSION['password_error']='Password not correct.';
                }
                else{
                    $userName=$user['name'];
                }
            }
            else{
                $errors[]='email not found';
                $_SESSION['email_error']='Email is not valid.';
            }
          
            

            

        }
        if(!empty($errors)){
            $_SESSION['errors']=$errors;
            header("location:../login.php");
        }
        else{
            $_SESSION['success']="login successfully";
            $_SESSION['login']="$userName";
            $_SESSION['id']=$user['id'];
           header("location:../index.php");
        }


    }
    else{
       header("location:../login.php");
    }
    
?>