<?php
include("../db.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['campus'])){
    $selectedCampus = $_POST['campus'];
    $campusList = "'" . implode("','", $selectedCampus) . "'";

    $sql = "SELECT idNum, studLName, studFName, campus
            FROM registration
            WHERE campus IN ($campusList) AND isDeleted = 0
            ORDER BY RAND()
            LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if($row = mysqli_fetch_assoc($result)){
        echo "<h2>Reveal the Lucky Winner!</h2>";
        echo "<table border = '1' cellpadding = '10'>
        <tr>
        <th>ID Number</th>
        <th>Name</th>
        <th>Campus</th>
        </tr>

        <tr>
        <td>{$row['idNum']}</td>
        <td>{$row['studLName']}, {$row['studFName']}</td>
        <td>{$row['campus']}</td>
        </tr>
        </table>";

        echo "<h3>CONGRATULATIONS!!!</h3>";
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
        text-align: center;
    }
    button{
        width: 350px;
        border-radius: 5px;
        padding: 10px;
        background-color: gold;
        color: white;
        font
    }
    table{
        margin-left: auto;
        margin-right: auto;
        width: 350px;
    }
    body{
        text-align: center;
    }
    h3{
        font-size: 30px;
    }
</style>
<body>
    <form method = "POST">
        <label><input type = "checkbox" name = "campus[]" value = "Main">Main</label>
        <label><input type = "checkbox" name = "campus[]" value = "Banilad">Banilad</label>
        <label><input type = "checkbox" name = "campus[]" value = "LM">LM</label><br><br>
        <button type = "submit">Reveal the Lucky Winner!</button>
    </form>
    
     <p style="text-align:center; margin-top: 20px;"><a href="../index.html">Back to Menu</a></p>
</body>
</html>