<?php
 
$host="localhost";
$username="root";
$password="";
$database="inventory";
$conn=mysqli_connect($host, $username, $password, $database);

if($_SERVER['REQUEST_METHOD']=="GET"){


if($_GET['add']=='customer'){

if((strlen($_GET['phonenumber'])==10)&&($_GET['phonenumber']>0)){
$q="insert into customers(name,emailid,phoneno,gender) values('".$_GET['customername']."','".$_GET['emailid']."','".$_GET['phonenumber']."','".$_GET['gender']."')";

$res=mysqli_query($conn,$q);

if($res){
	echo'Customer '.$_GET['customername'].'  Added successfully'.'<br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=4">Customers Table</a>&emsp;&emsp;<a href="add.php?addoption=1">Add another customer</a>';
}
else{echo'Some error occured';}

}

else{echo"Phone number should be 10 digits and +ve value ";exit();}
}



else{ //check for duplicate product id
$q="select productId from products where productId='".$_GET['productid']."'";
$res=mysqli_query($conn,$q);
if(mysqli_num_rows($res)==0){//validating the inputs
	if(!(($_GET['quantity']<0)||($_GET['quantitylowerlimit']<0)||($_GET['price']<0))){
	$q="INSERT INTO products(name,quantity,QuantityLowerLimit,price,productId)VALUES('".$_GET['productname']."','".$_GET['quantity']."','".$_GET['quantitylowerlimit']."','".$_GET['price']."','".$_GET['productid']."')";
	$res=mysqli_query($conn,$q);
	if($res){
	echo'Product '.$_GET['productname'].'  Added successfully'.'<br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=5">Products Table</a>&emsp;&emsp;<a href="add.php?addoption=2">Add another product</a>';
}else{echo'Some error occured';}}
	else{echo"Please enter only +ve value  "; }}
else{echo"Product ID you have entered already exists.Plz give different one  "; }

}
}?>

































