/* 
-------------- 
Login Nasabah 
--------------
*/

// form validation
let validatorNasabah = new Validator(document.getElementById("formLoginNasabah"), {
    delay: 0
});

// form on submit
$('#formLoginNasabah').on('submit', function(e) {
    e.preventDefault();

    if (isValidForm()) {
        showLoadingSpinner();
        
        // clear error message
        $('#email-nasabah-error').text('');
        $('#password-nasabah-error').text('');

        let form = new FormData(e.target);

        axios
        .post(`${APIURL}/nasabah/login`,form, {
            headers: {
                // header options 
            }
        })
        .then((response) => {
            hideLoadingSpinner();
            document.cookie = `token=${response.data.token}; path=/;`;
            window.location.replace(`${BASEURL}/dashboard/nasabah`);
        })
        .catch((error) => {
            hideLoadingSpinner();

            // error email/password
            if (error.response.status == 404) {
                $('#email-nasabah-error').text(error.response.data.messages.email);
                $('#password-nasabah-error').text(error.response.data.messages.password);
            }
            // account not verify
            if (error.response.status == 401) {
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

                        axios
                        .post(`${APIURL}/nasabah/verification`,form, {
                            headers: {
                                // header options 
                            }
                        })
                        .then((response) => {
                            return response.data.messages
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `code otp tidak valid`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'success!',
                            text: 'silahkan login kembali',
                        })
                    }
                })
            }
        })
    }
})

/* 
check message in div.feedback
*/
function isValidForm() {
    let isValid = true;

    $('.invalid-feedback').each(function(e) {
        if ($(this).text() !== '') {
            isValid = false;
        }
    })

    return isValid;
}