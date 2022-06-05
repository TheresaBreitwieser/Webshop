<?php include_once("header.php"); ?>

<main>
<h1>Webshop</h1>

<?php
 include_once("database/db_connection.php");
 $select = "SELECT product_id, product_img, price FROM products";

$result = $database_con->query($select);

echo '<div class="row gallery">';
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
      echo '<div class="col-4">';
      echo '<a href="detail.php?productid='.$row["product_id"].'" target="_self"><img src="images/'.$row["product_img"].'.jpg" alt='.$row["product_img"].'></a>';
      echo '<p>'.$row["price"].'</p>';
      echo '</div>';
}} else {
  echo "<h4>Daten konnten nicht abgerufen werden</h4>";
}

echo '</div>';


$database_con->close();
?>




</main>

<?php include_once("footer.php"); ?>