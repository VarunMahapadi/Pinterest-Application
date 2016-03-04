<html>
<style>
body{
    background-image: url("tri.jpg");
}
h1   {text-align: center;
                color:white;
                font-family: Monotype Corsiva;
                font-size: 300%;
                font-style: bold;
                }
                
                h2   {text-align: center;
                color:white;
                font-family: Comic Sans MS;
                font-size: 100%;
                font-style: bold;
                }
                
                
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
</style>
<body></body>
</html>

<?php
     
    include "connect.php";

    if(isset($_GET["login"]))
        {
            $user = $_GET["login_username"];
            $password = $_GET["login_password"];
            $query = "select * from user where uid = ? and password = ?";
            if($res=$con->prepare($query))
                {
                    $res->bind_param("ss",$user,$password);
                    $res->execute();
                    $res->bind_result($uid,$pswd,$fname,$lname,$dob,$aboutme);
                    
                                  
                    $res->store_result();
                    $rows = $res->num_rows;
                    if($rows==0)
                        {
                            echo "<script type='text/javascript'>
                                alert('No such user password combination! Please check your credentials ');
                                window.location.href = 'login.html';
                                </script>";
                            exit();
                        }
                    else
                        {   
                            $res->fetch();
                            $res->close();
                            
                            ob_start();
                            session_start();
                            $_SESSION["user"]=$user;
                            $_SESSION["password"]=$password;                                                                                           
                        }
                }
        }

        

        else if(isset($_GET["signup"]))
        {
            $user = $_GET["username"];
            $pwd = $_GET["password"];
           
            $fname = $_GET["firstname"];
            $lname = $_GET["lastname"];
            $dob = $_GET["dob"];
             
            $query = "select * from user where uid = ?";
            if($res=$con->prepare($query))
                {
                    $res->bind_param("s",$user);
                    $res->execute();
                    $res->store_result();
                    $rows = $res->num_rows;
                    if($rows>0)
                        echo "<script type='text/javascript'>
                                alert('Username already exists!');
                                window.location.href = 'login.html';
                                </script>";
                    else
                        {   
                            $res->close();
                            $query = "call signup(?,?,?,?,?);";
                                if($stmt=$con->prepare($query))
                                    {
                                        $stmt->bind_param("sssss",$user,$pwd,$fname,$lname,$dob);
                                        $stmt->execute();

                                        $stmt->close();
                                }
                        }
                }
        }

        echo  "<form action='home.php' method='get'>
        <input type='hidden' name='login_password' value=$password>
        <input type='hidden' name='login_username' value=$user>
        <input type='submit' name='login' value='Home'>
             </form>";

         echo "<h1>Hello $fname $lname</h1>";
                             echo "<table align='center'>
                            <tr>
                                <form action='profile.php'>
                                    <td><input type='submit' name='profile' value='My Profile'></td> 
                                    <input type='hidden' name='firstname' value=$fname></td>
                                    <input type='hidden' name='lastname' value=$lname></td>
                                    <input type='hidden' name='dob' value=$dob></td>
                                </form>
                                <form action='boards.php'>
                                    <td><input type='submit' name='boards' value='My PinBoards'></td>
                                 </form>
                                 <form action='followedboards.php'>
                                    <td><input type='submit' name='followboards' value='Followed Boards'></td>
                                 </form>
                                  <form action='fstream.php'>
                                   <td><input type='submit' name='followstream' value='Follow Streams'></td>
                                </form>
                                <form action='friends.php'>
                                   <td><input type='submit' name='friends' value='Followers'></td>
                                </form>
                                <form action='followings.php'>
                                   <td><input type='submit' name='following' value='Followings'></td>
                                </form>
                                <form action='logout.php'>
                                    <td><input type='submit' name='logout' value='Logout'></td>
                                </form>
                                <h2 align='center'><form action='search.php' method='get'>
                                    <input type='text' name='key'><br>
                                    <input type='radio' name='category' value='user'>User
                                    <input type='radio' name='category' value='boards'>Board
                                    <input type='submit' name='search' value='Search'>
                                    </form></h2><br>
                            </tr>
                            </table>";
                         

        $query = "select pid,pname,ptype,pdetails,purl from picture";
         if($res=$con->prepare($query))
                {                      
                    $res->execute();
                    $res->bind_result($picid,$picname,$pictype,$picdetails,$picurl);
                    while($res->fetch())
                    {   
                        echo " <div class='img'>
                        <form action='image.php' method='get'>
                        <img src=$picurl alt='Error' style='width:304px;height:228px'>
                        <input type='hidden' name='picid' value=$picid>
                        <input type='hidden' name='picname' value=$picname>
                        <input type='hidden' name='picurl' value=$picurl>
                        <input type='hidden' name='picdetails' value=$picdetails>
                        <input type ='submit' name='view' value='View'>
                        </form></div>";
                    }
                }
?>


