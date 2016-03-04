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

    $boardid = $_GET["boardid"];

    $query4="select uid from board where bid=?";
                        if($res=$con->prepare($query4))
                        {   
                            $res->bind_param("i",$boardid);
                            $res->execute();
                            $res->bind_result($uid);
                            $res->fetch();
                            $boarduser=$uid;
                            $res->close();
                        }
                        else
                        {
                            echo $con->error;
                        }
            
    if(isset($_GET["delete"]))
            {   
                $pid=$_GET["picid"];

                $query8="select pid from repin where pid=? and bid=?";

                if($res=$con->prepare($query8))
                     {      
                        $res->bind_param("ii",$pid,$boardid);
                         $res->execute();
                         $res->bind_result($repinpicid);
                         $res->store_result();
                         $rows = $res->num_rows;
                         $res->close();
                                                 
                    }

                if($rows!=0)
                        {
                            $query5="delete from repin where pid=? and bid=?";
                            if($res=$con->prepare($query5))
                             {      
                                 $res->bind_param("ii",$pid,$boardid);
                                 $res->execute();
                                 $res->close(); 
                             }
                        }

               /* $query5="delete from repin where pid=? and bid=?";
                    if($res=$con->prepare($query5))
                     {      
                        $res->bind_param("ii",$pid,$boardid);
                         $res->execute();
                         $res->close();
                    }*/

                else{
                $query7="delete from user_like where pid=?";
                    if($res=$con->prepare($query7))
                     {      
                        $res->bind_param("i",$pid);
                         $res->execute();
                         $res->close();
                    }
                

                $query6="delete from user_comment where pid=?";
                    if($res=$con->prepare($query6))
                     {      
                        $res->bind_param("i",$pid);
                         $res->execute();
                         $res->close();
                    }


                 $query5="delete from repin where pid=? and bid=?";
                    if($res=$con->prepare($query5))
                     {      
                        $res->bind_param("ii",$pid,$boardid);
                         $res->execute();
                         $res->close();
                    }

                 $query3="delete from picture where pid=? and bid=?";
                    if($res=$con->prepare($query3))
                     {   
                         $res->bind_param("ii",$pid,$boardid);
                         $res->execute();
                         $res->close();
                    }
             }
         }
     

    $query = "select picture.pid, pname, ptype, pdetails, purl, count(user_like.uid) as count from picture left outer join user_like on picture.pid = user_like.pid WHERE picture.bid = ?
    GROUP by picture.pid, pname, ptype, pdetails, purl
UNION
select t.pid, pname, ptype, pdetails, purl, count(user_like.uid) as count
from (select picture.pid,pname, ptype, pdetails, purl from picture left outer join repin on picture.pid=repin.pid where repin.bid=?)t, user_like where t.pid=user_like.pid group by pname, ptype, pdetails, purl";
    
    if($res=$con->prepare($query))
                {
                    $res->bind_param("ii",$boardid,$boardid);
                    $res->execute();
                    $res->bind_result($picid,$picname,$pictype,$picdetails,$picurl,$count);
                    while($res->fetch())
                    {
                    	echo "<div class='img'><form action = 'image.php' method='get'> 
                    	<h2>Name: $picname</h2>
                    	<img src=$picurl alt='Error' style='width:304px;height:228px'>
                    	<h2>Details: $picdetails</h2>
                    	<h2>$count Likes</h2> 
                    	<input type='hidden' name='picid' value=$picid>
                        <input type='hidden' name='picname' value=$picname>
                        <input type='hidden' name='picurl' value=$picurl>
                        <input type='submit' name='view' value='view'>
                        </form>";

                        /*$query4="select uid from board where bid=?";
                        if($res=$con->prepare($query4))
                        {   
                            $res->bind_param("i",$boardid);
                            $res->execute();
                            $res->bind_result($uid);
                            $res->fetch();
                            $boarduser=$uid;
                        }
                        else
                        {
                            echo $con->error;
                        }

                        if(isset($_GET["delete"]))
                        {
                            $query3="delete from picture where pid=? and bid=?";
                            if($res=$con->prepare($query3))
                            {   
                                $res->bind_param("ii",$pid,$boardid);
                                $res->execute();
                            }
                        }
                        */
                        if($boarduser==$username)
                        {
                        echo "<form action = 'pictures.php' method='get'>
                            <input type='hidden' name='picid' value=$picid> 
                            <input type='hidden' name='boardid' value=$boardid> 
                            <input type='submit' name='delete' value='Delete'><br>
                        </form></div>";
                        }
                    }
                }
                else
                {
                    echo $con->error;
                }

    

                if($boarduser==$username)
                {
                echo "<br><form action = 'add_picture.php' method='get'>
                    <input type='hidden' name='boardid' value=$boardid> 
                    <input type='submit' name='new' value='Add a photo'>
                </form>";
                }
?>
