window.$ = window.jQuery = require('jquery');

$(document).ready(function () {
//form thingie
    form = $("#form-change");
    form_pelajaran = $("#form-pelajaran");
    form_kelas = $("#form-kelas");

    //UI Elements
    username = $("#nisn");
    no_pelajaran = $("#no_pelajaran");
    kode_kelas = $("#kode_kelas");
    button_retrieve_user = $("#retrieve_user");
    button_submit_user = $("#submit_user");
    button_retrieve_pelajaran = $("#retrieve_pelajaran");
    button_submit_pelajaran = $("#submit_pelajaran");
    button_retrieve_kelas = $("#retrieve_kelas");
    button_submit_kelas = $("#submit_kelas");

    button_retrieve_user.on("click", function () {
        user_type = $(".user_type");
        if (user_type.val().length != 0 && username.val().length != 0) {
            get_user_data(user_type.val(), username.val());
            console.log(user_type.val());
            console.log(username.val());
        } else {
            alert("NISN or User Type is empty !");
        }
    });
    button_submit_user.on("click", function () {
        nama = $("#nama");
        var confirmation;

        confirmation = confirm("ARE YOU SURE YOU WANT TO DELETE IT ? (CHANGE IS IRREVERSIBLE!)");

        if (confirmation == true){
            data = {
                nisn: username.val(),
                user_type: user_type.val(),
                nama: nama.val(),
                soft_delete: true
            };
            console.log(data);
            set_user_data(data);

        } else {
            form.empty();
        }
    });

    button_retrieve_pelajaran.on("click", function () {
        if (no_pelajaran.val().length != 0) {

            data = {
                no_pelajaran: no_pelajaran.val()
            };
        } else {

            alert("Kode pelajaran is empty !");
        }
        get_lesson_data(data);
    });
    button_submit_pelajaran.on("click", function () {
        nama_pelajaran = $("#nama_pelajaran");
        var confirmation;

        confirmation = confirm("ARE YOU SURE YOU WANT TO DELETE IT ? (CHANGE IS IRREVERSIBLE!)");

        if (confirmation == true){
            data = {
                kode_pelajaran: no_pelajaran.val(),
                nama_pelajaran: nama_pelajaran.val(),
            };

            set_lesson_data(data);
        } else {
            form_pelajaran.empty();
        }
    });

    button_retrieve_kelas.on("click", function () {
        if (kode_kelas.val().length != 0) {

        data = {
            kode_kelas: kode_kelas.val()
        };
        } else {

            alert("Kode kelas is empty !");
        }
        get_class_data(data);
    });
    button_submit_kelas.on("click", function () {
        nama_kelas = $("#nama_kelas");

        confirmation = confirm("ARE YOU SURE YOU WANT TO DELETE IT ? (CHANGE IS IRREVERSIBLE!)");

        if (confirmation == true){
            console.log(nama_kelas);

            data = {
                kode_kelas: kode_kelas.val(),
                nama_kelas: nama_kelas.val()
            };

            set_class_data(data);
        } else {
            form_kelas.empty();
        }
    })

//  function for request & DELETE user data
    function get_user_data(user_type, nisn) {
        switch (user_type) {
            case "student":
                $.ajax({
                    url: "http://absensi.test/api/retrieve_user_info",
                    method: "POST",
                    dataType: "json",
                    data: {
                        user_type: user_type,
                        nisn: nisn
                    },
                    success: function (data) {
                        console.log(data);

                        if ($.isEmptyObject(data)){
                            alert("Data not found !");
                        } else {
                            form.empty();

                            //name
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Name*</strong></label>" +
                                "<input type=\"text\" class=\"form-control \" id=\"nama\"\n" + "value=" + data.nama + ">"
                            );
                            //alamat
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Alamat*</strong></label>" +
                                "<input type=\"text\" class=\"form-control \" id=\"alamat\"\n" + "value=" + data.alamat + ">"
                            );
                            //tempat lahir
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Tempat Lahir</strong></label>" +
                                "<input type=\"text\" class=\"form-control \" id=\"tempat_lahir\"\n" + "value=" + data.tempat_lahir + ">"
                            );
                            //tanggal lahir
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Tanggal Lahir</strong></label>" +
                                "<input type=\"date\" class=\"form-control \" id=\"tgllahir\"\n" + "value=" + data.tanggal_lahir + ">"
                            );
                            //notelp
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>No. Telp</strong></label>" +
                                "<input type=\"number\" class=\"form-control \" id=\"notelp\"\n" + "value=" + data.no_telp + ">"
                            );
                            //user_type
                            form.append(
                                "<input type='hidden' id ='user_type' value='" + user_type + "'>"
                            );

                            button_submit_user.css('visibility', 'visible');

                        }
                    },
                    error: function (data, status) {
                        console.log(data);
                        console.log(status);
                    }
                });
                break;
            case "teacher":
                $.ajax({
                    url: "",
                    method: "POST",
                    dataType: "json",
                    success: function (data) {

                    },
                    error: function (data, status) {

                    }
                });
                break;
            case "admin":
                $.ajax({
                    url: "",
                    method: "POST",
                    success: function (data) {

                    },
                    error: function (data, status) {

                    }
                });
                break;
        }
    }

    function set_user_data(data) {
        $.ajax({
            url: 'http://absensi.test/api/delete_user_info',
            method: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if (data.error) {
                    $.each(data.message, function (index, value) {
                        $.each(value, function (index, value) {
                            alert(value);
                        })
                    });
                } else {
                    alert(data.message);
                    form.empty();
                }
                console.log(data);
            },
            failed: function (data, status) {
                console.log(data);
                console.log(status);
            }
        });
    }

