<?php require_once '../inc/connection.php' ?>
<?php require_once '../inc/function.php' ?>
<?php 
    if(isset($_POST['register'])){
        $errors=[];
        $name='';
        $email='';
        $phone=htmlspecialchars(trim($_POST['phone']));
        $password=htmlspecialchars($_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //var_dump(validateString($_POST['name']));
        if(is_array(validateString($_POST['name']))){
            $errors=array_merge($errors,validateString($_POST['name']));
            $_SESSION['name_error']="Name is not valid";
        }
        else{
            $name=validateString($_POST['name']);
        }
        if(validateEmail($_POST['email'])){
            $email=validateEmail($_POST['email']);
        }
        else{
           $_SESSION['email_error']='Email is not valid.';
        }
        //check of password length
        if(!validLength($password,6)){
            $_SESSION["password_error"]='password must be greater than 6 char.';
        }
        if(empty($errors)){
            //insert in database
            $query="insert into users (`name`,`email`,`password`,`phone`) values ('$name','$email','$hashedPassword','$phone')";
            $runQuery=mysqli_query($conn,$query);
            if($runQuery){
                $_SESSION['success']="Register successfully";
                header("location:../login.php");
            }
            else{
                $errors[]='There is an error';
            }
        }
        $pattern = "/^(01)[0125]\d{8}$/";
        if(!preg_match($pattern, $phone)){
            $errors[]='phone is not valid';
            $_SESSION['phone_error']='phone is not valid';
        }
        if(!empty($errors)){
            $_SESSION['errors']=$errors;
            //print_r($errors);
            header("location:../register.php");
        }
    }
    else{
        header("location:../register.php");
    }
?>
