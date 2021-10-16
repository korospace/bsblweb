
// Session check
const sessioncheck = () => {
    showLoadingSpinner();

    axios
        .get(`${APIURL}/nasabah/sessioncheck`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            hideLoadingSpinner();
            $('head style').append(`<link rel="stylesheet" href="${BASEURL}/assets/css/soft-ui-dashboard.css"></link>`);
            $('#container').removeClass('d-none');
        })
        .catch((error) => {
            hideLoadingSpinner();
            $('head style').append(`<link rel="stylesheet" href="${BASEURL}/assets/css/soft-ui-dashboard.css"></link>`);
            $('#container').removeClass('d-none');
    
            // 401 Unauthorized
            if (error.response.status == 401) {
                if (error.response.data.messages == 'token expired') {
                    showAlert({
                        message: `<strong>session expired</strong> silahkan login kembali!`,
                        btnclose: true,
                        type:'info' 
                    })
                }
                document.cookie = `token=null; path=/;`;
                window.location.replace(`${BASEURL}/login`);
            }
            // server error
            else{
                showAlert({
                    message: `<strong>server error</strong> silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

sessioncheck();