let pageTitle   = document.title.replace(/\s/g,'').split('|');
let dataNasabah = '';

/**
 * API REQUEST GET
 */
const httpRequestGet = (url) => {

    return axios
        .get(url,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            return {
                'status':200,
                'data':response.data
            };
        })
        .catch((error) => {
            // 401 Unauthorized
            if (error.response.status == 401) {
                if (error.response.data.messages == 'token expired') {
                    Swal.fire({
                        icon : 'error',
                        title : '<strong>LOGIN EXPIRED</strong>',
                        text: 'silahkan login ulang untuk perbaharui login anda',
                        showCancelButton: false,
                        confirmButtonText: 'ok',
                    }).then(() => {
                        window.location.replace(`${BASEURL}/login`);
                        document.cookie = `token=null;expires=;path=/;`;
                    })
                }
                else{
                    window.location.replace(`${BASEURL}/login`);
                    document.cookie = `token=null;expires=;path=/;`;
                }
            }
            else if (error.response.status == 404) {
                return {'status':404};
            }
            // server error
            else{
                showAlert({
                    message: `<strong>Ups...</strong> terjadi kesalahan pada server, silahkan refresh halaman.`,
                    btnclose: true,
                    type:'danger' 
                })
            }

        })
};

/**
 * SESSION CHECK
 */
const sessioncheck = async () => {
    showLoadingSpinner();
    let httpResponse = await httpRequestGet(`${APIURL}/nasabah/sessioncheck`);
    hideLoadingSpinner();

    // update value filter transkasi
    let currentMonth = new Date().toLocaleString("en-US",{month: "numeric"});
    let currentYear  = new Date().toLocaleString("en-US",{year: "numeric"});
    $(`#filter-month option[value=${currentMonth}]`).attr('selected','selected');
    $(`#filter-year`).val(currentYear);

    if (httpResponse.status === 200) {
        if (pageTitle[1] === 'dashboard') {
            getTotalSampah();
            getAllTransaksi(`${currentMonth}-${currentYear}`);
            getDataSaldo();
            getDataProfile();
            getAllJenisSampah();
        }
        if (pageTitle[1] === 'profile') {
            getDataProfile();
        }
    }

};

sessioncheck();

/**
 * GET TOTAL SAMPAH
 */
const getTotalSampah = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/sampah/totalitem`);

    if (httpResponse.status === 200) {
        let dataSampah = httpResponse.data.data;

        for (const name in dataSampah) {
            $(`#sampah-${name}`).html(dataSampah[name].total+' Kg');
        }   
    }
};

