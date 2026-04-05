<?php
include("../db.php");



if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $idNum = $_POST['idNum'];
    $campus = $_POST['campus'];
    $studFName = $_POST['studFName'];
    $studLName = $_POST['studLName'];
    $amountPaid = $_POST['amountPaid'];

    $sql = "INSERT INTO registration (idNum, campus, studFName, studLName, amountPaid)
            VALUES ('$idNum', '$campus', '$studFName', '$studLName', '$amountPaid')";

            if(!mysqli_query($conn, $sql)){
                die("Error: " . mysqli_error($conn));
            }else{
                echo "Student added.";
                header("Location: add.php");
                exit();   
            }
}

$result = mysqli_query($conn, "SELECT * FROM registration WHERE isDeleted = 0");

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
        margin: auto;
        border: 3px solid black;
        width: 350px;
        border-radius: 8px;
        padding: 10px;
    }
    table{
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
</style>
<body>
    <form method = "POST" action = "">

    <h2>Register Students</h2>
        <label>ID Number</label>
        <input type = "number" name = "idNum" placeholder = "ID Number" required><br><br>

        <label>Campus</label>
        <input type = "text" name = "campus" placeholder = "Campus" required><br><br>

        <label>First Name</label>
        <input type = "text" name = "studFName" placeholder = "First Name" required><br><br>

        <label>Last Name</label>
        <input type = "text" name = "studLName" placeholder = "Last Name" required><br><br>

        <label>Amount Paid</label>
        <input type = "number" step = "0.01" name = "amountPaid" placeholder = "0.00" required><br><br>

        <button type = "submit">Register</button>
        
    </form><br>

    <table border = "1" cellpadding = "10">
        <tr>
            <th>ID Number</th>
            <th>Campus</th>
            <th>Name</th>
            <th>Amount Paid</th>
            <th>Actions</th>
        </tr>

        <?php
        $count = 0;
        $totalcollection = 0;

        while($row = mysqli_fetch_assoc($result)){
            $count++;
            $totalcollection += $row['amountPaid'];
            echo "<tr>";
            echo "<td>" . $row['idNum'] . "</td>";
            echo "<td>" . $row['campus'] . "</td>";
            echo "<td>" . $row['studLName'] . ", " . $row['studFName'] . "</td>";
            echo "<td>" . $row['amountPaid'] . "</td>";
            echo "<td>";
            echo "<a href='delete.php?id={$row['idNum']}'
            onclick=\"return confirm('Do you really want to delete this student?');\">Delete</a> | "; 
            echo "<a href='edit.php?id={$row['idNum']}'>Edit</a>";
                
                "</td>";
            echo "</tr>";
        }

        echo "<tr>

        <td colspan = '5'><strong>Registrants: {$count} | </strong>
        <strong>Total Collection: ₱{$totalcollection}</strong></td>
        
        
        
        
        </tr>";
?>

</table>
    
    <p style="text-align:center; margin-top: 20px;"><a href="../index.html">Back to Menu</a></p>
</body>
</html>