<?php

$servername = "localhost";  // server yang kita gunakan adalah localhost

$username = "root";         // username default adalah root, gunakan user lain yang anda setting jika ada

$password = "";             // password default adalah kosong, gunakan password yang anda setting jika ada

$dbname = "course_backend_db"; // kita terhubung pada basis data yang sudah kita buat sebelumnya yaitu course_backend_db

 

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if (!$conn) {

   die("Connection failed: " . mysqli_connect_error()); // jika gagal, maka akan koneksi akan dihentikan

}

?>