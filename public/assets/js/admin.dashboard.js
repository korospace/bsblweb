/**
 * GET TOTAL SAMPAH MASUK
 * =========================================================
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
 * GET SALDO NASABAH
 * ==============================================
 */
const getSaldoNasabah = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getsaldo`);
    
    if (httpResponse.status === 200) {
        let dataNasabah = httpResponse.data.data;

        $('#saldo-uang').html(modifUang(kFormatter(dataNasabah.uang.toString())));
        $('#saldo-ubs').html(parseFloat(dataNasabah.ubs).toFixed(2));
        $('#saldo-antam').html(parseFloat(dataNasabah.antam).toFixed(2));
        $('#saldo-galery24').html(parseFloat(dataNasabah.galery24).toFixed(2));
    }
};

/**
 * GET LAST TRANSACTION
 */
const getLastTransaksi = async () => {
    $('#transaksi-terbaru-notfound').addClass('d-none'); 
    $('#table-transaksi-terbaru').addClass('d-none'); 
    $('#transaksi-terbaru-spinner').removeClass('d-none'); 
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/lasttransaksi?limit=20`);
    $('#table-transaksi-terbaru').removeClass('d-none'); 
    $('#transaksi-terbaru-spinner').addClass('d-none'); 
    
    if (httpResponse.status === 404) {
        $('#transaksi-terbaru-notfound').removeClass('d-none'); 
        $('#transaksi-terbaru-notfound #text-notfound').html(`belum ada transaksi`); 
    }
    else if (httpResponse.status === 200) {
        let trTransaksi  = '';
        let allTransaksi = httpResponse.data.data;
    
        allTransaksi.forEach(t => {
            let date      = new Date(parseInt(t.date) * 1000);
            let hour      = date.toLocaleString("en-US",{ hour: 'numeric', minute: 'numeric' });
            // let minute    = date.toLocaleString("en-US",{minute: "numeric"});
            // let second    = date.toLocaleString("en-US",{second: "numeric"});
            let day       = date.toLocaleString("en-US",{day: "numeric"});
            let month     = date.toLocaleString("en-US",{month: "long"});
            let year      = date.toLocaleString("en-US",{year: "numeric"});
            let jenisTransaksi = (t.type == 'setor')?`${t.type} sampah`:`${t.type} saldo`;
            let color          = '';
            let jumlah         = '';

            if (t.type == 'setor') {
                color  = 'success';
                jumlah = `+ ${t.total_kg} kg`;
            } 
            else if (t.type == 'tarik') {
                color  = 'danger';
                jumlah = (t.jenis_saldo == 'uang')?`- Rp ${t.total_tarik}`:`- ${t.total_tarik} g`;
            } 
            else {
                color  = 'warning';
                jumlah = `<i class="fas fa-exchange-alt text-xxs"></i> Rp ${t.total_pindah}`;
            }

            trTransaksi += `<tr>
                <td class="align-middle text-sm">
                    <span class="text-xs text-name font-weight-bold"> 
                        ${t.id_transaksi}
                    </span>
                </td>
                <td class="align-middle text-sm">
                    <span class="text-xs text-name font-weight-bold">
                        ${t.nama_lengkap}
                    </span>
                </td>
                <td class="align-middle text-sm">
                    <span class="text-xxs text-name font-weight-bold badge border text-${color} border-${color} pb-1 rounded-sm" style="min-width:100px;max-width:100px;"> 
                        ${jenisTransaksi}
                    </span>
                </td>
                <td class="align-middle text-sm">
                    <span class="text-xs text-name font-weight-bold text-${color}"> 
                        ${jumlah}
                    </span>
                </td>
                <td class="align-middle text-sm">
                    <span class="text-xs text-name font-weight-bold">
                    ${day}/${month}/${year} ${hour}
                    </span>
                </td>
            </tr>`;
        });

        $('#table-transaksi-terbaru tbody').html(trTransaksi);
    }
};

// filter transaksi on change
let currentYear  = '';
$('.filter-transaksi').on('input', function(e) {
    chartGrafik.destroy();
    currentYear  = $(`#filter-year`).val();
    getRekapTransaksi(currentYear);
});

/**
 * GET REKAP TRANSAKSI
 */
