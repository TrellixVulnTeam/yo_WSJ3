const { json } = require("stream/consumers");
var carrito = 0;
var check = false;

function changeVal(el) {
  var qt = parseFloat(el.parent().children(".qt").html());
  var price = parseFloat(el.parent().children(".price").html());
  var eq = Math.round(price * qt * 100) / 100;
  
  el.parent().children(".full-price").html( eq + "€" );
  
  changeTotal();			
}

function changeTotal() {
  
  var price = 0;
  
  $(".full-price").each(function(index){
    price += parseFloat($(".full-price").eq(index).html());
  });
  
  price = Math.round(price * 100) / 100;
  var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($(".shipping span").html());
  var fullPrice = Math.round((price + tax + shipping) *100) / 100;
  
  if(price == 0) {
    fullPrice = 0;
  }
  
  $(".subtotal span").html(price);
  $(".tax span").html(tax);
  $(".total span").html(fullPrice);
}

$(document).ready(function(){
  
  //  $("#mensaje_agregado_carrito").hide();

  $(".remove").click(function(){
    var el = $(this);
    el.parent().parent().addClass("removed");
    window.setTimeout(
      function(){
        el.parent().parent().slideUp('fast', function() { 
          el.parent().parent().remove(); 
          if($(".product").length == 0) {
            if(check) {
              $("#cart").html("<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>");
            } else {
              $("#cart").html("<h1>No products!</h1>");
            }
          }
          changeTotal(); 
        });
      }, 200);
  });
  
  $(".qt-plus").click(function(){
    $(this).parent().children(".qt").html(parseInt($(this).parent().children(".qt").html()) + 1);
    
    $(this).parent().children(".full-price").addClass("added");
    
    var el = $(this);
    window.setTimeout(function(){el.parent().children(".full-price").removeClass("added"); changeVal(el);}, 150);
  });
  
  $(".qt-minus").click(function(){
    
    child = $(this).parent().children(".qt");
    
    if(parseInt(child.html()) > 1) {
      child.html(parseInt(child.html()) - 1);
    }
    
    $(this).parent().children(".full-price").addClass("minused");
    
    var el = $(this);
    window.setTimeout(function(){el.parent().children(".full-price").removeClass("minused"); changeVal(el);}, 150);
  });
  
  window.setTimeout(function(){$(".is-open").removeClass("is-open")}, 1200);
  
  $(".btn").click(function(){
    check = true;
    $(".remove").click();
  });
});





// $("#btn_addshopping").click({idproducto},function(e){
// e.preventDefault();

// addshopping(idproducto);
// });

function addCart(idproducto,nombre_producto,descripcion_producto,imagen_producto,precio_producto,categoria_producto){

  console.log(idproducto,nombre_producto,descripcion_producto,imagen_producto,precio_producto,categoria_producto);


  $.ajax({
    'url' : appData.ws_url + "productos/insertarcarrito/",
            "dataType" : "json",
            "type" : "post",
            "data" : {
                "idproducto" : idproducto,
            }
  })
  .done(function(json){
alert(JSON.stringify(json))

$("#cerrarmodal").click();
$("#ProjectId").html(json.mensaje);

if(json.resultado){

  janelaPopUp.abre( "example", 'p green',  'CARRITO' ,  json.mensaje);
  setTimeout(function(){janelaPopUp.fecha('example');}, 2000);
}
else{

  janelaPopUp.abre( "example", 'p red',  'CARRITO' ,  json.mensaje);
  setTimeout(function(){janelaPopUp.fecha('example');}, 2000);

  
}
 
  })
  .fail(error_ajax)








    // $.ajax({
    //     'url' : appData.base_url + "carrito/getcarrito/",
    //     "type" : "post",
    //     "data" : {
    //         "idproducto" : idproducto,
    //         "nombre_producto" : nombre_producto,
    //         'descripcion_producto': descripcion_producto,
    //         'imagen_producto':imagen_producto,
    //         'precio_producto':precio_producto,
    //         'categoria_producto':categoria_producto}
    // })
    // .done(function(done){
    //     window.location.href = appData.base_url + "carrito/getcarrito/"+
    //     appData.idcliente+"/"+appData.token;
    //     })

    //     .fail(error_ajax);


  // $("#titulo").html(nombre_producto); 
  // $("#carrito__imagen").attr("src",appData.base_url+'static/assets/img/build/img/calistenia/'+imagen_producto); 
  // $("")


    // $.ajax({
    //     'url' : appData.base_url + "carrito/getcarrito/",
    //     "type" : "post",
    //     'success': AjaxSucceeded,
    //     "data" : {
    //         "idproducto" : idproducto,
    //         "nombre_producto" : nombre_producto,
    //         'descripcion_producto': descripcion_producto,
    //         'imagen_producto':imagen_producto,
    //         'precio_producto':precio_producto,
    //         'categoria_producto':categoria_producto
    //       }
    // })
    // .done(function(json){
    //   alert(JSON.stringify(json));
    //   appDataCarrito = json;
    //     // window.location.href = appData.base_url + "carrito/"
    //     // appData.idcliente+"/"+appData.token;
    //     })

        // .fail(error_ajax);

        // function AjaxSucceeded(result){
        //   if(carrito == 0){
        //     alerta("succes","bien" );
        //     appDataCarrito = {
        //       "idproducto" : idproducto,
        //       "nombre_producto" : nombre_producto,
        //       'descripcion_producto': descripcion_producto,
        //       'imagen_producto':imagen_producto,
        //       'precio_producto':precio_producto,
        //       'categoria_producto':categoria_producto   
        //     };
        //   }
          
        
       
        // }

}