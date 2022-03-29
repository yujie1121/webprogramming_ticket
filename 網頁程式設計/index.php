<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>index.php</title>
</head>
<body bgcolor="#DDDDFF" text="#003C9D">
<?php
session_start();
$_SESSION["login_session"] =false;
echo "<center>";
echo "<table width='600' height='400' border='0'>";
echo "<tr><td align='center' valign='center'>";
echo "<h1><b><i>Welcome to FANS Ticket！</i></b></h1>";
echo "<h1><b><i>歡迎使用者！</i></b></h1>";
echo "</td></tr>";
echo "</table>";
echo "</center><br/>";
header('Refresh:1;url=end.php');
session_destroy();
?>
</body>
</html>



