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

        getAllTransaksi();
    }
};