 alert("carrito de compras");


var id_usuario       = appData.idcliente;
var total = 0;
var lenguaje = {
      "processing": "Procesando...",
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "No se encontraron resultados",
      "emptyTable": "Ningún dato disponible en esta tabla",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "search": "Buscar:",
      "infoThousands": ",",
      "loadingRecords": "Cargando...",
      "paginate": {
      "first": "Primero",
      "last": "Último",
      "next": "Siguiente",
      "previous": "Anterior"
      },
      "aria": {
      "sortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
      "copy": "Copiar",
      "colvis": "Personalizar Vista",
      "collection": "Colección",
      "colvisRestore": "Restaurar visibilidad",
      "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
      "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
      },
      "copyTitle": "Copiar al portapapeles",
      "csv": "CSV",
      "excel": "Excel",
      "pageLength": {
            "-1": "Mostrar todas las filas",
            "1": "Mostrar 1 fila",
            "_": "Mostrar %d filas",
            
      },
      "pdf": "PDF",
      "print": "Imprimir"
      },
      "autoFill": {
      "cancel": "Cancelar",
      "fill": "Rellene todas las celdas con <i>%d<\/i>",
      "fillHorizontal": "Rellenar celdas horizontalmente",
      "fillVertical": "Rellenar celdas verticalmentemente"
      },
      "decimal": ",",
      "searchBuilder": {
      "add": "Añadir condición",
      "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
      },
      "clearAll": "Borrar todo",
      "condition": "Condición",
      "conditions": {
            "date": {
                  "after": "Despues",
                  "before": "Antes",
                  "between": "Entre",
                  "empty": "Vacío",
                  "equals": "Igual a",
                  "not": "No",
                  "notBetween": "No entre",
                  "notEmpty": "No Vacio"
            },
            "moment": {
                  "after": "Despues",
                  "before": "Antes",
                  "between": "Entre",
                  "empty": "Vacío",
                  "equals": "Igual a",
                  "not": "No",
                  "notBetween": "No entre",
                  "notEmpty": "No vacio"
            },
            "number": {
                  "between": "Entre",
                  "empty": "Vacio",
                  "equals": "Igual a",
                  "gt": "Mayor a",
                  "gte": "Mayor o igual a",
                  "lt": "Menor que",
                  "lte": "Menor o igual que",
                  "not": "No",
                  "notBetween": "No entre",
                  "notEmpty": "No vacío"
            },
            "string": {
                  "contains": "Contiene",
                  "empty": "Vacío",
                  "endsWith": "Termina en",
                  "equals": "Igual a",
                  "not": "No",
                  "notEmpty": "No Vacio",
                  "startsWith": "Empieza con"
            }
      },
      "data": "Data",
      "deleteTitle": "Eliminar regla de filtrado",
      "leftTitle": "Criterios anulados",
      "logicAnd": "Y",
      "logicOr": "O",
      "rightTitle": "Criterios de sangría",
      "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
      },
      "value": "Valor"
      },
      "searchPanes": {
      "clearMessage": "Borrar todo",
      "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
      },
      "count": "{total}",
      "countFiltered": "{shown} ({total})",
      "emptyPanes": "Sin paneles de búsqueda",
      "loadMessage": "Cargando paneles de búsqueda",
      "title": "Filtros Activos - %d"
      },
      "select": {
      "1": "%d fila seleccionada",
      "_": "%d filas seleccionadas",
      "cells": {
            "1": "1 celda seleccionada",
            "_": "$d celdas seleccionadas"
      },
      "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
      }
      },
      "thousands": "."
};

if (!$.fn.DataTable.isDataTable('#table_carrito')) {
      tableGeneral = $("#table_carrito").DataTable({
            dom: '<"contenedorT"<"spaceNum mb-2 "l> <"leftC"> <"derechaB"f> >rtp',
            "ajax":{
                  'url' : 'bd/enlaces/carrito_cliente.php',
                  'data' : { 'id_usuario' : id_usuario},
                  'type' : 'POST'
            },
            "columns":[
                  {"data":"sucursal"},
                  {"data":"producto"},
                  {"data":"img_prod"},
                  {"data":"precio_prod"},
                  {"data":"cantidad"},
                  {"data":"subtotal"},
                  {"data":"acciones"},
                  {"data":"estatus","visible":false}
            ],
            "columnDefs": [
                  {"className": "dt-center", "targets": "_all",
                        "createdCell": function (td, cellData, rowData, row, col) {
                              if(col == 5) {
                                    if (typeof cellData === 'number') {
                                          $(td).html(cellData.toFixed(2));
                                    }    
                              }

                              else if(col == 3) {
                                    if (typeof cellData === 'number') {
                                          $(td).html(cellData.toFixed(2) );
                                    }    
                              }
                        }
                  }
            ],
            "drawCallback":function(){
                  var api = this.api();
                  $(api.column(0).footer()).html(
                      'Total: $ '+api.column(5, {page:'current'}).data().sum().toFixed(2)
                  )
            },
            "rowCallback": function( row, data ) {
                  if(data.estatus == 0){
                        $(row).css('background-color', '#FDA794').css('color', '#000000'); 
                  }
            },
            "paging": true,
            "lengthMenu": [[50, 25,10, -1], [50, 25,10, "All"]],
            "language" :lenguaje,
            "responsive":true,
            "scrollX": false,
            initComplete: function (settings, json) {
                  initPayPalButton();
            },
      });
};



