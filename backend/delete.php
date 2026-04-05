<?php
include("../db.php");

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $id = $_GET['id'];

    $sql = "UPDATE registration
            SET isDeleted = 1
            WHERE idNum = '$id'";

            if(mysqli_query($conn, $sql)){
                echo "Student deleted.";
                header("Location: add.php");
                exit();
            }else{
                echo "Error: " . mysqli_error($conn);
            }

}




?>
