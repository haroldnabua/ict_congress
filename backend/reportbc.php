<?php
include("../db.php");

$row = [];

if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST['campus'])){
    $selectedCampus = $_POST['campus'];

    $campusList = "'" . implode("','", $selectedCampus) . "'";
    
    $sql = "SELECT * FROM registration WHERE campus IN ($campusList)
            AND isDeleted = 0";

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
}
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
        border: 2px solid black;
        width: 350px;
        border-radius: 5px;
        padding: 10px;
        font-size: 20px;
    }
    table{
        margin: auto;
        text-align: center;
    }

    button{
        font-size: 20px;
        width: 350px;
        padding: 10px;
    }

</style>
<body>
    <form method="POST">
        <label><input type = "checkbox" name = "campus[]" value = "Main">Main</label>
        <label><input type = "checkbox" name = "campus[]" value = "Banilad">Banilad</label> 
        <label><input type = "checkbox" name = "campus[]" value = "LM">LM</label><br><br>

        <button type = "submit">Generate Report</button>
    </form><br><br>


    <?php if(!empty($rows)): ?>
        <table border = "1" cellpadding = "10">
            <tr>
                <th>ID Number</th>
                <th>Name</th>
                <th>Campus</th>
                <th>Amount Paid</th>
                <th>Attended</th>
            </tr>   

            <?php foreach($rows as $row): ?>
                <tr>
                    <td><?= $row['idNum'] ?></td>
                    <td><?= $row['studLName']?>, <?=$row['studFName']?></td>
                    <td><?= $row['campus'] ?></td>
                    <td><?= $row['amountPaid'] ?></td>
                    <td><?= $row['attended'] ?></td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php endif; ?>

    <p style="text-align:center; margin-top: 20px;"><a href="../index.html">Back to Menu</a></p>
    
</body>
</html>