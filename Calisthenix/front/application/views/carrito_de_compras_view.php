<?php
        $idcliente    = $this->session->userdata("idcliente"); 
      //  echo $id_cliente;
?>
<input id="idcliente" name="idcliente" type="hidden" value=<?=$idcliente?>>
<head>
      <style>
      .table tfoot{
            background-color: #448aff;
            color:#ffffff;
            font-weight: bold;
      }
      </style>
      <script>
            var appData ={
                  idcliente : $idcliente
            }
      </script>
</head>

<div class = "container-fluid">
      <div class = "col-12">
            <div class = "row">
                  <div class = "col-md-12 mb-2 mt-2">
                        <button type = "button" onclick = "return comprarcarrito()" class = "btn btn-success btn-new float-right" id = "button-selected" style="color:#efffff;font-weight: bold;"> <i class="fas fa-cash-register me-2"></i> Deposito a Cuenta </button>
                  </div>
                  <div id="smart-button-container">
                        <div style="text-align: center;">
                              <div id="paypal-button-container"></div>
                        </div>
                  </div>
            </div>
      </div>
</div>
<table id="table_carrito" class="table table-striped table-bordered table-condensed " style="width:100%;">
      <?php
            // echo('<thead class="text-center">
            //       <tr>
            //             <th class = "dt-center">SUCURSAL</th>
            //             <th class = "dt-center">PRODUCTO</th>
            //             <th class = "dt-center">IMAGEN</th>
            //             <th class = "dt-center">P.UNIDAD</th>
            //             <th class = "dt-center">CANTIDAD</th>
            //             <th class = "dt-center">SUBTOTAL</th>
            //             <th class = "dt-center">ACCIONES</th>
                        
            //       </tr>
            //       </thead>'
            // );
            // echo('<tbody>');
            // echo('</tbody>'); 
            // echo('<tfoot>
            //             <tr>
            //                   <th id= "total"></th>
            //                   <th></th>
            //                   <th></th>
            //                   <th></th>
            //                   <th></th>
            //                   <th></th>
            //                   <th></th>
            //                   <th></th>
                              
            //             </tr>');
            // echo('</tfoot>');
      ?>
</table>

<script type="text/javascript" src = "<?=base_url()?>static/js/carrito_compras.js">