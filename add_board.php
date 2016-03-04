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

    if(isset($_GET["create"]))
    {
    	$name= $_GET["boardname"];
    	$type= $_GET["boardtype"];
    	$details= $_GET["boarddetails"];
    	$username = $_SESSION["user"];
    	$query = "call createboard(?,?,?,?)";
    		if($stmt=$con->prepare($query))
    		{
    			$stmt->bind_param("ssss",$name,$type,$details,$username);
                                        $stmt->execute();
                                        $stmt->close();
    		}
    	header('Location: '."boards.php");
    }
 ?>
 <html>
<style>
body{
    background-image: url("tri.jpg");
}

                
                div.img {
                    
    margin: 10px;
    padding: 10px;
    border: 4px solid #0000ff;
    background-color: #69F0AE;
    height: 300px;
    width: 300px;
    float: left;
    text-align: center;
    
}   

div.img img {
    display: inline;
    margin: 10px;
    border: 4px solid #ffffff;
}
</style>

 <body>
 	<div class="img"><form action="add_board.php">
 		<br><br>Name:<br>
 		<input type="text" name="boardname">
 		<br><br>Type:<br>
 		<input type="text" name="boardtype">
 		<br><br>Details:<br>
 		<input type="text" name="boarddetails">
 		<br><br>
 		<input type="submit" name="create" value="Create a board">
 	</form> </div>
 </body>
 </html>