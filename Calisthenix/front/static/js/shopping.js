
var carrito = 0;
var check = false;
var i = 1;
var numerodeId = 0;
var subtotal = 0;
var cantidadinicial = 1;
var sub = 0;
var aaa = 0;
var numeroproductoscarrito = 0;

function changeVal(el) {
	var qt = parseFloat(el.parent().children(".qt").html());
	var price = parseFloat(el.parent().children(".price").html());
	var eq = Math.round(price * qt * 100) / 100;

	el.parent()
		.children(".full-price")
		.html(eq + "€");
	changeTotal();
}

function changeTotal() {
	var price = 0;

	$(".full-price").each(function (index) {
		price += parseFloat($(".full-price").eq(index).html());
	});

	price = Math.round(price * 100) / 100;
	var tax = Math.round(price * 0.05 * 100) / 100;
	var shipping = parseFloat($(".shipping span").html());
	var fullPrice = Math.round((price + tax + shipping) * 100) / 100;

	if (price == 0) {
		fullPrice = 0;
	}
	$(".subtotal span").html(price);
	$(".tax span").html(tax);
	$(".total span").html(fullPrice);
}

//PRODUCTOS DEL CARRITO
$(document).ready(function () {
	$("#nombreCliente").html(appData.nombre_cliente + " " + appData.apellidos_cliente);
	productoscarrito();
	cantidadiconocarrito();

	$(".remove").click(function () {
		var el = $(this);
		el.parent().parent().addClass("removed");
		window.setTimeout(function () {
			el.parent()
				.parent()
				.slideUp("fast", function () {
					el.parent().parent().remove();
					if ($(".product").length == 0) {
						if (check) {
							$("#cart").html(
								"<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>"
							);
						} else {
							$("#cart").html("<h1>No products!</h1>");
						}
					}
					changeTotal();
				});
		}, 200);
	});

	$(".qt-plus").click(function () {
		$(this)
			.parent()
			.children(".qt")
			.html(parseInt($(this).parent().children(".qt").html()) + 1);

		$(this).parent().children(".full-price").addClass("added");

		var el = $(this);
		window.setTimeout(function () {
			el.parent().children(".full-price").removeClass("added");
			changeVal(el);
		}, 150);
	});

	$(".qt-minus").click(function () {
		child = $(this).parent().children(".qt");

		if (parseInt(child.html()) > 1) {
			child.html(parseInt(child.html()) - 1);
		}

		$(this).parent().children(".full-price").addClass("minused");

		var el = $(this);
		window.setTimeout(function () {
			el.parent().children(".full-price").removeClass("minused");
			changeVal(el);
		}, 150);
	});
	window.setTimeout(function () {
		$(".is-open").removeClass("is-open");
	}, 1200);
});

function addCart(
	idproducto,
	nombre_producto,
	descripcion_producto,
	imagen_producto,
	precio_producto,
	categoria_producto
) {


	$.ajax({
		url: appData.ws_url + "productos/insertarcarrito/",
		dataType: "json",
		type: "post",
		data: {
			"idproducto": idproducto,
			"idcliente": appData.idcliente,
			"token": appData.token
		},
	})
		.done(function (json) {
		
			cantidadiconocarrito()
			
			$("#cerrarmodal").click();
			$("#ProjectId").html(json.mensaje);

			if (json.resultado) {

				janelaPopUp.abre("example", "p green", "CARRITO", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);
			}
			else if (json.mensaje == "Persona y token NO SON validos") {

				janelaPopUp.abre("example", "p red", "CARRITO", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);
				window.location.href = appData.base_url + 'home/cierrasesioninvalida/' + appData.email_cliente;
			}

			else {
				janelaPopUp.abre("example", "p red", "CARRITO", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);
			}
		})
}

function aumentar(cantidad, id, precio) {
	var resultado = cantidad * precio;
	$("#" + id).html(resultado);
	for (var i = 1; i <= numerodeId; i++) {
		aaa = aaa + eval($("#" + i).html());
	}
	$("#subtotal").html(aaa);
	aaa = 0;
}

function removercarrito(idproducto) {

	$.ajax({
		url: appData.ws_url + "productos/removercarrito/",
		dataType: "json",
		type: "post",
		data: {
			"idproducto": idproducto,
			"idcliente": appData.idcliente
		},
	})
		.done(function (json) {
			if (json.resultado) {
				$(".product").remove();

				janelaPopUp.abre("example", "p green", "CARRITO", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);
				setTimeout(() => {

				}, 2000);
				productoscarrito();
			} else {
				janelaPopUp.abre("example", "p red", "CARRITO", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);
			}
		})
		.fail();
}

