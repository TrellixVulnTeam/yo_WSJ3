$(document).ready(function(){
    
    
    $("#carritopro").click(function (e) { 
        e.preventDefault();

        $.ajax({
            'url' : appData.base_url + "carrito/",
            "type" : "post",
            "data" : {
                "idcliente" : appData.idcliente,
                "token" : appData.token
            }
        })
        .done(function(data){
            
                let url = appData.base_url+"carrito/";
                $('.modalCarritoUser').load(url,function(){
                    $('#carritoM').modal({show:true}); 
                });
            })
    
            .fail(error_ajax);
    });
})
    
    
    
    
    
    
    function carrito_de_compras(){
        this.event.preventDefault();
        let url = "vistas/modal/carrito_de_compras.php?id_usuario="+ id_usuario;
        $('.modalCarritoUser').load(url,function(){
            $('#carritoM').modal({show:true}); 
        });
        
    }