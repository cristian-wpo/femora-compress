	function femoracomparador(imagen1, imagen2) {
		console.log(imagen1);
		jQuery("#femoracompara1").attr("src", imagen2);
		jQuery("#femoracompara2").attr("src", imagen1);
	}
	jQuery(function () {
		jQuery(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({ default_offset_pct: 0.7 });
		jQuery(".twentytwenty-container[data-orientation='vertical']").twentytwenty({ default_offset_pct: 0.3, orientation: 'vertical' });
	});
	/*
	* Fin Ventana modal Comparador
	*/

	jQuery(document).ready(function () {
		jQuery('#femora_progress').goalProgress({
			goalAmount: 0,
			currentAmount: 0,
			textAfter: ' remaining images'
		});
		femora_llenartablas();
		cargar_configuraciones();
		femora_estadisticas();

	});

	var global_femora_img_insert = false;
	function cargar_configuraciones() {
		jQuery("#alturamaxima").blur(function () {
			var parametros = {
				"blurtipe": 'altura_maxima',
				"alturaimg": jQuery("#alturamaxima").val()
			};
			if (jQuery("#alturamaxima").val() != '') {
				var ajaxurl = femora_utiliti.femora_setting;
				var dimension = jQuery.ajax({
					data: parametros,
					url: ajaxurl,
					type: "POST",
					beforeSend: function () {
					},
					success: function (response) {
						//alert(response);
					}
				});
			}
		});
		jQuery("#anchuramaxima").blur(function () {
			var parametros = {
				"blurtipe": 'anchura_maxima',
				"anchuraimg": jQuery("#anchuramaxima").val()
			};
			//alert( "Handler for .blur() called." );
			if (jQuery("#anchuramaxima").val() != '') {
				var ajaxurl = femora_utiliti.femora_setting;
				var dimension = jQuery.ajax({
					data: parametros,
					url: ajaxurl,
					type: "POST",
					beforeSend: function () {
					},
					success: function (response) {
						//alert(response);
					}
				});
			}
		});
		jQuery("#femora-respaldo").click(function () {
			var parametros = {
				"blurtipe": 'crear_respaldo'
			};
			//alert( "Handler for .blur() called." );
			var ajaxurl = femora_utiliti.femora_setting;
			var respaldo = jQuery.ajax({
				data: parametros,
				url: ajaxurl,
				type: "POST",
				beforeSend: function () {
				},
				success: function (response) {
					//alert(response);
				}
			});
		});
		jQuery("#femora-convertir-webp").click(function () {
			var parametros = {
				"blurtipe": 'convertir_webp'
			};
			//alert( "Handler for .blur() called." );
			var ajaxurl = femora_utiliti.femora_setting;
			var dataTable = jQuery.ajax({
				data: parametros,
				url: ajaxurl,
				type: "POST",
				beforeSend: function () {
				},
				success: function (response) {
					//alert(response);
				}
			});
		});
		//boton de guardar sesion    

		//formularios opciones imagenes
		jQuery(".opciones-imagenes-png").blur(function () {
			var parametros = {
				"blurtipe": 'opciones_imagenes_png',
				"png_opciones": 'Hola mundo'
			};
			//alert( "Handler for .blur() called." );
			var ajaxurl = femora_utiliti.femora_setting;
			var dataTable = jQuery.ajax({
				data: parametros,
				url: ajaxurl,
				type: "POST",
				beforeSend: function () {
				},
				success: function (response) {
					console.log(response);
				}
			});
		});
	}

	function text_buton_gtoken() {
		var parametros = {
			"blurtipe": 'guardar_token',
			"femora_user": jQuery("#input-usuario").val(),
			"femora_pass": jQuery("#input-password").val()
		};
		var ajaxurl = femora_utiliti.femora_setting;
		var dataTable = jQuery.ajax({
			data: parametros,
			url: ajaxurl,
			type: "POST",
			beforeSend: function () {
				jQuery("#width1").html("<div class=\"femora_loader\" id=\"femora_loader\">Loading...</div>");
			},
			success: function (response) {
				if (response == 'exito') {
					jQuery("#width1").html("<input id=\"btn_registro\" readonly=\"readonly\" class=\"femora_boton\" value=\"Desconectar\" onclick=\"femora_desconectar()\"/>");
					//femora_update_domain(); 
				} else {
					jQuery("#width1").html("<div class=\"botton_separador_f\">" + response + "</div>" + "<input id=\"btn_registro\" readonly=\"readonly\" class=\"femora_boton\" value=\"Reintentar\" onclick=\"femora_reintentar()\"/>");
				}
				console.log(response);
			}
		});
	}

	function femora_estadisticas() {
		var ajaxurl = femora_statistics.statistics;
		jQuery.ajax({
			data: '', //datos que se envian a traves de ajax
			url: ajaxurl,
			type: 'post',
			beforeSend: function () {
				//jQuery("#imagenes-encontradas").html("Procesando, espere por favor...");
			},
			success: function (response) {
				var fem_obj = JSON.parse(response);
				jQuery("#femora-p-diferencia").html("Total Weight: <strong>" + fem_obj.peso_total + "</strong> New Weight: <strong>" + fem_obj.peso_ahorrado + "</strong>");
				jQuery("#imagenes-encontradas").html("<strong>" + fem_obj.total_imagenes + "</strong> Images found");
				if (fem_obj.total_imagenes != 0) {
					var porcentaje = ((100 - (100 * (fem_obj.total_imagenes - fem_obj.imagenes_optimizadas) / fem_obj.total_imagenes)));
					if (porcentaje < 20) {
						jQuery("#femora_progress .progressBar").width('20%');
					} else {
						jQuery("#femora_progress .progressBar").width(porcentaje + '%');
					}
					jQuery("#femora_progress .progressBar").text(fem_obj.total_imagenes - fem_obj.imagenes_optimizadas + ' remaining');

				}
				//console.log(fem_obj.total_imagenes + ' - ' + fem_obj.imagenes_optimizadas);
				//jQuery("#imagenes-encontradas").text((arrayresultado.length - 1) + " Images found");
			}
		});
	}

	function auxbuscarimagenes() {
		buscarimagenes();
	}

	function femora_llenartablas() {
		//llamado a función ajax declarada en femora-compress.php para llenar tabla
		var ajaxurl = femora_ajax.fill_table;
		var language_images = {
			search: "",
			searchPlaceholder: "INTELLIGENT IMAGE SEARCH",
			info: "Showing _START_ a _END_ of _TOTAL_ images",
			infoEmpty: "No images available",
			infoFiltered: "(Filtrado of _MAX_ imagenes)",
			zeroRecords: "No images found!",
			emptyTable: "0 images!",
			paginate: { first: "<<", previous: "<", next: ">", last: ">>" }
		};
		dataTable = jQuery('#tablafemoracompress').DataTable({
			responsive: true,
			bLengthChange: false,
			pageLength: 25,
			language: language_images,
			"order": [[3, "desc"]],
			"ajax": {
				url: ajaxurl,
				type: "POST"
			}
		});
	}

	function optimizarimagenes() {
		jQuery("#tablafemoracompress tbody tr").each(function (index) {
			var campo1, campo2, campo3 = "", campo4, elementotabla3, elementotabla4;
			jQuery(this).children("td").each(function (index2) {
				switch (index2) {
					case 0:
						campo1 = jQuery(this).text();
						break;
					case 1:
						campo2 = jQuery(this).text();
						break;
					case 2:
						campo3 = jQuery(this).text();
						break;
					case 3:
						//se envía la imágen al servidor
						elementotabla3 = this;
						break;
					case 4:
						elementotabla4 = this;
						var parametros = {
							"rutaimagen": campo2,
							"formatoimagen": campo1
						};
						if (campo3 != "") {
							try {
								var ajaxurl = femora_send_data.send_data;
								jQuery.ajax({
									data: parametros, //datos que se envian a traves de ajax
									url: ajaxurl, //archivo que recibe la peticion
									type: 'post', //método de envio
									beforeSend: function () {
										jQuery(elementotabla3).text("Comprimiendo...");
									},
									success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
										jQuery(elementotabla3).text(response);
										campo4 = response;
										var c3 = campo3.split(" ");
										var c4 = campo4.split(" ");
										var diferencia = ((c3[0] - c4[0]) / c4[0]) * 100;
										//alert(campo3 + " " + campo4);
										jQuery(elementotabla4).text(diferencia.toFixed(2) + "%");
									}
								});
							}
							catch (err) {
								document.getElementById("demo").innerHTML = err.message;
							}
						}
						break;
				}
			})
		})
	}

	function ejecutaroptimizardor() {
		try {
			//console.log('Taking a break...');
			var parametros = {
				"dominio": document.domain
			};
			var ajaxurl = femora_optimize.femora_optimize;
			jQuery.ajax({
				//data:  parametros, //datos que se envian a traves de ajax
				url: ajaxurl, //archivo que recibe la peticion
				type: 'post', //método de envio
				beforeSend: function () {
					jQuery("#imagenes-encontradas").html("Optimizando, espere por favor...");
				},
				success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
					console.log('termino...' + response);
					if (response != 'femora_cola_vacia') {
						jQuery('#femora_progress').val(response);
						console.log(response);
						optimizarimagenesescritorio();
					} else {
						dataTable.destroy();
						femora_llenartablas();
						jQuery('#femora_progress').val(100);
						//alert('Cola terminada');
					}
				}
			});
		}
		catch (err) {
			console.log(err);
		}
	}

	/*
	* Inicio Buscar y Guardar imagenes
	*/
	function femora_buscarimagenes() {
		jQuery('#burcar-imagenes').attr('disabled', 'disabled');
        /*
         * Función para buscar las imágenes dentro de Wordpress
         */
		var parametros = {
			"false": 'false'
		};
		var ajaxurl = femora_search.search;
		jQuery.ajax({
			data: parametros, //datos que se envian a traves de ajax
			url: ajaxurl, //archivo que recibe la peticion
			type: 'post', //método de envio
			beforeSend: function () {
				jQuery("#imagenes-encontradas").html("Looking for images, please wait...");
			},
			success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
				//console.log(response);
				//recibimos las imágenes en un Json que contiene un arreglo de arreglos
				femora_img_add_bd_aux(response);
			}
		});
	}


	function femora_img_add_bd_aux(response) {
		//console.log(response);
		var femora_imagenes_recibidas = JSON.parse(response);
		var femora_imagenes = [];
		(async function loop() {
			for (let i = 0; i < femora_imagenes_recibidas.length; i++) {
				var ultimo = false;
				if (i == femora_imagenes_recibidas.length - 1)
					ultimo = true;
				var parametros = {
					"femora_imagen": femora_imagenes_recibidas[i],
					"femora_ultimo_paquete": ultimo
				};
				try {
					var ajaxurl = femora_insert.insert_img;
					await jQuery.ajax({
						data: parametros, //datos que se envian a traves de ajax
						url: ajaxurl, //archivo que recibe la peticion
						type: 'post', //método de envio
						beforeSend: function () {
							jQuery("#imagenes-encontradas").html("ordering images...");
						},
						success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
							//console.log(response);
							if (response.split('(-separador-)')[1] == true) {
								if (ultimo) {
									dataTable.destroy();
									femora_llenartablas();
								}
								//jQuery("#imagenes-encontradas").html("Imagenes encontradas"); 
								femora_estadisticas();
								jQuery('#burcar-imagenes').removeAttr('disabled');
							} else {
								jQuery("#imagenes-encontradas").html("ordering images...");
							}
						}
					});
				} catch (error) {
					console.log(error);
				}

			}
		})();
		//console.log(femora_imagenes);
		//femora_img_add_bd(JSON.stringify(femora_imagenes, true));
	}

	function femora_img_add_bd(femora_ruta_img, aux) {
		var resultado = null;
        /*
         * Función para agregar las imágenes en la base de datos
         */
		//console.log(femora_ruta_img);
		var parametros = {
			"femora_imagen": femora_ruta_img,
			"femora_ultimo_paquete": aux
		};
		var ajaxurl = femora_insert.insert_img;
		jQuery.ajax({
			//async:false,
			//cache:false,
			data: parametros, //datos que se envian a traves de ajax
			url: ajaxurl, //archivo que recibe la peticion
			type: 'post', //método de envio
			beforeSend: function () {
				jQuery("#imagenes-encontradas").html("ordering images...");
			},
			success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
				resultado = response;
				console.log("respuesta " + response);
				if (response == true) {
					jQuery("#imagenes-encontradas").html("images found");
				} else {
					jQuery("#imagenes-encontradas").html("ordering images...");
				}
			}
		});
		return resultado;
	}
	/*
	* Fin insertar imagenes en la base de datos
	*/
	/*
	* Inicio recuperar respaldo
	*/
	function obtener_lista_respaldo() {
        /*
         * Funcion para obtener la lista de respaldos disponible en femora
         */
		var ajaxurl = femora_backup.get_backup_list;
		jQuery.ajax({
			url: ajaxurl,
			type: "POST",
			beforeSend: function () {
			},
			success: function (devuelve) {
				cargar_respaldos(devuelve);
				console.log(devuelve);

			}
		});
	}

	function cargar_respaldos(recibe) {
		var femora_imagenes = JSON.parse(recibe.slice(0, - 1));
		(async function loop_cargar_respaldo() {
			for (let i = 0; i < femora_imagenes.length; i++) {
				var parametros = {
					"listarespaldo": femora_imagenes[i]
				};
				try {
					await jQuery.ajax({
						data: parametros, //datos que se envian a traves de ajax
						url: femora_dump_backup.dump_backup, //archivo que recibe la peticion
						type: 'post', //método de envio
						beforeSend: function () {
							jQuery("#width4").html("<h2>cargando respaldo...</h2><div class=\"femora_loader\" id=\"femora_loader\">Loading...</div>");
						},
						success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
							console.log(response);
						}
					});
				} catch (error) {
					console.log(error);
				}
			}
			jQuery("#width4").html("<h2>RESPALDO CARGADO</h2>");
			console.log("Respaldo cargado");
		})();
		
	}
	/*
	* Fin recuperar respaldo
	*/

	/*
	 * Configuracion
	 */

	function femora_registro() {
		window.open('https://www.femora.pro/signup/', '_blank');
	}
	function femora_reintentar() {
		jQuery("#width1").html("<h2>Sign In</h2><form><div class=\"field\"><input id=\"input-usuario\" type=\"text\" class=\"username\" name=\"username\" placeholder=\"Username\" value=\"\"/></div><div class=\"field\"><input id=\"input-password\" type=\"password\" class=\"password\" name=\"password\" placeholder=\"Password\" value=\"\"/></div><ul class=\"inline-list\"><li><input id=\"btn_registro\" readonly=\"readonly\" class=\"femora_boton\" value=\"Registrarte\" onclick=\"femora_registro()\"/></li><li>  <a id=\"text-buton-gtoken\" onclick=\"text_buton_gtoken()\" class=\"btn_white\">Login</a></li></ul></form>");
	}
	function femora_desconectar() {
		var parametros = {
			"blurtipe": 'cerrar_sesion'
		};
		var ajaxurl = femora_utiliti.femora_setting;
		dataTable = jQuery.ajax({
			data: parametros,
			url: ajaxurl,
			type: "POST",
			beforeSend: function () {
				jQuery("#width1").html("Cerrando sesión");
			},
			success: function (response) {
				jQuery("#width1").html("<h2>Sign In</h2><form><div class=\"field\"><input id=\"input-usuario\" type=\"text\" class=\"username\" name=\"username\" placeholder=\"Username\" value=\"\"/></div><div class=\"field\"><input id=\"input-password\" type=\"password\" class=\"password\" name=\"password\" placeholder=\"Password\" value=\"\"/></div><ul class=\"inline-list\"><li><input id=\"btn_registro\" readonly=\"readonly\" class=\"femora_boton\" value=\"Registrarte\" onclick=\"femora_registro()\"/></li><li>  <a id=\"text-buton-gtoken\" onclick=\"text_buton_gtoken()\" class=\"btn_white\">Login</a></li></ul></form>");
			}
		});
	}


