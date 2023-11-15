<?php

$_db = "db_bencana_alam";

$db_utama = mysqli_connect("localhost", "root", "root", $_db);
if (!$db_utama) die("Gagal terkoneksi ke DB Utama. Error : " . mysqli_connect_error());

?>
