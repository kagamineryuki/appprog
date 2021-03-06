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
        user_type = $("input[name='user_type']:checked");
        if (user_type.val().length != 0 && username.val().length != 0) {
            get_user_data(user_type.val(), username.val());
            console.log(user_type.val());
            console.log(username.val());
        } else {
            alert("NISN or User Type is empty !");
        }
    });
    button_submit_user.on("click", function () {
        tempat_lahir = $("#tempat_lahir");
        tanggal_lahir = $("#tgllahir");
        no_telp = $("#notelp");
        nama = $("#nama");
        alamat = $("#alamat");
        user_type = $("input[name='user_type']:checked");

        switch(user_type.val()){
            case "student":
                data = {
                    nisn: username.val(),
                    user_type: user_type.val(),
                    nama: nama.val(),
                    alamat: alamat.val(),
                    no_telp: no_telp.val(),
                    tempat_lahir: tempat_lahir.val(),
                    tanggal_lahir: tanggal_lahir.val()
                };

                console.log(data);
                set_user_data(data);
                break;
            case "teacher":
                data = {
                    nign: username.val(),
                    user_type: user_type.val(),
                    nama: nama.val(),
                    alamat: alamat.val(),
                    no_telp: no_telp.val(),
                    tempat_lahir: tempat_lahir.val(),
                    tanggal_lahir: tanggal_lahir.val()
                };

                console.log(data);
                set_user_data(data);
                break;
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

        data = {
            kode_pelajaran: no_pelajaran.val(),
            nama_pelajaran: nama_pelajaran.val()
        }

        set_lesson_data(data);
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

        console.log(nama_kelas);

        data = {
            kode_kelas: kode_kelas.val(),
            nama_kelas: nama_kelas.val()
        }

        set_class_data(data);
    })

//  function for request & change user data
    function get_user_data(user_type, nisn) {
        switch (user_type) {
            case "student":
                $.ajax({
                    url: "/api/retrieve_user_info",
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
                                "<input type='text' class='form-control' id='nama' value=\""+ data.nama +" \" >"
                            );
                            //alamat
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Address*</strong></label>" +
                                "<input type=\"text\" class=\"form-control \" id=\"alamat\"\n" + "value=" + data.alamat + ">"
                            );
                            //tempat lahir
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Birthplace</strong></label>" +
                                "<input type=\"text\" class=\"form-control \" id=\"tempat_lahir\"\n" + "value=" + data.tempat_lahir + ">"
                            );
                            //tanggal lahir
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Birthdate</strong></label>" +
                                "<input type=\"date\" class=\"form-control \" id=\"tgllahir\"\n" + "value=" + data.tanggal_lahir + ">"
                            );
                            //notelp
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Phone Number</strong></label>" +
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
                    url: "/api/retrieve_user_info",
                    method: "POST",
                    dataType: "json",
                    data: {
                        user_type: user_type,
                        nign: nisn
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
                                "<input type='text' class='form-control' id='nama' value='"+ data.nama +"'>"
                            );
                            //alamat
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Address*</strong></label>" +
                                "<input type='text' class='form-control' id='alamat'" + "value=" + data.alamat + "'>"
                            );
                            //tempat lahir
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Birthplace</strong></label>" +
                                "<input type='text' class='form-control' id='tempat_lahir' value='" + data.tempat_lahir + "'>"
                            );
                            //tanggal lahir
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Birthdate</strong></label>" +
                                "<input type='date' class='form-control' id='tgllahir' value='" + data.tanggal_lahir + "'>"
                            );
                            //notelp
                            form.append(
                                "<div class=\"form-group mb-3\">" +
                                "<label class=\"mr-3\"><strong>Phone Number</strong></label>" +
                                "<input type='number' class='form-control' id='notelp' value=" + data.no_telp + "'>"
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
            url: '/api/update_user_info',
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
                }
                console.log(data);
            },
            failed: function (data, status) {
                console.log(data);
                console.log(status);
            }
        });
    }

//  function for request & change lesson data
    function get_lesson_data(data) {
        $.ajax({
            url: "/api/retrieve_pelajaran_info",
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
                            "<label class=\"mr-3\"><strong>Lesson Name</strong></label>" +
                            "<input type='text' class='form-control' id='nama_pelajaran' value='" + value.nama_pelajaran + "'>"
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
            url: '/api/update_pelajaran_info',
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
            url: "/api/retrieve_kelas_info",
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
                            "<label class=\"mr-3\"><strong>Class Name</strong></label>" +
                            "<input type='text' class='form-control' id='nama_kelas' value='" + value.nama_kelas + "'>"
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
            url: '/api/update_kelas_info',
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