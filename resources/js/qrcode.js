window.$ = window.jQuery = require('jquery');
window.Instascan = require('instascan');
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        continuous: true,
        mirror: false,
        backgroundScan: false
    });
    scanner.addListener('scan', function (content) {
        console.log(content);

        $.ajax({
            url: "./get_nisn",
            type: "POST",
            success: function(data,status,xhr){
                alert(status);
                alert(data.nisn);

                send_data(data.nisn,content);
            },
            error: function (xhr,status,error) {
                alert(error);
                alert(status);
            }
        });


    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras[1]) {
            scanner.start(cameras[1]);
        } else {
            scanner.start(cameras[0]);
            // console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });

    function send_data(nisn,content) {

        $.ajax({
            url: 'student/submit_qr',
            method: 'POST',
            async: false,
            dataType: 'json',
            data: {
                kode_qr: content,
                nisn: nisn
            },
            success: function(data){
                console.log(data);
                // window.location.replace('/student/submit_qr');
            },
            error: function(data,status){
                console.log(status);
            }
        })
    }
});


