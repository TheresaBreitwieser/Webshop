$(document).ready(()=> {
  updateCounter();

if(localStorage.getItem("products")){
  renderCart();
  updateCounter();
    document.getElementById("clearStorage").addEventListener("click", function(){
    localStorage.clear();
    location.reload();
  }); 
} 






function renderCart(){
let itemsInCart = localStorage.getItem("products");
let table=document.getElementById("cart");
    $.post(
  'cart-send.php',
  {webshop: itemsInCart},
  function(phpdata){
      if(phpdata){
        table.innerHTML=phpdata;
        calculateSum();
      }else {
          alert("Löschen nicht möglich");
      }
  }
)
}

  
  document.getElementById("update").addEventListener("click", calculateSum);
  
  
  function calculateSum(){
    let table = document.getElementById("cart");
    let val=[];

     let count=document.getElementsByClassName("amount").length;
    let amounts=[];
for(let i=0; i<count; i++){
      amounts[i]=document.querySelectorAll(".amount")[i].value;
      
    }

    //CALCULATE SUM PER ROW
    for (var r = 0; r < table.rows.length; r++) {
      table.rows[r].cells[4].innerHTML = Math.round(parseFloat(table.rows[r].cells[1].innerHTML)*parseInt(table.rows[r].cells[3].firstChild.value)*100)/100;
  }


  //CALCULATE SUM TOTAL:
  let sumTotal=0;
  for (var r = 0; r < table.rows.length; r++) {
    sumTotal += parseFloat(table.rows[r].cells[4].innerHTML);
}

document.getElementById("total").innerHTML=sumTotal.toFixed(2);

 
    console.log(amounts);

    updateLocalStorage(amounts);
    updateCounter();
 
  }
  

function updateLocalStorage(amounts) {
     //count in local storage anpassen nach Änderung bei Menge im Warenkorb
      products=JSON.parse(localStorage.getItem("products"));

      for(let i=0; i<products.length; i++){
       if(products[i]["amount"]!=amounts[i]){
         products[i]["amount"]=amounts[i];
       }
     }
     // products.push({"product_id": item, "price": price, "product_description":product_description, "amount": amount});
    //  localStorage.setItem("products", JSON.stringify(products));
    localStorage.setItem("products", JSON.stringify(products));
    console.log(products);
}


function updateCounter() {
if(localStorage.getItem("products")){
    products=JSON.parse(localStorage.getItem("products"));
  let counter = 0;

for(let i=0; i<products.length; i++){
  counter += parseInt(products[i]["amount"]);
}
document.getElementById("counter").innerHTML = counter;
}
else {
  document.getElementById("items_table").innerHTML="Your cart is empty";
  document.getElementById("counter").innerHTML = 0;
}


//localStorage.setItem("products", JSON.stringify(products));
}



//REMOVE ITEM

$("#cart").on("click", ".remove", function(){
  console.log($(this).data("id"));
  let currentItem=$(this).data("id");

  products=JSON.parse(localStorage.getItem("products"));
  console.log(products);



  for(let i=0; i<products.length; i++){
    if(currentItem == products[i]["product_id"]){
     // products.splice(products[i], 1)
      products=products.filter((i)=>i.product_id !== currentItem);
    }
}
console.log(products);
localStorage.setItem("products", JSON.stringify(products));
renderCart();
console.log(products);
updateCounter();

})

});
