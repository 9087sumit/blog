<?php
session_start();
if(isset($_SESSION["user"])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="class1">
        <?php
        if(isset($_POST["submit"])){
            $fullname=$_POST["fullname"];
            $email=$_POST["Email"];
            $password=$_POST["password"];
            $confirm_password=$_POST["confirm_password"];

            $passwordHash = password_hash($password,PASSWORD_DEFAULT);

            $errors= array();

            if(empty($fullname) or empty($email) or empty($password) or empty($confirm_password)){
                array_push($errors,"All fields are required");
            }
            if(!filter_var($email)){
                array_push($errors,"Email is not Valid");
            }
            if(strlen($password)<8){
                array_push($errors,"Password should contain atleast 8 characters");
            }
            if($password!==$confirm_password){
                array_push($errors,"Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM userdata where email='$email'";
            $result= mysqli_query($conn,$sql);
            $rowcount=mysqli_num_rows($result);
            if($rowcount>0){
                array_push($errors,"email already exist");
            }
            
            if(count($errors)>0){
                foreach($errors as $errors){
                    echo "<div class='alert alert-danger'>$errors</div>";
                }
            }else{

                
                $sql = " INSERT INTO userdata(Fullname,Email,password ) value(?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                $preparestmt=mysqli_stmt_prepare($stmt,$sql);
                if($preparestmt){
                    mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo"<div class='alert alert-success'>You are registered successfully</div>";}
               else{
                die("something went wrong"); 
            }
        }

        }
        ?>
        <div class="class2"><h1><u>BLOGO</u></h1></div>
        <form action="register.php" method="post">
            <div class="form">
                <input type="text" class="form-control" name="fullname" placeholder="full name">
            </div>
            <div class="form">
                <input type="email"class="form-control" name="Email" placeholder="E-mail">
            </div>
            <div class="form">
                <input type="password"class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form">
                <input type="password"class="form-control" name="confirm_password" placeholder="Confirm Password">
            </div>
            <div class="form">
                <input type="submit"class="btn btn-primary" value="Register" name="submit">
            </div>
            <div><p>Already registered<a href="login.php">Login here</a></p></div>
    </div>
    
</body>
</html>