const searchKodepos=async s=>{$("#kodepos-wraper").html(`<div class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">\n       <img src="${BASEURL}/assets/images/spinner.svg" style="width: 20px;" />\n    </div>`),axios.get(`https://kodepos.vercel.app/search/?q=${s.value}`,{headers:{}}).then((s=>{if(200===s.data.code)if("No data can be returned."===s.data.messages)$("#kodepos-wraper").html('<div class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">\n                    <h6 tyle="opacity: 0.6;">kodepos tidak ditemukan</h6>\n                </div>');else{let e="";s.data.data.forEach((s=>{e+=`\n                    <div class="w-100">\n                        <div class="kodepos-list w-100 d-flex align-items-center px-3 py-3" style="cursor: pointer;font-size:16px;" onclick="changeKodeposVal(this,'${s.postalcode}','${s.urban}','${s.subdistrict}','${s.city}','${s.province}');">\n                            <span class="w-100" style="display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">\n                                ${s.postalcode} - ${s.urban}, ${s.subdistrict}, ${s.city}, ${s.province}\n                            </span>\n                        </div>\n                    </div>`})),$("#kodepos-wraper").html(e)}}))},changeKodeposVal=(s,e,a,i,t,r)=>{$(".kodepos-list").removeClass("active"),$("input[name=kodepos]").val(e),$("input[name=kelurahan]").val(a),$("input[name=kecamatan]").val(i),$("input[name=kota]").val(t),$("input[name=provinsi]").val(r),s.classList.add("active")};function doValidate(s){let e=!0,a=s.get("kelamin");return $(".form-control").removeClass("is-invalid"),$(".form-check-input").removeClass("is-invalid"),$(".text-danger").html(""),""==$("#nama-regist").val()?($("#nama-regist").addClass("is-invalid"),$("#nama-regist-error").html("*nama lengkap harus di isi"),e=!1):$("#nama-regist").val().length>40&&($("#nama-regist").addClass("is-invalid"),$("#nama-regist-error").html("*maksimal 40 huruf"),e=!1),""==$("#username-regist").val()?($("#username-regist").addClass("is-invalid"),$("#username-regist-error").html("*username harus di isi"),e=!1):$("#username-regist").val().length<8||$("#username-regist").val().length>20?($("#username-regist").addClass("is-invalid"),$("#username-regist-error").html("*minimal 8 huruf dan maksimal 20 huruf"),e=!1):/\s/.test($("#username-regist").val())&&($("#username-regist").addClass("is-invalid"),$("#username-regist-error").html("*tidak boleh ada spasi"),e=!1),""==$("#email-regist").val()?($("#email-regist").addClass("is-invalid"),$("#email-regist-error").html("*email harus di isi"),e=!1):$("#email-regist").val().length>40?($("#email-regist").addClass("is-invalid"),$("#email-regist-error").html("*maksimal 40 huruf"),e=!1):/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(String($("#email-regist").val()).toLowerCase())||($("#email-regist").addClass("is-invalid"),$("#email-regist-error").html("*email tidak valid"),e=!1),""==$("#password-regist").val()?($("#password-regist").addClass("is-invalid"),$("#password-regist-error").html("*password harus di isi"),e=!1):$("#password-regist").val().length<8||$("#password-regist").val().length>20?($("#password-regist").addClass("is-invalid"),$("#password-regist-error").html("*minimal 8 huruf dan maksimal 20 huruf"),e=!1):/\s/.test($("#password-regist").val())&&($("#password-regist").addClass("is-invalid"),$("#password-regist-error").html("*tidak boleh ada spasi"),e=!1),""==$("#tgllahir-regist").val()&&($("#tgllahir-regist").addClass("is-invalid"),$("#tgllahir-regist-error").html("*tgl lahir harus di isi"),e=!1),null==a&&($(".form-check-input").addClass("is-invalid"),e=!1),""==$("#rw-regist").val()?($("#rw-regist").addClass("is-invalid"),$("#rw-regist-error").html("*rw harus di isi"),e=!1):$("#rw-regist").val().length<2||$("#rw-regist").val().length>2?($("#rw-regist").addClass("is-invalid"),$("#rw-regist-error").html("*minimal 2 huruf dan maksimal 2 huruf"),e=!1):/^\d+$/.test($("#rw-regist").val())||($("#rw-regist").addClass("is-invalid"),$("#rw-regist-error").html("*hanya boleh angka"),e=!1),""==$("#rt-regist").val()?($("#rt-regist").addClass("is-invalid"),$("#rt-regist-error").html("*rt harus di isi"),e=!1):$("#rt-regist").val().length<2||$("#rt-regist").val().length>2?($("#rt-regist").addClass("is-invalid"),$("#rt-regist-error").html("*minimal 2 huruf dan maksimal 2 huruf"),e=!1):/^\d+$/.test($("#rt-regist").val())||($("#rt-regist").addClass("is-invalid"),$("#rt-regist-error").html("*hanya boleh angka"),e=!1),""==$("#kodepos-regist").val()?($("#kodepos-regist").addClass("is-invalid"),$("#kodepos-regist-error").html("*kodepos harus di isi"),e=!1):$("#kodepos-regist").val().length<5||$("#kodepos-regist").val().length>5?($("#kodepos-regist").addClass("is-invalid"),$("#kodepos-regist-error").html("*minimal 5 huruf dan maksimal 5 huruf"),e=!1):/^\d+$/.test($("#kodepos-regist").val())||($("#kodepos-regist").addClass("is-invalid"),$("#kodepos-regist-error").html("*hanya boleh angka"),e=!1),""==$("#alamat-regist").val()?($("#alamat-regist").addClass("is-invalid"),$("#alamat-regist-error").html("*alamat harus di isi"),e=!1):$("#alamat-regist").val().length>255&&($("#alamat-regist").addClass("is-invalid"),$("#alamat-regist-error").html("*maksimal 255 huruf"),e=!1),""==$("#notelp-regist").val()?($("#notelp-regist").addClass("is-invalid"),$("#notelp-regist-error").html("*no.telp harus di isi"),e=!1):$("#notelp-regist").val().length>14?($("#notelp-regist").addClass("is-invalid"),$("#notelp-regist-error").html("*maksimal 14 huruf"),e=!1):/^\d+$/.test($("#notelp-regist").val())||($("#notelp-regist").addClass("is-invalid"),$("#notelp-regist-error").html("*hanya boleh angka"),e=!1),e}$("#formRegister").on("submit",(function(s){s.preventDefault();let e=new FormData(s.target);if(doValidate(e)){showLoadingSpinner();let s=e.get("tgl_lahir").split("-");e.set("tgl_lahir",`${s[2]}-${s[1]}-${s[0]}`),e.set("kodepos",$("input[name=kodepos]").val()),axios.post(`${APIURL}/register/nasabah`,e,{headers:{}}).then((s=>{hideLoadingSpinner(),setTimeout((()=>{Swal.fire({icon:"success",title:"<strong>SUCCESS</strong>",html:"check email anda untuk mendapatkan <strong>CODE OTP</strong> ",showCancelButton:!1,confirmButtonText:"ok"}).then((()=>{var s=BASEURL+"/otp",a=$('<form action="'+s+'" method="post"><input type="text" name="email" value="'+e.get("email")+'" /><input type="text" name="password" value="'+e.get("password")+'" /></form>');$("body").append(a),a.submit()}))}),300)})).catch((s=>{hideLoadingSpinner(),400==s.response.status?(s.response.data.messages.email&&($("#email-regist").addClass("is-invalid"),$("#email-regist-error").text(s.response.data.messages.email)),s.response.data.messages.username&&($("#username-regist").addClass("is-invalid"),$("#username-regist-error").text(s.response.data.messages.username)),s.response.data.messages.notelp&&($("#notelp-regist").addClass("is-invalid"),$("#notelp-regist-error").text(s.response.data.messages.notelp))):500==s.response.status&&showAlert({message:"<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi",autohide:!0,type:"danger"})}))}}));