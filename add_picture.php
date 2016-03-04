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
    
    if(isset($_GET["pin"]))
    {
    	$bid=$_GET["currentboardid"];

    	$pname=$_GET["picname"];
    	$ptype=$_GET["pictype"];
    	$pdetails=$_GET["picdetails"];
  		$purl=$_GET["img"];
      $query="call pinpicture(?,?,?,?,?)";
  		if($res=$con->prepare($query))
                {
                    $res->bind_param("ssssi",$pname,$ptype,$pdetails,$purl,$bid);
                    $res->execute();                   
                }
                else $con->error;
     }
   
?>
<html>
<body>
	<?php
	 $boardid=$_GET["boardid"];
	?>
	<form action="add_picture.php" method="get">    	
  		<br>Name:
 		<input type="text" name="picname">
 		<br>Type:
 		<input type="text" name="pictype">
    <input type='hidden' name='currentboardid' value="<?php echo $boardid;?>">
 		<br>Details:
    <input type="text" name="picdetails">
 		<input type='hidden' name='boardid' value="<?php echo $boardid;?>">
 		<br>Select a file: <input type="file" name="img">
 		<input type="submit" name="pin">
 	</form>
  <form action="pictures.php" method="get">
    <input type="submit" name="submit" value="My Pictures">
    <input type='hidden' name='boardid' value="<?php echo $boardid;?>">
  </form>
 </body>
 </html>