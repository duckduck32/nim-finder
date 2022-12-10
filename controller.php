<?php
    require_once('loginconfig.php');

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['nim'])){

            $nim = trim($_POST['nim']);

            if(is_numeric($nim) == TRUE && strlen($nim) == 10){

                $query = "SELECT nim,name FROM mhs WHERE nim = :nim";

                if($stmt = $database_PDO->prepare($query)){
                    $stmt->bindParam(":nim", $param_nim, PDO::PARAM_STR);
            
                    $param_nim = trim($_POST["nim"]);
                    if($stmt->execute()){
                        if($stmt->rowCount() == 1){
                            if($row = $stmt->fetch()){
                                $var = $row["nim"];
                                $varname = $row["name"];
                            }
                        }
                        else{
                            header("Location: ./nimTakTerdaftarPage.php");
                            unset($stmt);
                            unset($database_PDO);
                            $nim = "";
                            die();
                        }
                    }
                }
            }
            else{
                header("Location: ./inputTidakValidPage.php");
                unset($stmt);
                unset($database_PDO);
                $nim = "";
                die();
            }
            unset($stmt);
        }
        unset($database_PDO);
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

    <form action="controller.php" method="POST">

    <div style="margin-top: 4vh" align="center">
        <h1>NIM SEARCH</h1>
        <h2>LA07 KELAS SECURE PROGRAMMING</h2>
    </div>
    

    <div id="container" class="border border-primary;p-3 mb-2 bg-white text-dark; w-50 p-3" style="margin-top: 25vh; margin-left: 50vh">
    Nama yang terdaftar:  
   
            <p> <?php echo $var; ?> </p>
            <p><?php echo $varname; ?> </p>
            <div style="" align="right">
            <a href="./homepage.php"><button type="button" class="btn btn-secondary btn-block btn-ghost" name="back" value="back">Back</button></a>              
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