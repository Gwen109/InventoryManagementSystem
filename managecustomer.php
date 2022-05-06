<?php 
require'connection.php';
if($_SERVER['REQUEST_METHOD']=="GET"){
if($_GET['ncn']=="notedit"){ 
	if($_GET['option']=='delete'){
			$q="delete from customers where id='".$_GET['id']."'";
			$res=mysqli_query($conn,$q);
			$q="delete from orders where customerid='".$_GET['id']."'";
			$res=mysqli_query($conn,$q);
			echo'<h4>Customer Deleted successfully</h4>Please  check from your side,If it went wrong please check your  connection <br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=4">Customers Table</a>';
			}
	else{
		$q="select orderno, product,quantity from orders where customerid='".$_GET['id']."'";
		$res=mysqli_query($conn,$q);
		$on=0;
		echo'<a href="index.php">Home page</a><center><table style="width: 70%; margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>OrderNo<th>Product</th><th>Quantity<br>Purchased</th></tr></thead><tbody>';
		while($row=mysqli_fetch_array($res)){
			if($on!=$row['orderno']){
			echo '<tr><td>'.$row['orderno'].'</td>';
			$on=$row['orderno'];}
			else{echo'<td></td>';}
			echo'<td>'.$row['product'].'</td><td>'.$row['quantity'].'</td></tr>';

		}echo'</tbody><table></center>';
	}}

else{
	if((strlen($_GET['ncp'])==10)&&($_GET['ncp']>0)){
	$q="update customers set name='".$_GET['ncn']."',emailid='".$_GET['nce']."',phoneno='".$_GET['ncp']."',gender='".$_GET['ncg']."' where id='".$_GET['id']."'";
	$res=mysqli_query($conn, $q);
	$q="update orders set customername='".$_GET['ncn']."' where customerid='".$_GET['id']."'";
	$res=mysqli_query($conn, $q);
	echo'<h4>Customer details updated successfully</h4><br>Please check from your side,If it went wrong please check your  connection and the values you have entered <br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=4">Customers Table</a>';
}else{echo"Phone number should be 10 digits and +ve value ";}
}}
?>


























