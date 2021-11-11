/**
 * Get Detail Artikel
 */
showLoadingSpinner();
axios.get(`${APIURL}/berita_acara/getitem?id=${IDARTIKEL}`)
.then(res => {
    let response  = res.data.data;
    let date      = new Date(parseInt(response.created_at) * 1000);
    let day       = date.toLocaleString("en-US",{day: "numeric"});
    let month     = date.toLocaleString("en-US",{month: "long"});
    let year      = date.toLocaleString("en-US",{year: "numeric"});
    $('#blog-title').html(response.title);
    $('#blog-date').html(`<i class="fa fa-calendar text-muted text-xxs"></i>${month}, ${day} ,${year}`);
    $('#blog-content').html(response.content);
    $('#blog-img').attr('src', response.thumbnail);
    hideLoadingSpinner();
})
.catch(err => {
    hideLoadingSpinner();
    if (err.response.status == 404){
        $('#blog-title').html('Punten?');
    }  
    else if (err.response.status == 500){
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
    console.log(res);
    let elBerita  = '';
    let allBerita = res.data.data;
    arrayBerita   = allBerita;
    
    arrayBerita.forEach(b => {
        let newdate      = new Date(parseInt(b.created_at) * 1000);
        let newday       = newdate.toLocaleString("en-US",{day: "numeric"});
        let newmonth     = newdate.toLocaleString("en-US",{month: "long"});
        let newyear      = newdate.toLocaleString("en-US",{year: "numeric"});
        elBerita += `<div id="single-post">
                        <div class="image">
                            <img src="${BASEURL}/assets/images/404.webp" alt="thumbnail">
                        </div>
                        <div class="content">
                            <h5>
                                <a href="${BASEURL}/artikel/${b.id}" style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">
                                    ${b.title}
                                </a>
                            </h5>
                            <ul class="comment">
                                <li><i class="fa fa-calendar" aria-hidden="true"></i> ${newmonth} ${newday}, ${newyear}</li>
                            </ul>
                        </div>
                    </div>
                    <hr width="80%">`;
    
            });
        $('#blog-recommended').html(elBerita);
})
.catch(err => {
    hideLoadingSpinner();
    console.log(err);
});