const getRekapTransaksi = async (year) => {
    $('.spinner-wraper').removeClass('d-none');
    $('#transaksi-wraper').addClass('d-none');
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/rekapdata?year=${year}`);
    $('.spinner-wraper').addClass('d-none'); 
    $('#transaksi-wraper').removeClass('d-none');
    
    if (httpResponse.status === 404) {
        updateGrafikSetor([],[]);
        $('#transaksi-wraper').html(`<h6 class='opacity-6'>belum ada transaksi</h6>`); 
    }
    else if (httpResponse.status === 200) {
        let arrayMonth   = [];
        let arrayKg      = [];
        let elTransaksi  = '';
        let allTransaksi = httpResponse.data.data;

        for (const key in allTransaksi) {
            arrayMonth.push(key);
            arrayKg.push(allTransaksi[key].totSampahMasuk);
    
            elTransaksi  += `<li class="list-group-item border-0 p-0 border-radius-lg">
                <div class="d-flex align-items-center justify-content-between px-1">
                    <div class="d-flex flex-column" style="flex:1;">
                        <h6 class="text-dark font-weight-bold text-sm">${allTransaksi[key].date2}</h6>
                        <div class="d-flex w-100">
                            <table>
                                <tr>
                                    <td>
                                        <i class="fas fa-trash text-xs text-success mr-3">
                                            ${allTransaksi[key].totSampahMasuk} kg
                                        </i>
                                    </td>
                                    <td colspan="2">
                                        <i class="fas fa-dollar-sign text-xs text-success mr-3">
                                        Rp ${kFormatter(allTransaksi[key].totUangMasuk)}
                                        </i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-trash text-xs text-danger mr-3">
                                            ${allTransaksi[key].totSampahKeluar} kg
                                        </i>
                                    </td>
                                    <td>
                                        <i class="fas fa-dollar-sign text-xs text-danger mr-3">
                                            Rp ${kFormatter(allTransaksi[key].totUangKeluar)}
                                        </i>
                                    </td>
                                    <td>
                                        <i class="fas fa-coins text-xs text-danger mr-3">
                                            ${allTransaksi[key].totEmasKeluar} g
                                        </i>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="${BASEURL}/admin/cetakrekap/${allTransaksi[key].date1}" target="_blank" class="btn btn-link text-dark text-sm mb-0 px-0 h-100">
                        <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                    </a>
                </div>
                <hr class="horizontal dark">
            </li>`;
        }
        
        updateGrafikSetor(arrayMonth,arrayKg);
        $('#transaksi-wraper').html(`<ul class="list-group h-100 w-100" style="font-family: 'qc-medium';">
            ${elTransaksi}
        </ul>`);
    }
};

// update grafik setor
let chartGrafik = '';
const updateGrafikSetor = (arrayMonth,arrayKg) => {
    var ctx2       = document.getElementById("chart-line").getContext("2d");
    // let chartWidth = arrayId.length*160;
    document.querySelector("#chart-line").style.width    = '100%';
    document.querySelector("#chart-line").style.height   = '340px';
    document.querySelector("#chart-line").style.maxHeight= '340px';
    // document.querySelector("#chart-line").style.minWidth = `${chartWidth}px`;

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(193,217,102,0.2)');

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(193,217,102,0.2)');

    for (let i = arrayMonth.length; i <10; i++) {
        arrayMonth.push(' ');
    }

    chartGrafik = new Chart(ctx2, {
        type: "line",
        data: {
            labels: arrayMonth,
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
 * TRANSAKSI JUAL SAMPAH
 * =============================================
 */

// Edit modal when open
const openModalJualSampah = () => {
    $('.barisJualSampah').remove();
    tambahBaris();
    countTotalHarga();
    $('#formJualSampah .form-control').removeClass('is-invalid');
    $('#formJualSampah .text-danger').html('');
    $(`#formJualSampah .form-control`).val('');
}

// tambah baris
const tambahBaris = (event = false) => {
    if (event) {
        event.preventDefault();
    }

    let elJenisSampah = `<option value='' data-harga='0' data-tersedia='0' selected>-- pilih jenis sampah  --</option>`;

    if (arrayJenisSampah.length !== 0) {
        arrayJenisSampah.forEach(s=> {
            elJenisSampah += `<option value="${s.jenis}" data-harga="${s.harga}" data-tersedia="${s.jumlah}">${s.kategori} - ${s.jenis}</option>`;
        });
    }

    let totalBaris = $('.barisJualSampah').size();
    let elementRow = ` <td class="py-2" style="border-right: 0.5px solid #E9ECEF;">
        <span class="w-100 btn btn-danger d-flex justify-content-center align-items-center border-radius-sm" style="height: 38px;margin: 0;" onclick="hapusBaris(this);">
            <i class="fas fa-times text-white"></i>
        </span>
    </td>
    <td class="py-2" style="border-right: 0.5px solid #E9ECEF;">
        <select id="kategori-berita-wraper" class="inputJenisSampah form-control form-control-sm py-1 pl-2 border-radius-sm" name="transaksi[slot${totalBaris+1}][jenis_sampah]" style="min-height: 38px" onchange="getHargaInOption(this,event);">
            ${elJenisSampah}
        </select>
    </td>
    <td class="py-2 text-left" style="border-right: 0.5px solid #E9ECEF;">
        <input type="text" class="inputJumlahSampah form-control form-control-sm pl-2 border-radius-sm" value="0" name="transaksi[slot${totalBaris+1}][jumlah]" style="min-height: 38px" onkeyup="countHargaXjumlah(this);">

		<small class="text-danger"></small>
    </td>
    <td class="py-2">
        <input type="text" class="inputHargaSampah form-control form-control-sm pl-2 border-radius-sm" style="min-height: 38px" data-harga="0" value="0" disabled>
    </td>`

    let tr = document.createElement('tr');
    tr.classList.add('barisJualSampah');
    
    tr.innerHTML=elementRow;
    document.querySelector('#table-jual-sampah tbody').insertBefore(tr,document.querySelector('#special-tr'));
}

