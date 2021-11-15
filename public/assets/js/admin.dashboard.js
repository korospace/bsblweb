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
 * GET LAST TRANSACTION
 */
const getLastTransaksi = async () => {
    $('#transaksi-terbaru-notfound').addClass('d-none'); 
    $('#table-transaksi-terbaru').addClass('d-none'); 
    $('#transaksi-terbaru-spinner').removeClass('d-none'); 
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/lasttransaksi?limit=20`);
    $('#table-transaksi-terbaru').removeClass('d-none'); 
    $('#transaksi-terbaru-spinner').addClass('d-none'); 
    
    if (httpResponse.status === 404) {
        $('#transaksi-terbaru-notfound').removeClass('d-none'); 
        $('#transaksi-terbaru-notfound #text-notfound').html(`belum ada transaksi`); 
    }
    else if (httpResponse.status === 200) {
        let trTransaksi  = '';
        let allTransaksi = httpResponse.data.data;
    
        allTransaksi.forEach(t => {
            let date      = new Date(parseInt(t.date) * 1000);
            let hour      = date.toLocaleString("en-US",{ hour: 'numeric', minute: 'numeric' });
            // let minute    = date.toLocaleString("en-US",{minute: "numeric"});
            // let second    = date.toLocaleString("en-US",{second: "numeric"});
            let day       = date.toLocaleString("en-US",{day: "numeric"});
            let month     = date.toLocaleString("en-US",{month: "long"});
            let year      = date.toLocaleString("en-US",{year: "numeric"});
            let jenisTransaksi = (t.type == 'setor')?`${t.type} sampah`:`${t.type} saldo`;
            let color          = '';
            let jumlah         = '';

            if (t.type == 'setor') {
                color  = 'success';
                jumlah = `+ ${t.total_kg} kg`;
            } 
            else if (t.type == 'tarik') {
                color  = 'danger';
                jumlah = (t.jenis_saldo == 'uang')?`- Rp ${t.total_tarik}`:`- ${t.total_tarik} g`;
            } 
            else {
                color  = 'warning';
                jumlah = `<i class="fas fa-exchange-alt text-xxs"></i> Rp ${t.total_pindah}`;
            }

            trTransaksi += `<tr>
                <td class="align-middle text-sm">
                    <span class="text-xs text-name font-weight-bold"> 
                        ${t.id_transaksi}
                    </span>
                </td>
                <td class="align-middle text-sm">
                    <span class="text-xs text-name font-weight-bold">
                        ${t.nama_lengkap}
                    </span>
                </td>
                <td class="align-middle text-sm">
                    <span class="text-xxs text-name font-weight-bold badge border text-${color} border-${color} pb-1 rounded-sm" style="min-width:100px;max-width:100px;"> 
                        ${jenisTransaksi}
                    </span>
                </td>
                <td class="align-middle text-sm">
                    <span class="text-xs text-name font-weight-bold text-${color}"> 
                        ${jumlah}
                    </span>
                </td>
                <td class="align-middle text-sm">
                    <span class="text-xs text-name font-weight-bold">
                    ${day}/${month}/${year} ${hour}
                    </span>
                </td>
            </tr>`;
        });

        $('#table-transaksi-terbaru tbody').html(trTransaksi);
    }
};

// filter transaksi on change
let currentYear  = '';
$('.filter-transaksi').on('input', function(e) {
    chartGrafik.destroy();
    currentYear  = $(`#filter-year`).val();
    getRekapTransaksi(currentYear);
});

/**
 * GET REKAP TRANSAKSI
 */
