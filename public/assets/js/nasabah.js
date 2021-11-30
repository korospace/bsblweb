
/**
 * SESSION CHECK
 * ================================
 */
const sessioncheck = async () => {
    showLoadingSpinner();
    let httpResponse = await httpRequestGet(`${APIURL}/nasabah/sessioncheck`);
    hideLoadingSpinner();

    // update value filter transkasi
    // let currentMonth = new Date().toLocaleString("en-US",{month: "numeric"});
    // let currentYear  = new Date().toLocaleString("en-US",{year: "numeric"});
    // $(`#filter-month option[value=${currentMonth}]`).attr('selected','selected');
    // $(`#filter-year`).val(currentYear);

    if (httpResponse.status === 200) {
        getSampahMasuk();
        updateGrafikSetorNasabah();
        getHistoriTransaksi();
        getDataSaldo();
        getAllJenisSampah();
        getDataProfile();
    }
};

sessioncheck();

/**
 * GET SAMPAH MASUK
 * ==================================
 */
const getSampahMasuk = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/sampahmasuk`);

    if (httpResponse.status === 200) {
        let dataSampah = httpResponse.data.data;

        dataSampah.forEach(ds => {
            $(`#sampah-${ds.kategori}`).html(ds.total+' Kg');
        });    
    }
};

/**
 * FILTER TRANSACTION Section
 * =========================================================
 */

// modal filter transaksi is open
let openModalFilterT = (modalTitle) =>  {
    $('#formFilterTransaksi .modal-title').html(modalTitle);
}

const filterTransaksi = async (e) => {
    let formFilter = new FormData(e.parentElement.parentElement.parentElement);
    let startDate  = formFilter.get('date-start').split('-');
    let endDate    = formFilter.get('date-end').split('-');

    if ($('#formFilterTransaksi .modal-title').html() == 'Filter Histori') {
        dateStartHistori = `${startDate[2]}-${startDate[1]}-${startDate[0]}`;
        dateEndHistori   = `${endDate[2]}-${endDate[1]}-${endDate[0]}`;
        $('#btn-filter-histori #startdate').html(`${startDate[2]}/${startDate[1]}/${startDate[0]}`);
        $('#btn-filter-histori #enddate').html(`${endDate[2]}/${endDate[1]}/${endDate[0]}`);
        getHistoriTransaksi();
    } 
    else {
        dateStartGrafik = `${startDate[2]}-${startDate[1]}-${startDate[0]}`;
        dateEndGrafik   = `${endDate[2]}-${endDate[1]}-${endDate[0]}`;
        $('#btn-filter-grafik #startdate').html(`${startDate[2]}/${startDate[1]}/${startDate[0]}`);
        $('#btn-filter-grafik #enddate').html(`${endDate[2]}/${endDate[1]}/${endDate[0]}`);
        updateGrafikSetorNasabah();
    }
};

// set current start and end DATE
let dateStartGrafik  = '';
let dateEndGrafik    = '';
let dateStartHistori = '';
let dateEndHistori   = '';
let setCurrentStartDate = () =>  {
    let currentUnixTime = new Date(new Date().getTime());
    let currentDay   = currentUnixTime.toLocaleString("en-US",{day: "numeric"});
    let currentMonth = currentUnixTime.toLocaleString("en-US",{month: "numeric"});
    let currentYear  = currentUnixTime.toLocaleString("en-US",{year: "numeric"});

    let previousUnixTime = new Date(currentUnixTime.getTime()-(86400*30*1000));
    let previousDay   = previousUnixTime.toLocaleString("en-US",{day: "numeric"});
    let previousMonth = previousUnixTime.toLocaleString("en-US",{month: "numeric"});
    let previousYear  = previousUnixTime.toLocaleString("en-US",{year: "numeric"});

    dateStartGrafik  = `${previousDay}-${previousMonth}-${previousYear}`;
    dateEndGrafik    = `${currentDay}-${currentMonth}-${currentYear}`;
    dateStartHistori = `${previousDay}-${previousMonth}-${previousYear}`;
    dateEndHistori   = `${currentDay}-${currentMonth}-${currentYear}`;

    $('#btn-filter-grafik #startdate').html(`${previousDay}/${previousMonth}/${previousYear}`);
    $('#btn-filter-grafik #enddate').html(`${currentDay}/${currentMonth}/${currentYear}`);
    $('#btn-filter-histori #startdate').html(`${previousDay}/${previousMonth}/${previousYear}`);
    $('#btn-filter-histori #enddate').html(`${currentDay}/${currentMonth}/${currentYear}`);
    
    $('#formFilterTransaksi #date-start').val(`${previousYear}-${previousMonth}-${previousDay}`);
    $('#formFilterTransaksi #date-end').val(`${currentYear}-${currentMonth}-${currentDay}`);
}

