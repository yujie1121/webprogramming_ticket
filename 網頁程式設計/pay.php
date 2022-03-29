<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>pay.php</title>
</head>
<body bgcolor="#DDDDFF" text="#003C9D">
<center>
<?php
$name="";
$phone="";
$email="";
$sug="";
$showform=true;
$name = $_POST["User"];
$phone = $_POST["Phone"];
$email = $_POST["Email"];
$sug = $_POST["Suggestion"];
$det = 00;

if (isset($_POST["User"])){
   if (empty ($name)){
      echo "姓名欄位空白<br/><br/>";
      $det = 01;
   }else{
      echo "Name:".$name."<br/><br/>";
   }
   if (empty ($phone)){
      echo "電話欄位空白<br/><br/>";
      $det = 01;
   }else{
      echo "Phone:".$phone."<br/><br/>";
   }
   if (empty ($email)){
      echo "信箱欄位空白<br/><br/>";
      $det = 01;
   }else{
      echo "Email:".$email."<br/><br/>";
   }
   if (empty ($sug)){
      echo "意見欄位空白<br/><br/>";
      $det = 01;
   }else{
      echo "Suggestion:".$sug."<br/><br/>";
   }
}
if ($det == 01){
      echo '<font color="red">表單填寫不完整，無法送出！<br/>';
      echo '<a href="suggestion.html">重新填寫</a>';
} else {
      echo '<font color="red"><h3>成功送出！</h3><br/>';
      echo '<font color="red"><h3>請在24小時內完成付款，來電與專員確認!</h3><br/>';
      echo '<h3>謝謝您光臨，歡迎下次再為您服務！</h3><br/>';
      echo '<a href="event1.php">回到首頁</a>';
}
?>
</center>
</body>
</html>



