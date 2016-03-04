<html>
<style>
body{
    background-image: url("tri.jpg");
}

                
                h2   {text-align: center;
                color:black;
                font-family: Comic Sans MS;
                font-size: 100%;
                font-style: bold;
                }
                
                
                div.img {
                    
    margin: 10px;
    padding: 10px;
    border: 4px solid blue;
    background-color: #69F0AE;
    height: auto;
    width: auto;
    float: center;
    text-align: center;
    
}   

div.img img {
    display: inline;
    margin: 10px;
    border: 4px solid #ffffff;
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

    $picid = $_GET["picid"];
    $picurl = $_GET["picurl"];
    $picname = $_GET["picname"];
    
    echo "<form action='home.php' method='get'>
        <input type='hidden' name='login_password' value=$password10>
        <input type='hidden' name='login_username' value=$user10>
        <input type='submit' name='login' value='Home'>
             </form>";

    $query="select bid,bname from board where uid = ?";
     if($res=$con->prepare($query))
                {	
                	$res->bind_param("s",$user10);
                	$res->bind_result($boardid,$boardname);
                    $res->execute();
                }
                    
    $picid = $_GET["picid"];

    echo "<div class='img'><form action=image.php method='get'>";
    echo "Select a Board<br><br>
    <table align='left'>";
    while($res->fetch())
    {
    	echo "
    		<tr><input type='radio' name='boardid' value='$boardid'>$boardname<br></tr>
    		";
    }
    	
    echo "</table><input type='hidden' name='picid' value='$picid'><br>
		    <input type='hidden' name='picid' value=$picid>
		    <input type='hidden' name='picname' value=$picname>
            <input type='hidden' name='picurl' value=$picurl>
    <input type='submit' name='repinpicture' value='Done'>
    	</form></div>";

?>