<html>
<head>
    <style>

                
                
               div.img {
                    
    margin: 100px;
    padding: 100px;
    border: 25px solid orange;
    background-color: #69F0AE;
    height: auto;
    width: auto;
    float: center;
    text-align: center;

    
}   

div.img img {
    display: inline;
    margin: 100px;
    border: 25px solid #ffffff;
}
body
{
    background-image: url("tri.jpg");
}
</style>
</head>




<?php
	include"connect.php";
     ob_start();
    session_start(); 
    
	$uid = $_GET["uid"];
	
   $user10=$_SESSION["user"];
    $password10=$_SESSION["password"];

     echo "<form action='home.php' method='get'>
        <input type='hidden' name='login_password' value=$password10>
        <input type='hidden' name='login_username' value=$user10>
        <input type='submit' name='login' value='Home'>
             </form>";

	$query = "select * from user where uid = ?";
            if($res=$con->prepare($query))
                {
                    $res->bind_param("s",$uid);
                    $res->execute();
                    $res->bind_result($user,$pwd,$fname,$lname,$dob,$aboutme);
                    $res->store_result();
                    $res->fetch();
                }
echo "<form action='search.php' method='get'>
                                    <input type='text' name='key'><br>
                                    <input type='radio' name='category' value='user'>User
                                    <input type='radio' name='category' value='boards'>Board
                                    <input type='submit' name='search' value='Search'>
                                    </form>";
    
    echo "<div class='img'><h1>$fname $lname</h1>";
                            echo "<table align='center'>
                            <tr>
                                <form action='other_boards.php'>
                                	<td><input type='hidden' name='uid' value=$uid></td>
                                    <td><input type='submit' name='boards' value='PinBoards'></td>
                                 </form>
                                <form action='other_friends.php'>
                                	<td><input type='hidden' name='uid' value=$uid></td>
                                   <td><input type='submit' name='friends' value='Followers'></td>
                                </form>
                                <form action='other_followings.php'>
                                	<td><input type='hidden' name='uid' value=$uid></td>
                                   <td><input type='submit' name='following' value='Followings'></td>
                                </form>
                                
                            </tr>
                            </table>
                        <form>
                        Date of birth: $dob<br>
                        Contact id: $user <br>
                        About me: $aboutme <br>
                        </form>
                         </div>   ";
?>

<body>

    <?php          
            ?>

</body>
</html>