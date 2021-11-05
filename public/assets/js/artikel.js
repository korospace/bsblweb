/**
* GET ALL ARTIKEL
*/

let arrayBerita    = [];

showLoadingSpinner();
axios.get(`${APIURL}/berita_acara/getitem?kategori=${KATEGORI}`)
.then(res => {
    hideLoadingSpinner();

    let elBerita  = '';
    let allBerita = res.data.data;
    arrayBerita   = allBerita;
    
    allBerita.forEach(b => {
        
        let date      = new Date(parseInt(b.created_at) * 1000);
        let day       = date.toLocaleString("en-US",{day: "numeric"});
        let month     = date.toLocaleString("en-US",{month: "long"});
        let year      = date.toLocaleString("en-US",{year: "numeric"});

        elBerita += `<div class="col-md-4 pt-5">
        <div class="card text-white card-has-bg click-col"
            style="background-image:url('${b.thumbnail}'); object-fit: contain;">
            <div class="card-img-overlay d-flex flex-column">
                <div class="card-body">
                    <small class="card-meta mb-2">Thought Leadership</small>
                    <h4 class="card-title mt-0 "><a class="text-white" herf="<?= base_url('/artikel/'${b.id}) ?>">
                    ${b.title}</a></h4>
                </div>
                <div class="card-footer">
                    <div class="media">
                        <div class="media-body">
                        <small><i class="far fa-clock"></i> ${month} ${day}, ${year}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
    });
    
    $('#container-article').html(elBerita);

  })
  .catch(err => {
    hideLoadingSpinner();
    if (err.response.status == 404){
        $('#img-404').removeClass('d-none');
    }  
    else if (err.response.status == 500){
        showAlert({
            message: `<strong>Ups...</strong> terjadi kesalahan pada server, silahkan refresh halaman.`,
            btnclose: true,
            type:'danger' 
        })
    }
  });