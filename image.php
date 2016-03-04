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

     echo "<form action='home.php' method='get'>
        <input type='hidden' name='login_password' value=$password10>
        <input type='hidden' name='login_username' value=$user10>
        <input type='submit' name='login' value='Home'>
             </form>";

    $username = $_SESSION["user"];

    $picid = $_GET["picid"];
    $picurl = $_GET["picurl"];
    $picname = $_GET["picname"];
    //$picdetails = $_GET["picdetails"];
   
  /* if(isset($_GET["like"]))
   {
   	echo "I am set";
   } 
   else
   {
   	echo "I am not set";
   }*/

   if(isset($_GET["repinpicture"]))
    {
        $boardid=$_GET["boardid"];
        $pid=$_GET["picid"];
        $query1="insert into repin values(?,?,?);";
        if($res=$con->prepare($query1))
            {
                $res->bind_param("sii",$user10,$pid,$boardid);
                $res->execute();
            }
    }

   if(isset($_GET["like"]))
    {
    	$query1="call pinboard.like(?,?);";
    	if($res1=$con->prepare($query1))
                {
                    
                    $res1->bind_param("ss",$username,$picid);
                    $res1->execute();
                }
    }

    $query3 = "select pname, pdetails from picture where pid = ?";
    if($res=$con->prepare($query3))
                {   
                    $res->bind_param("i",$picid);
                    $res->bind_result($picname,$picdetails);
                    $res->execute();
                    $res->fetch();
                    $res->close();
                }

    $query2 = "select count(*) as count from user_like where pid = ?";
    if($res=$con->prepare($query2))
                {	

                	$res->bind_param("s",$picid);
                    $res->bind_result($count);
                    $res->execute();
                    
                    while($res->fetch())
                    {
                    echo "<div class = 'img'><form action='image.php' method='get'>
 		                    <h2>$picname</h2>
        	            	<img src=$picurl alt='Error' style='width:720px;height:480px'>
                    		<h2>Details: $picdetails</h2>
                    		<h2>$count Likes</h2> 
                    		<input type='submit' name='like' value='Like'>
                    		<input type='hidden' name='picid' value=$picid>
                        	<input type='hidden' name='picname' value=$picname>
                        	<input type='hidden' name='picurl' value=$picurl>
                        	<input type='hidden' name='picdetails' value=$picdetails>
                            </form>";
                        }
                }
                else
                	echo "TESTING else";

                echo "<form action='pin.php' method='get'>
                <input type='submit' name='pin' value='Pin it!'>
                <input type='hidden' name='picid' value=$picid>
                <input type='hidden' name='picname' value=$picname>
                <input type='hidden' name='picurl' value=$picurl>
                <input type='hidden' name='picdetails' value=$picdetails>
                </form>";

    if(isset($_GET["commentsubmit"]))
    {
    	$comment = $_GET["comment"];
    	$query3="call comments(?,?,?);";
    	if($res2=$con->prepare($query3))
                {	
                	$res2->bind_param("sss",$username,$picid,$comment);
                    $res2->execute();
                }
    }

    $query="select uid, comment, cdate from user_comment where pid = ?";
     if($res3=$con->prepare($query))
                {
                	$res3->bind_param("s",$picid);
                    $res3->execute();
                    $res3->bind_result($picuser,$piccomment,$picdate);
                    while($res3->fetch())
                    {
                    	echo "<h2>$picuser:: $piccomment:: $picdate</h2>";
                    			                    	
                    }	
                    echo "<form action='image.php' method='get'>
                    	<br><br><input type='text' name='comment'>
                    	<input type='submit' name='commentsubmit'>
                    	<input type='hidden' name='picid' value=$picid>
                    	<input type='hidden' name='picname' value=$picname>
                        <input type='hidden' name='picurl' value=$picurl>
                        <input type='hidden' name='picdetails' value=$picdetails>
                    	</form></div>";
                }
                else
                {
                	echo $con->error;
                }
?>