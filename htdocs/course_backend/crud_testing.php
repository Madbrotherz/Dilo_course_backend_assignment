<?php

include("database.php"); // sertakan database.php untuk dapat menggunakan class database

echo "CRUD TESTING<br>";

$test = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

 

//$test->execute("DELETE FROM game_tbl WHERE status = 0");

$getdata = $test->get_procedure_execute("GET_GAME_DATA_BY_STATUS(1)");

while($row = mysqli_fetch_assoc($getdata)) {

   echo "game_ID: " . $row["game_id"]. " - Nama: " . $row["nama"]. " - Tipe_Leaderboard: " . $row["tipe_leaderboard"]. " - ". $row["status"]."<br>";

}

?>