
/**
 * GET TOTAL SAMPAH NASABAH
 */
 const getTotalSampahNasabah = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/sampah/totalitem?idnasabah=${IDNASABAH}`);

    if (httpResponse.status === 200) {
        let dataSampah = httpResponse.data.data;

        for (const name in dataSampah) {
            $(`#sampah-${name}`).html(dataSampah[name].total+' Kg');
        }   
    }
};

// filter transaksi on change
let currentYear  = '';
let currentMonth = '';
$('.filter-transaksi').on('input', function(e) {
    if ($(`#filter-year`).val().length == 4) {
        chartGrafik.destroy();
        currentYear  = $(`#filter-year`).val();
        currentMonth = $(`#filter-month`).val();
        getAllTransaksiNasabah(`${currentMonth}-${currentYear}`);
    }
});

/**
 * GET ALL TRANSAKSI NASABAH
 */
const getAllTransaksiNasabah = async (date) => {
    $('.spinner-wraper').removeClass('d-none');
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getdata?idnasabah=${IDNASABAH}&date=${date}`);
    $('.spinner-wraper').addClass('d-none'); 
    
    if (httpResponse.status === 404) {
        updateGrafikSetorNasabah([],[]);
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
                    totalTransaksi = '-'+t[`total_${type}`]+'g';
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
                    <a href='' class="btn btn-link text-dark text-sm mb-0 p-2 text-sm bg-info border-radius-sm"  data-toggle="modal" data-target="#modalPrintTransaksi" onclick="getDetailTransaksiNasabah('${t.id_transaksi}');">
                        <i class="fas fa-file-pdf text-xs text-white"></i>
                    </a>
                    <a href='' class="btn btn-link text-dark text-sm mb-0 p-2 ml-1 text-sm bg-danger border-radius-sm" onclick="deleteTransaksiNasabah('${t.id_transaksi}',event);">
                        <i class="fas fa-trash text-xs text-white"></i>
                    </a>
                </div>
            </div>
            <hr class="horizontal dark mt-2">
        </li>`;
        });

        updateGrafikSetorNasabah(arrayId,arrayKg);
        $('#transaksi-wraper').html(`<ul class="list-group h-100 w-100" style="font-family: 'qc-medium';">
            ${elTransaksi}
        </ul>`);
    }
};

