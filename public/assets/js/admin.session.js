let webUrl      = window.location.href;
document.cookie = `lasturl=${webUrl}; path=/;`;

/**
* SESSION CHECK
*/
const sessioncheck = async () => {
    showLoadingSpinner();
    let httpResponse = await httpRequestGet(`${APIURL}/admin/sessioncheck`);
    hideLoadingSpinner();
    
    if (httpResponse.status === 200) {
        if (pageTitle2 === 'dashboard') {
            getSampahMasuk();
            getSaldoNasabah();
            getDataSetorSampah();
        }
        if (pageTitle2 === 'list sampah') {
            getAllKatSampah();
            getAllJenisSampah();
        }
        if (pageTitle2 === 'transaksi') {
            getDataTransaksi();
            getRekapTransaksi();
        }
        if (pageTitle2 === 'list admin') {
            getAllAdmin();
        }
        if (pageTitle2 === 'list nasabah') {
            getAllNasabah();
        }
        if (pageTitle2 === 'detil nasabah') {
            getSampahMasuk();
            updateGrafikSetorNasabah();
            getHistoriTransaksi();
            getSaldoNasabah();
            getDataProfileNasabah();
        }
        if (pageTitle2 === 'list artikel') {
            getAllBerita();
            localStorage.removeItem("add-artikel"); 
        }
        if (pageTitle2 === 'edit artikel') {
            setTimeout(() => {
                getDetailBerita();
            }, 50);
        }
        if (pageTitle2 === 'profile') {
            getDataProfile();
        }
    }
};

sessioncheck();