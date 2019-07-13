<?php
include('connect.php');
session_start();
$name = $_SESSION['name'];
$day = $_POST["day"];
$month = $_POST['month'];
$year = $_POST['year'];
$sql = 'SELECT * FROM incidents WHERE username = :name and month = :month and year = :year and day = :day';
$pdo = $db->prepare($sql);
$pdo->bindValue(':name',$name);
$pdo->bindValue(':month',$month);
$pdo->bindValue(':day',$day);
$pdo->bindValue(':year',$year);
$pdo->execute();
$results = $pdo->fetchAll();
$length = count($results);
if($length)
{
    foreach($results as $result)
        echo $result['content'].'<br>';
}
