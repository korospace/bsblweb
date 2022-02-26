
$('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
	$(this).on('keyup', function(e) {
		var parent = $($(this).parent());
		
		if(e.keyCode === 8 || e.keyCode === 37) {
			var prev = parent.find('input#' + $(this).data('previous'));
			
			if(prev.length) {
				$(prev).select();
			}
		} 
		else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
			var next = parent.find('input#' + $(this).data('next'));
			
			if(next.length) {
				$(next).select();
			} 
			else {
				if(parent.data('autosubmit')) {
					let otp = '';
					$('.digit-group input').each(function() {
						otp += $(this).val();
					});

					if (otp.length == 6) {

						showLoadingSpinner();
												
						let form = new FormData();
						form.append('code_otp',otp);

						axios
						.post(`${APIURL}/otp/verify`,form, {
							headers: {
								// header options 
							}
						})
						.then(() => {
							hideLoadingSpinner();

							Swal.fire({
								icon: 'success',
								title: 'verifikasi success!',
								confirmButtonText: 'ok',
							})
							.then(() => {
								if (USERNAME_OR_EMAIL == '' && PASSWORD == '') {
									window.location.replace(`${BASEURL}/login`);
								} 
								else {
									showLoadingSpinner();
									
									// Login
									let formLogin = new FormData();
									formLogin.append('username_or_email',USERNAME_OR_EMAIL);
									formLogin.append('password',PASSWORD);

									axios
									.post(`${APIURL}/login/nasabah`,formLogin, {
										headers: {
											// header options 
										}
									})
									.then((response) => {
										hideLoadingSpinner();
										document.cookie = `token=${response.data.token}; path=/;SameSite=None; Secure`;
										window.location.replace(`${BASEURL}/nasabah`);
									})
									.catch(() => {
										hideLoadingSpinner();
										window.location.replace(`${BASEURL}/login`);
									})
								}
							})
							
						})
						.catch(error => {
							hideLoadingSpinner();

							if (error.response.status == 404) {
								showAlert({
									message: `<strong>Ups . . .</strong> code OTP tidak valid!`,
									autohide: true,
									type:'danger' 
								})
							}
							else if (error.response.status == 500) {
								showAlert({
									message: `<strong>Ups . . .</strong> terjadi kesalahan, coba sekali lagi!`,
									autohide: true,
									type:'danger' 
								})
							}
						})
					}
				}
			}
		}
	});
});