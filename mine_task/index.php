<!DOCTYPE HTML>
<html>
<head>
<style>
#emp
{
 font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 50%;
}
table,th,td
{
  text-align: center;
   padding: 15px;
   
}
th
{
  background-color: #4CAF50;
  color: white;
}
tr
{
  tr:nth-child(even) {background-color: #f2f2f2;}

}
</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "rexx";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



<div><center>Deatils</center><div>
<hr>
<table id="sales" border="1" align="center">
<tr>
  <th>SALES ID</th>
  <th>CUSTOMER NAME</th>
  <th>MAIL</th>
  <th>PRODUCT ID</th>
  <th>PRODUCT NAME</th>
  <th>PRODUCT PRICE</th>
  <th>SALES DATE</th>
 </tr>
<?php

$query = mysqli_query($conn, "SELECT sale_id,customer_name,customer_mail,product_id,product_name,product_price,sale_date FROM sales ")
   or die (mysqli_error($conn));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['sale_id']}</td>
    <td>{$row['customer_name']}</td>
    <td>{$row['customer_mail']}</td>
    <td>{$row['product_id']}</td>
    <td>{$row['product_name']}</td>
    <td>{$row['product_price']}</td>
    <td>{$row['sale_date']}</td>
    </tr>";

}

?>

</table>
</body>
</html>

