<?php
error_reporting(0);
session_destroy();
session_start();
if($_SESSION['username']){
unset($_SESSION['username']);
}
if($_SESSION['is_login']){
    unset($_SESSION['is_login']);
}
require_once "loginconfig.php";
 $username = $password = $username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } 
    else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } 
    else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $database_PDO->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['is_login'] = true;
                            $_SESSION['username'] = $username;
                            header("location: homepage.php");
                        } 
                        else{
                            $login_err = "Invalid username or password.";
                        }
                    }
                } 
                else{
                    $login_err = "User not found.";
                }
            } 
            else{
                echo "system no good";
            }
            unset($stmt);
        }
    }
    unset($database_PDO);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
        body{ font: 14px; display: flex; justify-content: center; background-color: #e5e5e5; }
        .wrapper{ width: 80vh; padding: 20px; }
        .boxform{background-color: white; position: absolute; top:50%; left:50%; transform:translate(-50%, -50%); width:30%;}

    </style>
</head>
<body>
    <div class="row h-100">
    <div class="wrapper">
        <div class="boxform border border-5 border-dark my-auto">
        <h2 class="pl-2 pt-2 d-flex align-items-center justify-content-center">Login</h2>
        <p class="pl-2 d-flex align-items-center justify-content-center">Enter your credentials to login!</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group pl-3 pr-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group pl-3 pr-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group pl-3 pr-3 d-flex align-items-center justify-content-center">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
            <p class="pl-3">Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </div>
        </form>
    </div>
    </div>
</body>
</html>