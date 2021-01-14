<!DOCTYPE HTML>
<html>

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
<div>
<form action="action.php" method="post">
<table>
<td>
<select name="cust_name">
<option disabled selected>--- Select ---</option>
  

<?php

$query = mysqli_query($conn, "SELECT distinct customer_name FROM sales ")
   or die (mysqli_error($conn));

while($data = mysqli_fetch_array($query))
        {
            echo "<option value='". $data['customer_name'] ."'>" .$data['customer_name'] ."</option>";  
        }   
    ?>  
    

</select></td>
<td>
    <select name="prod_name">
<option disabled selected>--- Select ---</option>
  

<?php

$query = mysqli_query($conn, "SELECT distinct product_name FROM sales ")
   or die (mysqli_error($conn));

while($data = mysqli_fetch_array($query))
        {
            echo "<option value='". $data['product_name'] ."'>" .$data['product_name'] ."</option>";  
        }   
    ?>  
</select></td>
<td>
    <select name="pricee">
<option disabled selected>--- Select ---</option>
  

<?php

$query = mysqli_query($conn, "SELECT distinct product_price FROM sales ")
   or die (mysqli_error($conn));

while($data = mysqli_fetch_array($query))
        {
            echo "<option value='". $data['product_price'] ."'>" .$data['product_price'] ."</option>";  
        }   
    ?>  
</select></td>

<td>
<input type="submit" value="Filter"/></td></table>
</form>
</div>
<?php
$selectOption1 = $_POST['cust_name'];
$selectOption2 = $_POST['prod_name'];
$selectOption3 = $_POST['pricee'];
$qry="";
if($selectOption1!='' || $selectOption2!='' || $selectOption3!='')
{
    $qry=" WHERE ";
    if($selectOption1!='')
    {
        if($qry==" WHERE ")
    $qry=$qry."customer_name='".$selectOption1."' ";
        else
    $qry=$qry."and customer_name='".$selectOption1."' ";

    }
    if($selectOption2!='')
    {
       
        if($qry==" WHERE ")
    $qry=$qry."product_name LIKE '%".$selectOption2."%' ";
        else
    $qry=$qry."and product_name LIKE '%".$selectOption2."%' ";
      
    }
    if($selectOption3!='')
    {
        if($qry==" WHERE ")
    $qry=$qry."product_price='".$selectOption3."'";
        else
    $qry=$qry." and product_price='".$selectOption3."'";

    }
}
?>

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

$querystring="SELECT sale_id,customer_name,customer_mail,product_id,product_name,product_price,sale_date FROM sales ".$qry;
//print_r($querystring);exit();
$query = mysqli_query($conn, "SELECT sale_id,customer_name,customer_mail,product_id,product_name,product_price,sale_date FROM sales ".$qry)
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

<?php

$querystring="SELECT SUM(product_price) as sums FROM sales ".$qry;
//print_r($querystring);exit();
$query = mysqli_query($conn, "SELECT SUM(product_price) as sums  FROM sales ".$qry)
   or die (mysqli_error($conn));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>{$row['sums']}</td>
    <td></td>
    </tr>";

}
?>
</table>



</body>
</html>

