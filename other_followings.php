<html>
<head>
    <style>

                
                
                div.img {
                    
    margin: 10px;
    padding: 10px;
    border: 4px solid #0000ff;
    background-color: #69F0AE;
    height: auto;
    width: auto;
    float: left;
    text-align: center;
    
}   

div.img img {
    display: inline;
    margin: 10px;
    border: 4px solid #ffffff;
}
body
{
    background-image: url("tri.jpg");
}
</style>
<body></body>
</head>
</html>




<?php
	include "connect.php";
	ob_start();
    session_start(); 

    $user10=$_SESSION["user"];
    $password10=$_SESSION["password"];

     echo "<form action='home.php' method='get'>
        <input type='hidden' name='login_password' value=$password10>
        <input type='hidden' name='login_username' value=$user10>
        <input type='submit' name='login' value='Home'>
             </form>";

 			$username = $_GET["uid"];
 			$query = "select uid,fname,lname from user where uid in (select friends.uid1 from friends, user WHERE user.uid=friends.uid2 and uid=?)";


            	if($res=$con->prepare($query))
                {
                	$res->bind_param("s", $username);
                    $res->execute();
                    $res->bind_result($uid,$fname,$lname);
                    
                    while($res->fetch())
                    {
                    	echo 
                    	"<div class='img'><form action = 'other_profile.php' method='get'> 
                        <h3> $fname $lname</h3>
                        <td><input type='hidden' name='uid' value=$uid></td>
                        <input type='submit' name='view' value='view'>
                        </form></div>";
                    }
                }
?>