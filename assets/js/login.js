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
                    title: 'Submit your Github username',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Look up',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        return fetch(`//api.github.com/users/${login}`)
                        .then(response => {
                            if (!response.ok) {
                            throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                            `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                        title: `${result.value.login}'s avatar`,
                        imageUrl: result.value.avatar_url
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