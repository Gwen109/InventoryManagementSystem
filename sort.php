<?php
require'connection.php';
if($_SERVER['REQUEST_METHOD']=="GET"){  
	if($_GET['sortoption']==7){
	$q="SELECT name,id,totalamountspent FROM customers ORDER BY totalamountspent DESC";
	$res=mysqli_query($conn,$q);
	echo'<a href="index.php">Home page</a><center><table style="width: 50%; margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>Customer<br>ID</th><th>Name</th><th>TotalAmount<br>Spent</th></tr></thead><tbody>';
    while($row=mysqli_fetch_array($res)){
	echo '<tr><td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row['totalamountspent'].'</td></tr>';
    }echo'</center></tbody></table>';
}
else if($_GET['sortoption']==8){
	$q="SELECT name,quantity FROM products ORDER BY quantity DESC";
	$res=mysqli_query($conn,$q);
	echo'<a href="index.php">Home page</a><center><table style="width: 50%; margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>Product</th><th>Quantity</th></tr></thead><tbody>';
    while($row=mysqli_fetch_array($res)){
	echo '<tr><td>'.$row['name'].'</td><td>'.$row['quantity'].'</td></tr>';
    }echo'</center></tbody></table>';
}
else if($_GET['sortoption']==9){
	$q="SELECT name,price FROM products ORDER BY price DESC";
	$res=mysqli_query($conn,$q);
	echo'<a href="index.php">Home page</a><center><table style="width: 50%; margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>Product</th><th>Price</th></tr></thead><tbody>';
    while($row=mysqli_fetch_array($res)){
	echo '<tr><td>'.$row['name'].'</td><td>'.$row['price'].'</td></tr>';
    }echo'</center></tbody></table>';
}
else if($_GET['sortoption']==10){
	$q="SELECT name FROM products ORDER BY name ASC";
	$res=mysqli_query($conn,$q);
	echo'<a href="index.php">Home page</a><center><table style="width: 40%; margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>Product Name</th></tr></thead><tbody>';
    while($row=mysqli_fetch_array($res)){
		echo '<tr><td>'.$row['name'].'</td></tr>';
    }echo'</center></tbody></table>';
}
else if($_GET['sortoption']==11){
	$q="SELECT DISTINCT orderno,totalprice FROM orders ORDER BY totalprice DESC";
	$res=mysqli_query($conn,$q);
	echo'<a href="index.php">Home page</a><center><table style="width: 50%; margin-top:15px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>OrderNo</th><th>TotalPrice</th></tr></thead><tbody>';
    while($row=mysqli_fetch_array($res)){
	echo '<tr><td>'.$row['orderno'].'</td><td>'.$row['totalprice'].'</td></tr>';
    }echo'</center></tbody></table>';
}
else{
	$q="SELECT name FROM products where quantity < QuantityLowerLimit";
	$res=mysqli_query($conn,$q);
	echo'<a href="index.php">Home page</a><center><h3>';
	if (mysqli_num_rows($res)==0){
		echo"No products";}
	else{
	while($row=mysqli_fetch_array($res)){
		echo $row['name'].'<br>';
    }}
    echo'</center></h3>';
}
}?>