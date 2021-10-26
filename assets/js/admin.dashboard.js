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
 * GET ALL JENIS SAMPAH
 */
 let arrayJenisSampah = [];
 const getAllJenisSampah = async () => {
 
     $('#search-sampah').val('');
     $('#list-sampah-spinner').removeClass('d-none'); 
     let httpResponse = await httpRequestGet(`${APIURL}/sampah/getitem`);
     $('#list-sampah-spinner').addClass('d-none'); 
     
     if (httpResponse.status === 404) {
         $('#list-sampah-notfound').removeClass('d-none'); 
         $('#list-sampah-notfound #text-notfound').html(`jenis sampah belum ditambah`); 
     }
     else if (httpResponse.status === 200) {
         let trJenisSampah  = '';
         let allJenisSampah = httpResponse.data.data;
         arrayJenisSampah   = httpResponse.data.data;
 
         allJenisSampah.forEach((n,i) => {
 
             trJenisSampah += `<tr class="text-xs">
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold"> ${++i} </span>
                 </td>
                 <td class="align-middle text-center">
                     <span class="font-weight-bold text-capitalize"> ${n.kategori} </span>
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
                     <span id="btn-hapus" class="badge badge-warning text-xxs pb-1 rounded-sm cursor-pointer" data-toggle="modal" data-target="#modalAddEditNasabah" onclick="openModalAddEditNsb('editasabah','${n.id}')">edit</span>
                 </td>
             </tr>`;
         });
 
         $('#table-jenis-sampah tbody').html(trJenisSampah);
     }
 };

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
         preConfirm: () => {
             return axios
             .delete(`${APIURL}/sampah/deleteitem?id=${id}`, {
                 headers: {
                     token: TOKEN
                 }
             })
             .then(() => {
                 Swal.close();
                 getAllJenisSampah();
             })
             .catch(error => {
                 // unauthorized
                 if (error.response.status == 401) {
                     Swal.showValidationMessage(
                         `waktu login anda sudah habis!`
                     )
                     
                     setTimeout(() => {
                         document.cookie = `tokenAdmin=null; path=/;`;
                         window.location.replace(`${BASEURL}/login`);
                     }, 3000);
                 }
                 // error server
                 else if (error.response.status == 500) {
                     Swal.showValidationMessage(
                         `server error: coba sekali lagi!`
                     )
                 }
             })
         },
         allowOutsideClick: () => !Swal.isLoading()
     })
 }