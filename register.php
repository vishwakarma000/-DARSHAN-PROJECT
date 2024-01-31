<?php 
include "connect.php";


if(isset($_POST["submit"])){
                $Fullname = $_POST["Fullname"];
                $phone_no = $_POST["phone_no"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $confirm_pass = $_POST["confirm_pass"];
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $errors = array();
    
                // if (empty($Fullname) OR empty($phone_no) OR empty($email) OR empty($password) OR empty($confirm_pass) ) {
                //     array_push($error, "All fields are required");
                // }
                    // if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    //     array_push($errors, "Email is not valid");
                    // }
                // if(strlen($password)<8){
                //     array_push($error, "Password must be atleast 8 character long ");
                // }
                //     if($password!==$confirm_pass){
                //         die("Password does not match ");
                //     }
    require_once "connect.php" ;
    $sql = "SELECT * FROM registration WHERE email = '$email'" ;
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if($rowCount>0){
        die("User is already exists");

    }
    if(count($errors)>0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }else{
        
        $sql = "INSERT INTO registration (Fullname, phone_no, email, password) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if($prepareStmt){
            mysqli_stmt_bind_param($stmt, "siss", $Fullname, $phone_no, $email, $passwordHash );
            mysqli_stmt_execute($stmt);
            echo'<script> alert("Registration successfull")</script>';
            // header("Location: login.php") ;
            echo"<script> window.location.href = 'login.php'</script>";

        }else{
            die("something went wrong");
        }
    }


}