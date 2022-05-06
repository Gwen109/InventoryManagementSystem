<?php 
require'connection.php';
if($_SERVER['REQUEST_METHOD']=="GET"){
if($_GET['manageoption']==4){
	$query="select * from customers";
	$res=mysqli_query($conn, $query);
	echo'<a href="index.php">Home page</a><table style="width: 100%;margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>CustomerID</th><th>CustomerName</th><th>EmailID</th><th>Phone No</th><th>Gender</th><th>Edit</th><th>Delete</th><th>Products Purchased</th></tr></thead><tbody>';
while($row=mysqli_fetch_array($res)){
	echo '<tr><td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row['emailid'].'</td><td>'.$row['phoneno'].'</td><td>'.$row['gender'].'</td><td><a  href="manageproductscustomersfront.php?id='.$row['id'].'&name='.$row['name'].'&emailid='.$row['emailid'].'&phoneno='.$row['phoneno'].'&gender='.$row['gender'].'&option=editcustomer">Edit</a>'."</td><td>".'<a  href="managecustomer.php?id='.$row['id'].'&option=delete&ncn=notedit">Delete</a></td><td>'.'<a href="managecustomer.php?id='.$row['id'].'&option=productspurchased&ncn=notedit">Products Purchased</a></td></tr>';
}echo'</tbody></table>';
}
else if($_GET['manageoption']==5){
	echo'<a href="index.php">Home page</a><table style="width: 100%; margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>ProductID</th><th>ProductName</th><th>Quantity</th><th>QuantityLowerLimit</th><th>Price</th><th>Edit</th><th>Delete</th><th>customerspurchased</th></tr></thead><tbody>';
	$query="select *from products";
	$res=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($res)){
	echo '<tr><td>'.$row['productId'].'</td><td>'.$row['name'].'</td><td>'.$row['quantity'].'</td><td>'.$row['QuantityLowerLimit'].'</td><td>'.$row['price'].'</td><td><a  href="manageproductscustomersfront.php?id='.$row['productId'].'&name='.$row['name'].'&quantity='.$row['quantity'].'&quantitylowerlimit='.$row['QuantityLowerLimit'].'&price='.$row['price'].'&option=editproduct">Edit</a>'.'</td><td>'.'<a href="manageproducts.php?id='.$row['productId'].'&option=delete&npn=1">Delete</a>'.'</td><td>'.'<a href="manageproducts.php?id='.$row['productId'].'&option=customerspurchased&npn=1">Customers Purchased</a></td></tr>';
}
echo'</tbody></table>';
}else{
	echo'<a style="position:sticky; top:5; background-color:yellow;" href="index.php">Home page</a><br><br><table style="width: 100%;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>Orderno</th><th>Totalprice</th><th>Dateoforder<br>(YYYY-MM-DD)</th><th>CustomerName</th><th>Products</th><th>ProductID</th><th>ProductQuantity</th></tr></thead><tbody>';
	$query="select *from orders";
	$res=mysqli_query($conn, $query);
	$on=0;/*on is used in order not to repeat the order no and other info again and again */
while($row=mysqli_fetch_array($res)){
	if($on!=$row['orderno']){
		echo '<tr><td>'.$row['orderno'].'&emsp;<a href="manageorderfront.php?orderno='.$row['orderno'].'&option=editorder'.'&dateoforder='.$row['dateoforder'].'&id='.$row['customerid'].'&orderprice='.$row['totalprice'].'">EditOrder</a>'.'&emsp;<a href="manageorder.php?orderno='.$row['orderno'].'&option=deleteorder'.'&orderprice='.$row['totalprice'].'&id='.$row['customerid'].'">DeleteOrder</a>'.'</td><td>'.$row['totalprice'].'</td><td>'.$row['dateoforder'].'</td><td>'.$row['customername']."(id=".$row['customerid'].")".'</td>' ;
		$on=$row['orderno'];}
	else{echo'<td></td><td></td><td></td><td></td>';}
	echo '<td>'.$row['product'].'</td><td>'.$row['productId'].'</td><td>'.$row['quantity'].'&emsp;&emsp;<a href="manageorderfront.php?orderno='.$row['orderno'].'&productid='.$row['productId'].'&option=editproduct'.'&productname='.$row['product'].'&productquantity='.$row['quantity'].'&orderprice='.$row['totalprice'].'&id='.$row['customerid'].'">Editproduct</a></td></tr>';
	echo'</form>';
}echo'</tbody></table>';
}}?>