const getRekapTransaksi = async (year) => {
    $('.spinner-wraper').removeClass('d-none');
    $('#transaksi-wraper').addClass('d-none');
    let httpResponse = await httpRequestGet(`${APIURL}/transaksi/rekapdata?year=${year}`);
    $('.spinner-wraper').addClass('d-none'); 
    $('#transaksi-wraper').removeClass('d-none');
    
    if (httpResponse.status === 404) {
        updateGrafikSetor([],[]);
        $('#transaksi-wraper').html(`<h6 class='opacity-6'>belum ada transaksi</h6>`); 
    }
    else if (httpResponse.status === 200) {
        let arrayMonth   = [];
        let arrayKg      = [];
        let elTransaksi  = '';
        let allTransaksi = httpResponse.data.data;

        for (const key in allTransaksi) {
            arrayMonth.push(key);
            arrayKg.push(allTransaksi[key].totSampahMasuk);
    
            elTransaksi  += `<li class="list-group-item border-0 p-0 border-radius-lg">
                <div class="d-flex align-items-center justify-content-between px-1">
                    <div class="d-flex flex-column" style="flex:1;">
                        <h6 class="text-dark font-weight-bold text-sm">${allTransaksi[key].date2}</h6>
                        <div class="d-flex w-100">
                            <table>
                                <tr>
                                    <td>
                                        <i class="fas fa-trash text-xs text-success mr-3">
                                            ${allTransaksi[key].totSampahMasuk} kg
                                        </i>
                                    </td>
                                    <td colspan="2">
                                        <i class="fas fa-dollar-sign text-xs text-success mr-3">
                                        Rp ${kFormatter(allTransaksi[key].totUangMasuk)}
                                        </i>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-trash text-xs text-danger mr-3">
                                            ${allTransaksi[key].totSampahKeluar} kg
                                        </i>
                                    </td>
                                    <td>
                                        <i class="fas fa-dollar-sign text-xs text-danger mr-3">
                                            Rp ${kFormatter(allTransaksi[key].totUangKeluar)}
                                        </i>
                                    </td>
                                    <td>
                                        <i class="fas fa-coins text-xs text-danger mr-3">
                                            ${allTransaksi[key].totEmasKeluar} g
                                        </i>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="${BASEURL}/admin/cetakrekap/${allTransaksi[key].date1}" target="_blank" class="btn btn-link text-dark text-sm mb-0 px-0 h-100">
                        <i class="fas fa-file-pdf text-lg me-1"></i> PDF
                    </a>
                </div>
                <hr class="horizontal dark">
            </li>`;
        }
        
        updateGrafikSetor(arrayMonth,arrayKg);
        $('#transaksi-wraper').html(`<ul class="list-group h-100 w-100" style="font-family: 'qc-medium';">
            ${elTransaksi}
        </ul>`);
    }
};

