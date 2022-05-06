<?php 
require'connection.php';
if($_SERVER['REQUEST_METHOD']=="GET"){
if($_GET['npn']==1){ 
	if($_GET['option']=='delete'){
			$q="delete from products where productId='".$_GET['id']."'";
			$res=mysqli_query($conn,$q);
			echo'<h4>Product deleted successfully</h4><br>Please check from your side,If it went wrong please check your connection<br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=5">Products Table</a>';		
		}
	else{
		echo'<a href="index.php">Home page</a><table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>CustomerID</th><th>CustomerName</th><th>EmailID</th><th>Phone No</th><th>Gender</th></tr></thead><tbody>';
		$q="select distinct productId,customerid from orders where productId='".$_GET['id']."'";
		$res=mysqli_query($conn,$q);
		while($row=mysqli_fetch_array($res)){
			$pq="select * from customers where id=".$row['customerid'];
			$pres=mysqli_query($conn,$pq);
			while($prow=mysqli_fetch_array($pres)){
			echo '<tr><td>'.$prow['id'].'</td><td>'.$prow['name'].'</td><td>'.$prow['emailid'].'</td><td>'.$prow['phoneno'].'</td><td>'.$prow['gender'].'</td></tr>';}
		}echo'</tbody></table>';
}}
else{
$q="select productId from products where productId='".$_GET['npid']."'";
$res=mysqli_query($conn,$q);
if(($_GET['opid']==$_GET['npid'])||(mysqli_num_rows($res)==0)){//validating duplicate id
	if(($_GET['npq']>0)&&($_GET['npqll']>0)&&($_GET['npp']>0)){//validating quantity,its LowerLimit,price
$q="update products set productId='".$_GET['npid']."', name='".$_GET['npn']."',quantity='".$_GET['npq']."',QuantityLowerLimit='".$_GET['npqll']."',price='".$_GET['npp']."' where productId='".$_GET['opid']."'";
$res=mysqli_query($conn, $q);
$q="update orders set productId='".$_GET['npid']."', product='".$_GET['npn']."' where productId='".$_GET['opid']."'";
$res=mysqli_query($conn, $q);
echo'<h4>Product details updated successfully</h4><br>Please check from your side,If it went wrong please check your  connection and values you have entered<br><a href="index.php">Home page</a>&emsp;&emsp;<a href="manage.php?manageoption=5">Products Table</a>';}
else{echo"Plz enter only +ve values";}}
else{echo"Product ID you have entered already exists.Plz give different one";}}
}?>