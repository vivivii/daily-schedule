<?php
include('connect.php');
session_start();
$name = $_SESSION['name'];
$day = $_POST['day'];
$month = $_POST['mon'];
$year = $_POST['year'];
$content = $_POST['content'];
$sql = $db->prepare('INSERT INTO incidents(username,year,month,day,content) VALUES (:name,:year,:month,:day,:content);');
$sql -> bindValue(':name', $name);
$sql -> bindValue(':year', $year);
$sql -> bindValue(':month', $month);
$sql -> bindValue(':day', $day);
$sql -> bindValue(':content', $content);
$result = $sql->execute();
echo $result;
