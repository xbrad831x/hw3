<?php
require_once("configs.php");

$DB_config = new Configs();
$con = mysqli_connect($DB_config->host,$DB_config->username,$DB_config->password);

mysqli_query($con, "CREATE DATABASE story");
mysqli_select_db($con,'story');

mysqli_query($con, 
    "CREATE TABLE story (Identifier VARCHAR(30) PRIMARY KEY,
        Title VARCHAR(30),
        Author VARCHAR(30),
        Text VARCHAR(5000),
        Date timestamp,
        Views INT UNSIGNED NOT NULL
    )");

mysqli_query($con, 
    "CREATE TABLE genre (Animal Varchar(30),
        Funny Varchar(30),
        Cute Varchar(30),
        Crime Varchar(30),
        Fiction Varchar(30),
        Conspiracy Varchar(30)
    )");

mysqli_query($con, 
    "CREATE TABLE ratings (
        Identifier VARCHAR(30) PRIMARY KEY,
        Num_Of_Ratings INT, 
        Sum_Of_Ratings INT
    )");									  

?>