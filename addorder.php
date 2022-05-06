<?php

require 'connection.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$q="select max(orderno) as neworderno from orders";
$res=mysqli_query($conn,$q);
$m=mysqli_fetch_array($res);
$thisorder=$m['neworderno']+1;
/*separatedproducts'index each separate products.quantity
eachproduct[0]=product,eachproduct[1]=quantity*/
mysqli_autocommit($conn,FALSE);
$separatedproducts=explode(",",$_POST['order']);
$totalpriceoforder=0;
//checking whether the customerid is valid or not
$p="select id from customers  where id='".$_POST['customerid']."'";
$res=mysqli_query($conn,$p);
if(mysqli_num_rows($res)!=0){
	for($i=0;$i<count($separatedproducts);$i++){
	if(substr_count($separatedproducts[$i],"." )==1){// Format filter
		$eachproduct=explode(".",$separatedproducts[$i]);
		$priceq="select * from products  where productId='$eachproduct[0]' ";
		$priceres=mysqli_query($conn,$priceq);
		if($pricerow=mysqli_fetch_array($priceres)){//product filter 
			if(ctype_digit($eachproduct[1])&&($eachproduct[1]>0)){ //quantity filter
				if($eachproduct[1]<$pricerow['quantity']){
/*inserting the ordered products,customerid,quantity,dateoforder to 'orders' table*/
				$q="INSERT INTO orders(orderno,product,productId,quantity,dateoforder,customerid) VALUES('$thisorder','".$pricerow['name']."','$eachproduct[0]','$eachproduct[1]','".$_POST['dateoforder']."','".$_POST['customerid']."')";
				$lastres=mysqli_query($conn,$q);
/*Reducing the quantity of the ordered product */
				$updatedproductquantity=$pricerow['quantity']-$eachproduct[1];		
				$q="update products set quantity='$updatedproductquantity' where productId='$eachproduct[0]'";
        		$res=mysqli_query($conn,$q);
        		$totalpriceoforder=$totalpriceoforder+$pricerow['price']*$eachproduct[1];
 }				else{echo"<h3> Insufficient Quantity for productID  ".$eachproduct[0].'<br>Avaliable Quantity='.$pricerow['quantity'].'<br>Quantity for Order='.$eachproduct[1] ;  exit();}}			
 			else{echo"Please check quantity for productID  ".$eachproduct[0];  exit();}}
 		else{echo $eachproduct[0]."is not available ,Plz enter valid ProductID";exit();}}
 	else{echo"Please check your input format of products";  exit();}	
}mysqli_commit($conn);
/*updating the totalamountspent by the customers in 'customers' table*/
$q="select totalamountspent,name from customers where id='".$_POST['customerid']."'";
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_array($res);
$newtotalamountspent=$row['totalamountspent']+$totalpriceoforder;
/*adding totalPrice of the order to the 'orders' table*/
$q="update orders set totalprice='$totalpriceoforder',customername='".$row['name']."' where orderno='$thisorder'";
$res=mysqli_query($conn,$q);
$q="update customers set totalamountspent='$newtotalamountspent' where id='".$_POST['customerid']."'";
$res=mysqli_query($conn,$q);
echo'Please check from your side,if it went wrong then check the values and connection<br>';
echo'<h3>totalprice of this order=   '.$totalpriceoforder.'<h3>';
echo'<br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=6">Orders Table</a>&emsp;&emsp;<a href="add.php?addoption=3">Add another Order</a>';
mysqli_commit($conn);
}
else{echo"Mentioned Customer id is not present .Please check.";}
}
?>





























