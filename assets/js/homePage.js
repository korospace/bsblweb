/* 
-------------- 
get total sampah
--------------
*/
axios.get(APIURL+'/sampah/totalitem')
.then(res => {
    let elTotalSampah = '';
    let totalSampah   = res.data.data;

    for (const ts in totalSampah) {
        elTotalSampah += `<div class="col-md-3 col-sm-6">
          <div class="counter">
            <span class="counter-value">${kFormatter(totalSampah[ts].total)}</span>
            <div class="counter-content">
              <h3>KG<br>${totalSampah[ts].title}</br></h3>
            </div>
          </div>
        </div>`;
    }

    // modif number
    function kFormatter(num) {
        return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'K' : Math.sign(num)*Math.abs(num)
    }

    document.getElementById('totalSampahWraper').innerHTML = elTotalSampah;
}) 
.catch(res => {
})

/* 
-------------- 
send kritik 
--------------
*/
$('#contact').on('submit', function(e) {
    e.preventDefault();
    
    if (doValidate()) {
        showLoadingSpinner();

        let form = new FormData(e.target);

        axios
        .post(`${APIURL}/nasabah/sendkritik`,form, {
            headers: {
                // header options 
            }
        })
        .then((response) => {
            hideLoadingSpinner();

            setTimeout(() => {
                Swal.fire({
                    icon : 'success',
                    title : 'Success',
                    text : 'Pesan Telah Terkirim',
                    showConfirmButton: false, 
                    timer: 2000
                });
            }, 500);
        })
        .catch((error) => {
            hideLoadingSpinner();

            // error server
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    btnclose: true,
                    type:'danger'
                })
            }
        })
    }
});

// form validation
function doValidate() {
    let status     = true;
    let emailRules = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.error-message').html('');

    // name validation
    if ($('#contact-name').val() == '') {
        $('#contact-name').addClass('is-invalid');
        $('#contact-name-error').html('*nama harus di isi');
        status = false;
    }
    else if ($('#contact-name').val().length > 20) {
        $('#contact-name').addClass('is-invalid');
        $('#contact-name-error').html('*lebih dari 20 huruf');
        status = false;
    }
    // email validation
    if ($('#contact-email').val() == '') {
        $('#contact-email').addClass('is-invalid');
        $('#contact-email-error').html('*email harus di isi');
        status = false;
    }
    else if ($('#contact-email').val().length > 40) {
        $('#contact-email').addClass('is-invalid');
        $('#contact-email-error').html('*ebih dari 40 huruf');
        status = false;
    }
    else if (!emailRules.test(String($('#contact-email').val()).toLowerCase())) {
        $('#contact-email').addClass('is-invalid');
        $('#contact-email-error').html('*email tidak valid');
        status = false;
    }
    // message validation
    if ($('#contact-message').val() == '') {
        $('#contact-message').addClass('is-invalid');
        $('#contact-message-error').html('*pesan harus di isi');
        status = false;
    }

    return status;
}