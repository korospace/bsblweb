
/* 
-------------- 
Register Nasabah 
--------------
*/
$('#formRegister').on('submit', function(e) {
    e.preventDefault();
    let form = new FormData(e.target);
    
    if (doValidate(form)) {
        showLoadingSpinner();
        let newTgl = form.get('tgl_lahir').split('-');
        form.set('tgl_lahir',`${newTgl[2]}-${newTgl[1]}-${newTgl[0]}`)

        axios
        .post(`${APIURL}/nasabah/register`,form, {
            headers: {
                // header options 
            }
        })
        .then((response) => {
            hideLoadingSpinner();

            setTimeout(() => {
                Swal.fire({
                    icon : 'success',
                    title : '<strong>SUCCESS</strong>',
                    html:
                      'check email anda untuk mendapatkan ' +
                      '<strong>CODE OTP</strong> ',
                    showCancelButton: false,
                    confirmButtonText: 'ok',
                }).then((result) => {
                    window.location.replace(`${BASEURL}/login`);
                })
            }, 500);
        })
        .catch((error) => {
            hideLoadingSpinner();

            // bad request
            if (error.response.status == 400) {
                if (error.response.data.messages.email) {
                    $('#email-regist').addClass('is-invalid');
                    $('#email-regist-error').text(error.response.data.messages.email);
                }
                if (error.response.data.messages.username) {
                    $('#username-regist').addClass('is-invalid');
                    $('#username-regist-error').text(error.response.data.messages.username);
                }
                if (error.response.data.messages.notelp) {
                    $('#notelp-regist').addClass('is-invalid');
                    $('#notelp-regist-error').text(error.response.data.messages.notelp);
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
})

// form validation
function doValidate(form) {
    let status     = true;
    let emailRules = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    let kelamin    = form.get('kelamin');

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.form-check-input').removeClass('is-invalid');
    $('.text-danger').html('');

    // name validation
    if ($('#nama-regist').val() == '') {
        $('#nama-regist').addClass('is-invalid');
        $('#nama-regist-error').html('*nama lengkap harus di isi');
        status = false;
    }
    else if ($('#nama-regist').val().length > 40) {
        $('#nama-regist').addClass('is-invalid');
        $('#nama-regist-error').html('*maksimal 40 huruf');
        status = false;
    }
    // username validation
    if ($('#username-regist').val() == '') {
        $('#username-regist').addClass('is-invalid');
        $('#username-regist-error').html('*username harus di isi');
        status = false;
    }
    else if ($('#username-regist').val().length < 8 || $('#username-regist').val().length > 20) {
        $('#username-regist').addClass('is-invalid');
        $('#username-regist-error').html('*minimal 8 huruf dan maksimal 20 huruf');
        status = false;
    }
    // email validation
    if ($('#email-regist').val() == '') {
        $('#email-regist').addClass('is-invalid');
        $('#email-regist-error').html('*email harus di isi');
        status = false;
    }
    else if ($('#email-regist').val().length > 40) {
        $('#email-regist').addClass('is-invalid');
        $('#email-regist-error').html('*maksimal 40 huruf');
        status = false;
    }
    else if (!emailRules.test(String($('#email-regist').val()).toLowerCase())) {
        $('#email-regist').addClass('is-invalid');
        $('#email-regist-error').html('*email tidak valid');
        status = false;
    }
    // password validation
    if ($('#password-regist').val() == '') {
        $('#password-regist').addClass('is-invalid');
        $('#password-regist-error').html('*password harus di isi');
        status = false;
    }
    else if ($('#password-regist').val().length < 8 || $('#password-regist').val().length > 20) {
        $('#password-regist').addClass('is-invalid');
        $('#password-regist-error').html('*minimal 8 huruf dan maksimal 20 huruf');
        status = false;
    }
    // tgl lahir validation
    if ($('#tgllahir-regist').val() == '') {
        $('#tgllahir-regist').addClass('is-invalid');
        $('#tgllahir-regist-error').html('*tgl lahir harus di isi');
        status = false;
    }
    // kelamin validation
    if (kelamin == null) {
        $('.form-check-input').addClass('is-invalid');
        
        status = false;
    }
    // rw validation
    if ($('#rw-regist').val() == '') {
        $('#rw-regist').addClass('is-invalid');
        $('#rw-regist-error').html('*rw harus di isi');
        status = false;
    }
    else if ($('#rw-regist').val().length < 2 || $('#rw-regist').val().length > 2) {
        $('#rw-regist').addClass('is-invalid');
        $('#rw-regist-error').html('*minimal 2 huruf dan maksimal 2 huruf');
        status = false;
    }
    else if (!/^\d+$/.test($('#rw-regist').val())) {
        $('#rw-regist').addClass('is-invalid');
        $('#rw-regist-error').html('*hanya boleh angka');
        status = false;
    }
    // rt validation
    if ($('#rt-regist').val() == '') {
        $('#rt-regist').addClass('is-invalid');
        $('#rt-regist-error').html('*rt harus di isi');
        status = false;
    }
    else if ($('#rt-regist').val().length < 2 || $('#rt-regist').val().length > 2) {
        $('#rt-regist').addClass('is-invalid');
        $('#rt-regist-error').html('*minimal 2 huruf dan maksimal 2 huruf');
        status = false;
    }
    else if (!/^\d+$/.test($('#rt-regist').val())) {
        $('#rt-regist').addClass('is-invalid');
        $('#rt-regist-error').html('*hanya boleh angka');
        status = false;
    }
    // kodepos validation
    if ($('#kodepos-regist').val() == '') {
        $('#kodepos-regist').addClass('is-invalid');
        $('#kodepos-regist-error').html('*kodepos harus di isi');
        status = false;
    }
    else if ($('#kodepos-regist').val().length < 5 || $('#kodepos-regist').val().length > 5) {
        $('#kodepos-regist').addClass('is-invalid');
        $('#kodepos-regist-error').html('*minimal 5 huruf dan maksimal 5 huruf');
        status = false;
    }
    else if (!/^\d+$/.test($('#kodepos-regist').val())) {
        $('#kodepos-regist').addClass('is-invalid');
        $('#kodepos-regist-error').html('*hanya boleh angka');
        status = false;
    }
    // alamat validation
    if ($('#alamat-regist').val() == '') {
        $('#alamat-regist').addClass('is-invalid');
        $('#alamat-regist-error').html('*alamat harus di isi');
        status = false;
    }
    else if ($('#alamat-regist').val().length > 255) {
        $('#alamat-regist').addClass('is-invalid');
        $('#alamat-regist-error').html('*maksimal 255 huruf');
        status = false;
    }
    // notelp validation
    if ($('#notelp-regist').val() == '') {
        $('#notelp-regist').addClass('is-invalid');
        $('#notelp-regist-error').html('*no.telp harus di isi');
        status = false;
    }
    else if ($('#notelp-regist').val().length > 14) {
        $('#notelp-regist').addClass('is-invalid');
        $('#notelp-regist-error').html('*maksimal 14 huruf');
        status = false;
    }
    else if (!/^\d+$/.test($('#notelp-regist').val())) {
        $('#notelp-regist').addClass('is-invalid');
        $('#notelp-regist-error').html('*hanya boleh angka');
        status = false;
    }

    return status;
}