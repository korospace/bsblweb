
function nasabahLogin(e,event) {
    event.preventDefault();
    
    // show loading
    showLoadingSpinner();
    
    // hide loading
    setTimeout(() => {
        hideLoadingSpinner();
    }, 3000);
}