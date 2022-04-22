/**
* GET ALL PENGHARGAAN
*/
let arrayBerita = [];
axios.get(`${APIURL}/penghargaan/getpenghargaan`)
    .then(res => {
        let elMitra = ''
        res.data.data.forEach(e => {
            elMitra += `<div class="col-12 col-sm-6 col-md-4 mb-5 h-100">
                <div class="card no_skeleton h-100" style="display:flex;flex-direction:column;justify-content:center;align-items:center;cursor:pointer;" data-icon="${e.icon}" data-desc="${e.description}" onclick="cardOnClick(this);">
                    <div style="max-height:180px;overflow:hidden;">
                        <img class="img-thumbnail" src="${e.icon}" style="width:100%;"/>
                    </div>
                    <p class="text-center text-uppercase" style="margin-top:10px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;">
                        ${e.description}
                    </p>
                </div>
            </div>`;
        });

        $('#container-penghargaan').html(elMitra);
    })
    .catch(err => {
        $('#container-penghargaan').addClass('d-none');
        $('#img-404').removeClass('d-none');
        if (err.response.status == 500){
            showAlert({
                message: `<strong>Ups...</strong> terjadi kesalahan pada server, silahkan refresh halaman.`,
                btnclose: true,
                type:'danger' 
            })
        }
    });

/**
 * Card On Click
 */
let zoomBg = document.querySelector("#zoom_bg");
let zoomImg = document.querySelector("#zoom_bg #zoom_img")
let zoomClose = document.querySelector("#zoom_bg #zoom_close")
function cardOnClick(el) {
    let icon = el.dataset.icon;
    let desc = el.dataset.desc;

    document.body.style.overflow="hidden";
    zoomBg.classList.remove("hide");
    zoomImg.src = icon;
    console.log();
}
zoomClose.addEventListener("click", () => {
    zoomBg.classList.add("hide");
    zoomImg.src = "";
})