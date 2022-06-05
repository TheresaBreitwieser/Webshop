<?php include_once("header.php"); ?>

<main>
<?php
 include_once("database/db_connection.php");
 $select = "SELECT * FROM products WHERE product_id=".$_GET['productid']."";

$result = $database_con->query($select);

echo '<div class="row">';
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
      echo '<div class="col-6">';
      echo '<img src="images/'.$row["product_img"].'.jpg" alt='.$row["product_img"].'>';
      echo '</div>';
      echo '<div class="col-6">';
      echo '<h1>'.$row["product_name"].'</h1>';
      echo '<div>Product description:<span id="product_description"> '.$row["product_description"].'</span></div>';
      echo '<p>Price: <span id="price">'.$row["price"].'</span></p>';
        echo '<div>Product ID:<span id="productid"> '.$row["product_id"].'</span></div>';
      echo '<button class="addToCartButton"><i class="fas fa-shopping-cart"></i>Add to Cart</button>';
      echo '</div>';
}} else {
  echo "<h4>Daten konnten nicht abgerufen werden</h4>";
}
echo '</div>';


$selectAll = "SELECT product_img, product_id FROM products WHERE product_id !=".$_GET['productid']." ORDER BY RAND() LIMIT 3 ";
$resultAll = $database_con->query($selectAll);

echo '<h3>You might also be interested in......</h3>';

echo '<div class="row">';
if($resultAll->num_rows>0){
  while($rowAll=$resultAll->fetch_assoc()){
      echo '<div class="col-4">';
      echo '<a href="detail.php?productid='.$rowAll["product_id"].'" target="_self"><img src="images/'.$rowAll["product_img"].'.jpg" alt='.$rowAll["product_img"].'></a>';
      echo '</div>';
}} else {
  echo "<h4>Daten konnten nicht abgerufen werden</h4>";
}
echo '</div>';

$database_con->close();

?>

</main>

<script>
  
document.getElementsByClassName("addToCartButton")[0].addEventListener("click", addProduct);

function addProduct() {
    let item = document.getElementById("productid").innerHTML;
    let price = document.getElementById("price").innerHTML;
    let product_description = document.getElementById("product_description").innerHTML;
    let products=[];
    let amount=0;
    let counter=0;
  
      //check if local storage is empty, if not, filter for duplicates
    if(localStorage.getItem("products")){
    products=JSON.parse(localStorage.getItem("products"));

    for(let i=0; i<products.length; i++){
      counter+=products[i]["amount"];

     if(products[i]["product_id"]==item){
       amount= products[i]["amount"];
      products=products.filter((i)=>i.product_id !== item)
     }
   
   }
   amount++;
   counter++;

    console.log(products);
    products.push({"product_id": item, "price": price, "product_description":product_description, "amount": amount});
    localStorage.setItem("products", JSON.stringify(products));
  } else {
    amount=1;
    counter=1;
    products.push({"product_id": item, "price": price, "product_description":product_description, "amount": amount});
    localStorage.setItem("products", JSON.stringify(products));
    }
    document.getElementById("counter").innerHTML = counter;
  }


</script>

<?php include_once("footer.php"); ?>