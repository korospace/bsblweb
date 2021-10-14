axios.get(baseurl+'/sampah/totalitem')
.then(res => {
    let elTotalSampah = '';
    let totalSampah   = res.data.data;

    for (const ts in totalSampah) {
        console.log(totalSampah[ts]);
        elTotalSampah += `<div class="col-md-3 col-sm-6">
          <div class="counter">
            <span class="counter-value">${kFormatter(totalSampah[ts].total)}</span>
            <div class="counter-content">
              <h3>KG<br>${totalSampah[ts].title}</br></h3>
            </div>
          </div>
        </div>`;
    }

    document.getElementById('totalSampahWraper').innerHTML = elTotalSampah;
}) 
.catch(res => {
    console.log(res);
})

// modif number
function kFormatter(num) {
    return Math.abs(num) > 999 ? Math.sign(num)*((Math.abs(num)/1000).toFixed(1)) + 'k' : Math.sign(num)*Math.abs(num)
}

const dataSampah = ( async() => {
    
});