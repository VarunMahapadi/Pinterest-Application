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
    border: 5px solid green;
    background-color: #69F0AE;
    height: auto;
    width: auto;
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

    $fsid=$_GET["fsid"];
    $fsname=$_GET["fsname"];
    $fstype=$_GET["fstype"];
    $fsuserid=$_GET["fsuserid"];

    $query="select picture.pid, pname, ptype, pdetails, purl from picture natural join follow where follow.uid=? and picture.ptype=?";
     if ($res=$con->prepare($query))
     {
        $res->bind_param("ss",$user10,$fstype);
                    $res->execute();
                    $res->bind_result($picid,$picname,$pictype,$picdetails,$picurl);
                    while($res->fetch())
                    {
                        echo "<div class='img'><form action = 'image.php' method='get'> 
                        <h2>Name: $picname</h2>
                        <img src=$picurl alt='Error' style='width:304px;height:228px'>
                        <h2>Details: $picdetails</h2>
                        <input type='hidden' name='picid' value=$picid>
                        <input type='hidden' name='picname' value=$picname>
                        <input type='hidden' name='picurl' value=$picurl>
                        <input type='submit' name='view' value='view'>
                        </form></div>";
                    }
     }