
<?php include_once("header.php"); ?>


<main>
<div id="items_table">
        <h2>Cart</h2>
        <table>
            <thead>
            <tr>
            <th>Product ID</th>
            <th>Price € per Unit</th>  
            <th>Product description</th>   
            <th>Amount</th>  
            <th>Sum</th>  
            <th>Remove Item</th> 
            </tr>
            </thead>
            <tbody id="cart">
            </tbody>
        </table>
        <div>Sum total: <span id="total"></span></div>
        <button id="update">Update</button>
       <button id="clearStorage">Clear all</button>
</div>
</main>



<?php include_once("footer.php"); ?>