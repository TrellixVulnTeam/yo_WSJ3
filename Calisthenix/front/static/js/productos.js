$(document).ready(function(){
//OBTENER CATEGORIAS
    $.ajax({
        "url" : appData.ws_url + "productos/getproductos/",
        'dataType' : "json"
    })
    .done(function(json){
        
        alert(JSON.stringify(json));
        if(json.resultado){

          json.categorias.forEach(element => {

                $( "#select_categorias" ).append(
                    '<option value="text-center">' + element["categoria_producto"] + '</option>' 
                )
            });   
            
            
            json.productos.forEach((element,i) => {
                
                imagen = JSON.stringify(element["imagen_producto"]);
                imagen = JSON.parse(imagen);
                console.log(imagen)

              
                $( "#portfolio" ).append(

                    '<div class="col-lg-4 col-sm-6 mb-4">'+
                       '<div class="portfolio-item">'+
                            '<a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">'+
                                '<div class="portfolio-hover">'+
                                   '<div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>'+
                                '</div>'+
                                '<img class="img-fluid" src="'+appData.base_url+'static/assets/img/build/img/calistenia/'+imagen+'"alt="..." />'+
                           '</a>'+
                            '<div class="portfolio-caption">'+
                                '<div'+
                                'class="portfolio-caption-heading">'+element['nombre_producto']+'</div>'+
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
        
        })
        .fail(error_ajax);
    });
    var activities = document.getElementById("select_categorias");
    activities.addEventListener("change", function() {
        $("#titulo_productos").html($("#select_categorias :selected").text());  
        

    });