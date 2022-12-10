<?php
$databaseServer = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$databaseName = 'databaseassignment';
 

try{
    $database_PDO = new PDO("mysql:host=".$databaseServer.";dbname=".$databaseName,$databaseUsername,$databasePassword);
    $database_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    die($e->getMessage());
}
?>