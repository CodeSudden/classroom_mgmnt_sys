<?php
$txt1 = "Login Success";
$txt2 = "Incorrect username or password";
$uname = $_POST['uname'];
$password = $_POST['password'];
session_start();
$con=mysqli_connect("localhost", "root", "","schoolms");
$result = mysqli_query($con,"SELECT * FROM `adminlogin` WHERE `uname`= '$uname' && `password` = '$password' ");
$count = mysqli_num_rows($result);
if($count==1)
{
        print "<h1>" . $txt1 . "</h2>";
        $_SESSION['log']=1;
        header ("refresh:2;url=student.php");
}
else
{
        print "<h1>" . $txt2 . "</h2>";
        header("refresh:2;url=index.html");
}
?>
</body>
</html>