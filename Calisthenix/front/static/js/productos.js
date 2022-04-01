
$(document).ready(function(){
    cargatodo();
});


var activities = document.getElementById("select_categorias");
activities.addEventListener("change", function() {
    $("#titulo_productos").html($("#select_categorias :selected").text());  
    
    $(".productos").remove();
    getcategoria();
    
    
    
    
});










function getcategoria(){
    $.ajax({
        "url" : appData.ws_url + "productos/getproductos/",
        'dataType' : "json"
    })
    .done(function(json){
        
        // alert(JSON.stringify(json));
        if(json.resultado){
            
            
            json.productos.forEach((element,i) => {
                
                imagen = JSON.stringify(element["imagen_producto"]);
                imagen = JSON.parse(imagen);
                
                
                categoria = JSON.stringify(element["categoria_producto"]);
                categoria = JSON.parse(categoria);
                
                
                // alert(JSON.stringify(element["categoria_producto"]));
                quetiene = $("#titulo_productos").html();
                
                
                if(categoria ===  quetiene){
                    //   alert("entra");
                    $( "#portfolio" ).append(
                        
                        '<div class="col-lg-4 col-sm-6 mb-4 productos">'+
                        '<div class="portfolio-item">'+
                        '<a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal">'+
                        '<div class="portfolio-hover">'+
                        '<div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>'+
                        '</div>'+
                        '<img class="img-fluid" src="'+appData.base_url+'static/assets/img/build/img/calistenia/'+imagen+'"alt="..." />'+
                        '</a>'+
                        '<div class="portfolio-caption">'+
                        '<div class="portfolio-caption-heading">'+element['nombre_producto']+'</div>'+
                        '<div class="portfolio-caption-subheading text-muted">'+element['descripcion_producto']+'</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'
                        )
                    }
                    else if(quetiene=="All"){
                      
                        cargatodo();
                    }
                });
            }
            else{
                alerta("info",json.mensaje);
            }
            
        })
        .fail(error_ajax);
    }
    
    
    
    
    function cargatodo(){
        //OBTENER CATEGORIAS
        $.ajax({
            "url" : appData.ws_url + "productos/getproductos/",
            'dataType' : "json"
        })
        .done(function(json){
            
            if(json.resultado){
                $(".productos").remove();


                if( $("#select_categorias option[value='text-center']").length >0){

                }
                else{
                json.categorias.forEach(element => {
                     
            
                    $( "#select_categorias" ).append(
                        '<option value="text-center">' + element["categoria_producto"] + '</option>' 
                        )          
                
          
                    });   
                    
                }
                    json.productos.forEach((element,i) => {
                        
                        imagen = JSON.stringify(element["imagen_producto"]);
                        imagen = JSON.parse(imagen);
                        console.log(imagen)
                        
                        
                        $( "#portfolio" ).append(
                            
                            '<div class="col-lg-4 col-sm-6 mb-4 productos">'+
                            '<div class="portfolio-item">'+
                            '<a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal">'+
                            '<div class="portfolio-hover">'+
                            '<div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>'+
                            '</div>'+
                            '<img class="img-fluid" src="'+appData.base_url+'static/assets/img/build/img/calistenia/'+imagen+'"alt="..." />'+
                            '</a>'+
                            '<div class="portfolio-caption">'+
                            '<div class="portfolio-caption-heading">'+element['nombre_producto']+'</div>'+
                            '<div class="portfolio-caption-subheading text-muted">'+element['descripcion_producto']+'</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>'
                            )
                            
                        });
                    }
                    else{
                        alerta("info",json.mensaje);
                    }
                    

                appDataProductos = json;
                 console.log(appDataProductos);   
                })
                .fail(error_ajax);
            }




             $("#portfolioModal").click(function (e) { 
                 $("#ProjectName").html(appDataProductos);
                 e.preventDefault();
                  alert(JSON.stringify(appDataProductos));


                 
             });