<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>shoppingcart.php</title>
</head>
<body bgcolor="#DDDDFF" text="#003C9D">
<center><table border="0">
<tr bgcolor="#FFC1E0">
   <td></td><td>編號</td><td>活動名稱</td>
   <td>類型</td><td>開始日期</td><td>結束日期</td>
   <td>地點</td><td>金額</td><td>數量</td><td>小計</td></tr>
<?php
// 設定
error_reporting(E_ERROR | E_WARNING);
include "wfcart.php"; // 插入購物車的PHP類別檔
session_start();  // 啟用交談期
$cart =& $_SESSION['wfcart']; // 指向購物車物件
if(!is_object($cart)) $cart = new wfCart(); 
$flag = false;
if($cart->itemcount > 0) { // 檢查購物車是否有商品
   // 顯示購物車的內容
   foreach($cart->get_contents() as $item) {
	    if ($flag) {   // 切換顯示色彩
         $flag = false;
         $color="#C4E1FF";
      } else {
         $flag = true;
         $color="#C4E1FF";
      }
	    echo "<tr bgcolor='".$color."'>";
	    echo "<td><a href='delete.php?Id=".$item['id']."'>";
        echo "刪除</a></td>";     
      // 顯示選購的商品資料
		echo "<td>".$item['id']."</td>";
		echo "<td>".$item['name']."</td>";//原本info
		echo "<td>".$item['type']."</td>";//多加的
		echo "<td>".$item['start']."</td>";
		echo "<td>".$item['end']."</td>";
		echo "<td>".$item['place']."</td>";
		echo "<td>".number_format($item['price'],2)."</td>";
		echo "<td>".$item['quantity']."</td>";
		echo "<td>".number_format($item['subtotal'],2)."</td>";
	 }
	 echo "<tr bgcolor=white><td colspan='10' align='right'>";
   echo "總金額 = NT$".number_format($cart->total,2)."元</td></tr>";	
} 
else {
	 echo "<font color='red'>目前購物車沒有選購商品！";
}
?>
</table>
<hr/>  
<a href="shop.php"><h3>購票頁面</hn></a>
<a href="shoppingcart.php"><h3>檢視購物車內容</h3></a> 
</center>
</body>
</html>