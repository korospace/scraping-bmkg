<?php

$_db = "db_databmkg";

$db_utama = mysqli_connect("localhost", "root", "", $_db);
if (!$db_utama) die("Gagal terkoneksi ke DB Utama. Error : " . mysqli_connect_error());

?>
