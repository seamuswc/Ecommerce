(function(){
    document.addEventListener('DOMContentLoaded',generateQRCode);

    function generateQRCode() {

        let qrcode = new QRCode("qrcode",{
                width: 175,
                height: 175
            }),
            address = document.getElementById('crypto-address').textContent.trim();

        if (address.length) {
            qrcode.makeCode(address);
        }
    }

})();
