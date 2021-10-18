
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
                    message: `<strong>server error...</strong> silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

sessioncheck();

// Get data profile
const getDataProfile = () => {
    axios
        .get(`${APIURL}/nasabah/getprofile`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            updateDataCard(response.data.data);
        })
        .catch((error) => {
            // 500 server error
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>server error...</strong> gagal mendapatkan data nasabah, silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

getDataProfile();

// update card
const updateDataCard = (data) => {
    let date = new Date(parseInt(data.created_at) * 1000);

    // id card
    $('#card-id').html(`${data.id.slice(0, 5)}&nbsp;&nbsp;&nbsp;${data.id.slice(5, 9)}&nbsp;&nbsp;&nbsp;${data.id.slice(9,99999999)}`);
    // username
    $('#card-username').html(data.username);
    // tgl bergabung
    $('#card-date').html(`${date.toLocaleString("en-US",{day: "numeric"})}/${date.toLocaleString("en-US",{month: "numeric"})}/${date.toLocaleString("en-US",{year: "numeric"})}`);
};

// Get data saldo
const getDataSaldo = () => {
    axios
        .get(`${APIURL}/nasabah/getsaldo`,{
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            console.log(response.data.data);
            // updateCardSaldo(response.data.data);
        })
        .catch((error) => {
            // 500 server error
            if (error.response.status == 500) {
                showAlert({
                    message: `<strong>server error...</strong> gagal mendapatkan data saldo, silahkan refresh halaman!`,
                    btnclose: true,
                    type:'danger' 
                })
            }
        })
};

getDataSaldo();