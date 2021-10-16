// function sessioncheck() {
//     showLoadingSpinner();

//     axios
//     .get(`${APIURL}/nasabah/sessioncheck`,{
//         headers: {
//             token: TOKEN
//         }
//     })
//     .then((response) => {
//         hideLoadingSpinner();
//         document.cookie = `token=${response.data.token}; path=/;`;
//         window.location.replace(`${BASEURL}/dashboard/nasabah`);
//     })
//     .catch((error) => {
//         hideLoadingSpinner();

//         // error email/password
//         if (error.response.status == 404) {
//             $('#email-nasabah-error').text(error.response.data.messages.email);
//             $('#password-nasabah-error').text(error.response.data.messages.password);
//         }
//         // account not verify
//         if (error.response.status == 401) {
//             showPopupOtp();
//         }
//         // server error
//         else{
//             showAlert({
//                 message: `<strong>server error</strong> coba sekali lagi!`,
//                 btnclose: true,
//                 type:'danger' 
//             })
//         }
//     })
// }

// sessioncheck();