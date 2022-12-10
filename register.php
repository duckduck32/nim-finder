<?php
require_once "loginconfig.php";
$username = $password = $username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } 
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } 
    else{
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $database_PDO->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } 
                else if(strlen($param_username) <= 3){
                    $username_err = "Username must be longer than 3 characters";
                }
                else{
                    $username = trim($_POST["username"]);
                }
            } 
            else{
                echo "system no good";
            }
            unset($stmt);
        }
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) <= 7){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty($username_err) && empty($password_err)){
        
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $database_PDO->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if($stmt->execute()){
                header("location: login.php");
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
        body{ font: 14px; display: flex; justify-content: center; background-color: #e5e5e5;}
        .wrapper{ width: 80vh; padding: 20px;}
        .boxform{background-color: white; position: absolute; top:50%; left:50%; transform:translate(-50%, -50%); width:30%;}
    </style>
</head>
<body class="display:flex">
    <div class="wrapper">
    <div class="boxform border border-5 border-dark align-middle my-auto">
    <h2 class="pl-2 pt-2 d-flex align-items-center justify-content-center">Sign Up</h2>
    <p class="pl-2 d-flex align-items-center justify-content-center">Create your account here!</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group pl-3 pr-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group pl-3 pr-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group pl-3 pr-3">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p class="pl-3 pr-3">Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
        
    </div>    
</body>
</html>