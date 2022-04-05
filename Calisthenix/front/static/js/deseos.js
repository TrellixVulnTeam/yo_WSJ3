
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
	productosdeseos();
	// cantidadiconocarrito();

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

function addWishes(
	idproducto,
	nombre_producto,
	descripcion_producto,
	imagen_producto,
	precio_producto,
	categoria_producto
) {
	//PREGUNTAMOS



	$.ajax({
		url: appData.ws_url + "productos/insertardeseos/",
		dataType: "json",
		type: "post",
		data: {
			"idproducto": idproducto,
			"idcliente": appData.idcliente,
			"token": appData.token
		},
	})
		.done(function (json) {

			if (json.resultado) {
				productodeseo()
				janelaPopUp.abre("example", "p purple", "DESEOS", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);
			}
			else if (json.mensaje == "Persona y token NO SON validos") {

				janelaPopUp.abre("example", "p red", "DESEOS", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);
				window.location.href = appData.base_url + 'home/cierrasesioninvalida/' + appData.email_cliente;

			}

			else {
				janelaPopUp.abre("example", "p blue", "DESEOS", 'Deleted from favorites');
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);

				removerdeseos(idproducto);
				$('#idcorazon_' + idproducto).remove();
				$("#addWishes_" + idproducto).append(
					`<i  id="idcorazon_${idproducto}" class="fa fa-heart"></i>`
				);
				$("#addWishes_" + idproducto).removeClass('corazonlleno');
			}
		})
		.fail();
}



function removerdeseos(idproducto) {

	$.ajax({
		url: appData.ws_url + "productos/removerdeseos/",
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
				productosdeseos();
			} else {
				janelaPopUp.abre("example", "p red", "CARRITO", json.mensaje);
				setTimeout(function () {
					janelaPopUp.fecha("example");
				}, 2000);
			}
		})
		.fail();
}

function productosdeseos() {
	$.ajax({
		url: appData.ws_url + "productos/getdeseos/",
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
			<a onclick="removerdeseos(${element.idproducto})"class="remove">
			  <img  src="${appData.base_url}static/assets/img/build/img/calistenia/${imagen}" alt="Gamming Mouse">
			  <h3>Remove Favorite<br/><small style="background-color:#f1c40f;color:#000;">Available: <span style="font-weight: bold;">${element.cantidad}</span></small></h3>
			</a>
		  </header>
		  <div class="content">
			<h1>${element.nombre_producto}</h1>
		${element.descripcion_producto}
		  </div>
		  <footer class="content">
		  <button onclick="addCart2(${element.idproducto},'${element.nombre_producto}','${element.descripcion_producto}','${element.imagen_producto}',${element.precio_producto},'${element.categoria_producto}',${element.cantidad})" 
			  class="btn btn-primary" style="margin:0 0; padding: 0 0;width:fit-content;margin: auto auto;height:inherit;background:magenta" type="button">
		  Add to Shopping Cart
	  </button>
			
			<h2 class="price">
			  <span></span>
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

function productodeseo() {
	$.ajax({
		url: appData.ws_url + "productos/getdeseos/",
		dataType: "json",
		type: "post",
		data: {
			"idcliente": appData.idcliente
		}
	})
		.done(function (json) {

			json.productos.forEach((element, i) => {


				$("#addWishes_" + element.idproducto).addClass('corazonlleno');
				$('#idcorazon_' + element.idproducto).remove();
				//   if()   
				$("#addWishes_" + element.idproducto).append(
					`<i  id="idcorazon_${element.idproducto}" class="fa fa-heart fa-2x"></i>`
				);
			})
		})
}



function tienda() {
	window.location.href = appData.base_url + "home/index/" + appData.idcliente + "/" + appData.token;
}



function addCart2(
	idproducto,
	nombre_producto,
	descripcion_producto,
	imagen_producto,
	precio_producto,
	categoria_producto,
	cantidad
) {
	if(cantidad ==0){
		janelaPopUp.abre("example", "p red", "CARRITO", "NO PRODUCTS IN STOCK! SORRY );");
		setTimeout(function () {
			janelaPopUp.fecha("example");
		}, 2000);
	}
	else{
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
			.fail();
	}


}