async function optimizarimagenesescritorio() {
	var url = femora_opt.femora_optimize;
	//console.log(url);
	try {
		jQuery("#imagenes-encontradas").html('Optimizando imágenes, espere por favor...');
		const response = await fetch(url);
		var result = await response.text();
		var objrespuesta = JSON.parse(result);
		console.log(objrespuesta);
		if (objrespuesta['respuestaimg'] == 'iniciar sesion') {
			var URLactual = jQuery(location).attr('href').replace("femora_compress", "femora_configuracion");
			jQuery("#imagenes-encontradas").html('Por favor ' + '<a href="' + URLactual + '">iniciar sesion</a>' + ' para continuar');
		} else if (objrespuesta['respuestaimg'] == 'exito') {
			if (objrespuesta['estadisticas']['porcentaje'] < 20) {
				jQuery("#femora_progress .progressBar").width('20%');
			} else {
				jQuery("#femora_progress .progressBar").width(objrespuesta['estadisticas']['porcentaje'] + '%');
			}
			jQuery("#femora_progress .progressBar").text(objrespuesta['estadisticas']['restante'] + ' restantes');
			//console.log(objrespuesta['estadisticas']);
			optimizarimagenesescritorio();
		} else if (objrespuesta['respuestaimg'] == 'No autorizado') {
			var URLactual = jQuery(location).attr('href').replace("femora_compress", "femora_configuracion");
			jQuery("#imagenes-encontradas").html('Por favor ' + '<a href="' + URLactual + '">iniciar sesion</a>' + ' para continuar');
		} else if (objrespuesta['respuestaimg'] == 'limite excedido') {
			jQuery("#imagenes-encontradas").html('Limite mensual excedido, por favor  ' + '<a href="https://www.femora.pro/precios/">actualizate a pro</a>' + ' para continuar');
		}
		else {
			femora_estadisticas();
			//console.log(objrespuesta);
		}
	} catch (err) {
		console.log('fetch failed', err);
		optimizarimagenesescritorio();
	}
}
