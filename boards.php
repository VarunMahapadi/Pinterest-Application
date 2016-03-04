<html>
<style>
body{
    background-image: url("tri.jpg");
}

                
                h2   {text-align: center;
                color:black;
                font-family: Comic Sans MS;
                font-size: 100%;
                
                }
                
                
                div.img {
                    
    margin: 15px;
    padding: 15px;
    border: 5px solid yellow;
    background-color: #69F0AE;
    height: 200px;
    width: 200px;
    float: left;
    text-align: center;
    
}   

div.img img {
    display: inline;
    margin: 15px;
    border: 5px solid #ffffff;
}
</style>
<body></body>
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


		$username=$_SESSION["user"];
 
 				$query = "select bid,bname,btype,bdetails from board where uid = ?";
				if($res=$con->prepare($query))
                {
                    $res->bind_param("s",$username);
                    $res->execute();
                    $res->bind_result($bid,$bname,$btype,$bdetails);
                    $res->store_result();
                    $rows = $res->num_rows;
                    echo "<form action='add_board.php'>
                    		<input type='submit' name='new' Value='New'>
                    		</form>";
                    while($res->fetch())
                    {
                    	echo "<div class='img'> <form action = 'pictures.php' method='get'> 
                    	<h2>Name: $bname</h2>
                    	<h2>Type: $btype</h2>
                    	<h2>Details: $bdetails</h2>
                    	<input type='hidden' name='boardid' value=$bid>
                    	<input type='submit' name='view' value='view'>
                        </form></div>";                        
                    }
                }
                else{
                	$con->error;
                }   
	
?>	