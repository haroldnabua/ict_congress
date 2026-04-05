    <?php
    include("../db.php");

$row = null;

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $idNum = $_POST['idNum'];

        $checkstud = mysqli_query($conn, "SELECT * FROM registration WHERE idNum = '$idNum'
                                    AND isDeleted = 0");

        $sql = "UPDATE registration
                SET attended = 'YES'
                WHERE idNum = '$idNum'
                AND isDeleted = 0";

    if(mysqli_num_rows($checkstud) == 0){
        echo "Student is not registered.";
    }else{
        $row = mysqli_fetch_assoc($checkstud);

        if($row['attended'] == 'YES'){
            echo "Attendance already recorded.";
        }else{
            $sql = "UPDATE registration
                    SET attended = 'YES'
                    WHERE idNum = '$idNum'
                    AND isDeleted = 0";
        
            if(mysqli_query($conn, $sql)){
                echo "Attendance recorded.";
                $result = mysqli_query($conn, "SELECT * FROM registration WHERE idNum = '$idNum'
                                                AND isDeleted = 0");
                $row = mysqli_fetch_assoc($result);
            }else{
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    form{
        margin: auto;
        border: 2px solid black;
        padding: 10px;
        width: 350px;
        border-radius: 3px; 
    }
    table{
        margin: auto;
        text-align: center;
    }
    button{
        width: 350px;
        padding: 10px;
    }
</style>
<body>
    <form method = "POST">
        <label>ID Number</label>
        <input type = "number" name = "idNum" placeholder = "Input here..."><br><br>
        <button type = "submit">Record Attendance</button>
    </form><br><br>

<?php if($row): ?>
    <table border = "1" cellpadding = "10">
        <tr>
            <th>ID Number</th>
            <th>Name</th>
            <th>Campus</th>
            <th>Amount</th>
            <th>Attended</th>
        </tr>

            <tr>
                <td><?= $row['idNum'] ?></td>
                <td><?= $row['studLName']?>, <?= $row['studFName'] ?></td>
                <td><?= $row['campus'] ?></td>
                <td><?= $row['amountPaid'] ?></td>
                <td><?= $row['attended'] ?></td>

            </tr>
            
    </table>

   <?php endif; ?>

    <p style="text-align:center; margin-top: 20px;"><a href="../index.html">Back to Menu</a></p>
</body>
</html>