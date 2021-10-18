let pageTitle   = document.title.replace(/\s/g,'').split('|');
let dataNasabah = '';

// Session check
const sessioncheck = () => {
    showLoadingSpinner();

    axios
        .get(`${APIURL}/nasabah/sessioncheck`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            hideLoadingSpinner();
            $('#container').removeClass('d-none');
        })
        .catch((error) => {
            hideLoadingSpinner();
            $('#container').removeClass('d-none');
    
            // 401 Unauthorized
            if (error.response.status == 401) {
                if (error.response.data.messages == 'token expired') {
                    showAlert({
                        message: `<strong>session expired...</strong> silahkan login kembali!`,
                        btnclose: true,
                        type:'info' 
                    })
                }
                document.cookie = `token=null; path=/;`;
                window.location.replace(`${BASEURL}/login`);
            }
            // server error
            else{
                showAlert({
                    message: `<strong>server error...</strong> silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

sessioncheck();

// Get data profile
const getDataProfile = () => {
    axios
        .get(`${APIURL}/nasabah/getprofile`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            dataNasabah = response.data.data;
            if (pageTitle[1] == 'dashboard') {
                updateDataCard(response.data.data);
            }
            else if (pageTitle[1] == 'profile') {
                updatePersonalInfo(response.data.data);
            }
        })
        .catch((error) => {
            // 500 server error
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>server error...</strong> gagal mendapatkan data nasabah, silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

getDataProfile();

// update card
const updateDataCard = (data) => {
    let date = new Date(parseInt(data.created_at) * 1000);

    // id card
    $('#card-id').html(`${data.id.slice(0, 5)}&nbsp;&nbsp;&nbsp;${data.id.slice(5, 9)}&nbsp;&nbsp;&nbsp;${data.id.slice(9,99999999)}`);
    // username
    $('#card-username').html(data.username);
    // tgl bergabung
    $('#card-date').html(`${date.toLocaleString("en-US",{day: "numeric"})}/${date.toLocaleString("en-US",{month: "numeric"})}/${date.toLocaleString("en-US",{year: "numeric"})}`);
};

// update personal info
const updatePersonalInfo = (data) => {
    // email
    $('#email').html(data.email);
    // id nasabah
    $('#idnasabah').html(data.id);
    // nama lengkap
    $('#nama-lengkap').html(data.nama_lengkap);
    // username
    $('#username').html(data.username);
    // tgl lahir
    $('#tgl-lahir').html(data.tgl_lahir);
    // kelamin
    $('#kelamin').html(data.kelamin);
    // alamat
    $('#alamat').html(data.alamat);
    // No Telp
    $('#notelp').html(data.notelp);
};

// open modal edit profile
$('#btn-edit-profile').on('click', function(e) {
    e.preventDefault();

    // clear error message first
    $('#formEditProfile .form-control').removeClass('is-invalid');
    $('#formEditProfile .form-check-input').removeClass('is-invalid');
    $('#formEditProfile .text-danger').html('');

    for (const name in dataNasabah) {
        $(`#formEditProfile input[name=${name}]`).val(dataNasabah[name]);
    }

    let tglLahir = dataNasabah.tgl_lahir.split('-');
    $(`#formEditProfile input[name=tgl_lahir]`).val(`${tglLahir[2]}-${tglLahir[1]}-${tglLahir[0]}`);
    $(`#formEditProfile input#kelamin-${dataNasabah.kelamin}`).prop('checked',true);
});

$('#formEditProfile .form-check-input').on('click', function(e) {
    $(`#formEditProfile input[name=kelamin]`).val($(this).val());
    $('#formEditProfile .form-check-input').prop('checked',false);
    $(this).prop('checked',true);
});

// submit modal edit profile
$('#formEditProfile').on('submit', function(e) {
    e.preventDefault();
    let form = new FormData(e.target);
    console.log(form.get('kelamin'));

    if (validateFormEditProfile(form)) {
        let newTgl = form.get('tgl_lahir').split('-');
        form.set('tgl_lahir',`${newTgl[2]}-${newTgl[1]}-${newTgl[0]}`)
        $('#formEditProfile button#submit #text').addClass('d-none');
        $('#formEditProfile button#submit #spinner').removeClass('d-none');

        axios
        .put(`${APIURL}/nasabah/editprofile`,form, {
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            $('#formEditProfile button#submit #text').removeClass('d-none');
            $('#formEditProfile button#submit #spinner').addClass('d-none');

            let newDataProfile = {};
            for (var pair of form.entries()) {
                newDataProfile[pair[0]] = pair[1];
            }

            dataNasabah = newDataProfile;
            updatePersonalInfo(newDataProfile);

            showAlert({
                message: `<strong>Success...</strong> edit profile berhasil!`,
                btnclose: false,
                type:'success'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
        })
        .catch((error) => {
            $('#formEditProfile button#submit #text').removeClass('d-none');
            $('#formEditProfile button#submit #spinner').addClass('d-none');

            // bad request
            if (error.response.status == 400) {
                if (error.response.data.messages.username) {
                    $('#username-edit').addClass('is-invalid');
                    $('#username-edit-error').text(error.response.data.messages.username);
                }
                if (error.response.data.messages.notelp) {
                    $('#notelp-edit').addClass('is-invalid');
                    $('#notelp-edit-error').text(error.response.data.messages.notelp);
                }
                if (error.response.data.messages.old_password) {
                    $('#oldpass-edit').addClass('is-invalid');
                    $('#oldpass-edit-error').text(error.response.data.messages.old_password);
                }
            }
            // error server
            else if (error.response.status == 500) {
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    btnclose: true,
                    type:'danger'
                })
            }
        })
    }
});

// form edit profile validation
function validateFormEditProfile(form) {
    let status     = true;
    let kelamin    = form.get('kelamin');

    // clear error message first
    $('#formEditProfile .form-control').removeClass('is-invalid');
    $('#formEditProfile .form-check-input').removeClass('is-invalid');
    $('#formEditProfile .text-danger').html('');

    // name validation
    if ($('#nama-edit').val() == '') {
        $('#nama-edit').addClass('is-invalid');
        $('#nama-edit-error').html('*nama lengkap harus di isi');
        status = false;
    }
    else if ($('#nama-edit').val().length > 40) {
        $('#nama-edit').addClass('is-invalid');
        $('#nama-edit-error').html('*maksimal 40 huruf');
        status = false;
    }
    // username validation
    if ($('#username-edit').val() == '') {
        $('#username-edit').addClass('is-invalid');
        $('#username-edit-error').html('*username harus di isi');
        status = false;
    }
    else if ($('#username-edit').val().length < 8 || $('#username-edit').val().length > 20) {
        $('#username-edit').addClass('is-invalid');
        $('#username-edit-error').html('*minimal 8 huruf dan maksimal 20 huruf');
        status = false;
    }
    // tgl lahir validation
    if ($('#tgllahir-edit').val() == '') {
        $('#tgllahir-edit').addClass('is-invalid');
        $('#tgllahir-edit-error').html('*tgl lahir harus di isi');
        status = false;
    }
    // kelamin validation
    if (kelamin == null) {
        $('#formEditProfile .form-check-input').addClass('is-invalid');
        status = false;
    }
    // alamat validation
    if ($('#alamat-edit').val() == '') {
        $('#alamat-edit').addClass('is-invalid');
        $('#alamat-edit-error').html('*alamat harus di isi');
        status = false;
    }
    else if ($('#alamat-edit').val().length > 255) {
        $('#alamat-edit').addClass('is-invalid');
        $('#alamat-edit-error').html('*maksimal 255 huruf');
        status = false;
    }
    // notelp validation
    if ($('#notelp-edit').val() == '') {
        $('#notelp-edit').addClass('is-invalid');
        $('#notelp-edit-error').html('*no.telp harus di isi');
        status = false;
    }
    else if ($('#notelp-edit').val().length > 14) {
        $('#notelp-edit').addClass('is-invalid');
        $('#notelp-edit-error').html('*maksimal 14 huruf');
        status = false;
    }
    else if (!/^\d+$/.test($('#notelp-edit').val())) {
        $('#notelp-edit').addClass('is-invalid');
        $('#notelp-edit-error').html('*hanya boleh angka');
        status = false;
    }
    // pass validation
    if ($('#newpass-edit').val() !== '') {   
        if ($('#newpass-edit').val().length < 8 || $('#newpass-edit').val().length > 20) {
            $('#newpass-edit').addClass('is-invalid');
            $('#newpass-edit-error').html('*minimal 8 huruf dan maksimal 20 huruf');
            status = false;
        }
        if ($('#oldpass-edit').val() == '') {
            $('#oldpass-edit').addClass('is-invalid');
            $('#oldpass-edit-error').html('*password lama harus di isi');
            status = false;
        }
    }

    return status;
}

// Get data saldo
const getDataSaldo = () => {
    axios
        .get(`${APIURL}/nasabah/getsaldo`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            $('#saldo-uang').html(response.data.data.uang);
            $('#saldo-ubs').html(response.data.data.ubs);
            $('#saldo-antam').html(response.data.data.antam);
            $('#saldo-galery24').html(response.data.data.galery24);
        })
        .catch((error) => {
            // 500 server error
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>server error...</strong> gagal mendapatkan data saldo, silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

if (pageTitle[1] == 'dashboard') {
    getDataSaldo();
}

// logout
$('#btn-logout').on('click', function(e) {
    e.preventDefault();
      
    Swal.fire({
        title: 'LOGOUT',
        text: "Anda yakin ingin keluar dari dashboad?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'iya',
        cancelButtonText: 'tidak',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return axios
            .delete(`${APIURL}/nasabah/logout`, {
                headers: {
                    token: TOKEN
                }
            })
            .then(() => {
                Swal.close();
                
                document.cookie = `token=null; path=/;`;
                window.location.replace(`${BASEURL}/login`);
            })
            .catch(error => {
                Swal.close();

                // unauthorized
                if (error.response.status == 401) {
                    document.cookie = `token=null; path=/;`;
                    window.location.replace(`${BASEURL}/login`);
                }
                // error server
                else if (error.response.status == 500) {
                    Swal.showValidationMessage(
                        `server error: coba sekali lagi!`
                    )
                }
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
})