// update grafik setor
let chartGrafik = '';
const updateGrafikSetorNasabah = (arrayId,arrayKg) => {
    var ctx2       = document.getElementById("chart-line").getContext("2d");
    // let chartWidth = arrayId.length*160;
    document.querySelector("#chart-line").style.width    = '100%';
    document.querySelector("#chart-line").style.maxHeight= '300px';
    // document.querySelector("#chart-line").style.minWidth = `${chartWidth}px`;

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
 * GET DETAIL TRANSAKSI
 */
const getDetailTransaksiNasabah = async (id) => {
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
            let jenisSaldo = httpResponse.data.data.jenis_saldo;
            let jumlah     = (jenisSaldo == 'uang')?'Rp '+modifUang(httpResponse.data.data.jumlah):httpResponse.data.data.jumlah+' gram';


            $('#detil-transaksi-body').html(`<div class="p-4 bg-secondary border-radius-sm">
                <table>
                    <tr class="text-dark">
                        <td><h4>Jenis saldo&nbsp;</h4></td>
                        <td><h4>: &nbsp;&nbsp;${(jenisSaldo == 'uang') ? jenisSaldo : 'emas '+jenisSaldo}</h4></td>
                    </tr>
                    <tr class="text-dark">
                        <td><h4>Jumlah</h4></td>
                        <td><h4>: &nbsp;&nbsp;${jumlah}</h4></td>
                    </tr>
                </table>
            </div>`);
        }
        // pindah saldo
        if (httpResponse.data.data.type == 'pindah') {
            let jumlah = (httpResponse.data.data.jenis_saldo == 'uang')?'Rp '+modifUang(httpResponse.data.data.jumlah):httpResponse.data.data.jumlah+' gram';
            let hasilKonversi = (httpResponse.data.data.asal !== 'uang')?'Rp '+modifUang(httpResponse.data.data.hasil_konversi):httpResponse.data.data.hasil_konversi+' gram';

            $('#detil-transaksi-body').html(`<div class="p-4 bg-secondary border-radius-sm">
            <table>
                <tr class="text-dark">
                    <td>Saldo asal</td>
                    <td>: &nbsp;&nbsp;${httpResponse.data.data.asal}</td>
                </tr>
                <tr class="text-dark">
                    <td>Saldo tujuan</td>
                    <td>: &nbsp;&nbsp;${httpResponse.data.data.tujuan}</td>
                </tr>
                <tr class="text-dark">
                    <td>Jumlah</td>
                    <td>: &nbsp;&nbsp;${jumlah}</td>
                </tr>
                <tr class="text-dark">
                    <td>Harga emas</td>
                    <td>: &nbsp;&nbsp;Rp ${modifUang(httpResponse.data.data.harga_emas)}</td>
                </tr>
                <tr class="text-dark">
                    <td>Hasil konversi&nbsp;</td>
                    <td>: &nbsp;&nbsp;${hasilKonversi}</td>
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
 * GET DATA PROFILE NASABAH
 */
const getDataProfileNasabah = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/admin/getnasabah?id=${IDNASABAH}`);
    
    if (httpResponse.status == 404) {
        Swal.fire({
            icon : 'error',
            title : '<strong>NOT FOUND</strong>',
            text: `nasabah dengan id ${IDNASABAH} tidak ditemukan!`,
            showCancelButton: false,
            confirmButtonText: 'ok',
        }).then(() => {
            window.location.replace(`${BASEURL}/admin/listnasabah`);
        })
    }
    if (httpResponse.status === 200) {
        let dataNasabah = httpResponse.data.data;
        let date        = new Date(parseInt(dataNasabah.created_at) * 1000);

        // -- nasabah card --
        $('#card-id').html(`${dataNasabah.id.slice(0, 5)}&nbsp;&nbsp;&nbsp;${dataNasabah.id.slice(5, 9)}&nbsp;&nbsp;&nbsp;${dataNasabah.id.slice(9,99999999)}`);
        $('#card-username').html(dataNasabah.username);
        $('#card-date').html(`${date.toLocaleString("en-US",{day: "numeric"})}/${date.toLocaleString("en-US",{month: "numeric"})}/${date.toLocaleString("en-US",{year: "numeric"})}`);

        // -- saldo --
        $('#saldo-uang').html(modifUang(dataNasabah.saldo_uang));
        $('#saldo-ubs').html(parseFloat(dataNasabah.saldo_ubs).toFixed(4));
        $('#saldo-antam').html(parseFloat(dataNasabah.saldo_antam).toFixed(4));
        $('#saldo-galery24').html(parseFloat(dataNasabah.saldo_galery24).toFixed(4));

        // -- personal info --
        $('#personal-info #email').html(dataNasabah.email);
        $('#personal-info #nama-lengkap').html(dataNasabah.nama_lengkap);
        $('#personal-info #username').html(dataNasabah.username);
        $('#personal-info #tgl-lahir').html(dataNasabah.tgl_lahir);
        $('#personal-info #kelamin').html(dataNasabah.kelamin);
        $('#personal-info #alamat').html(dataNasabah.alamat);
        $('#personal-info #notelp').html(dataNasabah.notelp);
    }
};

/**
 * HAPUS TRANSAKSI
 */
const deleteTransaksiNasabah = (id,event) => {
    event.preventDefault();

    Swal.fire({
        title: 'ANDA YAKIN?',
        text: "Data akan terhapus permanen",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'iya',
    }).then((result) => {
        if (result.isConfirmed) {
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
                    form.append('username',USERNAME);
                    form.append('password',password);
        
                    return axios
                    .post(`${APIURL}/admin/confirmdelete`,form, {
                        headers: {
                            // header options 
                        }
                    })
                    .then((response) => {
                        return httpRequestDelete(`${APIURL}/transaksi/deleteitem?id=${id}`)
                        .then((e) => {
                            if (e.status == 201) {
                                chartGrafik.destroy();
                    
                                getAllTransaksiNasabah(`${currentMonth}-${currentYear}`);
                            }
                        })
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
        }
    })
}