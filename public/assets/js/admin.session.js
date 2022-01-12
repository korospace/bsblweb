if (pageTitle2 === 'dashboard') {
    getSampahMasuk();
    getSaldoNasabah();
    getDataSetorSampah();
    getTotalAkun();
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
    getDataGrafikSetor();
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