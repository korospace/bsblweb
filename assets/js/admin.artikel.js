
// Quil editor initialization
if (pageTitle === 'tambah artikel' || pageTitle === 'edit artikel') {
    var quill = new Quill('#editor-container', {
        modules: {
            imageResize: {
                displaySize: true
            },
            formula: true,
            syntax: true,
            toolbar: '#toolbar-container'
        },
        theme: 'snow'
    });
}

/**
 * GET ALL ARTIKEL
 */
 let arrayBerita    = [];
 const getAllBerita = async () => {
 
     $('#search-artikel').val('');
     $('#list-artikel-notfound').addClass('d-none'); 
     $('#container-list-artikel').addClass('d-none'); 
     $('#list-artikel-spinner').removeClass('d-none'); 
     let httpResponse = await httpRequestGet(`${APIURL}/berita_acara/getitem`);
     $('#container-list-artikel').removeClass('d-none'); 
     $('#list-artikel-spinner').addClass('d-none'); 
     
     if (httpResponse.status === 404) {
         $('#list-artikel-notfound').removeClass('d-none'); 
         $('#list-artikel-notfound #text-notfound').html(`artikel belum ditambah`); 
     }
     else if (httpResponse.status === 200) {
         let elBerita  = '';
         let allBerita = httpResponse.data.data;
         arrayBerita   = allBerita;
        
         allBerita.forEach(b => {

            let date      = new Date(parseInt(b.created_at) * 1000);
            let day       = date.toLocaleString("en-US",{day: "numeric"});
            let month     = date.toLocaleString("en-US",{month: "long"});
            let year      = date.toLocaleString("en-US",{year: "numeric"});
 
             elBerita += `<div class="col-12 col-sm-6 col-lg-4" style="min-height: 100%;">
                <div class="card mb-3" style="border: 0.5px solid #D2D6DA;min-height: 100%;">
                    <div class="position-relative">
                        <img class="card-img-top border-radius-0 position-absolute" style="z-index: 10;min-width: 100%;max-width: 100%;max-height: 100%;;min-height: 100%;" src="${b.thumbnail}" style="opacity: 0;">
                        <img class="card-img-top border-radius-0" src="${BASEURL}/assets/images/default-thumbnail.jpg" style="opacity: 0;">
                    </div>
                    <div class="card-body pb-0 d-flex flex-column justify-content-between" style="font-family: 'qc-semibold';">
                        <div class="row">
                            <h4 class="card-title text-capitalize" style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">${b.title}</h4>
                            <h6 class="card-subtitle mb-2 text-muted text-sm">
                                <i class="fas fa-list-ul mr-1 text-muted text-xs"></i>
                                ${b.kategori}
                            </h6>
                            <h6 class="card-subtitle mb-2 text-muted text-sm">
                                <i class="far fa-clock mr-1 text-muted text-xs"></i>
                                ${month}, ${day}, ${year}
                            </h6>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="${BASEURL}/admin/editartikel/${b.id}" class="w-100 btn btn-warning p-2 border-radius-sm" style="height: 34px;">
                                    <i class="far fa-edit"></i>
                                </a>
                            </div>
                            <div class="col-6">
                                <span class="w-100 btn btn-danger p-2 border-radius-sm" style="height: 34px;" onclick="hapusArtikel('${b.id}');">
                                    <i class="fas fa-trash text-white"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
         });
 
         $('#container-list-artikel').html(elBerita);
     }
 };

 // Search artikel
$('#search-artikel').on('keyup', function() {
    let elSugetion     = '';
    let beritaFiltered = [];
    
    if ($(this).val() === "") {
        beritaFiltered = arrayBerita;
    } 
    else {
        beritaFiltered = arrayBerita.filter((n) => {
            return n.title.includes($(this).val()) || n.kategori.includes($(this).val());
        });
    }

    if (beritaFiltered.length == 0) {
        $('#list-artikel-notfound').removeClass('d-none'); 
        $('#list-artikel-notfound #text-notfound').html(`artikel tidak ditemukan`); 
    } 
    else {
        $('#list-artikel-notfound').addClass('d-none'); 
        $('#list-artikel-notfound #text-notfound').html(` `); 

        beritaFiltered.forEach(b => {
            let date      = new Date(parseInt(b.created_at) * 1000);
            let day       = date.toLocaleString("en-US",{day: "numeric"});
            let month     = date.toLocaleString("en-US",{month: "long"});
            let year      = date.toLocaleString("en-US",{year: "numeric"});
            elSugetion += `<div class="col-12 col-sm-6 col-lg-4" style="min-height: 100%;">
            <div class="card mb-3" style="border: 0.5px solid #D2D6DA;min-height: 100%;">
                <div class="position-relative">
                    <img class="card-img-top border-radius-0 position-absolute" style="z-index: 10;min-width: 100%;max-width: 100%;max-height: 100%;;min-height: 100%;" src="${b.thumbnail}" style="opacity: 0;">
                    <img class="card-img-top border-radius-0" src="${BASEURL}/assets/images/default-thumbnail.jpg" style="opacity: 0;">
                </div>
                <div class="card-body pb-0 d-flex flex-column justify-content-between" style="font-family: 'qc-semibold';">
                    <div class="row">
                        <h4 class="card-title text-capitalize" style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">${b.title}</h4>
                        <h6 class="card-subtitle mb-2 text-muted text-sm">
                            <i class="fas fa-list-ul mr-1 text-muted text-xs"></i>
                            ${b.kategori}
                        </h6>
                        <h6 class="card-subtitle mb-2 text-muted text-sm">
                            <i class="far fa-clock mr-1 text-muted text-xs"></i>
                            ${month}, ${day}, ${year}
                        </h6>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="${BASEURL}/admin/editartikel/${b.id}" class="w-100 btn btn-warning p-2 border-radius-sm" style="height: 34px;">
                                <i class="far fa-edit"></i>
                            </a>
                        </div>
                        <div class="col-6">
                            <span class="w-100 btn btn-danger p-2 border-radius-sm" style="height: 34px;" onclick="hapusArtikel('${b.id}');">
                                <i class="fas fa-trash text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        });    
    }

    $('#container-list-artikel').html(elSugetion);
});

/**
 * GET DETAIL ARTIKEL
 */
const getDetailBerita = async () => {

    showLoadingSpinner();
    let httpResponse = await httpRequestGet(`${APIURL}/berita_acara/getitem?id=${IDARTIKEL}`);
    hideLoadingSpinner();
    
    if (httpResponse.status == 404) {
        Swal.fire({
            icon : 'error',
            title : '<strong>NOT FOUND</strong>',
            text: `artikel dengan id '${IDARTIKEL}' tidak ditemukan!`,
            showCancelButton: false,
            confirmButtonText: 'ok',
        }).then(() => {
            window.location.replace(`${BASEURL}/admin/listartikel`);
        })
    }
    if (httpResponse.status === 200) {
        let dataArtikel = httpResponse.data.data;
        let makeId      = dataArtikel.kategori.replace(/\s/g,'-');

        $('#idartikel').val(dataArtikel.id);
        document.querySelector('#preview-thumbnail').src = dataArtikel.thumbnail;
        $('#title').val(dataArtikel.title);
        $(`#${makeId}`).attr('selected','selected');
        $('.ql-editor').html(dataArtikel.content);
    }
};

/**
 * GET ALL KATEGORI ARTIKEL
 */
 let arrayKatBerita = [];
 const getAllKatBerita = async () => {
    let httpResponse = await httpRequestGet(`${APIURL}/kategori_berita/getitem`);
    
    if (httpResponse.status === 200) {
        let elKategori  = `<option value='' selected>-- pilih kategori --</option>`;
        let trKategori  = '';
        let allKategori = httpResponse.data.data;
        arrayKatBerita  = httpResponse.data.data;
 
        allKategori.forEach((k,i)=> {
            let makeId = k.name.replace(/\s/g,'-');
 
            elKategori += `<option id="${makeId}" value="${k.name}">${k.name}</option>`;
            trKategori += `<tr class="text-xs">
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold"> ${++i} </span>
                 </td>
                 <td class="align-middle text-center">
                     <span class="font-weight-bold"> ${k.name} </span>
                 </td>
                 <td class="align-middle text-center">
                     <span id="btn-hapus" class="badge badge-danger text-xxs pb-1 rounded-sm cursor-pointer" onclick="hapusKategori(this,'${k.id}','${k.name}')">hapus</span>
                 </td>
             </tr>`;
        });
 
        $('#kategori-berita-wraper').html(elKategori);
        $('#table-kategori-berita tbody').html(trKategori);
    }
 };

/**
 * ADD/EDIT ARTIKEL
 */
$('#formCrudArticle').on('submit', async (e) => {
    e.preventDefault();
    
    if (validateCrudArtikel()) {
        let httpResponse = '';
        let form         = new FormData(e.target);
        form.append('content',$('.ql-editor').html());
    
        showLoadingSpinner();
        if (IDARTIKEL !== '') {
            httpResponse = await httpRequestPut(`${APIURL}/berita_acara/edititem`,form);    
        } 
        else {
            httpResponse = await httpRequestPost(`${APIURL}/berita_acara/additem`,form);    
        }
        hideLoadingSpinner();

        if (httpResponse.status === 201) {
            setTimeout(() => {
                Swal.fire({
                    icon : 'success',
                    title : '<strong>SUCCESS</strong>',
                    html: `artikel berhasil ${(IDARTIKEL == '') ? 'dipublish' : 'diedit' }!`,
                    showCancelButton: false,
                    confirmButtonText: 'ok',
                })
                .then(() => {
                    window.location.replace(`${BASEURL}/admin/listartikel`);
                })
            }, 300);
        }
        else if (httpResponse.status === 400) {
           if (httpResponse.message.title) {
               $('#title').addClass('is-invalid');
               $('#title-error').text(httpResponse.message.title);
           }
        }
    }
})

// validate add kategori artikel
function validateCrudArtikel() {
    let status = true;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.text-danger').html('');
 
    // thumbnail
    if (IDARTIKEL == '') {
        if ($('#thumbnail').val() == '') {
            $('#thumbnail').addClass('is-invalid');
            status = false;
        }
    }
    // title
    if ($('#title').val() == '') {
        $('#title').addClass('is-invalid');
        status = false;
    }
    else if ($('#title').val().length > 250) {
        $('#title').addClass('is-invalid');
        $('#title-error').html('*maximal 250 character');
        status = false;
    }
    // kategori
    if ($('#kategori-berita-wraper').val() == '') {
        $('#kategori-berita-wraper').addClass('is-invalid');
        status = false;
    }

    return status;
 }

// Thumbnail Preview
const changeThumbPreview = (el) => {
    // If file is not image
    if(!/image/.test(el.files[0].type)){
        showAlert({
            message: `<strong>File yang anda upload bukan gambar!</strong>`,
            btnclose: false,
            type:'danger'
        });setTimeout(() => {
            hideAlert();
        }, 3000);

        el.value = "";
        return false;
    }
    // If file size more than 200kb
    else if(el.files[0].size > 200000){
        showAlert({
            message: `<strong>Ukuran maximal 200kb!</strong>`,
            btnclose: false,
            type:'danger'
        });setTimeout(() => {
            hideAlert();
        }, 3000);

        el.value = "";
        return false;
    }
    else{
      document.querySelector('#preview-thumbnail').src = URL.createObjectURL(el.files[0]);
    }
}

 /**
   * HAPUS KATEGORI ARTIKEL
   */
const hapusKategori = (el,id,katName) => {
    Swal.fire({
        title: 'ANDA YAKIN?',
        text: `semua berita dengan kategori '${katName}' akan ikut terhapus`,
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
                    form.append('username',$.cookie("username"));
                    form.append('password',password);
        
                    return axios
                    .post(`${APIURL}/admin/confirmdelete`,form, {
                        headers: {
                            // header options 
                        }
                    })
                    .then((response) => {
                        if ($('#formAddEditSampah input[name=kategori]').val() == katName) {
                            $('#formAddEditSampah input[name=kategori]').val('');    
                        }
                    
                        el.parentElement.parentElement.remove();
            
                        return httpRequestDelete(`${APIURL}/kategori_berita/deleteitem?id=${id}`)
                        .then(e => {
                           getAllKatBerita();
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
};

 /**
  * HAPUS ARTIKEL
  */
const hapusArtikel = (id) => {
    Swal.fire({
        title: 'ANDA YAKIN?',
        text: "Data akan terhapus permanen",
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
                    form.append('username',$.cookie("username"));
                    form.append('password',password);
        
                    return axios
                    .post(`${APIURL}/admin/confirmdelete`,form, {
                        headers: {
                            // header options 
                        }
                    })
                    .then((response) => {
                        return httpRequestDelete(`${APIURL}/berita_acara/deleteitem?id=${id}`)
                        .then((e) => {
                            if (e.status == 201) {
                                getAllBerita();
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