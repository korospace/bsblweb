
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
                        message: `<strong>session expired...</strong> silahkan login kembali!`,
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
};

getDataProfile();

// update card
const updateDataCard = (data) => {
    let date      = new Date(parseInt(data.created_at));
    let idNasabah = [...data.id].map((e,i) => {
        if (i==4) {
            return e+"&nbsp;&nbsp;&nbsp;";
        }
        else if (i==8) {
            return e+"&nbsp;&nbsp;&nbsp;";
        }
        else{
            return e;
        }
    });

    $('#card-id').html(idNasabah.toString().replace(/,/g,''));
    $('#card-date').html(`${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`);
    $('#card-username').html(data.username);
};