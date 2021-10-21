/* 
-------------- 
Login Nasabah 
--------------
*/

// form on submit
$('#formLoginNasabah').on('submit', function(e) {
    e.preventDefault();

    if (doValidate()) {
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
                // showPopupOtp(form);
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

// form validation
function doValidate(form) {
    let status     = true;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.text-danger').html('');

    // email validation
    if ($('#nasabah-email').val() == '') {
        $('#nasabah-email').addClass('is-invalid');
        $('#nasabah-email-error').html('*email harus di isi');
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
PopUp OTP
*/
function showPopupOtp(formLogin) {
    Swal.fire({
        title: 'CODE OTP',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        html:'akun belum ter-verifikasi. check email anda untuk melihat code OTP',
        footer: 'merasa kesulitan? <a href="">hubungi admin</a>',
        showCancelButton: true,
        confirmButtonText: 'submit',
        showLoaderOnConfirm: true,
        preConfirm: (otp) => {
            let form = new FormData();
            form.append('code_otp',otp);

            // Cek OTP
            return axios
            .post(`${APIURL}/nasabah/verification`,form, {
                headers: {
                    // header options 
                }
            })
            .then(() => {
                // Login
                return axios
                .post(`${APIURL}/nasabah/login`,formLogin, {
                    headers: {
                        // header options 
                    }
                })
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'verifikasi success!',
                        showConfirmButton: false,
                    })

                    setTimeout(() => {
                        document.cookie = `token=${response.data.token}; path=/;`;
                        window.location.replace(`${BASEURL}/nasabah`);
                    }, 2000);
                })
                .catch(() => {
                    Swal.close();

                    showAlert({
                        message: `<strong>Ups . . .</strong> terjadi kesalahan, coba sekali lagi!`,
                        btnclose: true,
                        type:'danger' 
                    })
                })
            })
            .catch(error => {
                if (error.response.status == 404) {
                    Swal.showValidationMessage(
                        `code otp tidak valid`
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
}

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
            // console.log(response.data);
            document.cookie = `tokenAdmin=${response.data.token}; path=/;`;
            window.location.replace(`${BASEURL}/admin`);
        })
        .catch((error) => {
            hideLoadingSpinner();
            console.log(error.response);
            console.log(error);

            // error email/password
            if (error.response.status == 404) {
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
        $('#admin-username-error').html('*email harus di isi');
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