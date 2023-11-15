<?php

include "../config/db_utama.php";

$exe = $_REQUEST['exe'];

if (!empty($exe)) {
    $exe($db_utama);
}

// Scraping Gempa Terkini
// ----------------------
function scraping_gempaterkini($conn) {
    create_table_gempaterkini($conn);

    $link = "https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.xml";

    $xml  = @simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);

    if ($xml == false) {
        http_response_code(404);
        header("Content-type: application/json");
        echo json_encode([
            'message' => 'url tidak ditemukan'
        ]);
        die;
    }
    else {
        
        $counter    = 0;
        $xmlToJson  = json_encode($xml);
        $xmlToArray = json_decode($xmlToJson,TRUE);
        
        foreach ($xmlToArray['gempa'] as $row) {
            $DateTime       = date('Y-m-d H:i:s', strtotime($row['DateTime']));
            $Time           = explode(" ", $DateTime)[1];
            $Coordinates    = $row['point']['coordinates'];
            $Lintang        = $row['Lintang'];
            $Bujur          = $row['Bujur'];
            $Magnitude      = $row['Magnitude'];
            $Kedalaman      = $row['Kedalaman'];
            $Wilayah        = $row['Wilayah'];
            $Potensi        = $row['Potensi'];

            $selectQuery = "SELECT COUNT(*) FROM gempaterkini WHERE tanggal = '$DateTime' AND koordinat = '$Coordinates' AND lintang = '$Lintang' AND bujur = '$Bujur'";
            $selectQuery = mysqli_query($conn, $selectQuery);
            $rowCount    = mysqli_fetch_row($selectQuery);

            if ($rowCount[0] == 0) {
                $counter++;

                $insertQuery = "INSERT INTO gempaterkini (tanggal, jam, koordinat, lintang, bujur, kekuatan, kedalaman, wilayah, keterangan) 
                        VALUES ('$DateTime', '$Time','$Coordinates', '$Lintang', '$Bujur', $Magnitude, '$Kedalaman', '$Wilayah', '$Potensi')";
    
                if (mysqli_query($conn, $insertQuery) == false) 
                {
                    http_response_code(500);
                    header("Content-type: application/json");
                    echo json_encode([
                        'message' => 'gagal menyimpan salah satu data crawling!',
                        'debug'   => mysqli_error($conn)
                    ]);
                    die;
                } 
            }
        }

        http_response_code(200);
        header("Content-type: application/json");
        echo json_encode([
            'new_rows' => $counter,
            'message'  => "$counter baris berhasil ditambahkan!"
        ]);
        die;
    }
}

// Get Gempa Terkini
// ----------------------
function get_gempaterkini($conn) {
    create_table_gempaterkini($conn);
    
    $search = $_POST['search']['value'];
    $limit  = $_POST['length'];
    $start  = $_POST['start'];

    $sql        = mysqli_query($conn, "SELECT id FROM gempaterkini");
    $sql_count  = mysqli_num_rows($sql);

    $query          = "SELECT * FROM gempaterkini WHERE (wilayah LIKE '%".$search."%')";
    $order_index    = $_POST['order'][0]['column'];
    $order_field    = $_POST['columns'][$order_index]['data'];
    $order_ascdesc  = $_POST['order'][0]['dir'];
    $order          = " ORDER BY ".$order_field." ".$order_ascdesc;
    
    $sql_data       = mysqli_query($conn, $query.$order." LIMIT ".$limit." OFFSET ".$start);
    $sql_filter     = mysqli_query($conn, $query);

    $sql_filter_count = mysqli_num_rows($sql_filter);
    $data             = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);

    // mapping
    $new_data = [];
    $nomor_baris = $start+1;

    foreach ($data as $row) {
        // nomor baris
        $row['no'] = $nomor_baris;
        $nomor_baris++;

        // tanggal
        $row['tanggal'] = date('d-m-Y', strtotime($row['tanggal']));

        $new_data[] = $row;
    }
    
    $callback = array(
        'draw'              => $_POST['draw'],
        'recordsTotal'      => $sql_count,
        'recordsFiltered'   => $sql_filter_count,
        'data'              => $new_data
    );
    
    header('Content-Type: application/json');
    echo json_encode($callback);
}

// Membuat Tabel Gempa Terkini
// ---------------------------
function create_table_gempaterkini($conn) {
    $checkTableQuery = "SHOW TABLES LIKE 'gempaterkini'";
    $result = mysqli_query($conn, $checkTableQuery);

    if (mysqli_num_rows($result) == 0) {
        $createTableQuery = "
            CREATE TABLE gempaterkini (
                id INT AUTO_INCREMENT PRIMARY KEY,
                tanggal DATETIME DEFAULT NULL,
                jam TIME DEFAULT NULL,
                koordinat VARCHAR(255),
                lintang VARCHAR(255),
                bujur VARCHAR(255),
                kekuatan VARCHAR(255),
                kedalaman VARCHAR(255),
                wilayah VARCHAR(255),
                keterangan VARCHAR(255)
            )
        ";

        if (mysqli_query($conn, $createTableQuery)) {
            return true;
        } 
        else {
            http_response_code(404);
            header("Content-type: application/json");
            echo json_encode([
                'message' => 'gagal membuat tabel "gempaterkini"'
            ]);
            die;
        }
    }
}