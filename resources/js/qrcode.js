window.Instascan = require('instascan');
let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
scanner.addListener('scan', function (content) {
    console.log(content);
});
Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras[1]) {
        scanner.start(cameras[1]);
    } else {
        scanner.start(cameras[0]);
        // console.error('No cameras found.');
    }
}).catch(function (e) {
    console.error(e);
});