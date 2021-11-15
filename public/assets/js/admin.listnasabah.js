/**
 * GET ALL NASABAH
 */
let arrayNasabah = [];
const getAllNasabah = async () => {

    $('#search-nasabah').val('');
    $('#list-nasabah-notfound').addClass('d-none'); 
    $('#table-nasabah').addClass('d-none'); 
    $('#list-nasabah-spinner').removeClass('d-none'); 
    let httpResponse = await httpRequestGet(`${APIURL}/admin/getnasabah`);
    $('#table-nasabah').removeClass('d-none'); 
    $('#list-nasabah-spinner').addClass('d-none'); 
    
    if (httpResponse.status === 404) {
        $('#list-nasabah-notfound').removeClass('d-none'); 
        $('#list-nasabah-notfound #text-notfound').html(`belum ada nasabah`); 
    }
    else if (httpResponse.status === 200) {
        let trNasabah  = '';
        let allNasabah = httpResponse.data.data;
        arrayNasabah   = httpResponse.data.data;

        allNasabah.forEach((n,i) => {

            trNasabah += `<tr class="text-xs">
                <td class="align-middle text-center py-3">
                    <span class="font-weight-bold"> ${++i} </span>
                </td>
                <td class="align-middle text-center py-3">
                    <span class="font-weight-bold"> ${n.id} </span>
                </td>
                <td class="align-middle text-center">
                    <span class="font-weight-bold text-capitalize"> ${n.email} </span>
                </td>
                <td class="align-middle text-center">
                    <span class="font-weight-bold text-capitalize"> ${n.nama_lengkap} </span>
                </td>
                <td class="align-middle text-center">
                    <span class="font-weight-bold badge border ${(n.is_verify === 't')? 'text-success border-success' : 'text-warning border-warning'} pb-1 rounded-sm"> ${(n.is_verify === 't')? 'yes' : 'no'} </span>
                </td>
                <td class="align-middle text-center">
                    <span id="btn-hapus" class="badge badge-danger text-xxs pb-1 rounded-sm cursor-pointer" onclick="hapusNasabah(this,'${n.id}')">hapus</span>
                    <span id="btn-hapus" class="badge badge-warning text-xxs pb-1 rounded-sm cursor-pointer" data-toggle="modal" data-target="#modalAddEditNasabah" onclick="openModalAddEditNsb('editasabah','${n.id}')">edit</span>
                    <a href="${BASEURL}/admin/detilnasabah/${n.id}" id="btn-detil" class="badge badge-info text-xxs pb-1 rounded-sm cursor-pointer">detil</a>
                    <span id="btn-detil" class="d-none badge badge-info text-xxs pb-1 rounded-sm cursor-pointer" onclick="goToDetilNasabah('${n.id}')">detil</span>
                </td>
            </tr>`;
        });

        $('#table-nasabah tbody').html(trNasabah);
    }
};

