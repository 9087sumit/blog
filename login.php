<?php
session_start();
if(isset($_SESSION["user"])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="class1">
    <div class="class2"><h1><u>LOGIN</u></h1></div>
    <?php
    if(isset($_POST["login"])){
        $email=$_POST["email"];
        $password=$_POST["password"];
        require_once "database.php";
        $sql = " SELECT * FROM userdata where email = '$email'";
        $result=mysqli_query($conn,$sql);
        $user= mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($user){
            if(password_verify($password,$user["password"])){
                session_start();
                $_SESSION["user"]="yes"; 
                header("location:index.php");
                die();
            }else{
                    echo"<div class='alert alert-danger'>Password does not exist</div>";
                };
            

        }else{
            echo"<div class='alert alert-danger'>Email does not exist</div>";
        }
    }
    ?>
        <form action="login.php" method="post">
            <div class=form>
                <input type="email" placeholder="enterr your email" name="email" class="form-control">
            </div>
            <div class=form>
                <input type="password" placeholder="enterr your password" name="password" class="form-control">
            </div>
            <div class=form-btn>
                <input type="submit" placeholder="LOGIN" name="login" class="btn btn-primary">
            </div>


        </form>
        <div><a href="register.php">Forget Password?</a></div>
        <div><p>Not registered yet<a href="register.php">Register now</a></p></div>
    </div>
</body>
</html>