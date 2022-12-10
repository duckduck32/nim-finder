<?php
session_start();
if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header('Location: ./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body style="background-color: #e5e5e5;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <form action="controller.php" method="POST">

    <div style="margin-top: 4vh" align="center">
        <h1>NIM SEARCH</h1>
        <h2>LA07 KELAS SECURE PROGRAMMING</h2>
    </div>
    

    <div id="container" class="border border-primary;p-3 mb-2 bg-white text-dark; w-50 p-3" style="margin-top: 25vh; margin-left: 50vh">
    
            
                <div class="input-group mb-3" align="center">
                    <span class="input-group-text" id="NIM">NIM</span>
                    <input type="text" name="nim" value="" class="form-control" placeholder="Input NIM" aria-label="NIM" aria-describedby="nim">
                </div>

            <div style="" align="right">
                <a href="./login.php"><button type="button" class="btn btn-danger btn-block btn-ghost">Logout</button></a>
                <button class="btn btn-primary btn-block btn-ghost" name="search" value="Search">Search</button>                
            </div>
    
    </div>
    

        <div class="footer d-flex justify-content-center mt-5">
            <div>
                Web created by Leon, Kelly, Arthur, Rainer and Reuben © 2022
            </div>  
        </div>

        </form>
</body>
</html>