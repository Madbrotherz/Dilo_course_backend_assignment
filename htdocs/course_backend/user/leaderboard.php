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

   $userdata = $db->get("SELECT user_tbl.nik as nik, user_tbl.nama_depan as nama_depan, user_tbl.nama_belakang as nama_belakang,

                       user_tbl.alamat as alamat, user_tbl.kode_pos as kode_pos, kota_tbl.nama_kota as nama_kota,

                       provinsi_tbl.nama_provinsi as nama_provinsi

                       from user_tbl,kota_tbl, provinsi_tbl WHERE user_tbl.nik = '".$nik."' AND

                       user_tbl.kota_id = kota_tbl.kota_id AND kota_tbl.provinsi_id = provinsi_tbl.provinsi_id");               

   $userdata = mysqli_fetch_assoc($userdata);  

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

PAGE : LEADERBOARD

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/course_backend/user/">HOME</a></td>

       <td><a href="http://localhost/course_backend/user/statistik.php">STATISTIK</a></td>       

       <td><a href="http://localhost/course_backend/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/course_backend/user/logout.php">LOGOUT</a></td>

   </tr>

</table>

<br>

<form action="http://localhost/course_backend/user/leaderboard.php" method='GET'>

       Pilih Game

       <select name="gameid">

           <?php

           $gamedata = $db->get("SELECT game_id,nama FROM game_tbl WHERE status=1");                                

           while($row = mysqli_fetch_assoc($gamedata))

           {

               ?>

               <option value="<?php echo $row['game_id']?>"><?php echo $row['nama']?></option>

               <?php

           }

           ?>

       </select>

       <input type="submit" value="Tampilkan Leaderboard">

</form>

<?php

if(isset($_GET['gameid']))

{

   echo "LEADERBOARD GAME ID :".$_GET['gameid'];

   ?>

   <table border=1>

   <tr><td>NO</td><td>NAMA</td><td>SCORE</td></tr>

   <?php

   $leaderboarddata = $db->get("SELECT user_tbl.nama_depan as nama_depan, user_tbl.nama_belakang as nama_belakang, max(user_game_data_tbl.score) as score FROM user_tbl, user_game_data_tbl WHERE user_tbl.nik = user_game_data_tbl.nik AND user_game_data_tbl.game_id = ".$_GET['gameid']." GROUP BY user_tbl.nik ORDER BY score DESC");

   $no = 0;

   while($row = mysqli_fetch_assoc($leaderboarddata))

   {

       $no++;

       ?>

       <tr>

       <td><?php echo $no?></td>

       <td><?php echo $row['nama_depan']." ".$row['nama_belakang']?></td>

       <td><?php echo $row['score']?></td>               

       </tr>

       <?php

   }

   ?>

   </table>

   <?php

}

?>