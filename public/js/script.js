var jumlahTitikKoordinat = 4;
var koordinatPolygon = document.getElementById('koordinatPolygon');

/*
*
* Menambah tag input pada form tambah di halaman koordinat
*
*/
function tambahInputKoordinatPolygon() {
    let colmd61 = document.createElement('div');
    colmd61.setAttribute('class', 'col-md-6 tambahLat');
    let colmd62 = document.createElement('div');
    colmd62.setAttribute('class', 'col-md-6 tambahLong');

    let formgroupLat = document.createElement('div');
    formgroupLat.setAttribute('class', 'form-group');

    let formgroupLong = document.createElement('div');
    formgroupLong.setAttribute('class', 'form-group');

    let labelLat = document.createElement('label');
    labelLat.innerHTML = `Titik Latitude ${jumlahTitikKoordinat}`;

    let labelLong = document.createElement('label');
    labelLong.innerHTML = `Titik Longitude ${jumlahTitikKoordinat}`;

    let small1 = document.createElement('small');
    small1.setAttribute('style', 'color: red;');
    small1.innerHTML = '* Wajib diisi';

    let small2 = document.createElement('small');
    small2.setAttribute('style', 'color: red;');
    small2.innerHTML = '* Wajib diisi';

    labelLat.appendChild(small1);
    labelLong.appendChild(small2);

    let inputLat = document.createElement('input');
    inputLat.setAttribute('type','number');
    inputLat.setAttribute('name',`lat${jumlahTitikKoordinat}`);
    inputLat.setAttribute('class','form-control shadow-sm');
    inputLat.setAttribute('step',1e-15);
    inputLat.setAttribute('required', '');

    let inputLong = document.createElement('input');
    inputLong.setAttribute('type','number');
    inputLong.setAttribute('name',`long${jumlahTitikKoordinat}`);
    inputLong.setAttribute('class','form-control shadow-sm');
    inputLong.setAttribute('step',1e-15);
    inputLong.setAttribute('required', '');

    formgroupLat.appendChild(labelLat);
    formgroupLat.appendChild(inputLat);

    formgroupLong.appendChild(labelLong);
    formgroupLong.appendChild(inputLong);

    colmd61.appendChild(formgroupLat);
    colmd62.appendChild(formgroupLong);

    koordinatPolygon.appendChild(colmd61);
    koordinatPolygon.appendChild(colmd62);

    jumlahTitikKoordinat++;
}

function hapusInputKoordinatPolygon() {
    let inputLat = Array.from(document.querySelectorAll('.tambahLat'));
    let inputLong = Array.from(document.querySelectorAll('.tambahLong'));
    koordinatPolygon.removeChild(inputLat[(inputLat.length) - 1]);
    koordinatPolygon.removeChild(inputLong[(inputLong.length) - 1]);
    jumlahTitikKoordinat--;
}

/*
*
* Interaksi tombol keterangan polygon
*
*/
function editKeteranganPolygon(id) {
    let inputKet = document.getElementById(`ket${id}`);
    let tblEdit = document.getElementById(`editKet${id}`);
    let tblSave = document.getElementById(`simpanKet${id}`);

    tblEdit.classList.toggle('hidden');
    tblSave.classList.toggle('hidden');

    inputKet.removeAttribute('readonly');
}

function simpanKeteranganPolygon(id) {
    let inputKet = document.getElementById(`ket${id}`);
    let tblEdit = document.getElementById(`editKet${id}`);
    let tblSave = document.getElementById(`simpanKet${id}`);

    tblEdit.classList.toggle('hidden');
    tblSave.classList.toggle('hidden');

    inputKet.setAttribute('readonly', '');
}

/*
*
* Interaksi tombol koordinat polygon
*
*/
function editKoordinat(id, lat, long) {
    let latfield = document.getElementById(lat);
    let longfield = document.getElementById(long);
    let tblEdit = document.getElementById(`edit${id}`);
    let tblSave = document.getElementById(`simpan${id}`);

    latfield.removeAttribute('readonly');
    longfield.removeAttribute('readonly');

    tblEdit.classList.toggle('hidden');
    tblSave.classList.toggle('hidden');
}

function simpanEditKoordinat(id, lat, long) {
}