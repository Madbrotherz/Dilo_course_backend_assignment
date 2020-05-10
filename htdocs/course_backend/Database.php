<?php

// buat class database dan fungsinya agar dapat digunakan sebagai objek

class Database

{

   function execute($query) // fungsi execute digunakan untuk menjalankan query dan mengembalikan status berhasil atau gagal dari query tersebut (true/false)

   {

       include("database_connect.php");

       if (mysqli_query($conn, $query)) {

           mysqli_close($conn);       

           return true;

       }       

       mysqli_close($conn);       

       return false;

   }

   function get($query) // fungsi get digunakan untuk menjalankan query dan mengembalikan data dari query jika berhasil dan null jika gagal

   {

       include("database_connect.php");       

       $result = $conn->query($query);

       if ($result->num_rows > 0)

       {

           $conn->close();

           return $result;

       }

       $conn->close();

       return null;

   }

   function get_procedure_execute($procedure) // fungsi execute digunakan untuk menjalankan procedure dan mengembalikan status berhasil atau gagal dari query tersebut (true/false)

   {

       include("database_connect.php");

       return mysqli_query($conn,"CALL ".$procedure);

   }   

}

?>