
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
            $('#container').removeClass('d-none');
        })
        .catch((error) => {
            hideLoadingSpinner();
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

// Get data profile
const getDataProfile = () => {
    showLoadingSpinner();

    axios
        .get(`${APIURL}/nasabah/getprofile`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            hideLoadingSpinner();
            
            updateDataCard(response.data.data);
        })
        .catch((error) => {
            hideLoadingSpinner();
    
            // 500 server error
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>gagal mendapatkan data nasabah</strong> silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })

        // update card
        const updateDataCard = (data) => {
            $('#card-username').html(data.username);
        };
};

getDataProfile();