/**
* GET ALL ARTIKEL
*/

let arrayBerita = [];

axios.get(`${APIURL}/berita_acara/getitem?kategori=${KATEGORI}`)
    .then(res => {
        let elBerita  = '';
        let allBerita = res.data.data;
        arrayBerita   = allBerita;
        
        allBerita.forEach(b => {
            let date      = new Date(parseInt(b.created_at) * 1000);
            let day       = date.toLocaleString("en-US",{day: "numeric"});
            let month     = date.toLocaleString("en-US",{month: "long"});
            let year      = date.toLocaleString("en-US",{year: "numeric"});

            elBerita += `<div class="col-sm-6 col-lg-4 mb-5">
            <a href="${BASEURL}/artikel/${b.id}" class="card text-white card-has-bg click-col position-relative">
            
                <img src="${b.thumbnail}" class="position-absolute" style="height:100%;width:100%;">

                <div class="card-img-overlay d-flex flex-column">
                    <div class="card-body">
                        <small class="card-meta mb-2">${b.kategori}</small>
                        <h4 class="card-title mt-0 ">
                            ${b.title}
                        </h4>
                    </div>
                    <div class="card-footer">
                        <div class="media">
                            <div class="media-body">
                            <small><i class="far fa-clock"></i> ${month} ${day}, ${year}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>`;
        });
        
        $('#container-article').html(elBerita);
    })
    .catch(err => {
        if (err.response.status == 404){
            $('#container-article').addClass('d-none');
            $('#img-404').removeClass('d-none');
        }  
        else if (err.response.status == 500){
            $('#container-article').addClass('d-none');
            $('#img-404').removeClass('d-none');
            showAlert({
                message: `<strong>Ups...</strong> terjadi kesalahan pada server, silahkan refresh halaman.`,
                btnclose: true,
                type:'danger' 
            })
        }
    });