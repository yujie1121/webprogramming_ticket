<?php
$id = $_GET["Id"];  // 取得URL參數
// 設定報告等級
error_reporting(E_ERROR | E_WARNING);
include "wfcart.php"; // 插入購物車的PHP類別檔
session_start();  // 啟用交談期
$cart =& $_SESSION['wfcart']; // 指向購物車物件
if(!is_object($cart)) $cart = new wfCart(); 
$cart->del_item($id);  // 刪除商品
header("Refresh:1;url=shoppingcart.php");  // 轉址
?>