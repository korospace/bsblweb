/**
 * GET TOTAL SAMPAH
 */
const getTotalSampah = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/sampah/totalitem`);

    if (httpResponse.status === 200) {
        let dataSampah = httpResponse.data.data;

        for (const name in dataSampah) {
            $(`#sampah-${name}`).html(dataSampah[name].total+' Kg');
        }   
    }
};

/**
 * GET ALL KATEGORI SAMPAH
 */
let arrayKatSampah = [];
const getAllKatSampah = async () => {

   $('#kategori-sampah-wraper').html(`<div class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
       <img src="${BASEURL}/assets/images/spinner.svg" style="width: 20px;" />
   </div>`); 
   let httpResponse = await httpRequestGet(`${APIURL}/kategori_sampah/getitem`);
   
   if (httpResponse.status === 404) {
       $('#kategori-sampah-wraper').html(`<div class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
           <h6 tyle="opacity: 0.6;">kategori belum tersedia</h6>
       </div>`); 
   }
   else if (httpResponse.status === 200) {
       let elKategori  = '';
       let allKategori = httpResponse.data.data;
       arrayKatSampah  = httpResponse.data.data;

       allKategori.forEach(k => {
           let makeId = k.name.replace(/\s/g,'-');

           elKategori += `
           <div class="w-100">
               <div id="${makeId}" class="kategori-list w-100 d-flex justify-content-between align-items-center px-3 py-2 cursor-pointer">
                   <div class="d-flex align-items-center text-md" onclick="changeKatSampahVal(this,'${k.name}')" style="flex: 1;">
                       ${k.name} <i class="checklist fas fa-check-circle text-muted ml-2"></i>
                   </div>
                   <span class="add-item badge badge-danger border-radius-sm cursor-pointer"  onclick="deleteKatSampahVal(this,'${k.id}','${k.name}')">
                       <i class="fas fa-trash text-white"></i>
                   </span>
               </div>
               <hr class="horizontal dark mt-0">
            </div>`;
       });

       $('#kategori-sampah-wraper').html(elKategori);
   }
};

// change input value with name kategori
// in formAddEditSampah
const changeKatSampahVal = (el,kategoriName) => {
    $('.kategori-list').removeClass('active');
    $('#formAddEditSampah input[name=kategori]').val(kategoriName);
    el.parentElement.classList.add('active');
};

/**
* ADD KATEGORI SAMPAH
*/
$('#btnAddKategoriSampah').on('click', async function(e) {
    e.preventDefault();
    
    if (validateAddKategori()) {

        let form = new FormData();
        form.append('kategori_name',$('input#NewkategoriSampah').val().trim().toLowerCase());

        $('#btnAddKategoriSampah #text').addClass('d-none');
        $('#btnAddKategoriSampah #spinner').removeClass('d-none');
        let httpResponse = await httpRequestPost(`${APIURL}/kategori_sampah/additem`,form);
        $('#btnAddKategoriSampah #text').removeClass('d-none');
        $('#btnAddKategoriSampah #spinner').addClass('d-none');

        if (httpResponse.status === 201) {
            $('input#NewkategoriSampah').val('');
            getAllKatSampah();

           showAlert({
               message: `<strong>Success...</strong> kategori berhasil ditambah!`,
               btnclose: false,
               type:'success'
           })
           setTimeout(() => {
               hideAlert();
           }, 3000);
        }
    }
});

/**
  * HAPUS KATEGORI SAMPAH
  */