$('#table_carrito tbody').on('mouseover', 'tr', function () {
      $('body>.tooltip').remove();
      $('.img_data_tooltip').tooltip({
            placement: 'right',
            html: true, 
            trigger: "click"
      });
});

async function comprarcarritoPaypal(statusP,id){

      if(statusP == "COMPLETED"){
            let url = "http://dtai.uteq.edu.mx/~descua201/portafolio/vistas/integradora/bd/facturas.php?id_usuario="+id_usuario.toString();
            window.open(url);
            setTimeout(async function(){
                  let response = await finalizarcompra();
                  let datos = JSON.parse(response);
                  let status        = datos.status;
                  let message       = datos.message;
                  let data          = datos.data;
                  if(status == "error"){
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message,
                        }).then(() => {
                              $(location).attr('href','index.php');
                        });
                  }
                  else{
                        let newmessage = "Transaction <strong>" + statusP.toString() + "</strong></br> Id : </br> <strong>"+ id.toString() + "</strong>";
                        Swal.fire({
                              title: '<strong>Correct!</strong>',
                              icon: 'success',
                              html:
                              newmessage,
                              showCloseButton: false,
                              showCancelButton: false,
                              confirmButtonText:
                              '<i class="fa fa-thumbs-up"></i> OK!'
                        }).then(() => {
                              $(location).attr('href','index.php');
                        });
            }
            },3000);
            
      }
      else{
            Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: "No se pudo realizar el Pago",
                  }).then(() => {
                        $(location).attr('href','index.php');
                  });
      }
      
}

async function comprarcarrito(){
      let response = await finalizarcompra();
      let datos = JSON.parse(response);
      let status        = datos.status;
      let message       = datos.message;
      let data          = datos.data;
      if(status == "error"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message,
            }).then(() => {
                  $(location).attr('href','index.php');
            });
      }
      else{
            let folio = data.folio.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();;
            let total = data.total;
           
            
            let newmessage = "Por favor Pague <strong>$" + total.toString() + "</strong></br> con el código : </br> <strong>"+ folio.toString() + "</strong>";
            Swal.fire({
                  title: '<strong>Correct!</strong>',
                  icon: 'success',
                  html:
                    newmessage,
                  showCloseButton: false,
                  showCancelButton: false,
                  confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> OK!'
                }).then(() => {
                  $(location).attr('href','index.php');
              });
      }
      
}

function finalizarcompra(){
      let url = "bd/enlaces/comprar_carrito.php";
      let postData = {
        id_usuario : id_usuario
      }
      return new Promise(resolve => {
            $.post(url,postData,function(response){
                  resolve(response);
            });
      });
}

function initPayPalButton() {
      let totals = document.getElementById("total").textContent.split("$");
      total = totals[1].trim();
      if(total > 0.00){
            paypal.Buttons({
                  style: {
                        shape: 'pill',
                        color: 'gold',
                        layout: 'vertical',
                        label: 'paypal',
                  },
                  createOrder: function(data, actions) {
                        return actions.order.create({
                          purchase_units: [{"description":"Comprar Ahora","amount":{"currency_code":"MXN","value":total}}]
                        });
                  },
              
                  onApprove: function(data, actions) {
                    return actions.order.capture().then(async function(orderData) {
                      // Full available details
                      console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                      var transaction = orderData.purchase_units[0].payments.captures[0];
                      await comprarcarritoPaypal(transaction.status,transaction.id);
                      //alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                      // Show a success message within this page, e.g.
                      /*const element = document.getElementById('paypal-button-container');
                      element.innerHTML = '';
                      element.innerHTML = '<h3>Thank you for your payment!</h3>';*/
            
                      // Or go to another URL:  actions.redirect('thank_you.html');
                      
                    });
                  },
                  onError: function(err) {
                        console.log(err);
                  }
            }).render('#paypal-button-container');
      }
      
}

