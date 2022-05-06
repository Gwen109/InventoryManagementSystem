<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
if($_GET['option']=='editproduct'){
echo"Please edit only the value which need to be edit and leave remaining".' <form method=GET action="manageorder.php">
<input type="hidden" value="'.$_GET['orderprice'].'"  name="orderprice" required>
<input type="hidden" value="'.$_GET['id'].'"  name="id" required>
<input type="hidden" value="'.$_GET['orderno'].'"  name="orderno" required>
<input type="hidden" value="editproduct" name="option" required>
<input type="hidden" value="'.$_GET['productid'].'"  name="opid" required>
<input type="hidden" value="'.$_GET['productquantity'].'"  name="opq" required>
<label>ProductID:</label><input type="text" value="'.$_GET['productid'].'"  name="npid" required>
<label>Product Quantity:</label><input type="number" value="'.$_GET['productquantity'].'" name="npq" required><br><a href="manage.php?manageoption=5" >View ProductID and Available quantity </a>';
echo'<button>Change</button><form>'; }
else{
 echo"Please edit only the value which need to be edit and leave remaining".'<form method=GET action="manageorder.php">
<input type="hidden" value="editorder" name="option">
<input type="hidden" value="'.$_GET['id'].'"  name="id">
<input type="hidden" value="'.$_GET['orderprice'].'"  name="orderprice">
<input type="hidden" value="'.$_GET['orderno'].'"  name="orderno">
<label>Date of order(MM-DD-YYYY):</label><input type="date" value="'.$_GET['dateoforder'].'" name="ndof" min="1000-12-31" max="9999-12-31" required>
<label>Customer ID:</label><input type="text" value="'.$_GET['id'].'"  name="ncid" required><br><a href="manage.php?manageoption=4" >View CustomerID </a>';
echo'<button>Change</button><form>';
}}?>