// Search nasabah
$('#search-nasabah').on('keyup', function() {
    let elSugetion      = '';
    let nasabahFiltered = [];
    
    if ($(this).val() === "") {
        nasabahFiltered = arrayNasabah;
    } 
    else {
        nasabahFiltered = arrayNasabah.filter((n) => {
            return n.nama_lengkap.includes($(this).val()) || n.id.includes($(this).val()) || n.region.toLowerCase().includes($(this).val());
        });
    }

    if (nasabahFiltered.length == 0) {
        $('#list-nasabah-notfound').removeClass('d-none'); 
        $('#list-nasabah-notfound #text-notfound').html(`nasabah tidak ditemukan`); 
    } 
    else {
        $('#list-nasabah-notfound').addClass('d-none'); 
        $('#list-nasabah-notfound #text-notfound').html(` `); 

        nasabahFiltered.forEach((n,i) => {
            elSugetion += `<tr class="text-xs">
                <td class="align-middle text-center py-3">
                    <span class="font-weight-bold"> ${++i} </span>
                </td>
                <td class="align-middle text-center py-3">
                    <span class="font-weight-bold"> ${n.id} </span>
                </td>
                <td class="align-middle text-center">
                    <span class="font-weight-bold text-capitalize"> ${n.email} </span>
                </td>
                <td class="align-middle text-center">
                    <span class="font-weight-bold text-capitalize"> ${n.nama_lengkap} </span>
                </td>
                <td class="align-middle text-center">
                    <span class="font-weight-bold badge border ${(n.is_verify === 't')? 'text-success border-success' : 'text-warning border-warning'} pb-1 rounded-sm"> ${(n.is_verify === 't')? 'yes' : 'no'} </span>
                </td>
                <td class="align-middle text-center">
                    <span id="btn-hapus" class="badge badge-danger text-xxs pb-1 rounded-sm cursor-pointer" onclick="hapusNasabah(this,'${n.id}')">hapus</span>
                    <span id="btn-hapus" class="badge badge-warning text-xxs pb-1 rounded-sm cursor-pointer" data-toggle="modal" data-target="#modalAddEditNasabah" onclick="openModalAddEditNsb('editasabah','${n.id}')">edit</span>
                    <a href="${BASEURL}/admin/detilnasabah/${n.id}" id="btn-detil" class="badge badge-info text-xxs pb-1 rounded-sm cursor-pointer">detil</a>
                    <span id="btn-detil" class="d-none badge badge-info text-xxs pb-1 rounded-sm cursor-pointer" onclick="goToDetilNasabah('${n.id}')">detil</span>
                </td>
            </tr>`;
        });    
    }

    $('#table-nasabah tbody').html(elSugetion);
});

// Edit modal when open
const openModalAddEditNsb = (modalName,idnasabah=null) => {
    let modalTitle = (modalName=='addnasabah') ? 'tambah nasabah' : 'edit nasabah' ;
    
    $('#modalAddEditNasabah .modal-title').html(modalTitle);
    $('#formAddEditNasabah .form-check-input').prop('checked',false);
    // clear error message first
    $('#formAddEditNasabah .form-control').removeClass('is-invalid');
    $('#formAddEditNasabah .form-check-input').removeClass('is-invalid');
    $('#formAddEditNasabah .text-danger').html('');

    if (modalName == 'addnasabah') {
        $('#modalAddEditNasabah .addnasabah-item').removeClass('d-none');
        $('#modalAddEditNasabah .editnasabah-item').addClass('d-none');        
        
        clearInputForm();
    } 
    else {
        $('#modalAddEditNasabah .addnasabah-item').addClass('d-none');
        $('#modalAddEditNasabah .editnasabah-item').removeClass('d-none');        
        
        $('#modalAddEditNasabah #list-nasabah-spinner').removeClass('d-none');
        getProfileNasabah(idnasabah);
    }
}

/**
 * KODEPOS
 * =============================================
 */

// search kodepos
const searchKodepos = async (el) => {
 
    $('#kodepos-wraper').html(`<div class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
       <img src="${BASEURL}/assets/images/spinner.svg" style="width: 20px;" />
    </div>`); 

    axios
    .get(`https://kodepos.vercel.app/search/?q=${el.value}`,{
        headers: {
        }
    })
    .then((response) => {

        // console.log(response.data.status);
        if (response.data.code === 200) {
            if (response.data.messages === 'No data can be returned.') {
                $('#kodepos-wraper').html(`<div class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
                    <h6 tyle="opacity: 0.6;">kodepos tidak ditemukan</h6>
                </div>`);    
            } 
            else {
                let elPostList = '';

                response.data.data.forEach(x => {
                    let makeStringRegion = `${x.urban},${x.subdistrict},${x.city},${x.province}`;

                    elPostList += `
                    <div class="w-100">
                        <div class="kodepos-list w-100 d-flex align-items-center px-3 py-3" style="cursor: pointer;font-size:16px;" onclick="changeKodeposVal(this,'${x.postalcode}','${makeStringRegion}');">
                            <span class="w-100" style="display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">
                                ${x.postalcode} - ${x.urban}, ${x.subdistrict}, ${x.city}, ${x.province}
                            </span>
                        </div>
                    </div>`;
                });
        
                $('#kodepos-wraper').html(elPostList);
                if (el.value == '') {
                    $('#kodepos-wraper').html(``); 
                }
            } 
        }
    })
 };

 const changeKodeposVal = (el,kodepos,stringRegion) => {
     $('.kodepos-list').removeClass('active');
     $('input[name=kodepos]').val(kodepos);
     $('input[name=region]').val(stringRegion);
     el.classList.add('active');
 };