setCurrentStartDate();

/**
 * UPDATE GRAFIK SETOR
 * ========================================
 */
let chartGrafik = '';
const updateGrafikSetorNasabah = async () => {

    $('#spinner-wraper-grafik').removeClass('d-none');
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getdata?start=${dateStartGrafik}&end=${dateEndGrafik}`);
    $('#spinner-wraper-grafik').addClass('d-none'); 
    let arrayId = [];
    let arrayKg = [];
    
    if (httpResponse.status === 200) {
        let allTransaksi = httpResponse.data.data;
        
        allTransaksi.forEach(t => {
            if (t.jenis_transaksi == 'penyetoran sampah') {
                arrayId.push(t.id_transaksi);
                arrayKg.push(t.total_kg_setor);
            } 
        });
    }
    if (chartGrafik != '') {
        chartGrafik.destroy();
    }

    var ctx2 = document.getElementById("chart-line").getContext("2d");
    document.querySelector("#chart-line").style.width    = '100%';
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
                    maxBarThickness: 6,
                    minBarLength: 6,
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
                    beginAtZero: true,
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
 * GET ALL TRANSAKSI NASABAH
 * ========================================
 */
const getHistoriTransaksi = async () => {
    $('#spinner-wraper-histori').removeClass('d-none');
    $('#transaksi-wraper-histori').addClass('d-none');
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getdata?start=${dateStartHistori}&end=${dateEndHistori}`);
    $('#spinner-wraper-histori').addClass('d-none'); 
    $('#transaksi-wraper-histori').removeClass('d-none');
    
    if (httpResponse.status === 404) {
        $('#transaksi-wraper-histori').html(`<h6 class='opacity-6'>belum ada transaksi</h6>`); 
    }
    else if (httpResponse.status === 200) {
        let elTransaksi  = '';
        let allTransaksi = httpResponse.data.data;
        
        allTransaksi.forEach(t => {
            let textClass      = '';
            let totalTransaksi = '';
            let jenisTransaksi = t.jenis_transaksi;
            let jenisSaldo     = t.jenis_saldo;
            let date      = new Date(parseInt(t.date) * 1000);
            let day       = date.toLocaleString("en-US",{day: "numeric"});
            let month     = date.toLocaleString("en-US",{month: "long"});
            let year      = date.toLocaleString("en-US",{year: "numeric"});

            // const zeroPad = (num, places) => String(num).padStart(places, '0');
            // const xMonth  = zeroPad(date.toLocaleString("en-US",{month: "numeric"}), 2);
            // const yMonth  = dateFilter.split('-');
            
            if (jenisTransaksi == 'penyetoran sampah') {
                textClass      = 'text-success';
                totalTransaksi = '+ Rp'+modifUang(t[`total_uang_setor`]);
                
                // arrayId.push(t.id_transaksi);
                // arrayKg.push(t.total_kg);
            } 
            else if (jenisTransaksi == 'konversi saldo') {
                textClass      = 'text-warning';
                totalTransaksi = 'Rp'+modifUang(kFormatter(t[`total_pindah`]))+' <i class="fas fa-exchange-alt"></i> '+parseFloat(t[`hasil_konversi`]).toFixed(2)+'g';
            }
            else {
                textClass = 'text-danger';
                if (jenisSaldo == 'uang') {
                    totalTransaksi = '- Rp'+modifUang(t[`total_tarik`]);
                } 
                else {
                    totalTransaksi = '- '+t[`total_tarik`]+'g';
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
                        <a href='' class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"  data-toggle="modal" data-target="#modalPrintTransaksi" onclick="getDetailTransaksiNasabah('${t.id_transaksi}');">
                            <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                        </a>
                    </div>
                </div>
                <hr class="horizontal dark mt-2">
            </li>`;
        });

        // updateGrafikSetorNasabah(arrayId,arrayKg);
        $('#transaksi-wraper-histori').html(`<ul class="list-group h-100 w-100" style="font-family: 'qc-medium';">
            ${elTransaksi}
        </ul>`);
    }
};

/**
 * GET DETAIL TRANSAKSI
 * ==============================================
 */
const getDetailTransaksiNasabah = async (id) => {
    $('#detil-transaksi-body').html(' ');
    $('#detil-transaksi-spinner').removeClass('d-none');
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getdata?id_transaksi=${id}`);
    
    if (httpResponse.status === 200) {
        $('#detil-transaksi-spinner').addClass('d-none');
        let date  = new Date(parseInt(httpResponse.data.data.date) * 1000);
        let day   = date.toLocaleString("en-US",{day: "numeric"});
        let month = date.toLocaleString("en-US",{month: "numeric"});
        let year  = date.toLocaleString("en-US",{year: "numeric"});
        let time  = date.toLocaleString("en-US",{hour: '2-digit', minute: '2-digit',second: '2-digit'});
        
        $('#detil-transaksi-date').html(`${day}/${month}/${year}&nbsp;&nbsp;&nbsp;${time}`);
        $('#detil-transaksi-nama').html(httpResponse.data.data.nama_lengkap);
        $('#detil-transaksi-idnasabah').html(httpResponse.data.data.id_user);
        $('#detil-transaksi-idtransaksi').html(httpResponse.data.data.id_transaksi);
        $('#detil-transaksi-type').html(httpResponse.data.data.jenis_transaksi);
        $('#btn-cetak-transaksi').attr('href',`${BASEURL}/nasabah/cetaktransaksi/${httpResponse.data.data.id_transaksi}`);

        // tarik saldo
        if (httpResponse.data.data.jenis_transaksi == 'penarikan saldo') {
            let jenisSaldo = httpResponse.data.data.jenis_saldo;
            let jumlah     = (jenisSaldo == 'uang')?'Rp '+modifUang(httpResponse.data.data.jumlah_tarik):httpResponse.data.data.jumlah_tarik+' gram';

            $('#detil-transaksi-body').html(`<div class="p-4 bg-secondary border-radius-sm">
                <table>
                    <tr class="text-dark">
                        <td><h4>Jenis saldo&nbsp;</h4></td>
                        <td>
                            <h4>
                            : &nbsp;&nbsp;${(jenisSaldo == 'uang') ? jenisSaldo : 'emas '+jenisSaldo}
                            </h4>
                        </td>
                    </tr>
                    <tr class="text-dark">
                        <td><h4>Jumlah</h4></td>
                        <td><h4>: &nbsp;&nbsp;${jumlah}</h4></td>
                    </tr>
                </table>
            </div>`);
        }
        // konversi saldo
        if (httpResponse.data.data.jenis_transaksi == 'konversi saldo') {
            $('#detil-transaksi-body').html(`<div class="p-4 bg-secondary border-radius-sm">
            <table>
                <tr class="text-dark">
                    <td>Saldo tujuan</td>
                    <td>: &nbsp;&nbsp;${httpResponse.data.data.saldo_tujuan}</td>
                </tr>
                <tr class="text-dark">
                    <td>Jumlah</td>
                    <td>: &nbsp;&nbsp;Rp ${modifUang(httpResponse.data.data.jumlah)}</td>
                </tr>
                <tr class="text-dark">
                    <td>Harga emas</td>
                    <td>: &nbsp;&nbsp;Rp ${modifUang(httpResponse.data.data.harga_emas)}</td>
                </tr>
                <tr class="text-dark">
                    <td>Hasil konversi&nbsp;</td>
                    <td>
                        : &nbsp;&nbsp;${parseFloat(httpResponse.data.data.hasil_konversi).toFixed(4)} g
                    </td>
                </tr>
            </table>
            </div>`);
        }
        // setor sampah
        if (httpResponse.data.data.jenis_transaksi == 'penyetoran sampah') {
            let totalRp= 0;
            let trBody = '';
            let barang = httpResponse.data.data.barang;
            barang.forEach((b,i) => {
                totalRp += parseFloat(b.jumlah_rp);
                trBody  += `<tr class="text-center">
                    <th scope="row">${++i}</th>
                    <td>${b.jenis}</td>
                    <td>${b.jumlah_kg} kg</td>
                    <td class="text-left">Rp ${modifUang(b.jumlah_rp)}</td>
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
                    <tr>
                        <th class="text-center" colspan='3'>Total</th>
                        <td class="text-left">Rp ${modifUang(totalRp.toString())}</td>
                    </tr>
                </tbody>
            </table>`);
        }
    }
};

/**
 * GET DATA SALDO
 * ===============================================
 */
const getDataSaldo = async () => {
    $('#saldo-uang').html('_ _');
    $('#saldo-ubs').html('_ _');
    $('#saldo-antam').html('_ _');
    $('#saldo-galery24').html('_ _');

    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getsaldo`);
    
    if (httpResponse.status === 200) {
        let dataNasabah = httpResponse.data.data;

        $('#saldo-uang').html(modifUang(dataNasabah.uang.toString()));
        $('#saldo-ubs').html(parseFloat(dataNasabah.ubs).toFixed(4));
        $('#saldo-antam').html(parseFloat(dataNasabah.antam).toFixed(4));
        $('#saldo-galery24').html(parseFloat(dataNasabah.galery24).toFixed(4));
    }
};

/**
 * GET ALL JENIS SAMPAH
 * ===============================================
 */
const getAllJenisSampah = async () => {
    $('#list-sampah-notfound').addClass('d-none'); 
    $('#table-jenis-sampah').addClass('d-none'); 
    $('#list-sampah-spinner').removeClass('d-none'); 
    let httpResponse = await httpRequestGet(`${APIURL}/sampah/getsampah`);
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
 * DATA PROFILE
 * ===============================================
 */

let dataNasabah = '';

// get data
const getDataProfile = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/nasabah/getprofile`);
    
    if (httpResponse.status === 200) {
        dataNasabah = httpResponse.data.data;
        
        if (pageTitle2 == 'dashboard') {
            updateNasabahCard(dataNasabah);
        }
        else if (pageTitle2 == 'profile') {
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

/**
 * EDIT PROFILE 
 * =============================================
 */

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

// submit form
$('#formEditProfile').on('submit', async function(e) {
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
        httpResponse = await httpRequestPut(`${APIURL}/nasabah/editprofile`,form);
        $('#formEditProfile button#submit #text').removeClass('d-none');
        $('#formEditProfile button#submit #spinner').addClass('d-none');

        if (httpResponse.status === 201) {
            if (form.get('new_password') != '') {
                $('#newpass-edit').val('');
                $('#oldpass-edit').val('');
            }

            let newDataProfile = {};
            for (var pair of form.entries()) {
                newDataProfile[pair[0]] = pair[1];
            }

            dataNasabah = newDataProfile;
            updatePersonalInfo(newDataProfile);

            showAlert({
                message: `<strong>Success...</strong> edit profile berhasil!`,
                autohide: true,
                type:'success'
            })
        }
        else if (httpResponse.status === 400) {
           if (httpResponse.message.username) {
               $('#username-edit').addClass('is-invalid');
               $('#username-edit-error').text('*'+httpResponse.message.username);
           }
           if (httpResponse.message.notelp) {
               $('#notelp-edit').addClass('is-invalid');
               $('#notelp-edit-error').text('*'+httpResponse.message.notelp);
           }
           if (httpResponse.message.old_password) {
               $('#oldpass-edit').addClass('is-invalid');
               $('#oldpass-edit-error').text('*'+httpResponse.message.old_password);
           }
        }
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
