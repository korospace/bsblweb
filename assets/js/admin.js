let pageTitle   = document.title.replace(/\s/g,'').split('|');

// Session check
const sessioncheck = () => {
    showLoadingSpinner();

    axios
        .get(`${APIURL}/admin/sessioncheck`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            hideLoadingSpinner();
            $('#container').removeClass('d-none');

        })
        .catch((error) => {
            hideLoadingSpinner();
            $('#container').removeClass('d-none');
    
            // 401 Unauthorized
            if (error.response.status == 401) {
                document.cookie = `tokenAdmin=null; path=/;`;
                
                if (error.response.data.messages == 'token expired') {
                    Swal.fire({
                        icon : 'error',
                        title : '<strong>LOGIN EXPIRED</strong>',
                        text: 'silahkan login ulang untuk perbaharui login anda',
                        showCancelButton: false,
                        confirmButtonText: 'ok',
                    }).then((result) => {
                        window.location.replace(`${BASEURL}/login`);
                    })
                }
                else{
                    window.location.replace(`${BASEURL}/login`);
                }
            }
            // server error
            else{
                showAlert({
                    message: `<strong>server error...</strong> silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

sessioncheck();


// Admin Logout
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
                Swal.close();

                // unauthorized
                if (error.response.status == 401) {
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