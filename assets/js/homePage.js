// get total sampah
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

    document.getElementById('totalSampahWraper').innerHTML = elTotalSampah;
}) 
.catch(res => {
})

// modif number
function kFormatter(num) {
    return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'K' : Math.sign(num)*Math.abs(num)
}

let validatorKritik = new Validator(document.querySelector("form"), {
    delay: 0
});

$('#contact').on('submit', function(e) {
    e.preventDefault();
    if (isValidForm()) {
        //showLoadingSpinner();
        
        // clear error message
        $('#messages-nasabah-error').text('');

        let form = new FormData(e.target);

        axios
        .post(`${APIURL}/nasabah/sendkritik`,form, {
            headers: {
                // header options 
            }
        })
        .then((response) => {
            //hideLoadingSpinner();
            
        })
        .catch((error) => {
            console.log(error);
            //hideLoadingSpinner();
            // Swal.fire({
            //         title : 'Success',
            //         text : 'Pesan Telah Terkirim',
            //         showConfirmButton: false, 
            //         timer: 5000
            //     });
            // error email/password
            if (error.response.status == 400) {
                $('#message-contact-error').text(error.response.data.messages.messages);
            }
        })
    }

});

function isValidForm() {
    let isValid = true;

    $('.invalid-feedback').each(function(e) {
        if ($(this).text() !== '') {
            isValid = false;
        }
    });
    return isValid;
}

//Send Message Function (Bug : need twice click)
// sendMssg = (e, event) => {
//     event.preventDefault();
//     $("form#contact").validate({
//         errorElement: "small",
//         rules: {
//             name: {
//                 required: true,
//             },
//             email: {
//                 required: true,
//                 email: true
//             },
//             message: {
//                 required: true
//             }
//         },
//         submitHandler: function(form) {
//             let formKritik = new FormData(form);
//             Swal.fire({
//                 title : "Checking...",
//                 text : "Please wait",
//                 imageUrl : "assets/images/loader.gif",
//                 showConfirmButton: false,
//                 allowOutsideClick: false
//             });
//             console.log(formKritik.get('name'));
//             axios.post(baseurl + '/nasabah/sendkritik', formKritik)
//             .then(res => {
//                 console.log(res);
//                 // Buat Dialog Sukses
//                 Swal.fire({
//                     title : 'Success',
//                     text : 'Pesan Telah Terkirim',
//                     showConfirmButton: false, 
//                     timer: 5000
//                 });
//             })
//             .catch(res => {
//                 console.log(res);
//             });
//         }
//     });
// }