<?php

SESSION_START();

include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$nik = (isset($_SESSION['nik'])) ? $_SESSION['nik'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $nik)

{

   $result = $db->execute("SELECT * FROM user_tbl WHERE nik = '".$nik."' AND token = '".$token."' AND status = 1 ");

   if(!$result)

   {

       // redirect ke halaman login, data tidak valid

       header("Location: http://localhost/course_backend/");

   }

   // abaikan jika token valid

   $statisticdata = $db->get("SELECT game_tbl.nama as game, MIN(user_game_data_tbl.score) as min, MAX(user_game_data_tbl.score) as max,

                               AVG(user_game_data_tbl.score) as avg FROM user_game_data_tbl, game_tbl

                               WHERE user_game_data_tbl.game_id = game_tbl.game_id AND user_game_data_tbl.nik = '".$nik."' group by user_game_data_tbl.game_id");               

       

 

}

else

{

   header("Location: http://localhost/course_backend/");

}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);   

}

?>

PAGE : STATISTIK

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/course_backend/user/">HOME</a></td>

       <td><a href="http://localhost/course_backend/user/statistik.php">STATISTIK</a></td>       

       <td><a href="http://localhost/course_backend/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/course_backend/user/logout.php">LOGOUT</a></td>

   </tr>

</table>

<table border=1>

   <tr><td align="center" colspan=4>USER STATISTIK SKOR GAME</td></tr>

   <tr><td>GAME</td><td>MIN</td><td>MAX</td><td>AVG</td></tr>

   <?php

       while($row = mysqli_fetch_assoc($statisticdata))

       {

           ?>

           <tr>

               <td><?php echo $row['game']?></td>

               <td><?php echo $row['min']?></td>

               <td><?php echo $row['min']?></td>

               <td><?php echo $row['min']?></td>               

           </tr>

           <?php

       }

   ?>

</table>