// filter transaksi on change
$('.filter-transaksi').on('input', function(e) {
    if ($(`#filter-year`).val().length == 4) {
        chartGrafik.destroy();
        getAllTransaksi(`${$(`#filter-month`).val()}-${$(`#filter-year`).val()}`);
    }
});

/**
 * GET ALL TRANSAKSI
 */
const getAllTransaksi = async (date) => {
    $('.spinner-wraper').removeClass('d-none');
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getdata?date=${date}`);
    $('.spinner-wraper').addClass('d-none');
    
    if (httpResponse.status === 404) {
        updateGrafikSetor([],[]);
        $('#transaksi-wraper').html(`<h6 class='opacity-6'>belum ada transaksi</h6>`); 
    }
    else if (httpResponse.status === 200) {
        let arrayId      = [];
        let arrayKg      = [];
        let elTransaksi  = '';
        let allTransaksi = httpResponse.data.data;
        
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
                    totalTransaksi = '<i class="fas fa-exchange-alt"></i> Rp'+modifUang(t[`total_${type}`]);
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
        $('#transaksi-wraper').html(`<ul class="list-group h-100 w-100" style="font-family: 'qc-medium';">
            ${elTransaksi}
        </ul>`);
    }
};

// modif saldo uang
const modifUang = (rHarga) => {
    return rHarga.replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");;
}

// update grafik setor
let chartGrafik = '';
const updateGrafikSetor = (arrayId,arrayKg) => {
    var ctx2 = document.getElementById("chart-line").getContext("2d");
    // let chartWidth = arrayId.length*160;
    // document.querySelector("#chart-line").style.minWidth = `${chartWidth}px`;
    document.querySelector("#chart-line").style.width    = '100%';
    document.querySelector("#chart-line").style.minHeight= '100%';
    document.querySelector("#chart-line").style.maxHeight= '300px';

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(193,217,102,0.2)');

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(193,217,102,0.2)');

    for (let i = arrayId.length; i <10; i++) {
        arrayId.push(' ');
    }

    chartGrafik = new Chart(ctx2, {
        type: "bar",
        data: {
            labels: arrayId,
            datasets: [
                {
                    label: "Kg",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#c1d966",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: arrayKg,
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

/**
 * GET DETAIL TRANSAKSI
 */
const getDetailTransaksi = async (id) => {
    $('#detil-transaksi-body').html(' ');
    $('#detil-transaksi-spinner').removeClass('d-none');
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getdata?id_transaksi=${id}`);
    
    if (httpResponse.status === 200) {
        $('#detil-transaksi-spinner').addClass('d-none');
        let date = new Date(parseInt(httpResponse.data.data.date) * 1000);
        
        $('#detil-transaksi-date').html(`${date.toLocaleString("en-US",{day: "numeric"})}/${date.toLocaleString("en-US",{month: "numeric"})}/${date.toLocaleString("en-US",{year: "numeric"})}&nbsp;&nbsp;&nbsp;${date.toLocaleString("en-US",{hour: '2-digit', minute: '2-digit',second: '2-digit'})}`);
        $('#detil-transaksi-nama').html(httpResponse.data.data.nama_lengkap);
        $('#detil-transaksi-idnasabah').html(httpResponse.data.data.id_nasabah);
        $('#detil-transaksi-idtransaksi').html(httpResponse.data.data.id_transaksi);
        $('#detil-transaksi-type').html((httpResponse.data.data.type == 'setor')?httpResponse.data.data.type+' sampah':httpResponse.data.data.type+' saldo');
        $('#btn-cetak-transaksi').attr('href',`${BASEURL}/nasabah/cetaktransaksi/${httpResponse.data.data.id_transaksi}`);

        // tarik saldo
        if (httpResponse.data.data.type == 'tarik') {
            let jumlah = (httpResponse.data.data.jenis_saldo == 'uang')?'Rp '+modifUang(httpResponse.data.data.jumlah):httpResponse.data.data.jumlah+' gram';

            $('#detil-transaksi-body').html(`<div class="p-4 bg-secondary border-radius-sm">
                <h4><strong>Jumlah</strong> : ${jumlah}</h4>
            </div>`);
        }
        // pindah saldo
        if (httpResponse.data.data.type == 'pindah') {
            let jumlah = (httpResponse.data.data.jenis_saldo == 'uang')?'Rp '+modifUang(httpResponse.data.data.jumlah):httpResponse.data.data.jumlah+' gram';
            let hasilKonversi = (httpResponse.data.data.asal !== 'uang')?'Rp '+modifUang(httpResponse.data.data.hasil_konversi):httpResponse.data.data.hasil_konversi+' gram';

            $('#detil-transaksi-body').html(`<div class="p-4 bg-secondary border-radius-sm">
            <table>
                <tr class="text-dark">
                    <td>Saldo asal&nbsp;&nbsp;&nbsp;</td>
                    <td>: ${httpResponse.data.data.asal}</td>
                </tr>
                <tr class="text-dark">
                    <td>Saldo tujuan&nbsp;&nbsp;&nbsp;</td>
                    <td>: ${httpResponse.data.data.tujuan}</td>
                </tr>
                <tr class="text-dark">
                    <td>Jumlah&nbsp;&nbsp;&nbsp;</td>
                    <td>: ${jumlah}</td>
                </tr>
                <tr class="text-dark">
                    <td>Harga emas&nbsp;&nbsp;&nbsp;</td>
                    <td>: Rp ${modifUang(httpResponse.data.data.harga_emas)}</td>
                </tr>
                <tr class="text-dark">
                    <td>Hasil konversi&nbsp;&nbsp;&nbsp;</td>
                    <td>: ${hasilKonversi}</td>
                </tr>
            </table>
            </div>`);
        }
        // setor sampah
        if (httpResponse.data.data.type == 'setor') {
            let trBody = '';
            let barang = httpResponse.data.data.barang;
            barang.forEach((b,i) => {
                trBody += `<tr class="text-center">
                    <th scope="row">${++i}</th>
                    <td>${b.jenis_sampah}</td>
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
    }
};

/**
 * GET DATA SALDO
 */
const getDataSaldo = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/nasabah/getsaldo`);

    if (httpResponse.status === 200) {
        $('#saldo-uang').html(modifUang(httpResponse.data.data.uang));
        $('#saldo-ubs').html(parseFloat(httpResponse.data.data.ubs).toFixed(4));
        $('#saldo-antam').html(parseFloat(httpResponse.data.data.antam).toFixed(4));
        $('#saldo-galery24').html(parseFloat(httpResponse.data.data.galery24).toFixed(4));
    }
};

/**
 * GET ALL JENIS SAMPAH
 */
 const getAllJenisSampah = async () => {
 
     $('#search-sampah').val('');
     $('#list-sampah-notfound').addClass('d-none'); 
     $('#table-jenis-sampah').addClass('d-none'); 
     $('#list-sampah-spinner').removeClass('d-none'); 
     let httpResponse = await httpRequestGet(`${APIURL}/sampah/getitem`);
     $('#table-jenis-sampah').removeClass('d-none'); 
     $('#list-sampah-spinner').addClass('d-none'); 
     
     if (httpResponse.status === 404) {
         $('#list-sampah-notfound').removeClass('d-none'); 
         $('#list-sampah-notfound #text-notfound').html(`jenis sampah belum ditambah`); 
     }
     else if (httpResponse.status === 200) {
         let trJenisSampah  = '';
         let allJenisSampah = sortingSampah(httpResponse.data.data);
         arrayJenisSampah   = allJenisSampah;
        
         allJenisSampah.forEach((n,i) => {
 
             trJenisSampah += `<tr class="text-xs">
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold"> ${++i} </span>
                 </td>
                 <td class="align-middle text-center">
                     <span class="font-weight-bold"> ${n.kategori} </span>
                 </td>
                 <td class="align-middle text-center">
                    ${n.jenis}
                 </td>
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold">Rp. ${modifUang(n.harga)} </span>
                 </td>
             </tr>`;
         });
 
         $('#table-jenis-sampah tbody').html(trJenisSampah);
     }
 };

// sorting sampah
const sortingSampah = (data) => {
    let arrKategori = [];
    let objSampah   = {};
    let newArrSampah= [];
    
    // create array kategori
    data.forEach(d => {
        if (!arrKategori.includes(d.kategori)) {
            arrKategori.push(d.kategori.replace(/\s/g,'_'));
        }
    });

    arrKategori.forEach(aK => {
        objSampah[aK] = data.filter((d) => {
            return d.kategori == aK.replace(/_/g,' ');
        })
    });

    for (let key in objSampah) {
        objSampah[key].forEach(x => {
            newArrSampah.push(x);
        });
    }

    return newArrSampah;
}

/**
 * GET DATA PROFILE
 */
const getDataProfile = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/nasabah/getprofile`);
    
    if (httpResponse.status === 200) {
        dataNasabah = httpResponse.data.data;
        
        if (pageTitle[1] == 'dashboard') {
            updateNasabahCard(dataNasabah);
        }
        else if (pageTitle[1] == 'profile') {
            updatePersonalInfo(dataNasabah);
        }
    }
};

// update nasabah card
const updateNasabahCard = (data) => {
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
    $('#profile-spinner').addClass('d-none');

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

/**
 * EDIT PROFILE PROFILE
 */
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

/**
 * LOGOUT
 */
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