// tambah baris
const hapusBaris = (el) => {
    el.parentElement.parentElement.remove();
    countTotalHarga();
}

// get harga in option
const getHargaInOption = (el,event) =>{
    var harga    = event.target.options[event.target.selectedIndex].dataset.harga;
    var tersedia = event.target.options[event.target.selectedIndex].dataset.tersedia;

    let elInputJumlah   = el.parentElement.nextElementSibling.children[0];
    elInputJumlah.value = 1;
    elInputJumlah.setAttribute('data-tersedia',tersedia);
    elInputJumlah.classList.remove('is-invalid');
    elInputJumlah.nextElementSibling.innerHTML = '';

    let elInputHarga   = el.parentElement.nextElementSibling.nextElementSibling.children[0];
    // elInputHarga.value = modifUang(harga);
    elInputHarga.value = harga;
    elInputHarga.setAttribute('data-harga',harga);

    countTotalHarga();
};

// count harga*jumlah
const countHargaXjumlah = (el) =>{
    var jumlahKg = el.value;
    let elInputJenis = el.parentElement.previousElementSibling.children[0];
    
    if (elInputJenis.value !== '') {
        if (jumlahKg !== '') {
            let elInputHarga = el.parentElement.nextElementSibling.children[0];
            let harga        = elInputHarga.getAttribute('data-harga');
            
            elInputHarga.value = parseFloat(jumlahKg)*parseFloat(harga);
            countTotalHarga();
        }
    }
};

// count total harga sampah
const countTotalHarga = () =>{
    let total = 0;
    $(`.inputHargaSampah`).each(function() {
        total = total + parseFloat($(this).val());
    });

    $('#special-tr #total-harga').html(modifUang(total.toString()));
};

// Validate Jual sampah
const validateJualSampah = () => {
    let status = true;
    let msg    = '';
    $('#formJualSampah .form-control').removeClass('is-invalid');
    $('#formJualSampah .text-danger').html('');

    // tgl transaksi
    if ($('#formJualSampah #date').val() == '') {
        $('#formJualSampah #date').addClass('is-invalid');
        $('#formJualSampah #date-error').html('*tanggal harus di isi');
        status = false;
    }

    // jenis sampah
    $(`.inputJenisSampah`).each(function() {
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            status = false;
            msg    = 'input tidak boleh kosong!';
        }
    });
    // jumlah sampah
    $(`.inputJumlahSampah`).each(function() {
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            status = false;
            msg    = 'input tidak boleh kosong!';
        }
        if (/[^0-9\.]/g.test($(this).val())) {
            $(this).addClass('is-invalid');
            status = false;
            msg    = 'jumlah hanya boleh berupa angka positif dan titik!';
        }
        if (parseFloat($(this).val()) > parseFloat($(this).attr('data-tersedia'))) {
            $(this).addClass('is-invalid');
            $(this).siblings().html(`hanya tersedia ${$(this).attr('data-tersedia')} kg`);
            status = false;
        }
    });

    if (status == false && msg !== "") {
        showAlert({
            message: `<strong>${msg}</strong>`,
            btnclose: false,
            type:'danger'
        })
        setTimeout(() => {
            hideAlert();
        }, 3000);
    }

    return status;
}

// Send Transaksi to API
const doTransaksi = async (el,event) => {
    event.preventDefault();
    let elForm    = el.parentElement.parentElement.parentElement;

    if (validateJualSampah()) {
        Swal.fire({
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            html:`<h5 class='mb-4'>Password</h5>`,
            showCancelButton: true,
            confirmButtonText: 'submit',
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                let form = new FormData();
                form.append('hashedpass',PASSADMIN);
                form.append('password',password);
    
                return axios
                .post(`${APIURL}/admin/confirmdelete`,form, {
                    headers: {
                        // header options 
                    }
                })
                .then((response) => {
                    doTransaksiInner();
                })
                .catch(error => {
                    if (error.response.status == 404) {
                        Swal.showValidationMessage(
                            `password salah`
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
        
        let doTransaksiInner = async () => {
            let form         = new FormData(elForm);
            let tglTransaksi = form.get('date').split('-');
            form.set('date',`${tglTransaksi[2]}-${tglTransaksi[1]}-${tglTransaksi[0]}`);
    
            showLoadingSpinner();
            httpResponse = await httpRequestPost(`${APIURL}/transaksi/jualsampah`,form);    
            hideLoadingSpinner();
    
            if (httpResponse.status === 201) {
                chartGrafik.destroy();
                $(`#formJualSampah .form-control`).val('');
                $('#formJualSampah .form-check-input').prop('checked',false);
                $(`#filter-year`).val(tglTransaksi[0]);
                getRekapTransaksi(tglTransaksi[0]);
    
                $('#formJualSampah .barisJualSampah').remove();
                tambahBaris();
                countTotalHarga();
                getAllJenisSampah();
    
                showAlert({
                    message: `<strong>Success...</strong> jual sampah berhasil!`,
                    btnclose: false,
                    type:'success'
                })
                setTimeout(() => {
                    hideAlert();
                }, 3000);
            }
        }
    }

}