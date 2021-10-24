let webTitle  = document.title.split('|');
let pageTitle = webTitle[1].replace(/\s/,'');

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
                        document.cookie = `tokenAdmin=null;expires=;path=/;`;
                    })
                }
                else{
                    window.location.replace(`${BASEURL}/login`);
                    document.cookie = `tokenAdmin=null;expires=;path=/;`;
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
    let httpResponse = await httpRequestGet(`${APIURL}/admin/sessioncheck`);
    hideLoadingSpinner();
    
    if (httpResponse.status === 200) {
        getTotalSampah();
        getDataProfile();
    }
};

sessioncheck();

/**
 * GET TOTAL SAMPAH NASABAH
 */
 const getTotalSampah = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/sampah/totalitem?idnasabah=${IDNASABAH}`);

    if (httpResponse.status === 200) {
        let dataSampah = httpResponse.data.data;

        for (const name in dataSampah) {
            $(`#sampah-${name}`).html(dataSampah[name].total+' Kg');
        }   
    }
    if (error.response.status == 404) {
        window.location.replace(`${BASEURL}/admin/listnasabah`);
    }
};

/**
 * GET ALL TRANSAKSI NASABAH
 */
const getAllTransaksi = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/getdata`);
    
    if (httpResponse.status === 404) {
        updateGrafikSetor([],[]);
        $('#transaksi-wraper').html(`<h6 class='opacity-6'>belum ada transaksi</h6>`); 
    }
    else if (httpResponse.status === 200) {
        let arrayId      = [];
        let arrayKg      = [];
        let elTransaksi  = '';
        let allTransaksi = httpResponse.data.data;
        getDataSaldo();
        
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
    }
};

/**
 * GET DATA PROFILE NASABAH
 */
const getDataProfile = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/admin/getnasabah?id=${IDNASABAH}`);
    
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

// modif saldo uang
const modifUang = (rHarga) => {
    return rHarga.replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");;
}