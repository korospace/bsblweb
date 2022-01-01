let docTitle    = document.title.split('|');
let pageTitle1  = docTitle[0].replace(/\s/,'');
let pageTitle2  = docTitle[1].replace(/\s/,'');
let dataAdmin   = '';

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
                        document.cookie = `token=null;expires=;path=/;`;
                        window.location.replace((pageTitle1 == 'Nasabah') ? `${BASEURL}/login` : `${BASEURL}/login/admin`);
                    })
                }
                else{
                    document.cookie = `token=null;expires=;path=/;`;
                    window.location.replace((pageTitle1 == 'Nasabah') ? `${BASEURL}/login` : `${BASEURL}/login/admin`);
                }
            }
            // server error
            else if (error.response.status == 500){
                showAlert({
                    message: `<strong>Ups...</strong> terjadi kesalahan pada server, silahkan refresh halaman.`,
                    autohide: true,
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
        let noPair = ['id','id_admin','id_nasabah','id_kategori','username','password','new_password','old_password','thumbnail','content'];

        if (noPair.includes(pair[0]) == false) {
            if (pair[0].includes('transaksi')) {
                newForm.set(pair[0], pair[1].trim());    
            } 
            else {
                newForm.set(pair[0], pair[1].trim().toLowerCase());    
            }
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
                        document.cookie = `token=null;expires=;path=/;`;
                        window.location.replace((pageTitle1 == 'Nasabah') ? `${BASEURL}/login` : `${BASEURL}/login/admin`);
                    })
                }
                else{
                    document.cookie = `token=null;expires=;path=/;`;
                    window.location.replace((pageTitle1 == 'Nasabah') ? `${BASEURL}/login` : `${BASEURL}/login/admin`);
                }
            }
            // error server
            else if (error.response.status == 500){
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    autohide: true,
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
        let noPair = ['id','username','password','id_kategori','new_password','old_password','thumbnail','new_thumbnail','content'];

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
                        document.cookie = `token=null;expires=;path=/;`;
                        window.location.replace((pageTitle1 == 'Nasabah') ? `${BASEURL}/login` : `${BASEURL}/login/admin`);
                    })
                }
                else{
                    document.cookie = `token=null;expires=;path=/;`;
                    window.location.replace((pageTitle1 == 'Nasabah') ? `${BASEURL}/login` : `${BASEURL}/login/admin`);
                }
            }
            // error server
            else if (error.response.status == 500){
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    autohide: true,
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
                        document.cookie = `token=null;expires=;path=/;`;
                        window.location.replace((pageTitle1 == 'Nasabah') ? `${BASEURL}/login` : `${BASEURL}/login/admin`);
                    })
                }
                else{
                    document.cookie = `token=null;expires=;path=/;`;
                    window.location.replace((pageTitle1 == 'Nasabah') ? `${BASEURL}/login` : `${BASEURL}/login/admin`);
                }
            }
            // error server
            else if (error.response.status == 500) {
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    autohide: true,
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
* LOGOUT
*/
$('#btn-logout').on('click', function(e) {
    e.preventDefault();

    let url      = (pageTitle1 === 'Nasabah')?`${APIURL}/nasabah/logout`:`${APIURL}/admin/logout`;
    let loginUrl = (pageTitle1 === 'Nasabah')?`${BASEURL}/login`:`${BASEURL}/login/admin`;
    
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
            .delete(url, {
                headers: {
                    token: TOKEN
                }
            })
            .then(() => {
                Swal.close();

                document.cookie = `token=null; path=/;`;
                document.cookie = `lasturl=null; path=/;`;
                window.location.replace(loginUrl);
                // setTimeout(() => {
                //     console.log(loginUrl);
                //     return 0;
                // }, 5000);
            })
            .catch(error => {
                // unauthorized
                if (error.response.status == 401) {
                    Swal.close();

                    document.cookie = `token=null; path=/;`;
                    document.cookie = `lasturl=null; path=/;`;
                    window.location.replace(loginUrl);
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

// --- navbar OnScroll ---
$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    var box    = $('.main-content').offset().top;
    
    if (scroll >= box) {
        $(".navbar").addClass("blur shadow-blur");
    } 
    else {
        $(".navbar").removeClass("blur shadow-blur");
    }
});

// --- Button navbar OnClick ---
$('#iconNavbarSidenav').on('click', function (e) {
    e.preventDefault();

    $('body').toggleClass('g-sidenav-pinned');
    $('aside').toggleClass('bg-white');
})

// modif saldo uang
const modifUang = (rHarga) => {
    return rHarga.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");;
}

// modif number
function kFormatter(num) {
    return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'K' : Math.sign(num)*Math.abs(num)
}