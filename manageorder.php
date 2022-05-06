<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
require'connection.php';
if($_GET['option']=='editproduct'){
/*updating new product quantity*/
  $q="select * from products  where productId='".$_GET['npid']."'";
  $res=mysqli_query($conn,$q);
  if($row=mysqli_fetch_array($res)){//productid validation
    if((($row['quantity']+$_GET['opq'])>=$_GET['npq'])&&($_GET['npq']>0)){//quantity validation
      $newproductname=$row['name'];
      $npupdatedquantity=$row['quantity']-$_GET['npq'];
      $newproductprice=$row['price']*$_GET['npq'];
      $q="update products set quantity='$npupdatedquantity' where productId='".$_GET['npid']."'";
      $res=mysqli_query($conn,$q);}
    else{$newavailable=$row['quantity']+$_GET['opq'];
    echo"<h3>This Quantity cannot be accepted for productID = ".$_GET['npid'].'       .Please change.<br>Avaliable Quantity='.$newavailable.'<br>New Quantity for this Order='.$_GET['npq'];  exit();}}
  else{echo"ProductId you have entered is unavailable";exit();}
  /*updating old product quantity*/
  $q="select * from products  where productId='".$_GET['opid']."'";
  $res=mysqli_query($conn,$q);
  $row=mysqli_fetch_array($res);
  $opupdatedquantity=$row['quantity']+$_GET['opq'];
  $oldproductprice=$row['price']*$_GET['opq'];
  $q="update products set quantity='$opupdatedquantity' where productId='".$_GET['opid']."'";
  $res=mysqli_query($conn,$q);
/*calculating the updated price and updating in the customer's total amount spent and tottalpriceoforder*/
 $neworderprice=$_GET['orderprice']-$oldproductprice+$newproductprice;
 $q="update orders set totalprice='$neworderprice' where orderno='".$_GET['orderno']."'";
 $res=mysqli_query($conn,$q);
$q="select totalamountspent from customers where id='".$_GET['id']."'";
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_array($res);
$ototalamountspent=$row['totalamountspent'];
$ntotalamountspent=$ototalamountspent-$oldproductprice+$newproductprice;

$q="update customers set totalamountspent='$ntotalamountspent' where id='".$_GET['id']."'";
$res=mysqli_query($conn,$q);
/*updating the newproductname,its id and quantity in place of oldproduct in 'orders' table*/
$q="update orders set product='$newproductname' , productId='".$_GET['npid']."',quantity='".$_GET['npq']."'where orderno='".$_GET['orderno']."' and productId='".$_GET['opid']."'";
 $res=mysqli_query($conn,$q);
 echo'<h4>Product information edited successfully</h4><br>Please check from your side,If it went wrong please check your  connection and the values you have entered <br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=6">Orders Table</a> ';
}
else if ($_GET['option']=='deleteorder'){
//increasing the order'products's quantities in 'products' table
$q="select productId,quantity from orders where orderno='".$_GET['orderno']."'";
$res=mysqli_query($conn,$q);
while($row=mysqli_fetch_array($res)){
	$productid=$row['productId'];
	$orderquantity=$row['quantity'];
	
$qq="select quantity from products where productId='$productid'";
	$qres=mysqli_query($conn,$qq);
	$qrow=mysqli_fetch_array($qres);
	$newquantity=$qrow['quantity']+$orderquantity;
$uq="update products set quantity='$newquantity' where productId='$productid'";
	$ures=mysqli_query($conn,$uq);
}
//decreasing the totalamountspent of the ordered customer
$q="select totalamountspent from customers where id='".$_GET['id']."'";
	$res=mysqli_query($conn,$q);
	$row=mysqli_fetch_array($res);
	$ototalamountspent=$row['totalamountspent'];
	$ntotalamountspent=$ototalamountspent-$_GET['orderprice'];

$q="update customers set totalamountspent='$ntotalamountspent' where id='".$_GET['id']."'";
	$res=mysqli_query($conn,$q);
//Atlast deleting the order in 'orders' table
$q="delete from orders where orderno='".$_GET['orderno']."'";
	$res=mysqli_query($conn,$q);
echo'<h4>Order Successfully deleted </h4><br>Please check from your side,If it went wrong please check your  connection<br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=6">Orders Table</a>';
}
else{//checking whther customer id is valid or not and updating totalamount spent
  $q="select totalamountspent,name from customers where id='".$_GET['ncid']."'";
$res=mysqli_query($conn,$q);
if(mysqli_num_rows($res)!=0){
$row=mysqli_fetch_array($res);
$nctotalamountspent=$row['totalamountspent'];
$nctotalamountspent=$nctotalamountspent+$_GET['orderprice'];
//updating dateoforder and customer name in 'orders' table
$q="update orders set dateoforder='".$_GET['ndof']."',customername='".$row['name']."' ,customerid='".$_GET['ncid']."' where orderno='".$_GET['orderno']."'";
$res=mysqli_query($conn,$q);
$q="update customers set totalamountspent='$nctotalamountspent' where id='".$_GET['ncid']."'";
$res=mysqli_query($conn,$q);
//updating total amount spent in old customer
$q="select totalamountspent from customers where id='".$_GET['id']."'";
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_array($res);
$octotalamountspent=$row['totalamountspent'];
$octotalamountspent=$octotalamountspent-$_GET['orderprice'];
$q="update customers set totalamountspent='$octotalamountspent' where id='".$_GET['id']."'";
$res=mysqli_query($conn,$q);

echo'<h4>Date of Order/Cutomer ID edited successfully</h4><br>Please check from your side,If it went wrong please check your  connection and the values you have entered<br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=6">Orders Table</a>';
}else{echo"Mentioned Customer id is not present .Please check.";}
}
}?>