
let webTitle  = document.title.split('|');
let pageTitle = webTitle[1].replace(/\s/,'');
let dataAdmin = '';

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
            hideLoadingSpinner();
            return {
                'status':200,
                'data':response.data
            };
        })
        .catch((error) => {
            hideLoadingSpinner();
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
    
    if (httpResponse.status === 200) {
        if (pageTitle === 'dashboard') {
            getTotalSampah();
            getAllKatSampah();
        }
        if (pageTitle === 'profile') {
            getDataProfile();
        }
        if (pageTitle === 'list nasabah') {
            getAllNasabah();
        }
        if (pageTitle === 'detil nasabah') {
            getTotalSampahNasabah();
            getDataProfileNasabah();
            getAllTransaksiNasabah();
        }
    }
};

sessioncheck();

// modif saldo uang
const modifUang = (rHarga) => {
    return rHarga.replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");;
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
            .delete(`${APIURL}/admin/logout`, {
                headers: {
                    token: TOKEN
                }
            })
            .then(() => {
                Swal.close();
                
                document.cookie = `tokenAdmin=null; path=/;`;
                window.location.replace(`${BASEURL}/login`);
            })
            .catch(error => {
                // unauthorized
                if (error.response.status == 401) {
                    Swal.close();
                    document.cookie = `tokenAdmin=null; path=/;`;
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