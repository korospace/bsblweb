/**
 * Get Detail Artikel
 */
axios.get(`${APIURL}/berita_acara/getitem?id=${IDARTIKEL}`)
.then(res => {
    let response  = res.data.data;
    let date      = new Date(parseInt(response.created_at) * 1000);
    let day       = date.toLocaleString("en-US",{day: "numeric"});
    let month     = date.toLocaleString("en-US",{month: "long"});
    let year      = date.toLocaleString("en-US",{year: "numeric"});
    $('#blog-img').parent().removeClass('skeleton');
    $('#blog-img').removeClass('d-none');
    $('#blog-img').attr('src', response.thumbnail);
    $('#blog-title').removeClass('skeleton');
    $('#blog-title').html(response.title);
    $('#blog-date').removeClass('skeleton');
    $('#blog-date').html(`<i class="fa fa-calendar text-muted text-xxs"></i>${month}, ${day} ,${year}`);
    $('#blog-content').html(response.content);
    hideLoadingSpinner();
})
.catch(err => {
    if (err.response.status == 404){
        $('#img-404').removeClass('d-none');
        $('.main-content').addClass('d-none');
        $('.sidebar-content').addClass('d-none');
    }  
    else if (err.response.status == 500){
        $('#img-404').removeClass('d-none');
        $('.main-content').addClass('d-none');
        $('.sidebar-content').addClass('d-none');
        showAlert({
            message: `<strong>Ups...</strong> terjadi kesalahan pada server, silahkan refresh halaman.`,
            btnclose: true,
            type:'danger' 
        })
    }
});

/**
 * Get Other Items
 */
let arrayBerita = [];
axios.get(`${APIURL}/berita_acara/otheritem?id=${IDARTIKEL}`)
.then(res => {
    let elBerita  = '';
    let allBerita = res.data.data;
    arrayBerita   = allBerita;
    
    arrayBerita.forEach(b => {
        let newdate      = new Date(parseInt(b.created_at) * 1000);
        let newday       = newdate.toLocaleString("en-US",{day: "numeric"});
        let newmonth     = newdate.toLocaleString("en-US",{month: "long"});
        let newyear      = newdate.toLocaleString("en-US",{year: "numeric"});
        elBerita += `<a id="single-post" href="${BASEURL}/artikel/${b.id}" class="col-12 col-sm-6 col-lg-12 mb-4">
                        <div class="image position-relative">
                            <img src="${BASEURL}/assets/images/skeleton-thumbnail.webp" alt="thumbnail" class="w-100 position-relative" style="z-index: 1;">
                            <img src="${b.thumbnail}" alt="thumbnail" class="w-100 h-100 position-absolute" style="z-index: 10;left:0;">
                        </div>
                        <div class="content mt-3">
                            <h5 class="text-dark" style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">
                                ${b.title}
                            </h5>
                            <h6 class="text-secondary mt-2" style="font-size: 13px;">
                                ${b.kategori}
                            </h6>
                            <h6 class="text-secondary mt-1" style="font-size: 13px;">
                                <i class="fa fa-calendar" aria-hidden="true" style="font-size: 10px;"></i> ${newmonth} ${newday}, ${newyear}
                            </h6>
                        </div>
                    </a>
                    <hr width="">`;
    
            });
        $('#blog-recommended').html(elBerita);
})
.catch(err => {
    $('#blog-recommended').html('');
});