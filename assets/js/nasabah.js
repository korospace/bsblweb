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
            // update cookie
            // const d = new Date();
            // d.setTime(d.getTime() + response.data.data.expired);
            // let token   = TOKEN;
            // let expired = d.toUTCString();
            // document.cookie = `token=${token}; expires=${expired}; path=/;`;

            hideLoadingSpinner();

            if (pageTitle[1] == 'dashboard') {
                getDataSaldo();
                getTotalSampah();
                getAllTransaksi();
            }

            getDataProfile();
        })
        .catch((error) => {
            hideLoadingSpinner();
    
            // 401 Unauthorized
            if (error.response.status == 401) {
                document.cookie = `token=null;expires=;path=/;`;
                
                if (error.response.data.messages == 'token expired') {
                    Swal.fire({
                        icon : 'error',
                        title : '<strong>LOGIN EXPIRED</strong>',
                        text: 'silahkan login ulang untuk perbaharui login anda',
                        showCancelButton: false,
                        confirmButtonText: 'ok',
                    }).then((result) => {
                        window.location.replace(`${BASEURL}/login`);
                    })
                }
                else{
                    window.location.replace(`${BASEURL}/login`);
                }
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

// modif saldo uang
function modifUang(rHarga){
    return rHarga.replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");;
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
            $('#saldo-uang').html(modifUang(response.data.data.uang));
            $('#saldo-ubs').html(parseFloat(response.data.data.ubs).toFixed(4));
            $('#saldo-antam').html(parseFloat(response.data.data.antam).toFixed(4));
            $('#saldo-galery24').html(parseFloat(response.data.data.galery24).toFixed(4));
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

// get total sampah
const getTotalSampah = () => {
    axios
        .get(`${APIURL}/sampah/totalitem`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            let dataSampah = response.data.data;
            for (const name in dataSampah) {
                $(`#sampah-${name}`).html(dataSampah[name].total+' Kg');
            }
        })
        .catch((error) => {
            // 500 server error
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>server error...</strong> gagal mendapatkan data sampah, silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

// get all transaksi
const getAllTransaksi = () => {
    axios
        .get(`${APIURL}/transaksi/getdata`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            let arrayId      = [];
            let arrayKg      = [];
            let elTransaksi  = '';
            let allTransaksi = response.data.data;
            
            allTransaksi.forEach(t => {
                let type      = t.type;
                let jenisSaldo= t.jenis_saldo;
                let textClass = '';
                let date      = new Date(parseInt(t.date) * 1000);
                let day       = date.toLocaleString("en-US",{day: "numeric"});
                let month     = date.toLocaleString("en-US",{month: "long"});
                let year      = date.toLocaleString("en-US",{year: "numeric"});
                let totalTransaksi = '';
                
                if (type == 'setor') {
                    textClass = 'text-success';
                    totalTransaksi = '+Rp'+modifUang(t[`total_${type}`]);
                    arrayId.push(t.id_transaksi);
                    arrayKg.push(t.total_kg);
                } 
                else if (type == 'tarik') {
                    textClass = 'text-danger';
                    if (jenisSaldo == 'uang') {
                        totalTransaksi = '-Rp'+modifUang(t[`total_${type}`]);
                    } else {
                        totalTransaksi = t[`total_${type}`]+'g';
                    }
                }
                else {
                    textClass = 'text-warning';
                    if (jenisSaldo == 'uang') {
                        totalTransaksi = 'Rp'+modifUang(t[`total_${type}`]);
                    } else {
                        totalTransaksi = t[`total_${type}`]+'g';
                    }
                }

                elTransaksi  += `<li class="list-group-item border-0 ps-0 border-radius-lg">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark font-weight-bold text-sm">${month}, ${day}, ${year}</h6>
                        <span class="text-xs">ID: ${t.id_transaksi}</span>
                        <span class="${textClass} mt-2">${totalTransaksi}</span>
                    </div>
                    <div class="d-flex align-items-center text-sm">
                        <a href='' class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"  data-toggle="modal" data-target="#modalPrintTransaksi" onclick="getDetailTransaksi('${t.id_transaksi}');">
                            <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                        </a>
                    </div>
                </div>
                <hr class="horizontal dark mt-2">
            </li>`;
            });

            updateGrafikSetor(arrayId,arrayKg);
            $('#transaksi-wraper').html(`<ul class="list-group w-100" style="font-family: 'qc-medium';">
                ${elTransaksi}
            </ul>`);
        })
        .catch((error) => {
            // transaksi not found
            if (error.response.status == 404) {
                updateGrafikSetor([],[]);
                $('#transaksi-wraper').html(`<h6 class='opacity-6'>belum ada transaksi</h6>`); 
            }
            // 500 server error
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>server error...</strong> gagal mendapatkan data transaksi, silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

// update grafik setor
const updateGrafikSetor = (arrayId,arrayKg) => {
    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(193,217,102,0.2)');

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(193,217,102,0.2)');

    new Chart(ctx2, {
        type: "bar",
        data: {
            // labels: ['sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss','sssssssssss'],
            labels: arrayId,
            datasets: [{
                label: "Kg",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#c1d966",
                borderWidth: 3,
                backgroundColor: gradientStroke1,
                fill: true,
                data: arrayKg,
                // data: [20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20],
                maxBarThickness: 6
            },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#b2b9bf',
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#b2b9bf',
                    padding: 0,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            },
        },
    });
};

// Get detail tranksaksi
const getDetailTransaksi = (id) => {
    $('#detil-transaksi-body').html(' ');
    $('#detil-transaksi-spinner').removeClass('d-none');
    
    axios
        .get(`${APIURL}/transaksi/getdata?id_transaksi=${id}`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            $('#detil-transaksi-spinner').addClass('d-none');
            let date = new Date(parseInt(response.data.data.date) * 1000);
            
            $('#detil-transaksi-date').html(`${date.toLocaleString("en-US",{day: "numeric"})}/${date.toLocaleString("en-US",{month: "numeric"})}/${date.toLocaleString("en-US",{year: "numeric"})}&nbsp;&nbsp;&nbsp;${date.toLocaleString("en-US",{hour: '2-digit', minute: '2-digit',second: '2-digit'})}`);
            $('#detil-transaksi-nama').html(response.data.data.nama_lengkap);
            $('#detil-transaksi-idnasabah').html(response.data.data.id_nasabah);
            $('#detil-transaksi-idtransaksi').html(response.data.data.id_transaksi);
            $('#detil-transaksi-type').html((response.data.data.type == 'setor')?response.data.data.type+' sampah':response.data.data.type+' saldo');
            $('#btn-cetak-transaksi').attr('href',`${BASEURL}/nasabah/cetaktransaksi/${response.data.data.id_transaksi}`);

            // tarik saldo
            if (response.data.data.type == 'tarik') {
                let jumlah = (response.data.data.jenis_saldo == 'uang')?'Rp '+modifUang(response.data.data.jumlah):response.data.data.jumlah+' gram';

                $('#detil-transaksi-body').html(`<div class="p-4 bg-secondary border-radius-sm">
                    <h4><strong>Jumlah</strong> : ${jumlah}</h4>
                </div>`);
            }
            // pindah saldo
            if (response.data.data.type == 'pindah') {
                let jumlah = (response.data.data.jenis_saldo == 'uang')?'Rp '+modifUang(response.data.data.jumlah):response.data.data.jumlah+' gram';
                let hasilKonversi = (response.data.data.asal !== 'uang')?'Rp '+modifUang(response.data.data.hasil_konversi):response.data.data.hasil_konversi+' gram';

                $('#detil-transaksi-body').html(`<div class="p-4 bg-secondary border-radius-sm">
                <table>
                    <tr class="text-dark">
                        <td>Saldo asal&nbsp;&nbsp;&nbsp;</td>
                        <td>: ${response.data.data.asal}</td>
                    </tr>
                    <tr class="text-dark">
                        <td>Saldo tujuan&nbsp;&nbsp;&nbsp;</td>
                        <td>: ${response.data.data.tujuan}</td>
                    </tr>
                    <tr class="text-dark">
                        <td>Jumlah&nbsp;&nbsp;&nbsp;</td>
                        <td>: ${jumlah}</td>
                    </tr>
                    <tr class="text-dark">
                        <td>Harga emas&nbsp;&nbsp;&nbsp;</td>
                        <td>: Rp ${modifUang(response.data.data.harga_emas)}</td>
                    </tr>
                    <tr class="text-dark">
                        <td>Hasil konversi&nbsp;&nbsp;&nbsp;</td>
                        <td>: ${hasilKonversi}</td>
                    </tr>
                </table>
                </div>`);
            }
            // setor sampah
            if (response.data.data.type == 'setor') {
                let trBody = '';
                let barang = response.data.data.barang;
                barang.forEach((b,i) => {
                    trBody += `<tr class="text-center">
                        <th scope="row">${++i}</th>
                        <td>${b.jenis}</td>
                        <td>${b.jumlah}</td>
                        <td>Rp ${modifUang(b.harga)}</td>
                    </tr>`;
                })

                $('#detil-transaksi-body').html(`<table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jenis sampah</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${trBody}
                    </tbody>
                </table>`);
            }
        })
        .catch((error) => {
            $('#detil-transaksi-spinner').addClass('d-none');
            // 500 server error
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>server error...</strong> gagal mendapatkan detail transaksi, silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

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
    $('#newpass-edit').val('');
    $('#oldpass-edit').val('');
});

// change kelamin value
$('#formEditProfile .form-check-input').on('click', function(e) {
    $(`#formEditProfile input[name=kelamin]`).val($(this).val());
    $('#formEditProfile .form-check-input').prop('checked',false);
    $(this).prop('checked',true);
});

// submit modal edit profile
$('#formEditProfile').on('submit', function(e) {
    e.preventDefault();
    let form = new FormData(e.target);

    if (validateFormEditProfile(form)) {
        let newTgl = form.get('tgl_lahir').split('-');
        form.set('tgl_lahir',`${newTgl[2]}-${newTgl[1]}-${newTgl[0]}`)

        if (form.get('new_password') == '') {
            form.delete('new_password');
        }

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
            $('#newpass-edit').val('');
            $('#oldpass-edit').val('');

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
                    $('#username-edit-error').text('*'+error.response.data.messages.username);
                }
                if (error.response.data.messages.notelp) {
                    $('#notelp-edit').addClass('is-invalid');
                    $('#notelp-edit-error').text('*'+error.response.data.messages.notelp);
                }
                if (error.response.data.messages.old_password) {
                    $('#oldpass-edit').addClass('is-invalid');
                    $('#oldpass-edit-error').text('*'+error.response.data.messages.old_password);
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
    else if (/\s/.test($('#username-edit').val())) {
        $('#username-edit').addClass('is-invalid');
        $('#username-edit-error').html('*tidak boleh ada spasi');
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
        else if (/\s/.test($('#newpass-edit').val())) {
            $('#newpass-edit').addClass('is-invalid');
            $('#newpass-edit-error').html('*tidak boleh ada spasi');
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