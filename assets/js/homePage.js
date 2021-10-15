// get total sampah
axios.get(baseurl+'/sampah/totalitem')
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

// Send Message Function (Bug : need twice click)
sendMssg = (e, event) => {
    event.preventDefault();
    $("form#contact").validate({
        errorElement: "small",
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            message: {
                required: true
            }
        },
        submitHandler: function(form) {
            let formKritik = new FormData(form);
            Swal.fire({
                title : "Checking...",
                text : "Please wait",
                imageUrl : "assets/images/loader.gif",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            console.log(formKritik.get('name'));
            axios.post(baseurl + '/nasabah/sendkritik', formKritik)
            .then(res => {
                console.log(res);
                // Buat Dialog Sukses
                Swal.fire({
                    title : 'Success',
                    text : 'Pesan Telah Terkirim',
                    showConfirmButton: false, 
                    timer: 5000
                });
            })
            .catch(res => {
                console.log(res);
            });
        }
    });
}