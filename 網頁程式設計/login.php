<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>login.php</title>
</head>
<body>
<?php
$username="";
$password="";
$showform=true;
$username = $_POST["Username"];
$password = $_POST["Password"];
//檢查是否輸入使用者名稱密碼
if ($username != "" && $password != "") {
//建立My的資料庫連接
   $link = mysqli_connect("localhost", "root",
                  "fansfamily123", "fans_ticket")
        or die("無法開啟MySQL資料庫連接<br/>");
//送出UTF8編碼的MySQL指令
   mysqli_query($link, 'SET NAMES utf8') ;
//建立SQL指令字串
   $sql = "SELECT * FROM ft_member WHERE password='";
   $sql.= $password."' AND name='".$username."'";
//執行SQL查詢
   $result = mysqli_query($link, $sql);
   $total_records = mysqli_num_rows($result);
//是否有查詢到使用者記錄
   if ( $total_records > 0 ) {
//成功登入,指定 Session變數
      $_SESSION["login_session"] = true;
      header("Refresh:1;url=index.php");
      mysqli_close ($link);  //關閉資料庫連接
   } else { //登入失敗
      echo "<center><font color='red'>";
      echo "使用者名稱或密碼錯誤!<br/>";
      echo "</font>";
      $_SESSION["login_session"] = false;
   }
}

?>
</body>
</html>