//  function for request & DELETE lesson data
    function get_lesson_data(data) {
        $.ajax({
            url: "http://absensi.test/api/retrieve_pelajaran_info",
            method: "POST",
            dataType: "json",
            data: data,
            success: function (data) {
                form_pelajaran.empty();

                if (data.error) {
                    console.log(data)
                    $.each(data.message, function (index, value) {
                        alert(value);
                    });
                } else {
                    $.each(data, function (index,value) {
                        //nama pelajaran
                        form_pelajaran.append(
                            "<div class=\"form-group mb-3\">" +
                            "<label class=\"mr-3\"><strong>Nama Pelajaran</strong></label>" +
                            "<input type=\"text\" class=\"form-control \" id=\"nama_pelajaran\"\n" + "value=" + value.nama_pelajaran + ">"
                        );
                    })

                    button_submit_pelajaran.css('visibility', 'visible');
                }

            },
            error: function (data, status) {
                console.log(data);
                console.log(status);
            }
        });
    }

    function set_lesson_data(data) {
        $.ajax({
            url: 'http://absensi.test/api/delete_pelajaran_info',
            method: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if (data.error) {
                    $.each(data.message, function (index, value) {
                        $.each(value, function (index, value) {
                            alert(value);
                        })
                    });
                } else {
                    alert(data.message);
                    form_pelajaran.empty();
                    button_submit_pelajaran.css('visibility', 'hidden');
                }
                console.log(data);
            },
            failed: function (data, status) {
                console.log(data);
                console.log(status);
            }
        });
    }

//  function for request & change class data
    function get_class_data(data) {
        $.ajax({
            url: "http://absensi.test/api/retrieve_kelas_info",
            method: "POST",
            dataType: "json",
            data: data,
            success: function (data) {
                form_kelas.empty();

                if (data.error) {
                    console.log(data)
                    $.each(data.message, function (index, value) {
                        alert(value);
                    });
                } else {
                    $.each(data, function (index,value) {
                        //nama pelajaran
                        form_kelas.append(
                            "<div class=\"form-group mb-3\">" +
                            "<label class=\"mr-3\"><strong>Nama Kelas</strong></label>" +
                            "<input type=\"text\" class=\"form-control \" id=\"nama_kelas\"\n" + "value=" + value.nama_kelas + ">"
                        );
                    })

                    button_submit_kelas.css('visibility', 'visible');
                }

            },
            error: function (data, status) {
                console.log(data);
                console.log(status);
            }
        });
    }

    function set_class_data(data) {
        $.ajax({
            url: 'http://absensi.test/api/delete_kelas_info',
            method: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
                if (data.error) {
                    $.each(data.message, function (index, value) {
                        $.each(value, function (index, value) {
                            alert(value);
                        })
                    });
                } else {
                    alert(data.message);
                    $("#submit_kelas").css('visibility', 'hidden');
                    form_kelas.empty();
                }
                console.log(data);
            },
            failed: function (data, status) {
                console.log(data);
                console.log(status);
            }
        });
    }
});