function productoscarrito() {
	$.ajax({
		url: appData.ws_url + "productos/getcarrito/",
		dataType: "json",
		type: "post",
		data: {
			"idcliente": appData.idcliente
		}
	})
		.done(function (json) {
			if (json.resultado) {
			
				json.productos.forEach((element, i) => {
					numeroproductoscarrito = i + 1;
					imagen = JSON.stringify(element["imagen_producto"]);
					imagen = JSON.parse(imagen);
					numerodeId++;
					sub = sub + eval(element.precio_producto);

					$('#cart').append(
						` <article class="product">
		  <header>
		  <input id="precio_producto_${numerodeId}" hidden "type="number" value="${element.precio_producto}"></input>
		  <input id="idproducto_${numerodeId}" hidden "type="number" value="${element.idproducto}">asasas</input>
			<a onclick="removercarrito(${element.idproducto})"class="remove">
			  <img  src="${appData.base_url}static/assets/img/build/img/calistenia/${imagen}" alt="Gamming Mouse">
			  <h3>Remove product<br/><small style="background-color:#f1c40f;color:#000;">Available: <span style="font-weight: bold;">${element.cantidad}</span></small></h3>
			</a>
		  </header>
		  <div class="content">
			<h1>${element.nombre_producto}</h1>
		${element.descripcion_producto}
		  </div>
		  <footer class="content">
		  <span style="margin-right:30px"class='qt'>&nbsp;&nbsp;Cantidad: </span>
		   <input class="qt-plus" onchange='aumentar(this.value,${numerodeId},${element.precio_producto})' type="number" id="cantidad_producto_${numerodeId}" min="1" max="${element.cantidad}" value="1"> </input>
			<h2 class="full-price" id="${numerodeId}">
			${element.precio_producto}
			</h2>
			<h2 class="price">
			  <span>$</span>${element.precio_producto}
			</h2>
		  </footer>
		</article>`
					)
					$('#subtotal').html(sub)
				});
			}
			else {
				$("#cart").append(
					'<h2 class="full-price">Cart is empty...</h2>'
				);
				$("#checkout").remove();
				$('#subtotal').html("0")
			}
		})
		.fail();
}

function cantidadiconocarrito() {
	$.ajax({
		url: appData.ws_url + "productos/cantidadcarrito/",
		dataType: "json",
		type: "post",
		data: {
			"idcliente": appData.idcliente
		}
	})
		.done(function (json) {
			for (var key in json) {
				$('#cantidad-cart').html(json[key]);
			}
		})
		.fail();
}
function tienda() {
	window.location.href = appData.base_url + "home/index/" + appData.idcliente + "/" + appData.token;
}


function insertardetalle() {

	$.ajax({
		url: appData.ws_url + "productos/insertarcompra/",
		dataType: "json",
		type: "post",
		data: {
			"idcliente": appData.idcliente
		}
	})
		.done(function (json) {
			if (json.resultado) {
				idcompra = JSON.stringify(json.idcompra);
				for (var i = 1; i <= numerodeId; i++) {
					$.ajax({
						url: appData.ws_url + "productos/insertardetalle/",
						dataType: "json",
						type: "post",
						data: {
							"idcliente": appData.idcliente,
							'idcompra': idcompra,
							'cantidad': eval($("#cantidad_producto_" + i).val()),
							'idproducto': eval($("#idproducto_" + i).val()),
							'precio': eval($("#precio_producto_" + i).val())
						}
					})
						.done(function (json) {
						})

					$.ajax({
						url: appData.ws_url + "productos/removercarrito/",
						dataType: "json",
						type: "post",
						data: {
							"idproducto": eval($("#idproducto_" + i).val()),
							"idcliente": appData.idcliente
						},
					})
						.done(function (json) {
						})
				}

				janelaPopUp.abre("example", "p green", "CARRITO", json.mensaje);
				$(".product").remove();
				$("#cart").append(
					'		<h2 class="full-price">Cart is empty...</h2>'
				);
				$("#checkout").remove();
				$('#subtotal').html("0")
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 3000);

				setTimeout(
					function () {
						window.location.href = appData.base_url + "home/index/" + appData.idcliente + "/" + appData.token;
					}, 3000);
			}
			else {

				janelaPopUp.abre("example", "p red", "CARRITO", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);

			}
		})
}

