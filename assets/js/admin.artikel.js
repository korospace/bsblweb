
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
 * GET ALL BERITA
 */
 let arrayBerita    = [];
 const getAllBerita = async () => {
 
     $('#search-berita').val('');
     $('#list-berita-notfound').addClass('d-none'); 
     $('#container-list-berita').addClass('d-none'); 
     $('#list-berita-spinner').removeClass('d-none'); 
     let httpResponse = await httpRequestGet(`${APIURL}/berita_acara/getitem`);
     $('#container-list-berita').removeClass('d-none'); 
     $('#list-berita-spinner').addClass('d-none'); 
     
     if (httpResponse.status === 404) {
         $('#list-berita-notfound').removeClass('d-none'); 
         $('#list-berita-notfound #text-notfound').html(`jenis berita belum ditambah`); 
     }
     else if (httpResponse.status === 200) {
         let elBerita  = '';
         let allBerita = httpResponse.data.data;
         arrayBerita   = allBerita;
        
         allBerita.forEach(b => {
 
             elBerita += `<div class="col-12 col-sm-6 col-lg-4 h-100">
                <div class="card mb-3" style="border: 0.5px solid #D2D6DA;">
                    <img class="card-img-top border-radius-0" src="${b.thumbnail}">
                    <div class="card-body" style="font-family: 'qc-semibold';">
                        <h5 class="card-title">${b.title}</h5>
                        <a href="" class="btn btn-warning p-2 border-radius-sm" style="width: 34px;height: 34px;">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="" class="btn btn-danger p-2 border-radius-sm" style="width: 34px;height: 34px;">
                            <i class="fas fa-trash text-white"></i>
                        </a>
                    </div>
                </div>
            </div>`;
         });
 
         $('#container-list-berita').html(elBerita);
     }
 };

/**
 * GET ALL KATEGORI BERITA
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
 * ADD KATEGORI BERITA
 */
$('#formCrudArticle').on('submit', async (e) => {
    e.preventDefault();
    
    if (validateCrudArtikel()) {
        let form = new FormData(e.target);
        form.append('content',$('.ql-editor').html());
    
        showLoadingSpinner();
        let httpResponse = await httpRequestPost(`${APIURL}/berita_acara/additem`,form);
        hideLoadingSpinner();

        if (httpResponse.status === 201) {
            setTimeout(() => {
                Swal.fire({
                    icon : 'success',
                    title : '<strong>SUCCESS</strong>',
                    html:
                      'artikel berhasil ditambah!',
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

// validate add kategori sampah
function validateCrudArtikel() {
    let status = true;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.text-danger').html('');
 
    // thumbnail
    if ($('#thumbnail').val() == '') {
        $('#thumbnail').addClass('is-invalid');
        status = false;
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
            btnclose: true,
            type:'danger'
        });

        el.value = "";
        return false;
    }
    // If file size more than 200kb
    else if(el.files[0].size > 200000){
        showAlert({
            message: `<strong>Ukuran maximal 200kb!</strong>`,
            btnclose: true,
            type:'danger'
        });

        el.value = "";
        return false;
    }
    else{
      document.querySelector('#preview-thumbnail').src = URL.createObjectURL(el.files[0]);
    }
}

 /**
   * HAPUS KATEGORI SAMPAH
   */
 const hapusKategori = (el,id,katName) => {
     Swal.fire({
         title: 'ANDA YAKIN?',
         text: `semua berita dengan kategori '${katName}' akan ikut terhapus `,
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'iya',
         cancelButtonText: 'tidak',
         showLoaderOnConfirm: true,
         preConfirm: async () => {
             if ($('#formAddEditSampah input[name=kategori]').val() == katName) {
                 $('#formAddEditSampah input[name=kategori]').val('');    
             }
         
             el.parentElement.parentElement.remove();
 
             return httpRequestDelete(`${APIURL}/kategori_berita/deleteitem?id=${id}`)
             .then(e => {
                getAllKatBerita();
             })
         },
         allowOutsideClick: () => !Swal.isLoading()
     })
 };