const deleteKatSampahVal = (el,id,katName) => {
    Swal.fire({
        title: 'ANDA YAKIN?',
        text: `semua sampah dengan kategori '${katName}' akan ikut terhapus `,
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

            return httpRequestDelete(`${APIURL}/kategori_sampah/deleteitem?id=${id}`)
            .then(e => {
                if (e.status == 201) {
                    getAllJenisSampah();
                }
                else if (e.status == 500) {
                    getAllKatSampah();
                }
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
};

// validate add kategori sampah
function validateAddKategori() {
   let status = true;

   if ($('input#NewkategoriSampah').val() == '') {
       showAlert({
           message: `<strong>Masukan kategori baru !</strong>`,
           btnclose: true,
           type:'danger'
       })
       status = false;
   }
   else if ($('input#NewkategoriSampah').val().length > 40) {
       showAlert({
           message: `<strong>Kategori baru maximal 20 huruf !</strong>`,
           btnclose: true,
           type:'danger'
       })
       status = false;
   }
   // check kategori is exist
   arrayKatSampah.forEach(ks => {
       if (ks.name.toLowerCase() == $('input#NewkategoriSampah').val().toLowerCase().trim()) {
           showAlert({
               message: `<strong>Kategori sudah tersedia !</strong>`,
               btnclose: true,
               type:'danger'
           })
           status = false;
       }
   });

   return status;
}

/**
 * GET ALL JENIS SAMPAH
 */
 let arrayJenisSampah = [];
 const getAllJenisSampah = async () => {
 
     $('#search-sampah').val('');
     $('#list-sampah-notfound').addClass('d-none'); 
     $('#table-jenis-sampah').addClass('d-none'); 
     $('#list-sampah-spinner').removeClass('d-none'); 
     let httpResponse = await httpRequestGet(`${APIURL}/sampah/getitem`);
     $('#table-jenis-sampah').removeClass('d-none'); 
     $('#list-sampah-spinner').addClass('d-none'); 
     
     if (httpResponse.status === 404) {
         $('#list-sampah-notfound').removeClass('d-none'); 
         $('#list-sampah-notfound #text-notfound').html(`jenis sampah belum ditambah`); 
     }
     else if (httpResponse.status === 200) {
         let trJenisSampah  = '';
         let allJenisSampah = sortingSampah(httpResponse.data.data);
         arrayJenisSampah   = allJenisSampah;
        
         allJenisSampah.forEach((n,i) => {
 
             trJenisSampah += `<tr class="text-xs">
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold"> ${++i} </span>
                 </td>
                 <td class="align-middle text-center">
                     <span class="font-weight-bold"> ${n.kategori} </span>
                 </td>
                 <td class="align-middle text-center">
                    ${n.jenis}
                 </td>
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold">Rp. ${modifUang(n.harga)} </span>
                 </td>
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold"> ${n.jumlah} </span>
                 </td>
                 <td class="align-middle text-center">
                     <span id="btn-hapus" class="badge badge-danger text-xxs pb-1 rounded-sm cursor-pointer" onclick="hapusSampah('${n.id}')">hapus</span>
                     <span id="btn-hapus" class="badge badge-warning text-xxs pb-1 rounded-sm cursor-pointer" data-toggle="modal" data-target="#modalAddEditSampah" onclick="openModalAddEditSmp('editasampah','${n.id}')">edit</span>
                 </td>
             </tr>`;
         });
 
         $('#table-jenis-sampah tbody').html(trJenisSampah);
     }
 };

// sorting sampah
const sortingSampah = (data) => {
    let arrKategori = [];
    let objSampah   = {};
    let newArrSampah= [];
    
    // create array kategori
    data.forEach(d => {
        if (!arrKategori.includes(d.kategori)) {
            arrKategori.push(d.kategori.replace(/\s/g,'_'));
        }
    });

    arrKategori.forEach(aK => {
        objSampah[aK] = data.filter((d) => {
            return d.kategori == aK.replace(/_/g,' ');
        })
    });

    for (let key in objSampah) {
        objSampah[key].forEach(x => {
            newArrSampah.push(x);
        });
    }

    return newArrSampah;
}

// Search sampah
$('#search-sampah').on('keyup', function() {
    let elSugetion     = '';
    let sampahFiltered = [];
    
    if ($(this).val() === "") {
        sampahFiltered = arrayJenisSampah;
    } 
    else {
        sampahFiltered = arrayJenisSampah.filter((n) => {
            return n.kategori.includes($(this).val()) || n.jenis.includes($(this).val());
        });
    }

    if (sampahFiltered.length == 0) {
        $('#list-sampah-notfound').removeClass('d-none'); 
        $('#list-sampah-notfound #text-notfound').html(`sampah tidak ditemukan`); 
    } 
    else {
        $('#list-sampah-notfound').addClass('d-none'); 
        $('#list-sampah-notfound #text-notfound').html(` `); 

        sampahFiltered.forEach((n,i) => {
            elSugetion += `<tr class="text-xs">
            <td class="align-middle text-center py-3">
                <span class="font-weight-bold"> ${++i} </span>
            </td>
            <td class="align-middle text-center">
                <span class="font-weight-bold"> ${n.kategori} </span>
            </td>
            <td class="align-middle text-center">
               ${n.jenis}
            </td>
            <td class="align-middle text-center py-3">
                <span class="font-weight-bold">Rp. ${modifUang(n.harga)} </span>
            </td>
            <td class="align-middle text-center py-3">
                <span class="font-weight-bold"> ${n.jumlah} </span>
            </td>
            <td class="align-middle text-center">
                <span id="btn-hapus" class="badge badge-danger text-xxs pb-1 rounded-sm cursor-pointer" onclick="hapusSampah('${n.id}')">hapus</span>
                <span id="btn-hapus" class="badge badge-warning text-xxs pb-1 rounded-sm cursor-pointer" data-toggle="modal" data-target="#modalAddEditSampah" onclick="openModalAddEditSmp('editasampah','${n.id}')">edit</span>
            </td>
        </tr>`;
        });    
    }

    $('#table-jenis-sampah tbody').html(elSugetion);
});

// clear input form
const clearInputForm = () => {
    $(`#formAddEditSampah .form-control`).val('');
}

 // Edit modal when open
 const openModalAddEditSmp = (modalName,idSampah=null) => {
     let modalTitle = (modalName=='addsampah') ? 'tambah sampah' : 'edit sampah' ;
     
     $('#modalAddEditSampah .modal-title').html(modalTitle);
     // clear error message first
     $('#formAddEditSampah .form-control').removeClass('is-invalid');
     $('#formAddEditSampah .text-danger').html('');
     $('.kategori-list').removeClass('active');
 
     if (modalName == 'addsampah') {
        $('#formAddEditSampah').attr('onsubmit','addSampah(this,event);');
        $('#modalAddEditSampah .edit-item').addClass('d-none');
        $('#modalAddEditSampah .add-item').removeClass('d-none');

        clearInputForm();
     } 
     else {
        $('#formAddEditSampah').attr('onsubmit','editSampah(this,event);');
        $('#modalAddEditSampah .edit-item').removeClass('d-none');  
        $('#modalAddEditSampah .add-item').addClass('d-none');
         
        let selectedSampah = arrayJenisSampah.filter((n) => {
            return n.id == idSampah;
        });
        
        $('#formAddEditSampah #id').val(selectedSampah[0].id);
        $('#formAddEditSampah #jenis').val(selectedSampah[0].jenis);
        $('#formAddEditSampah #harga').val(selectedSampah[0].harga);
        $('#formAddEditSampah #jumlah').val(selectedSampah[0].jumlah);
        $('#formAddEditSampah #kategori').val(selectedSampah[0].kategori);

        let makeId = selectedSampah[0].kategori.replace(/\s/g,'-');
        $(`#kategori-sampah-wraper #${makeId}`).addClass('active');
        currentKategori = selectedSampah[0].kategori;
     }
 }

 /**
  * ADD SAMPAH
  */
 const addSampah = async (el,event) => {
     event.preventDefault();
     
     if (doValidateAddSmp()) {
         let form = new FormData(el);
         form.set('kategori',$('#formAddEditSampah input#kategori').val());

         $('#formAddEditSampah #btn-add-edit-sampah #text').addClass('d-none');
         $('#formAddEditSampah #btn-add-edit-sampah #spinner').removeClass('d-none');
         let httpResponse = await httpRequestPost(`${APIURL}/sampah/additem`,form);
         $('#formAddEditSampah #btn-add-edit-sampah #text').removeClass('d-none');
         $('#formAddEditSampah #btn-add-edit-sampah #spinner').addClass('d-none');

         if (httpResponse.status === 201) {
            $('.kategori-list').removeClass('active');
            getAllJenisSampah();
            clearInputForm();

            showAlert({
                message: `<strong>Success...</strong> sampah berhasil ditambah!`,
                btnclose: false,
                type:'success'
            })
            setTimeout(() => {
                hideAlert();
            }, 3000);
         }
         else if (httpResponse.status === 400) {
            if (httpResponse.message.jenis) {
                $('#formAddEditSampah #jenis').addClass('is-invalid');
                $('#formAddEditSampah #jenis-error').text(httpResponse.message.jenis);
            }
         }
     }
 }

/**
 * EDIT SAMPAH
 */
const editSampah = async (el,event) => {
    event.preventDefault();
    
    if (doValidateAddSmp()) {
        let form = new FormData(el);
        form.set('kategori',$('#formAddEditSampah input#kategori').val());

        $('#formAddEditSampah #btn-add-edit-sampah #text').addClass('d-none');
        $('#formAddEditSampah #btn-add-edit-sampah #spinner').removeClass('d-none');
        let httpResponse = await httpRequestPut(`${APIURL}/sampah/edititem`,form);
        $('#formAddEditSampah #btn-add-edit-sampah #text').removeClass('d-none');
        $('#formAddEditSampah #btn-add-edit-sampah #spinner').addClass('d-none');

        if (httpResponse.status === 201) {
           getAllJenisSampah();

           showAlert({
               message: `<strong>Success...</strong> sampah berhasil diubah!`,
               btnclose: false,
               type:'success'
           })
           setTimeout(() => {
               hideAlert();
           }, 3000);
        }
        else if (httpResponse.status === 400) {
           if (httpResponse.message.jenis) {
               $('#formAddEditSampah #jenis').addClass('is-invalid');
               $('#formAddEditSampah #jenis-error').text(httpResponse.message.jenis);
           }
        }
    }
}

 /**
  * HAPUS JENIS SAMPAH
  */
 const hapusSampah = (id) => {
     Swal.fire({
         title: 'ANDA YAKIN?',
         text: "Data akan terhapus permanen",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'iya',
         cancelButtonText: 'tidak',
         showLoaderOnConfirm: true,
         preConfirm: async () => {
            return httpRequestDelete(`${APIURL}/sampah/deleteitem?id=${id}`)
            .then((e) => {
                if (e.status == 201) {
                    getAllJenisSampah();
                }
            })
         },
         allowOutsideClick: () => !Swal.isLoading()
     })
 }

// validate add sampah
const doValidateAddSmp = () => {
    let status = true;

    // clear error message first
    $('.form-control').removeClass('is-invalid');
    $('.text-danger').html('');

    // jenis validation
    if ($('#formAddEditSampah #jenis').val() == '') {
        $('#formAddEditSampah #jenis').addClass('is-invalid');
        $('#formAddEditSampah #jenis-error').html('*jenis harus di isi');
        status = false;
    }
    else if ($('#formAddEditSampah #jenis').val().length > 40) {
        $('#formAddEditSampah #jenis').addClass('is-invalid');
        $('#formAddEditSampah #jenis-error').html('*maksimal 40 huruf');
        status = false;
    }
    // harga validation
    if ($('#formAddEditSampah #harga').val() == '') {
        $('#formAddEditSampah #harga').addClass('is-invalid');
        $('#formAddEditSampah #harga-error').html('*harga harus di isi');
        status = false;
    }
    else if ($('#formAddEditSampah #harga').val().length > 11) {
        $('#formAddEditSampah #harga').addClass('is-invalid');
        $('#formAddEditSampah #harga-error').html('*maksimal 11 angka');
        status = false;
    }
    else if (!/^\d+$/.test($('#formAddEditSampah #harga').val())) {
        $('#formAddEditNasabah #harga').addClass('is-invalid');
        $('#formAddEditNasabah #harga-error').html('*hanya boleh angka');
        status = false;
    }
    // jumlah validation
    if (!$('#formAddEditSampah .edit-item').hasClass('d-none')) {
        if ($('#formAddEditSampah #jumlah').val() == '') {
            $('#formAddEditSampah #jumlah').addClass('is-invalid');
            $('#formAddEditSampah #jumlah-error').html('*jumlah harus di isi');
            status = false;
        }
        else if ($('#formAddEditSampah #jumlah').val().length > 11) {
            $('#formAddEditSampah #jumlah').addClass('is-invalid');
            $('#formAddEditSampah #jumlah-error').html('*maksimal 11 angka');
            status = false;
        }
        else if (/[^0-9\.]/g.test($('#formAddEditSampah #jumlah').val())) {
            $('#formAddEditSampah #jumlah').addClass('is-invalid');
            $('#formAddEditSampah #jumlah-error').html('*hanya boleh angka');
            status = false;
        }
    }
    // kategori validation
    if ($('#formAddEditSampah #kategori').val() == '') {
        $('#formAddEditSampah #kategori').addClass('is-invalid');
        status = false;
    }

    return status;
}