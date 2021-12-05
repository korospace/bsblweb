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

// open modal detail sampah masuk
const openModalSampahMasuk = async (kategori) => {
    $('#modalDetailSampah .modal-title').html(`kategori ${kategori}`);
    
    $('#detil-sampah-spinner').removeClass('d-none');
    $('#detil-sampah-notfound').addClass('d-none')
    $('#modalDetailSampah #table-jenis-wraper').html(``);
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/sampahmasuk?kategori=${kategori}`);
    $('#detil-sampah-spinner').addClass('d-none');

    if (httpResponse.status === 404) {
        $('#detil-sampah-notfound').removeClass('d-none')
    }
    else if (httpResponse.status === 200) {
        let trBody     = '';
        let dataSampah = httpResponse.data.data;
        
        dataSampah.forEach((b,i) => {
            trBody  += `<tr class="text-center">
                <th scope="row">${++i}</th>
                <td>${b.jenis}</td>
                <td>${b.jumlah_kg} kg</td>
            </tr>`;
        })

        $('#modalDetailSampah #table-jenis-wraper').html(`<table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Jenis sampah</th>
                    <th scope="col">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                ${trBody}
            </tbody>
        </table>`);
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