<?php
include("../db.php");

$sql = "SELECT campus,
        COUNT(*) AS registered,
        SUM(CASE WHEN attended = 'YES' THEN 1 ELSE 0 END) AS attended,
        SUM(amountPaid) AS totalcollection
        FROM registration
        WHERE isDeleted = 0
        GROUP BY campus";

$result = mysqli_query($conn, $sql);

if(!$result){
    die ("Query failed: " . mysqli_error($conn));
}



echo "
<h2>Summary Report</h2>
<h3>(All Campus)</h3>
    <table border = '1' cellpadding = '10'>
    <tr>
    <th>Campus</th> 
    <th>Registered</th>
    <th>Attended</th>
    <th>Total Collection</th>
    </tr>";

$totalregistered = 0;
$totalattended = 0;
$totalcollection = 0;

    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
        <td>{$row['campus']}</td>
        <td>{$row['registered']}</td>
        <td>{$row['attended']}</td>
        <td>" .  "₱". number_format($row['totalcollection'], 2) . "</td>
        </tr>";

        $totalregistered += $row['registered'];
        $totalattended += $row['attended'];
        $totalcollection += $row['totalcollection'];
    }

        echo "
        <tr>
        <td><strong>TOTALS</strong></td>
        <td><strong> $totalregistered</strong></td>
        <td><strong>$totalattended</strong></td>
        <td><strong>" . "₱"  . number_format($totalcollection, 2) . "</strong></td>   
        </tr>
        
        
        <tr>
        <td colspan = '4'><b>Date Generated</b>: " . date("m/d/Y") . "</td>
        </tr>";

        echo "</table><br>";
    





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT Congress Management System</title>
</head>
<style>
    table{
        margin: auto;
        width: 1000px;
        text-align: center;
        font-size: 20px;
    }
    th{
        font-size: 20px;
    }
    body{
        text-align: center;
        margin-top: 50px;
    }
</style>
<body>
    <p style="text-align:center; margin-top: 20px;"><a href="../index.html">Back to Menu</a></p>
</body>
</html>