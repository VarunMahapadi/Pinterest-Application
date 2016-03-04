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

		$username=$_SESSION["user"];
		$key=$_GET["key"];
		$choice=$_GET["category"];

        if(isset($_GET["followboard"]))
        {
            $followboardid = $_GET["boardid"];
            $query2="insert into follow values(?,?)";
            if($res=$con->prepare($query2))
                {
                    $res->bind_param("si",$username,$followboardid);
                    $res->execute();
                    $res->close(); 
                }
                else
                    echo $con->error;
        }

        if(isset($_GET["follow"]))
        {
            $followed = $_GET["uid"];
            $query1="insert into friends values(?,?)";
            if($res=$con->prepare($query1))
                {
                    $res->bind_param("ss",$followed,$username);
                    $res->execute(); 
                    $res->close();
                }
        }

        
        $query4="select bid from follow where uid=? and bid=?";
        if($res=$con->prepare($query4))
                {
                    $res->bind_param("si",$user10,$bid);
                    $res->execute();
                    $res->bind_result($bid); 
                    $res->store_result();
                    $rows = $res->num_rows;
                    if($rows==0)
                        $flag=1;
                    else
                        $flag=0;
                    $res->close();
                }

		if($choice=='user')
		{
			$query="select * from user where fname=? or lname=? or uid=?";
			if($res=$con->prepare($query))
                {
                    $res->bind_param("sss",$key,$key,$key);
                    $res->execute();
                    $res->bind_result($uid,$pswd,$fname,$lname,$dob,$aboutme);
                      while($res->fetch())
                    {
                    	echo "<div class='img'><form action = 'other_profile.php' method='get'>
                        <h3> $fname $lname</h3><br>
                        <input type='hidden' name='uid' value=$uid>
                        <input type='submit' name='view' value='View'>
                        </form>";

                        echo "<form action = 'search.php' method='get'>
                        <input type='hidden' name='uid' value=$uid>
                        <input type='hidden' name='key' value=$key>
                        <input type='hidden' name='category' value=$choice>";
                        if($flag)
                        {
                            echo "<input type='submit' name='follow' value='Follow'>";
                        }
                        
                        echo "</form></div>";

                    	//"<form action = '' method='get'> 
                    	
                    	/*<h4>Details: $bdetails</h4>
                    	<input type='hidden' name='boardid' value=$bid>
                    	<input type='submit' name='view' value='view'>
                    	</form>";*/
                    }
                    $res->close();
				}
		}

		else if($choice=='boards')
		{	
			$query="select * from board where bname=? or btype=? or bdetails=?";
			if($res=$con->prepare($query))
                {
                    $res->bind_param("sss",$key,$key,$key);
                    $res->execute();
                    $res->bind_result($bid,$bname,$btype,$bdetails,$uid);
                      while($res->fetch())
                    {
                    	echo "<div class='img'><form action = 'pictures.php' method='get'> 
                    	<h3>Name: $bname</h3>
                    	<h4>Type: $btype</h4>
                    	<h4>Details: $bdetails</h4>
                    	<input type='hidden' name='boardid' value=$bid>
                    	<input type='submit' name='view' value='view'>
                        </form>";

                        if($flag){
                        echo "<form action = 'search.php' method='get'>
                        <input type='hidden' name='uid' value=$uid>
                        <input type='hidden' name='key' value=$key>
                        <input type='hidden' name='boardid' value=$bid>
                        <input type='hidden' name='category' value=$choice>
                        <input type='submit' name='followboard' value='Follow'>
                        </form></div>";
                        }
                }

		}
    }

		?>