<html>
<head>
    <style>

                
                
                div.img {
                    
    margin: 10px;
    padding: 10px;
    border: 4px solid yellow;
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
		$username=$_GET["uid"];
 
 				$query = "select bid,bname,btype,bdetails from board where uid = ?";
				if($res=$con->prepare($query))
                {
                    $res->bind_param("s",$username);
                    $res->execute();
                    $res->bind_result($bid,$bname,$btype,$bdetails);
                    $res->store_result();
                    $rows = $res->num_rows;
                    while($res->fetch())
                    {
                    	echo "<div class='img'><form action = 'pictures.php' method='get'> 
                    	<h3>Name: $bname</h3>
                    	<h4>Type: $btype</h4>
                    	<h4>Details: $bdetails</h4>
                    	<input type='hidden' name='boardid' value=$bid>
                    	<input type='submit' name='view' value='view'>
                        </form></div>";                        
                    }
                }
                else{
                	$con->error;
                }   
	
?>	