/**
 * CRUD NASABAH
 */
const crudNasabah = async (el,event) => {
    event.preventDefault();
    let form = new FormData(el);

    if (doValidate(form)) {
        let httpResponse = '';
        let modalTitle   = $('#modalAddEditNasabah .modal-title').html();
        let newTgl       = form.get('tgl_lahir').split('-');
        form.set('tgl_lahir',`${newTgl[2]}-${newTgl[1]}-${newTgl[0]}`);

        $('#formAddEditNasabah button#submit #text').addClass('d-none');
        $('#formAddEditNasabah button#submit #spinner').removeClass('d-none');
        if (modalTitle == 'edit nasabah') {
            form.set('is_verify',$('#formAddEditNasabah input[name=is_verify]').val());

            httpResponse = await httpRequestPut(`${APIURL}/admin/editnasabah`,form);    
        } 
        else {
            form.set('kodepos',$('input[name=kodepos]').val());

            httpResponse = await httpRequestPost(`${APIURL}/admin/addnasabah`,form);    
        }
        $('#formAddEditNasabah button#submit #text').removeClass('d-none');
        $('#formAddEditNasabah button#submit #spinner').addClass('d-none');

        if (httpResponse.status === 201) {
            getAllNasabah();
            if (modalTitle == 'tambah nasabah') {
                clearInputForm();
            } 

            showAlert({
                message: `<strong>Success...</strong> nasabah berhasil ${(modalTitle == 'tambah nasabah') ? 'ditambah' : 'diedit' }!`,
                btnclose: false,
                type:'success'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
        }
        else if (httpResponse.status === 400) {
            if (httpResponse.message.email) {
                $('#formAddEditNasabah #email').addClass('is-invalid');
                $('#formAddEditNasabah #email-error').text(httpResponse.message.email);
            }
            if (httpResponse.message.username) {
                $('#formAddEditNasabah #username').addClass('is-invalid');
                $('#formAddEditNasabah #username-error').text(httpResponse.message.username);
            }
            if (httpResponse.message.notelp) {
                $('#formAddEditNasabah #notelp').addClass('is-invalid');
                $('#formAddEditNasabah #notelp-error').text(httpResponse.message.notelp);
            }
        }
    }
}

/**
 * GET PROFILE NASABAH
 */
 const getProfileNasabah = async (id) => {

    let httpResponse = await httpRequestGet(`${APIURL}/admin/getnasabah?id=${id}`);
    $('#modalAddEditNasabah #list-nasabah-spinner').addClass('d-none');
    
    if (httpResponse.status === 200) {
        dataNasabah = httpResponse.data.data;
        
        for (const name in dataNasabah) {
            $(`#formAddEditNasabah input[name=${name}]`).val(dataNasabah[name]);
        }
    
        // tgl lahir
        let tglLahir = dataNasabah.tgl_lahir.split('-');
        $(`#formAddEditNasabah input[name=tgl_lahir]`).val(`${tglLahir[2]}-${tglLahir[1]}-${tglLahir[0]}`);
        // kelamin
        $(`#formAddEditNasabah input#kelamin-${dataNasabah.kelamin}`).prop('checked',true);
        // is verify
        if (dataNasabah.is_verify == 't') {
            $(`#formAddEditNasabah input[name=is_verify]`).val('1');
            $(`#formAddEditNasabah #btn-toggle`).removeClass('bg-secondary').addClass('active bg-success');
        } 
        else {
            $(`#formAddEditNasabah input[name=is_verify]`).val('0');
            $(`#formAddEditNasabah #btn-toggle`).removeClass('active bg-success').addClass('bg-secondary');
        }

        $('#newpass').val('');
    }
};

/**
 * EDIT NASABAH
 */
const editNasabah = (el,event) => {
    event.preventDefault();
    let form = new FormData(el);

    if (doValidate(form)) {
        $('#formAddEditNasabah button#submit #text').addClass('d-none');
        $('#formAddEditNasabah button#submit #spinner').removeClass('d-none');

        let newTgl = form.get('tgl_lahir').split('-');
        form.set('tgl_lahir',`${newTgl[2]}-${newTgl[1]}-${newTgl[0]}`);
        form.set('is_verify',$('#formAddEditNasabah input[name=is_verify]').val());
        
        if (form.get('new_password') == '') {
            form.delete('new_password');
        }

        for (var pair of form.entries()) {
            console.log(pair[0],pair[1]);
        }

        axios
        .put(`${APIURL}/admin/editnasabah`,form, {
            headers: {
                token: TOKEN
            }
        })
        .then((response) => {
            $('#formAddEditNasabah button#submit #text').removeClass('d-none');
            $('#formAddEditNasabah button#submit #spinner').addClass('d-none');
            getAllNasabah();
            $('#newpass-edit').val('');

            showAlert({
                message: `<strong>Success...</strong> edit profile berhasil!`,
                btnclose: false,
                type:'success'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
        })
        .catch((error) => {
            $('#formAddEditNasabah button#submit #text').removeClass('d-none');
            $('#formAddEditNasabah button#submit #spinner').addClass('d-none');

            // bad request
            if (error.response.status == 400) {
                if (error.response.data.messages.username) {
                    $('#formAddEditNasabah #username').addClass('is-invalid');
                    $('#formAddEditNasabah #username-error').text(error.response.data.messages.username);
                }
                if (error.response.data.messages.notelp) {
                    $('#formAddEditNasabah #notelp').addClass('is-invalid');
                    $('#formAddEditNasabah #notelp-error').text(error.response.data.messages.notelp);
                }
            }
            // error server
            else {
                showAlert({
                    message: `<strong>Ups . . .</strong> terjadi kesalahan pada server, coba sekali lagi`,
                    btnclose: true,
                    type:'danger'
                })
            }
        })
        
    }
}

// clear input form
const clearInputForm = () => {
    $(`#formAddEditNasabah .form-control`).val('');
}

// change kelamin value
$('#formAddEditNasabah .form-check-input').on('click', function(e) {
    $(`#formAddEditNasabah input[name=kelamin]`).val($(this).val());
    $('#formAddEditNasabah .form-check-input').prop('checked',false);
    $(this).prop('checked',true);
});

// change isverify value
$('#formAddEditNasabah input[name=is_verify]').on('click', function(e) {
    if ($(this).val() == '1') {
        $(this).val('0');
        $(this).parent().removeClass('active bg-success').addClass('bg-secondary');
    } 
    else {
        $(this).val('1');
        $(this).parent().removeClass('bg-secondary').addClass('active bg-success');
    }
});

// form validation
const doValidate = (form) => {
    let status     = true;
    let emailRules = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.form-check-input').removeClass('is-invalid');
    $('.text-danger').html('');

    // name validation
    if ($('#formAddEditNasabah #nama').val() == '') {
        $('#formAddEditNasabah #nama').addClass('is-invalid');
        $('#formAddEditNasabah #nama-error').html('*nama lengkap harus di isi');
        status = false;
    }
    else if ($('#formAddEditNasabah #nama').val().length > 40) {
        $('#formAddEditNasabah #nama').addClass('is-invalid');
        $('#formAddEditNasabah #nama-error').html('*maksimal 40 huruf');
        status = false;
    }
    // username validation
    if ($('#formAddEditNasabah #username').val() == '') {
        $('#formAddEditNasabah #username').addClass('is-invalid');
        $('#formAddEditNasabah #username-error').html('*username harus di isi');
        status = false;
    }
    else if ($('#formAddEditNasabah #username').val().length < 8 || $('#formAddEditNasabah #username').val().length > 20) {
        $('#formAddEditNasabah #username').addClass('is-invalid');
        $('#formAddEditNasabah #username-error').html('*minimal 8 huruf dan maksimal 20 huruf');
        status = false;
    }
    else if (/\s/.test($('#formAddEditNasabah #username').val())) {
        $('#formAddEditNasabah #username').addClass('is-invalid');
        $('#formAddEditNasabah #username-error').html('*tidak boleh ada spasi');
        status = false;
    }

    // add nasabah
    if (!$('#modalAddEditNasabah .addnasabah-item').hasClass('d-none')) {
        // email validation
        if ($('#formAddEditNasabah #email').val() == '') {
            $('#formAddEditNasabah #email').addClass('is-invalid');
            $('#formAddEditNasabah #email-error').html('*email harus di isi');
            status = false;
        }
        else if ($('#formAddEditNasabah #email').val().length > 40) {
            $('#formAddEditNasabah #email').addClass('is-invalid');
            $('#formAddEditNasabah #email-error').html('*maksimal 40 huruf');
            status = false;
        }
        else if (!emailRules.test(String($('#formAddEditNasabah #email').val()).toLowerCase())) {
            $('#formAddEditNasabah #email').addClass('is-invalid');
            $('#formAddEditNasabah #email-error').html('*email tidak valid');
            status = false;
        }
        // password validation
        if ($('#formAddEditNasabah #password').val() == '') {
            $('#formAddEditNasabah #password').addClass('is-invalid');
            $('#formAddEditNasabah #password-error').html('*password harus di isi');
            status = false;
        }
        else if ($('#formAddEditNasabah #password').val().length < 8 || $('#formAddEditNasabah #password').val().length > 20) {
            $('#formAddEditNasabah #password').addClass('is-invalid');
            $('#formAddEditNasabah #password-error').html('*minimal 8 huruf dan maksimal 20 huruf');
            status = false;
        }
        else if (/\s/.test($('#formAddEditNasabah #password').val())) {
            $('#formAddEditNasabah #password').addClass('is-invalid');
            $('#formAddEditNasabah #password-error').html('*tidak boleh ada spasi');
            status = false;
        }
        // rw validation
        if ($('#formAddEditNasabah #rw').val() == '') {
            $('#formAddEditNasabah #rw').addClass('is-invalid');
            $('#formAddEditNasabah #rw-error').html('*rw harus di isi');
            status = false;
        }
        else if ($('#formAddEditNasabah #rw').val().length < 2 || $('#formAddEditNasabah #rw').val().length > 2) {
            $('#formAddEditNasabah #rw').addClass('is-invalid');
            $('#formAddEditNasabah #rw-error').html('*minimal 2 huruf dan maksimal 2 huruf');
            status = false;
        }
        else if (!/^\d+$/.test($('#formAddEditNasabah #rw').val())) {
            $('#formAddEditNasabah #rw').addClass('is-invalid');
            $('#formAddEditNasabah #rw-error').html('*hanya boleh angka');
            status = false;
        }
        // rt validation
        if ($('#formAddEditNasabah #rt').val() == '') {
            $('#formAddEditNasabah #rt').addClass('is-invalid');
            $('#formAddEditNasabah #rt-error').html('*rt harus di isi');
            status = false;
        }
        else if ($('#formAddEditNasabah #rt').val().length < 2 || $('#formAddEditNasabah #rt').val().length > 2) {
            $('#formAddEditNasabah #rt').addClass('is-invalid');
            $('#formAddEditNasabah #rt-error').html('*minimal 2 huruf dan maksimal 2 huruf');
            status = false;
        }
        else if (!/^\d+$/.test($('#formAddEditNasabah #rt').val())) {
            $('#formAddEditNasabah #rt').addClass('is-invalid');
            $('#formAddEditNasabah #rt-error').html('*hanya boleh angka');
            status = false;
        }
        // kodepos validation
        if ($('#formAddEditNasabah #kodepos').val() == '') {
            $('#formAddEditNasabah #kodepos').addClass('is-invalid');
            $('#formAddEditNasabah #kodepos-error').html('*kodepos harus di isi');
            status = false;
        }
        else if ($('#formAddEditNasabah #kodepos').val().length < 5 || $('#formAddEditNasabah #kodepos').val().length > 5) {
            $('#formAddEditNasabah #kodepos').addClass('is-invalid');
            $('#formAddEditNasabah #kodepos-error').html('*minimal 5 huruf dan maksimal 5 huruf');
            status = false;
        }
        else if (!/^\d+$/.test($('#formAddEditNasabah #kodepos').val())) {
            $('#formAddEditNasabah #kodepos').addClass('is-invalid');
            $('#formAddEditNasabah #kodepos-error').html('*hanya boleh angka');
            status = false;
        }
    }
    else{
        // new pass 
        if ($('#modalAddEditNasabah #newpass').val() !== '') {   
            if ($('#modalAddEditNasabah #newpass').val().length < 8 || $('#modalAddEditNasabah #newpass').val().length > 20) {
                $('#modalAddEditNasabah #newpass').addClass('is-invalid');
                $('#modalAddEditNasabah #newpass-error').html('*minimal 8 huruf dan maksimal 20 huruf');
                status = false;
            }
            else if (/\s/.test($('#modalAddEditNasabah #newpass').val())) {
                $('#modalAddEditNasabah #newpass').addClass('is-invalid');
                $('#modalAddEditNasabah #newpass-error').html('*tidak boleh ada spasi');
                status = false;
            }
        }
    
        // saldo uang validation
        if ($('#formAddEditNasabah #saldo_uang').val() == '') {
            $('#formAddEditNasabah #saldo_uang').addClass('is-invalid');
            status = false;
        }
        else if (/[^0-9\.]/g.test($('#modalAddEditNasabah #saldo_uang').val())) {
            $('#formAddEditNasabah #saldo_uang').addClass('is-invalid');
            showAlert({
                message: `<strong>Saldo hanya boleh angka dan titik</strong>`,
                btnclose: false,
                type:'danger'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
            status = false;
        }
        // saldo antam validation
        if ($('#formAddEditNasabah #saldo_antam').val() == '') {
            $('#formAddEditNasabah #saldo_antam').addClass('is-invalid');
            status = false;
        }
        else if (/[^0-9\.]/g.test($('#modalAddEditNasabah #saldo_antam').val())) {
            $('#formAddEditNasabah #saldo_antam').addClass('is-invalid');
            showAlert({
                message: `<strong>Saldo hanya boleh angka dan titik</strong>`,
                btnclose: false,
                type:'danger'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
            status = false;
        }
        // saldo ubs validation
        if ($('#formAddEditNasabah #saldo_ubs').val() == '') {
            $('#formAddEditNasabah #saldo_ubs').addClass('is-invalid');
            status = false;
        }
        else if (/[^0-9\.]/g.test($('#modalAddEditNasabah #saldo_ubs').val())) {
            $('#formAddEditNasabah #saldo_ubs').addClass('is-invalid');
            showAlert({
                message: `<strong>Saldo hanya boleh angka dan titik</strong>`,
                btnclose: false,
                type:'danger'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
            status = false;
        }
        // saldo g24 validation
        if ($('#formAddEditNasabah #saldo_galery24').val() == '') {
            $('#formAddEditNasabah #saldo_galery24').addClass('is-invalid');
            status = false;
        }
        else if (/[^0-9\.]/g.test($('#modalAddEditNasabah #saldo_galery24').val())) {
            $('#formAddEditNasabah #saldo_galery24').addClass('is-invalid');
            showAlert({
                message: `<strong>Saldo hanya boleh angka dan titik</strong>`,
                btnclose: false,
                type:'danger'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
            status = false;
        }
    }


    // tgl lahir validation
    if ($('#formAddEditNasabah #tgllahir').val() == '') {
        $('#formAddEditNasabah #tgllahir').addClass('is-invalid');
        $('#formAddEditNasabah #tgllahir-error').html('*tgl lahir harus di isi');
        status = false;
    }
    // kelamin validation
    if ($(`#formAddEditNasabah input[name=kelamin]`).val() == '') {
        $('.form-check-input').addClass('is-invalid');
        
        status = false;
    }
    // alamat validation
    if ($('#formAddEditNasabah #alamat').val() == '') {
        $('#formAddEditNasabah #alamat').addClass('is-invalid');
        $('#formAddEditNasabah #alamat-error').html('*alamat harus di isi');
        status = false;
    }
    else if ($('#formAddEditNasabah #alamat').val().length > 255) {
        $('#formAddEditNasabah #alamat').addClass('is-invalid');
        $('#formAddEditNasabah #alamat-error').html('*maksimal 255 huruf');
        status = false;
    }
    // notelp validation
    if ($('#formAddEditNasabah #notelp').val() == '') {
        $('#formAddEditNasabah #notelp').addClass('is-invalid');
        $('#formAddEditNasabah #notelp-error').html('*no.telp harus di isi');
        status = false;
    }
    else if ($('#formAddEditNasabah #notelp').val().length > 14) {
        $('#formAddEditNasabah #notelp').addClass('is-invalid');
        $('#formAddEditNasabah #notelp-error').html('*maksimal 14 huruf');
        status = false;
    }
    else if (!/^\d+$/.test($('#formAddEditNasabah #notelp').val())) {
        $('#formAddEditNasabah #notelp').addClass('is-invalid');
        $('#formAddEditNasabah #notelp-error').html('*hanya boleh angka');
        status = false;
    }

    return status;
}

/**
 * HAPUS NASABAH
 */
const hapusNasabah = (el,id) => {
    Swal.fire({
        title: 'ANDA YAKIN?',
        text: "Semua data transaksi dan saldo nasabah akan ikut terhapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'iya',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                html:`<h5 class='mb-4'>Password</h5>`,
                showCancelButton: true,
                confirmButtonText: 'submit',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    let form = new FormData();
                    form.append('hashedpass',PASSADMIN);
                    form.append('password',password);
        
                    return axios
                    .post(`${APIURL}/admin/confirmdelete`,form, {
                        headers: {
                            // header options 
                        }
                    })
                    .then((response) => {
                        return httpRequestDelete(`${APIURL}/admin/deletenasabah?id=${id}`)
                        .then((e) => {
                            if (e.status == 201) {
                                el.parentElement.parentElement.remove();
                                arrayNasabah = arrayNasabah.filter(e => e.id != id);
                                if (arrayNasabah.length == 0) {
                                    $('#list-nasabah-notfound').removeClass('d-none'); 
                                    $('#list-nasabah-notfound #text-notfound').html(`nasabah belum ditambah`); 
                                } 
                            }
                        })
                    })
                    .catch(error => {
                        if (error.response.status == 404) {
                            Swal.showValidationMessage(
                                `password salah`
                            )
                        }
                        else if (error.response.status == 500) {
                            Swal.showValidationMessage(
                                `terjadi kesalahan, coba sekali lagi`
                            )
                        }
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }
    })
}