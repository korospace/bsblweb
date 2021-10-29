/**
 * GET ALL KATEGORI BERITA
 */
 let arrayKatBerita = [];
 const getAllKatBerita = async () => {
    let httpResponse = await httpRequestGet(`${APIURL}/kategori_berita/getitem`);
    
    if (httpResponse.status === 200) {
        let elKategori  = '<option>-- pilih kategori --</option>';
        let trKategori  = '';
        let allKategori = httpResponse.data.data;
        arrayKatBerita  = httpResponse.data.data;
 
        allKategori.forEach((k,i)=> {
            let makeId = k.name.replace(/\s/g,'-');
 
            elKategori += `<option id="${makeId}" value="${k.id}">${k.name}</option>`;
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
$('#formAddKategoriBerita').on('submit', async (e) => {
    e.preventDefault();

    if (validateAddKategoriBerita()) {
        let form = new FormData(e.target);
    
        $('#formAddKategoriBerita #submit #text').addClass('d-none');
        $('#formAddKategoriBerita #submit #spinner').removeClass('d-none');
        let httpResponse = await httpRequestPost(`${APIURL}/kategori_berita/additem`,form);
        $('#formAddKategoriBerita #submit #text').removeClass('d-none');
        $('#formAddKategoriBerita #submit #spinner').addClass('d-none');
    
        if (httpResponse.status === 201) {
            $('#formAddKategoriBerita input').val('');
            getAllKatBerita();
    
            showAlert({
                message: `<strong>Success...</strong> kategori berhasil ditambah!`,
                btnclose: false,
                type:'success'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
        }
        else if (httpResponse.status === 400) {
           if (httpResponse.message.kategori_name) {
               $('#formAddKategoriBerita #kategori_name').addClass('is-invalid');
               $('#formAddKategoriBerita #kategori_name-error').text(httpResponse.message.kategori_name);
           }
        }
    }
})

// validate add kategori sampah
function validateAddKategoriBerita() {
    let status = true;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.text-danger').html('');
 
    if ($('#formAddKategoriBerita #kategori_name').val() == '') {
        $('#formAddKategoriBerita #kategori_name').addClass('is-invalid');
        $('#formAddKategoriBerita #kategori_name-error').html('*kategori harus di isi');
        status = false;
    }
    else if ($('#formAddKategoriBerita #kategori_name').val().length > 20) {
        $('#formAddKategoriBerita #kategori_name').addClass('is-invalid');
        $('#formAddKategoriBerita #kategori_name-error').html('*maximal 20 character');
        status = false;
    }
    // check kategori is exist
    arrayKatBerita.forEach(ks => {
        if (ks.name.toLowerCase() == $('#formAddKategoriBerita #kategori_name').val().toLowerCase().trim()) {
            $('#formAddKategoriBerita #kategori_name').addClass('is-invalid');
            $('#formAddKategoriBerita #kategori_name-error').html('*kategori sudah tersedia');
            status = false;
        }
    });
 
    return status;
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