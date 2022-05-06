<?php
require'connection.php';
if($_SERVER['REQUEST_METHOD']=="GET"){
if($_GET['addoption']==1){
	echo'<a href="index.php">Home page</a>
	<form method="GET" action="addcustomerproduct.php"><center>
	<input type="hidden" name="add" value="customer">
	<label> Name: </label> <input type="text" name="customername" placeholder="Name" required><br>
	<label> Email id: </label> <input type="email" name="emailid" placeholder="Email ID" required><br>
	<label> Phone number: </label> <input type="number" name="phonenumber" placeholder="Phone Number"  required><br>
	<label> Gender: </label> <select name="gender" required>  <option >Male</option>  <option>Female</option> </select><br>
	<button type="submit">Submit </button></center>
	</form>';
}
else if($_GET['addoption']==2 ){

	echo '<a href="index.php">Home page</a><form method="GET" action="addcustomerproduct.php"><center>
		<input type="hidden" name="add" value="product">
	<label> Name: </label> <input type="text" name="productname" placeholder="ProductName" required><br>
	<label> Quantity: </label> <input type="number" name="quantity"  required><br>
	<label> Quantity Lower limit: </label> <input type="number" name="quantitylowerlimit" required><br>
	<label> Price(Rupess(Rs.) not need to be mentioned): </label> <input type="number" name="price"  required><br>
	<label>Product id:</label><input type="text" name="productid"  required><br>
	<center><button type="submit">Submit </button></center></center>
	</form>';
}
else{ 
	echo'<a href="index.php">Home page</a><br><table style="width: 40%;  float: left; margin-right:10px;" border="1" cellspacing="0" cellpadding="10"><thead><tr><th>ProductID</th><th>ProductName</th><th>Quantity<br>Available</th></tr></thead><tbody>';
	$query="select *from products where quantity > 0" ;
	$res=mysqli_query($conn, $query);
	while($row=mysqli_fetch_array($res)){
		echo '<tr><td>'.$row['productId'].'</td><td>'.$row['name'].'</td><td>'.$row['quantity'].'</td></tr>'; 
		 }
		 echo'</tbody></table>';  
	echo'<form method="POST" action="addorder.php">';
	echo'<label> Date of Order: </label> <input type="date" name="dateoforder" min="1000-12-31" max="9999-12-31" required>
	<br>
	<h4>Please enter the Customer ID by referring from this link</h4><a href="manage.php?manageoption='."4".'" >Customers list </a><br>
	<label> Customer ID: </label> <input type="text" name="customerid" required><br><br>';
	echo"ENTER MULTIPLE PRODUCTS IN THE FORMAT: Product1ID.Quantity,Product2ID.Quantity, and so on..   FOR EXAMPLE: JE01.67,SH01.100, (and so on)";
	echo'<label>Orders:</label><textarea style="font-size:20px;position:sticky;top:5; "  name="order" rows="5" cols="50" placeholder="enter products with quantity in above mentioned format" required></textarea>';
	echo'<center><button type="submit">Submit Order </button></center></form>';
}
}
?>