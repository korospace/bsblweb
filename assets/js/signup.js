/* 
-------------- 
Register Nasabah 
--------------
*/

// form validation
let validatorRegist = new Validator(document.getElementById("formRegister"), {
    delay: 0
});

// form on submit
$('#formRegister').on('submit', function(e) {
    e.preventDefault();

    if (isValidForm()) {

        Swal.fire({
            icon: 'info',
            title: 'Loading',
            text: 'Tungggu Sebentar..',
            showConfirmButton: false,
            allowOutsideClick: false
        })

        
        // clear error message
        $('#nama-nasabah-error').text('');
        $('#username-nasabah-error').text('');
        $('#email-nasabah-error').text('');
        $('#tgl-nasabah-error').text('');
        $('#kelamin-nasabah-error').text('');
        $('#alamat-nasabah-error').text('');
        $('#rw-nasabah-error').text('');
        $('#rt-nasabah-error').text('');
        $('#kodedpos-nasabah-error').text('');
        $('#notelp-nasabah-error').text('');
        $('#password-nasabah-error').text('');

        let form = new FormData(e.target);
        axios
        .post(`${APIURL}/nasabah/register`,form, {
            headers: {
                // header options 
            }
        })
        .then((response) => {
            Swal.fire({
                icon: 'success',
                title: 'success!',
                text: 'Silahkan Login',
            })
            window.location.replace(`${BASEURL}/login`);
        })
        .catch((error) => {
            console.log(error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Perbaiki sesuai dengan yang tertera',
            })
            // error response input invalid
            if (error.status == 400) {
                console.log(error.status);
                $('#nama-nasabah-error').text(error.response.messages.nama_lengkap);
                $('#username-nasabah-error').text(error.response.messages.username);
                $('#email-nasabah-error').text(error.response.messages.email);
                $('#tgl-nasabah-error').text(error.response.messages.tgl);
                $('#kelamin-nasabah-error').text(error.response.messages.kelamin);
                $('#alamat-nasabah-error').text(error.response.messages.alamat);
                $('#rw-nasabah-error').text(error.response.messages.rw);
                $('#rt-nasabah-error').text(error.response.messages.rt);
                $('#kodedpos-nasabah-error').text(error.response.messages.kodepos);
                $('#notelp-nasabah-error').text(error.response.messages.notelp);
                $('#password-nasabah-error').text(error.response.messages.password);
            }
            else{
                showAlert({
                    message: `<strong>server error</strong> coba sekali lagi!`,
                    btnclose: true,
                    type:'danger' 
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