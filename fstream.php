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
	include"connect.php";
     ob_start();
    session_start(); 

     $user10=$_SESSION["user"];
    $password10=$_SESSION["password"];

     echo "<form action='home.php' method='get'>
        <input type='hidden' name='login_password' value=$password10>
        <input type='hidden' name='login_username' value=$user10>
        <input type='submit' name='login' value='Home'>
             </form>";

     $query="select * from followstream where uid=?";
     if ($res=$con->prepare($query))
     {
     	$res->bind_param("s",$user10);
                    $res->execute();
                    $res->bind_result($fsid, $fsname, $fsuserid, $fstype);
                    $res->store_result();
     }

     while($res->fetch())
                    {
                    	echo "<div class='img'><form action = 'viewstream.php' method='get'> 
                    	<h3>Name: $fsname</h3>
                    	<input type='hidden' name='fsname' value=$fsname>
                        <input type='hidden' name='fstype' value=$fstype>
                        <input type='hidden' name='fsid' value=$fsid>
                        <input type='hidden' name='fsuserid' value=$fsuserid>
                    	<h4>Type: $fstype</h4>
                    	<input type='submit' name='viewfs' value='View'>
                    	</form></div>";
                        	}

     ?>