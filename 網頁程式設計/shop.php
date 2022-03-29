<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>shop.php</title>
<?php
// 設定報告等級
error_reporting(E_ERROR | E_WARNING);
include "wfcart.php";  // 插入購物車的PHP類別檔
session_start();  // 啟用交談期
$cart =& $_SESSION['wfcart']; // 指向購物車物件
if( !is_object($cart) ) $cart = new wfCart();
$msg = "";
// 檢查是否是表單送回
if ( isset($_POST["Order"]) ) {      
   // 新增至購物車
   $id = $_POST["ID"];  // 取得表單欄位
   $name = $_POST["Name"];
   $type = $_POST["Type"];
   $start = $_POST["Start"];
   $end = $_POST["End"];
   $place = $_POST["Place"];
   $price = $_POST["Price"];//原本是cost
   $quantity = $_POST["Quantity"];
   if ( $quantity == "" ) $quantity = 1;
   $cart->add_item($id,$quantity,$price,$name,$type,$start,$end,$place);
   $msg = "<font color='red'>已將選購商品".$id;
   $msg .= "放入購物車!</font><br/>";
}
?>
</head>
<body bgcolor="#DDDDFF" text="#003C9D">
<center><table border="0">
<tr bgcolor="#FFC1E0">
   <td>編號</td><td>活動名稱</td><td>類型</td>
   <td>開始日期</td><td>結束日期</td>
   <td>地點</td><td>金額</td><td>數量</td><td>訂購</td>
</tr>
<?php
// 插入函式庫的PHP檔案
require_once("dataAccess.php");
// 建立dataAccess物件的資料庫連接
$dao = new dataAccess("localhost","root",
                      "fansfamily123","fans_ticket");
$sql = "SELECT * FROM events";  // 建立SQL指令字串
$dao->fetchDB($sql);  // 執行SQL查詢指令字串，獲取資料
$flag = false;
// 顯示資料庫內容
while ( $row = $dao->getRecord() ) {
   if ($flag) {
      $flag = false;
      $color="#C4E1FF";
   } else {
      $flag = true;
      $color="#C4E1FF";
   }
   // 顯示選購商品的表單
?>
<form action="shop.php" method="post">
   <input type="hidden" name="ID" 
          value="<?php echo $row["event_num"] ?>"/>
   <input type="hidden" name="Name" 
          value="<?php echo $row["event_name"] ?>"/>
   <input type="hidden" name="Type"
          value="<?php echo $row["type"]; ?>"/>
   <input type="hidden" name="Start"
          value="<?php echo $row["start_time"]; ?>"/>
   <input type="hidden" name="End"
          value="<?php echo $row["end_time"]; ?>"/>
   <input type="hidden" name="Place"
          value="<?php echo $row["place"]; ?>"/>
   <input type="hidden" name="Price"//cost先改成price不然易搞混
          value="<?php echo $row["cost"]; ?>"/>
<tr bgcolor="<?php echo $color ?>">
   <td><?php echo $row["event_num"] ?></td>
   <td><?php echo $row["event_name"] ?></td>
   <td><?php echo $row["type"] ?></td>
   <td><?php echo $row["start_time"] ?></td>
   <td><?php echo $row["end_time"] ?></td>
   <td><?php echo $row["place"] ?></td>
   <td><?php echo $row["cost"] ?></td>
   <td valign="top">
   <input type="text" size="5" name="Quantity" value="1"/>
   </td><td valign="top">
      <input type="submit" name="Order" value="訂購"/>
   </td>
</tr>
</form>
<?php
} ?>
</table><?php echo $msg ?>
<hr/> 
<a href="shop.php"><h3>購票頁面</h3></a>
<a href="shoppingcart.php"><h3>檢視購物車內容</h3></a> 
</center>
</body>
</html>