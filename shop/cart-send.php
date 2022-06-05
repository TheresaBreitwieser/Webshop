<?php

//var_dump($_POST);

$list = json_decode($_POST["webshop"]);

$result = '';

foreach($list as $myobject){
   // var_dump($myobject->product_id);
    $result .= '<tr>';
    foreach($myobject as $key => $value){
        if($key == "amount"){
            $result .='<td><input type"text" name="amount" class="amount" value='.$value.'></td>';
        }
   else $result .= '<td class="data">'.$value.'</td>';
   
}
 //$result .='<td><input type"text" name="amount" class="amount" value="1"></td>';
 $result .='<td>x</td>';
 $result .='<td><button type="button" class="remove" data-id="'.$myobject->product_id.'">Remove Item</button></td>';
$result .= '</tr>';
}

echo $result;
 
?>

