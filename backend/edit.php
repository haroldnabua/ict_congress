<?php
include("../db.php");

$id = $_GET['id'];


if($_SERVER['REQUEST_METHOD'] === "POST"){
    $campus = $_POST['campus'];
    $studFName = $_POST['studFName'];
    $studLName = $_POST['studLName'];
    $amountPaid = $_POST['amountPaid'];

    $sql = "UPDATE registration
            SET campus = '$campus',
                studFName = '$studFName',
                studLName = '$studLName',
                amountPaid = '$amountPaid'
            WHERE idNum = '$id'";
    if(!mysqli_query($conn, $sql)){
        die ("Error: " . mysqli_error($conn));
    }else{
        echo "Student updated.";
        header("Location: add.php");
        exit();
    }
}

$result = mysqli_query($conn, "SELECT * FROM registration WHERE idNum = '$id'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT Congress Management System</title>
</head>
<style>
    form{
        border: 2px solid black;
        width: 350px;
        border-radius: 5px;
        padding: 10px;
        margin: auto;
    }
    button{
        align-items: center;
        display: flex;
        justify-content: center;
        width: 350px;
        color: white;
        background-color: green;
        padding: 10px;
        margin: 0;
    }
</style>
<body>
    <form method = "POST">
        <h2>Edit Student Details</h2>
        <label>ID Number</label>
        <input type = "number" name = "idNum" value = "<?php echo $row['idNum'];?>" readonly><br><br>
        <label>Campus</label>
        <input type = "text" name = "campus" value = "<?php echo $row['campus'];?>"><br><br>
        <label>First Name</label>
        <input type = "text" name = "studFName" value = "<?php echo $row['studFName'];?>"><br><br>
        <label>Last Name</label>
        <input type = "text" name = "studLName" value = "<?php echo $row['studLName'];?>"><br><br>
        <label>Amount Paid</label>
        <input type = "text" name = "amountPaid" value = "<?php echo $row['amountPaid'];?>"><br><br>

        <button type = "submit">Update</button>
    </form>
    <p style="text-align:center; margin-top: 20px;"><a href="../index.html">Back to Menu</a></p>
</body>
</html>