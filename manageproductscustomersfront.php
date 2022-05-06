<?php 
if($_SERVER['REQUEST_METHOD']=="GET"){
if($_GET['option']=='editproduct'){
echo'<h4>Please edit only the value which need to be edit and leave remaining</h4><br><br>';
echo'<form method="GET" action="manageproducts.php">
<input type="hidden" value="'.$_GET['id'].'" name="opid" >
<label>Product id:</label><input type="text" value="'.$_GET['id'].'" name="npid" required><br>
<label>ProductName:</label><input type="text" value="'.$_GET['name'].'" name="npn" required><br>
<label>Quantity:</label><input type="number" value="'.$_GET['quantity'].'" name="npq" required><br>
<label>QuantityLowerLimit:</label><input type="number" value="'.$_GET['quantitylowerlimit'].'" name="npqll" required><br>
<label>Price(Rupees(Rs.) not need to be mentioned):</label><input type="number" value="'.$_GET['price'].'" name="npp" required><br>
<button>Update New Value</button></form>';
}
else{
echo'<h4>Please edit only the value which need to be edit and leave remaining</h4><br><br>';
echo'<form method="GET" action="managecustomer.php">
<input type="hidden" value="'.$_GET['id'].'" name="id" >
<label>CustomerName:</label><input type="text" value="'.$_GET['name'].'" name="ncn" required><br>
<label>EmailID:</label><input type="email" value="'.$_GET['emailid'].'" name="nce" required><br>
<label>Phone no:</label><input type="number" value="'.$_GET['phoneno'].'" name="ncp" required><br>
<label>Gender(Male/Female):</label><input type="text" value="'.$_GET['gender'].'" name="ncg" required><br>
<button>Update New Value</button></form>';
}}?>