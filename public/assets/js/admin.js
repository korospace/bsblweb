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
            return {
                'status':200,
                'data':response.data
            };
        })
        .catch((error) => {
            // unauthorized
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
            // server error
            else if (error.response.status == 500){
                showAlert({
                    message: `<strong>Ups...</strong> terjadi kesalahan pada server, silahkan refresh halaman.`,
                    btnclose: true,
                    type:'danger' 
                })
            }
            
            return {
                'status':error.response.status,
            };
        })
};

/**
 * API REQUEST POST
 */
const httpRequestPost = (url,form) => {
    let newForm = new FormData();

    for (var pair of form.entries()) {
        let noPair = ['id','username','password','new_password','old_password','thumbnail','content'];

        if (noPair.includes(pair[0]) == false) {
            newForm.set(pair[0], pair[1].trim().toLowerCase());
        }
        else{
            if (pair[1].type) {
                newForm.set(pair[0], pair[1], pair[1].name);
            } 
            else {
                newForm.set(pair[0], pair[1]);                
            }
        }
    }

    return axios
        .post(url,newForm, {
            headers: {
                token: TOKEN
            }
        })
        .then(() => {
            return {
                'status':201,
            };
        })
        .catch((error) => {
            // unauthorized
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
            // error server
            else if (error.response.status == 500){
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    btnclose: true,
                    type:'danger'
                })
            }
            
            return {
                'status':error.response.status,
                'message':error.response.data.messages
            };
        })
};

/**
 * API REQUEST PUT
 */
const httpRequestPut = (url,form) => {
    let newForm = new FormData();

    for (var pair of form.entries()) {
        let noPair = ['id','username','password','new_password','old_password','thumbnail','new_thumbnail','content'];

        if (noPair.includes(pair[0]) == false) {
            newForm.set(pair[0], pair[1].trim().toLowerCase());
        }
        else{
            if (pair[1].type) {
                newForm.set(pair[0], pair[1], pair[1].name);
            } 
            else {
                newForm.set(pair[0], pair[1]);                
            }
        }
    }

    return axios
        .put(url,newForm, {
            headers: {
                token: TOKEN
            }
        })
        .then(() => {
            return {
                'status':201,
            };
        })
        .catch((error) => {
            // unauthorized
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
            // error server
            else if (error.response.status == 500){
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    btnclose: true,
                    type:'danger'
                })
            }
            
            return {
                'status':error.response.status,
                'message':error.response.data.messages
            };
        })
};

/**
 * API REQUEST DELETE
 */
const httpRequestDelete = (url) => {
    return axios
        .delete(url, {
            headers: {
                token: TOKEN
            }
        })
        .then(() => {
            return {
                'status':201,
            };
        })
        .catch((error) => {
            // unauthorized
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
            // error server
            else if (error.response.status == 500) {
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    btnclose: true,
                    type:'danger'
                })
            }
            
            return {
                'status':error.response.status,
            };
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
        if (pageTitle === 'dashboard') {
            getTotalSampah();
            getAllKatSampah();
            getAllJenisSampah();
        }
        if (pageTitle === 'profile') {
            getDataProfile();
        }
        if (pageTitle === 'list admin') {
            getAllAdmin();
        }
        if (pageTitle === 'list nasabah') {
            getAllNasabah();
        }
        if (pageTitle === 'detil nasabah') {
            // update value filter transkasi
            let currentMonth = new Date().toLocaleString("en-US",{month: "numeric"});
            let currentYear  = new Date().toLocaleString("en-US",{year: "numeric"});
            $(`#filter-month option[value=${currentMonth}]`).attr('selected','selected');
            $(`#filter-year`).val(currentYear);

            getTotalSampahNasabah();
            getDataProfileNasabah();
            getAllTransaksiNasabah(`${currentMonth}-${currentYear}`);
        }
        if (pageTitle === 'list artikel') {
            getAllBerita();
        }
        if (pageTitle === 'edit artikel') {
            setTimeout(() => {
                getDetailBerita();
            }, 50);
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