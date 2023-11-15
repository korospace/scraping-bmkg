$(function () {
    /**
     * Hide Alert At First Load
     */
    $("#alert_rsync_gempaterkini").hide();

    /**
     * Close Alert
     */
    $('#alert_rsync_gempaterkini button').click(function(event) {
        $("#alert_rsync_gempaterkini").hide();
    })

    /**
     * Button Rsync Gempa Terkini
    */
    $('#btn_rsync_gempaterkini').click(function(event) {
        event.preventDefault();

        $("#alert_rsync_gempaterkini").hide();
    
        $('#btn_rsync_gempaterkini i').addClass('fa-spin');
    
        $.ajax({
            type: "GET",
            url: `${BASE_URL}/api/scraping-gempa.php?exe=scraping_gempaterkini`,
            success:function(res) {
                $('#btn_rsync_gempaterkini i').removeClass('fa-spin');
                if (res.new_rows == 0) {
                    $("#alert_rsync_gempaterkini span").html("tidak ada data terbaru!");
                    $("#alert_rsync_gempaterkini").removeClass('alert-danger alert-success').addClass('alert-info');
                } 
                else {
                    $("#alert_rsync_gempaterkini span").html(res.message);
                    $("#alert_rsync_gempaterkini").removeClass('alert-danger alert-info').addClass('alert-success');
                }

                $("#alert_rsync_gempaterkini").show();
                tabel_gempaterkini.ajax.reload();
            },
            error:function(res) {
                $('#btn_rsync_gempaterkini i').removeClass('fa-spin');
                $("#alert_rsync_gempaterkini span").html(res.responseJSON.message);
                $("#alert_rsync_gempaterkini").removeClass('alert-success').addClass('alert-danger');
                $("#alert_rsync_gempaterkini").show();
            }
        });
    });

    /**
     * Tabel Gempa Terkini
     */
    let tabel_gempaterkini = $('#tabel_gempaterkini').DataTable({
        "bDestroy": true,
        "responsive": true,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ordering": true, // Set true agar bisa di sorting
        "order": [[ 1, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
        "ajax":
        {
            "url": `${BASE_URL}/api/scraping-gempa.php?exe=get_gempaterkini`, // URL file untuk proses select datanya
            "type": "POST"
        },
        "deferRender": true,
        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
        "columns": [
            { "data": "no" },
            { "data": "tanggal" },
            { "data": "jam" },
            { "data": "koordinat" },
            { "data": "lintang" },
            { "data": "bujur" },
            { "data": "kekuatan" },
            { "data": "kedalaman" },
            { "data": "wilayah" },
            { "data": "keterangan" },
        ],
        "columnDefs": [
            {
                "targets": [0],
                "className": "text-center align-middle",
            },
        ],
    });
})