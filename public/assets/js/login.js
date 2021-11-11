/* 
-------------- 
Login Nasabah 
--------------
*/

$('#formLoginNasabah').on('submit', function(e) {
    e.preventDefault();

    if (doValidateNasabah()) {
        showLoadingSpinner();
        let formLogin = new FormData(e.target);

        axios
        .post(`${APIURL}/nasabah/login`,formLogin, {
            headers: {
                // header options 
            }
        })
        .then((response) => {
            hideLoadingSpinner();
            document.cookie = `token=${response.data.token}; path=/;`;
            window.location.replace(`${BASEURL}/nasabah`);
        })
        .catch((error) => {
            hideLoadingSpinner();

            // error email/password
            if (error.response.status == 404) {
                if (error.response.data.messages.email) {
                    $('#nasabah-email').addClass('is-invalid');
                    $('#nasabah-email-error').text(error.response.data.messages.email);
                } 
                else if (error.response.data.messages.password){
                    $('#nasabah-password').addClass('is-invalid');
                    $('#nasabah-password-error').text(error.response.data.messages.password);
                }
            }
            // account not verify
            else if (error.response.status == 401) {
                setTimeout(() => {
                    Swal.fire({
                        icon: 'warning',
                        title: 'LOGIN GAGAL!',
                        text: 'akun anda belum ter-verifikasi. silahkan verifikasi akun terlebih dahulu',
                        confirmButtonText: 'ok',
                    })
                    .then(() => {
                        var url = BASEURL + '/otp';
                        var form = $('<form action="' + url + '" method="post">' +
                        '<input type="text" name="email" value="' + formLogin.get('email') + '" />' +
                        '<input type="text" name="password" value="' + formLogin.get('password') + '" />' +
                        '</form>');
                        $('body').append(form);
                        form.submit();

                        // window.location.replace(`${BASEURL}/otp`);
                    })
                }, 300);
            }
            // server error
            else{
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan, coba sekali lagi!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
    }
})

function doValidateNasabah(form) {
    let status     = true;
    let emailRules = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.text-danger').html('');

    // email validation
    if ($('#nasabah-email').val() == '') {
        $('#nasabah-email').addClass('is-invalid');
        $('#nasabah-email-error').html('*email harus di isi');
        status = false;
    }
    else if (!emailRules.test(String($('#nasabah-email').val()).toLowerCase())) {
        $('#nasabah-email').addClass('is-invalid');
        $('#nasabah-email-error').html('*email tidak valid');
        status = false;
    }
    // password validation
    if ($('#nasabah-password').val() == '') {
        $('#nasabah-password').addClass('is-invalid');
        $('#nasabah-password-error').html('*password harus di isi');
        status = false;
    }

    return status;
}

/* 
Lupa password
*/
$('#btn-forgotpass').on('click', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'LUPA PASSWORD?',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        html:`<p class='mb-4'>masukan email yang terdaftar. kami akan mengirim password anda melalui email</p>`,
        footer: '<a href="">hubungi admin</a>',
        showCancelButton: true,
        confirmButtonText: 'submit',
        showLoaderOnConfirm: true,
        preConfirm: (email) => {
            let form = new FormData();
            form.append('email',email);

            return axios
            .post(`${APIURL}/nasabah/forgotpass`,form, {
                headers: {
                    // header options 
                }
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'success!',
                    text: 'password sudah dikirim ke email anda. silahkan cek email',
                    showConfirmButton: true,
                })
            })
            .catch(error => {
                if (error.response.status == 404) {
                    Swal.showValidationMessage(
                        `email tidak terdaftar`
                    )
                }
                else if (error.response.status == 500) {
                    Swal.showValidationMessage(
                        `terjadi kesalahan, coba sekali lagi`
                    )
                }
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
})

/* 
-------------- 
Login Admin 
--------------
*/

$('#formLoginAdmin').on('submit', function(e) {
    e.preventDefault();

    if (doValidateAdmin()) {
        showLoadingSpinner();
        let form = new FormData(e.target);

        axios
        .post(`${APIURL}/admin/login`,form, {
            headers: {
                // header options 
            }
        })
        .then((response) => {
            hideLoadingSpinner();
            
            let url = `${BASEURL}/admin`;
            if (LASTURL != '') {
                url = LASTURL;
            }

            document.cookie = `token=${response.data.token}; path=/;`;
            window.location.replace(url);
        })
        .catch((error) => {
            hideLoadingSpinner();

            // akun tidak aktif
            if (error.response.status == 401) {
                showAlert({
                    message: `<strong>Maaf . . .</strong> akun anda sudah tidak aktif!`,
                    btnclose: true,
                    type:'warning' 
                })
            }
            // error username/password
            else if (error.response.status == 404) {
                if (error.response.data.messages.username) {
                    $('#admin-username').addClass('is-invalid');
                    $('#admin-username-error').text(error.response.data.messages.username);
                } 
                else if (error.response.data.messages.password){
                    $('#admin-password').addClass('is-invalid');
                    $('#admin-password-error').text(error.response.data.messages.password);
                }
            }
            // server error
            else{
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan, coba sekali lagi!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
    }
})

function doValidateAdmin(form) {
    let status     = true;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.text-danger').html('');

    // email validation
    if ($('#admin-username').val() == '') {
        $('#admin-username').addClass('is-invalid');
        $('#admin-username-error').html('*username harus di isi');
        status = false;
    }
    // password validation
    if ($('#admin-password').val() == '') {
        $('#admin-password').addClass('is-invalid');
        $('#admin-password-error').html('*password harus di isi');
        status = false;
    }

    return status;
}