// update grafik setor
let chartGrafik = '';
const updateGrafikSetor = (arrayMonth,arrayKg) => {
    var ctx2       = document.getElementById("chart-line").getContext("2d");
    // let chartWidth = arrayId.length*160;
    document.querySelector("#chart-line").style.width    = '100%';
    document.querySelector("#chart-line").style.height   = '340px';
    document.querySelector("#chart-line").style.maxHeight= '340px';
    // document.querySelector("#chart-line").style.minWidth = `${chartWidth}px`;

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(193,217,102,0.2)');

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(193,217,102,0.2)');

    for (let i = arrayMonth.length; i <10; i++) {
        arrayMonth.push(' ');
    }

    chartGrafik = new Chart(ctx2, {
        type: "line",
        data: {
            labels: arrayMonth,
            datasets: [
                {
                    label: "Kg",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#c1d966",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: arrayKg,
                    maxBarThickness: 6,
                    minBarLength: 6,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#b2b9bf',
                    beginAtZero: true,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#b2b9bf',
                    padding: 0,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            },
        },
    });
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
                   <span class="add-item badge badge-danger border-radius-sm cursor-pointer"  onclick="hapusKatSampahVal(this,'${k.id}','${k.name}')">
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
                     <span id="btn-hapus" class="badge badge-danger text-xxs pb-1 rounded-sm cursor-pointer" onclick="hapusSampah(this,'${n.id}')">hapus</span>
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
                <span id="btn-hapus" class="badge badge-danger text-xxs pb-1 rounded-sm cursor-pointer" onclick="hapusSampah(this,'${n.id}')">hapus</span>
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
  * HAPUS KATEGORI SAMPAH
  */
const hapusKatSampahVal = (el,id,katName) => {
    Swal.fire({
        title: 'ANDA YAKIN?',
        text: `semua sampah dengan kategori '${katName}' akan ikut terhapus`,
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
                        if ($('#formAddEditSampah input[name=kategori]').val() == katName) {
                            $('#formAddEditSampah input[name=kategori]').val('');    
                        }
                    
                        return httpRequestDelete(`${APIURL}/kategori_sampah/deleteitem?id=${id}`)
                        .then(e => {
                            if (e.status == 201) {
                                el.parentElement.parentElement.remove();
                                arrayKatSampah = arrayKatSampah.filter(e => e.id != id);
                                getAllJenisSampah();
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
};

 /**
  * HAPUS JENIS SAMPAH
  */
const hapusSampah = (el,id) => {
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
                    form.append('hashedpass',PASSADMIN);
                    form.append('password',password);
        
                    return axios
                    .post(`${APIURL}/admin/confirmdelete`,form, {
                        headers: {
                            // header options 
                        }
                    })
                    .then((response) => {
                        return httpRequestDelete(`${APIURL}/sampah/deleteitem?id=${id}`)
                        .then((e) => {
                            if (e.status == 201) {
                                el.parentElement.parentElement.remove();
                                arrayJenisSampah = arrayJenisSampah.filter(e => e.id != id);
                                if (arrayJenisSampah.length == 0) {
                                    $('#list-sampah-notfound').removeClass('d-none'); 
                                    $('#list-sampah-notfound #text-notfound').html(`sampah belum ditambah`); 
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
   else if ($('input#NewkategoriSampah').val().length > 20) {
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


/**
 * TRANSAKSI JUAL SAMPAH
 * =============================================
 */

// Edit modal when open
const openModalJualSampah = () => {
    $('.barisJualSampah').remove();
    tambahBaris();
    countTotalHarga();
    $('#formJualSampah .form-control').removeClass('is-invalid');
    $('#formJualSampah .text-danger').html('');
    $(`#formJualSampah .form-control`).val('');
}

// tambah baris
const tambahBaris = (event = false) => {
    if (event) {
        event.preventDefault();
    }

    let elJenisSampah = `<option value='' data-harga='0' data-tersedia='0' selected>-- pilih jenis sampah  --</option>`;

    if (arrayJenisSampah.length !== 0) {
        arrayJenisSampah.forEach(s=> {
            elJenisSampah += `<option value="${s.jenis}" data-harga="${s.harga}" data-tersedia="${s.jumlah}">${s.kategori} - ${s.jenis}</option>`;
        });
    }

    let totalBaris = $('.barisJualSampah').size();
    let elementRow = ` <td class="py-2" style="border-right: 0.5px solid #E9ECEF;">
        <span class="w-100 btn btn-danger d-flex justify-content-center align-items-center border-radius-sm" style="height: 38px;margin: 0;" onclick="hapusBaris(this);">
            <i class="fas fa-times text-white"></i>
        </span>
    </td>
    <td class="py-2" style="border-right: 0.5px solid #E9ECEF;">
        <select id="kategori-berita-wraper" class="inputJenisSampah form-control form-control-sm py-1 pl-2 border-radius-sm" name="transaksi[slot${totalBaris+1}][jenis_sampah]" style="min-height: 38px" onchange="getHargaInOption(this,event);">
            ${elJenisSampah}
        </select>
    </td>
    <td class="py-2 text-left" style="border-right: 0.5px solid #E9ECEF;">
        <input type="text" class="inputJumlahSampah form-control form-control-sm pl-2 border-radius-sm" value="0" name="transaksi[slot${totalBaris+1}][jumlah]" style="min-height: 38px" onkeyup="countHargaXjumlah(this);">

		<small class="text-danger"></small>
    </td>
    <td class="py-2">
        <input type="text" class="inputHargaSampah form-control form-control-sm pl-2 border-radius-sm" style="min-height: 38px" data-harga="0" value="0" disabled>
    </td>`

    let tr = document.createElement('tr');
    tr.classList.add('barisJualSampah');
    
    tr.innerHTML=elementRow;
    document.querySelector('#table-jual-sampah tbody').insertBefore(tr,document.querySelector('#special-tr'));
}

// tambah baris
const hapusBaris = (el) => {
    el.parentElement.parentElement.remove();
    countTotalHarga();
}

// get harga in option
const getHargaInOption = (el,event) =>{
    var harga    = event.target.options[event.target.selectedIndex].dataset.harga;
    var tersedia = event.target.options[event.target.selectedIndex].dataset.tersedia;

    let elInputJumlah   = el.parentElement.nextElementSibling.children[0];
    elInputJumlah.value = 1;
    elInputJumlah.setAttribute('data-tersedia',tersedia);
    elInputJumlah.classList.remove('is-invalid');
    elInputJumlah.nextElementSibling.innerHTML = '';

    let elInputHarga   = el.parentElement.nextElementSibling.nextElementSibling.children[0];
    // elInputHarga.value = modifUang(harga);
    elInputHarga.value = harga;
    elInputHarga.setAttribute('data-harga',harga);

    countTotalHarga();
};

// count harga*jumlah
const countHargaXjumlah = (el) =>{
    var jumlahKg = el.value;
    let elInputJenis = el.parentElement.previousElementSibling.children[0];
    
    if (elInputJenis.value !== '') {
        if (jumlahKg !== '') {
            let elInputHarga = el.parentElement.nextElementSibling.children[0];
            let harga        = elInputHarga.getAttribute('data-harga');
            
            elInputHarga.value = parseFloat(jumlahKg)*parseFloat(harga);
            countTotalHarga();
        }
    }
};

// count total harga sampah
const countTotalHarga = () =>{
    let total = 0;
    $(`.inputHargaSampah`).each(function() {
        total = total + parseFloat($(this).val());
    });

    $('#special-tr #total-harga').html(modifUang(total.toString()));
};

// Validate Jual sampah
const validateJualSampah = () => {
    let status = true;
    let msg    = '';
    $('#formJualSampah .form-control').removeClass('is-invalid');
    $('#formJualSampah .text-danger').html('');

    // tgl transaksi
    if ($('#formJualSampah #date').val() == '') {
        $('#formJualSampah #date').addClass('is-invalid');
        $('#formJualSampah #date-error').html('*tanggal harus di isi');
        status = false;
    }

    // jenis sampah
    $(`.inputJenisSampah`).each(function() {
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            status = false;
            msg    = 'input tidak boleh kosong!';
        }
    });
    // jumlah sampah
    $(`.inputJumlahSampah`).each(function() {
        if ($(this).val() == '') {
            $(this).addClass('is-invalid');
            status = false;
            msg    = 'input tidak boleh kosong!';
        }
        if (/[^0-9\.]/g.test($(this).val())) {
            $(this).addClass('is-invalid');
            status = false;
            msg    = 'jumlah hanya boleh berupa angka positif dan titik!';
        }
        if (parseFloat($(this).val()) > parseFloat($(this).attr('data-tersedia'))) {
            $(this).addClass('is-invalid');
            $(this).siblings().html(`hanya tersedia ${$(this).attr('data-tersedia')} kg`);
            status = false;
        }
    });

    if (status == false && msg !== "") {
        showAlert({
            message: `<strong>${msg}</strong>`,
            btnclose: false,
            type:'danger'
        })
        setTimeout(() => {
            hideAlert();
        }, 3000);
    }

    return status;
}

// Send Transaksi to API
const doTransaksi = async (el,event) => {
    event.preventDefault();
    let elForm    = el.parentElement.parentElement.parentElement;

    if (validateJualSampah()) {
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
                    doTransaksiInner();
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
        
        let doTransaksiInner = async () => {
            let form         = new FormData(elForm);
            let tglTransaksi = form.get('date').split('-');
            form.set('date',`${tglTransaksi[2]}-${tglTransaksi[1]}-${tglTransaksi[0]}`);
    
            showLoadingSpinner();
            httpResponse = await httpRequestPost(`${APIURL}/transaksi/jualsampah`,form);    
            hideLoadingSpinner();
    
            if (httpResponse.status === 201) {
                chartGrafik.destroy();
                $(`#formJualSampah .form-control`).val('');
                $('#formJualSampah .form-check-input').prop('checked',false);
                $(`#filter-year`).val(tglTransaksi[0]);
                getRekapTransaksi(tglTransaksi[0]);
    
                $('#formJualSampah .barisJualSampah').remove();
                tambahBaris();
                countTotalHarga();
                getAllJenisSampah();
    
                showAlert({
                    message: `<strong>Success...</strong> jual sampah berhasil!`,
                    btnclose: false,
                    type:'success'
                })
                setTimeout(() => {
                    hideAlert();
                }, 3000);
            }
        }
    }

}