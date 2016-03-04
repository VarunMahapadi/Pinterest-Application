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
 			$pwd = $_SESSION["password"];
          	//echo $username;
            $fname = $_GET["firstname"];
            $lname = $_GET["lastname"];
            $dob = $_GET["dob"];
          

            if(isset($_GET["Edit"]))
            {
            	$query = "update user set fname=?, lname=?, password=?, dob=? where uid=?";
            	if($res=$con->prepare($query))
                {
                	$res->bind_param("sssss",$fname,$lname,$pwd, $dob,$username);
                    $res->execute();
                }

                else
                	echo $con->error;
            }

            
?>
    
<html>
<style>
body{
    background-image: url("tri.jpg");
    t
}
div.img {
                    
    margin: 100px;
    padding: 100px;
    border: 25px solid gray;
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
</style>

<body>
    
    <div class="img"><form action="profile.php" method="get">
    	First Name: <input type="text" name="firstname" value="<?php echo $fname;?>">
    	<br><br>
    	Last Name: <input type="text" name="lastname" value="<?php echo $lname;?>">
    	<br><br>
    	Password: <input type="password" name="password" value="<?php echo $pwd;?>">
        <br><br>
        Date_Of_Birth: <input type="date" name="dob" value="<?php echo $dob;?>"> 
        <br><br>

    	<input type="submit" name = "Edit" value = "Edit Profile">
        
        </form></div>
    
</body>
</html>