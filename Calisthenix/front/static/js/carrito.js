$(document).ready(function () {

});
function shopping() {
    $.ajax({
        'url': appData.base_url + "carrito/index/",
        "type": "post",
        "data": {
            "idcliente": appData.idcliente,
            "token": appData.token
        }
    })
        .done(function (done) {
            window.location.href = appData.base_url + "carrito/index/" +
                appData.idcliente + "/" + appData.token;
        })
        .fail();
}



