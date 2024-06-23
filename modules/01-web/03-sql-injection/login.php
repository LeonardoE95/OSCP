<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["name"]) && isset($_POST["password"])) {
        $name = $_POST["name"];
        $password = $_POST["password"];
        $p_hash = hash('sha256', $password);

        $sql = "SELECT name FROM users WHERE name='$name' AND password='$p_hash'";

        $result = $db->query($sql);
        $array = $result->fetchArray(SQLITE3_ASSOC);
        if ($array) {
            $count = count($array);
            if ($count == 1) {
		$_SESSION["username"] = $name;
                header("location: list.php");
            } else {
                $error = "Your Login Name or Password is invalid";
            }
        } else {
            $error = "Your Login Name or Password is invalid";
        }

        // echo $count;
        //  while($row = $result->fetchArray(SQLITE3_ASSOC) ){
        //     $username=$row["name"];
        //     echo $username;
        // }
    }
}

// ------------------------------------------------------

?>

<html>
   
   <head>
      <title>Students Archive Login</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; margin-top: 50px;" >
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b> Students Archive Login</b></div>
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <label>name</label> <br/> <input type = "text" name = "name" class="box"/><br /><br />
                  <label>password</label><input type = "password" name = "password" class="box" /><br/><br />
                  <input type = "submit" value = "login "/><br />
               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            </div>
         </div>
      </div>

   </body>
</html>
