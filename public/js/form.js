/*Funciones creada por villate yorbis*/
function cargarfunciones()
{
    loadajax('10','Cargando la Pagina, por favor espera...');
    estadosistema();
    intervalo = setInterval(vereficarsession, 20000);
    intervalobloqueo = setInterval(estadosistema, 300000);
    //alertassistema('<h5><i class="fa fa-check"></i> Bienvenido al Sistema EDOS.C.A</h5>');
    //MsjSistema();
}

function loadajax(sec,title)
{
    if(sec == undefined) sec = 10;
    if(title == undefined) title = "Espere Por Favor";

    $.blockUI
        ({
            css: {
             padding: '20px',
             top:  ($(window).height() - 280) /2 + 'px',
             left: ($(window).width() - 280) /2 + 'px',
             width: '280px',
             border: 'none',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
        },
            message: "<h4>"+title+"</h4> <img src='"+base_url+"/public/img/load/ajax-loader.gif' /> "
        });
       setTimeout($.unblockUI, sec * 100);   
}

function fin_ajax()
{
    $.unblockUI();
}

function estadosistema()
{
    $.ajax({
        type: 'POST',
        url: base_url + 'login/estado_sistema',
        cache: false,
        async: false,
        dataType: 'json',
        success: function(data)
        {   
            if(data.getEstadoSistema == 0)
            {
              getEstadoSistema(data.getEstadoSistema);
            }
        }
    });
}

function vereficarsession()
{
    $.ajax({
        type: 'POST',
        url: base_url + 'login/verificar_session',
        data: {recargar : 1},
        async: false,
        cache: false,
        dataType: "json",
        success: function(data)
        {
          if(data.session == false)
          {  
              setTimeout(function()
              {
                window.location = base_url + 'login';
                return;
              },200);
          }
          else
          {
              if(data.tiempoinactivo >= 300)
              {   
                  clearInterval(intervalo);
                  Bloquear_Sistema(true);
              }  
          }
        },
    });
}

function mostrar(dataform, urlmostrar, divurlmostrar)
{
  loadajax('10', 'Cargando Pagina...');
    $.ajax({
        type: 'POST',
        url: urlmostrar,
        data: dataform,
        contentType: false,
        processData: false,
        beforeSend: function ()
        {
             $(divurlmostrar).html('cargando <i class="fa fa-spinner"></i>');
        },
        success: function(data)
        {
             $(divurlmostrar).html(data);
        }
    }); 
}

function modalshow(dataform,url,div,modal,urlmostrar)
{
    $.ajax({
        type: 'POST',
        url: url,
        data: dataform,
        dataType: 'json', 
        beforeSend: function ()
        {
             $(div).html('cargando <i class="fa fa-spinner"></i>');
        },
        success: function(data)
        {
            if(data.success == false) 
            {
              showModal("Atención!",data.mensaje);
            }
            else
            {
               showModal("<b>Operación Completada</b>",'<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+data.mensaje+'</div>');
               resultados('id_caja='+data.id, urlmostrar, '#resultado');      
            }
        }
    }); 
}

function resultados(id, urlmostrar, div)
{
  loadajax();
    $.ajax({
        type: 'POST',
        url: urlmostrar,
        data: id,
        beforeSend: function ()
        {
             $(div).html('cargando <i class="fa fa-spinner"></i>');
        },
        success: function(data)
        {
             $(div).html(data);
        }
    }); 
}

function showModal(title,message)
{
    $("h4.modal-title").html(title);
    $(".modal-body").html(message);
    $(".modal").modal('show');
}

function filtros(id, url, div)
{
  loadajax();
    $.ajax({
        type: 'POST',
        url: url,
        data: id,
        beforeSend: function ()
        {
             $(div).html('cargando <i class="fa fa-spinner"></i>');
        },
        success: function(data)
        {
             $(div).html(data);
        }
    }); 
}

function busqueda(id, url, div)
{


    $.ajax({
        type: 'POST',
        url: url,
        data: id,
        beforeSend: function ()
        {
             $(div).html('cargando <i class="fa fa-spinner"></i>');
        },
        success: function(data)
        {
             $(div).html(data);
        }
    }); 
}



function grupos(id, div, url, defaultt)
{
  if(id == undefined) id = "";
  if(defaultt == undefined) defaultt = "Seleccionar";

  $.ajax({
        type: 'POST',
        url: url,
        data: id,
        async: false,
        cache: false,
        dataType: "json",

        success: function(data)
        {
            if(data.length > 0)
            {
                var select = "<option value=''>.."+defaultt+"..</option>";
                for(var i = 0; i < data.length ; i++)
                {
                    selected="";
                    if(id != "") selected = "selected=''";
                    select += "<option value='"+data[i].id+"' "+selected+" >"+data[i].categorias+"</option>";
                }

                $(div).html(select);
                setselect2(div);
            }
            else
            {
               var select = "<option value=''>..No hay resultados..</option>"; 
               $(div).html(select);
            }
        }
    });   
}

function modal(id,url,div,modal,tipomodal)
{
  if (tipomodal == 1) // 1 upload //// vacio normal
  {
        if(modal == undefined) modal = "";
        $.ajax({
            type: 'POST',
            url: url,
            data: id,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            
            beforeSend: function ()
            {
                 $(modal).modal({ keyboard:true}, 'show');
                 $(div).html('Cargando <i class="fa fa-refresh fa-spin"></i>');
            },
            success: function(data)
            {
              if(data != "")
              {
                  if(modal != "")
                      $(modal).modal('show');
                      $(div).html(data);
              }
            },
        });
     }
     else
     {
        if(modal == undefined) modal = "";
          $.ajax({
              type: 'POST',
              url: url,
              data: id,

              beforeSend: function ()
              {
                   $(modal).modal({ keyboard:true}, 'show');
                   $(div).html('Cargando <i class="fa fa-refresh fa-spin"></i>');
              },
              success: function(data)
              {
                if(data != "")
                {
                    if(modal != "")
                        $(modal).modal('show');
                        $(div).html(data);
                }
              },
          });
     }
}

function getEstadoSistema(data)
{
  if(data == 0)
  {
      var html = "";
         html += '<div class="modal-dialog">'+
                '<div class="modal-content">'+
                     '<div class="modal-header">'+
                          '<h4 class="modal-title text-center">"Mensaje De Alerta"</h4>'+
                     '</div>'+
                     '<div class="modal-body text-center text-warning">'+
                          '<h4>Lo sentimos pero el sistema se encuentra en mantenimiento, estaremos avisando al personal la restauración de este. Gracias</h4>'+
                          '<img src="'+base_url+'public/img/sitio/mantenimiento.png" alt="En Mantenimiento" class="img-thumbnail">'+
                     '</div>'+
                     '<div class="modal-footer">'+
                          '<button type="submit" class="btn btn-primary" onclick="salir();" >Aceptar</button>'+
                     '</div>'+
                '</div>'+
           '</div>';
      mostrarmodalstatic("#bloquear",html,true);
    }          
}

function Bloquear_Sistema()
{
    loadajax();
    setTimeout(function()
    {
      if($("#bloquear").html() == ""){
          $.ajax({
            type: 'POST',
            url: base_url + 'login/bloquear_sistema',
            cache: false,
            async: false,
            success: function(data)
            {
              html = '<div class="modal-dialog">'+
                        '<div class="modal-content">'+
                          '<form role="form" id="form_modal_bloqueo" role="form" onsubmit="return false;" >'+
                             '<div class="modal-header">'+
                                  '<h4 class="modal-title">Modo: "Sistema Bloqueado"</h4>'+
                             '</div>'+
                             '<div class="modal-body">'+
                                  '<p class="text-center text-info"><strong>Por favor inicie sessión para desbloquear la pantalla:</strong></p>'+
                                  '<div id="msj_alert_modal"></div>'+
                                   '<div class="form-group">'+
                                        '<label for="txtusuario">Usuario</label>'+
                                        '<input type="text" class="form-control" name="txtusuario" id="txtusuario" placeholder="Ingrese Su Usuario">'+
                                   '</div>'+
                                   '<div class="form-group">'+
                                        '<label for="txtpassword">Contraseña</label>'+
                                        '<input type="password" class="form-control" id="txtpassword" placeholder="Ingrese Su Contraseña">'+
                                   '</div>'+
                             '</div>'+
                             '<div class="modal-footer">'+
                                  '<button type="submit" class="btn btn-primary" onclick="Desbloquear_Sistema();" >Desbloquear</button>'+
                                  '<button type="submit" class="btn btn-primary" onclick="salir();" >Salir</button>'+
                             '</div>'+
                          '</form>'+
                        '</div>'+
                   '</div>';
                 mostrarmodalstatic("#bloquear",html,true); 
               }
          });
      }
    },200);
}

function Desbloquear_Sistema()
{
    $.ajax({
        type: 'POST',
        url: base_url + 'login/entrar',
        data:{usuario: $("#txtusuario").val(), clave: $("#txtpassword").val()},
        cache: false,
        async: false,
        dataType: 'json',
        success: function(data)
        {
            if(data.success == true)
            {
                setInterval(vereficarsession, 20000);
                $("#bloquear").modal('hide');
                $("#bloquear").html(''); 
            } 
            else 
            {
                $("#bloquear"+" #msj_alert_modal").html(data.mensages);
            }
        }
    });
    return false;
}

function mostrarmodalstatic(div,html,black)
{
    if(html == undefined) html = '';
    $(div).html(html);
    $(div).modal({
        backdrop: 'static',
        keyboard : false,
        show: true,
    });
    if(black != undefined)
    {
        $(".modalbloqueo").css('background-color','#000');
    }
}

function borrar(div, url, id, url2)
{
    var confirmar = confirm("¿Realmente desea eliminar esto?"); 
    if (confirmar == true) 
    { 
       loadajax();
        $.ajax({
            type: 'POST',
            url: url,
            data: id,
            beforeSend: function ()
            {     
               $(div).html('<i class="fa fa-refresh fa-spin"></i>');
            },
            success: function(data)
            {
                $(div).html(data);
            }
        });
    } 
    else
    {
       loadajax();
          $.ajax({
            type: 'POST',
            data: id,
            url: url2,
            beforeSend: function ()
            {
                $(div).html('<i class="fa fa-refresh fa-spin"></i>');
            },
            success: function(data)
            {
                $(div).html(data);
            }
        }); 
    } 
}

function getTimePicker(id, fechagestor)
{
    $(id).attr("data-date-format","hh:mm A");
    $(id).removeAttr("readonly");

    $(id).datetimepicker
    ({
        format:'Y-m-d',
        timepicker:false,
    });
} 

function mostrartabla(datos, url, div)
{
   loadajax();
    $.ajax({
        type: 'POST',
        url: url,
        data: datos,
        dataType: "json",
        success: function(data)
        {
          if(data.success == false) 
          {
            showModal("Atención!",data.mensaje);
          }
          else
          {
              if(data.length > 0)
              {
                var html = "";

                 html +='<div class="col-md-8 col-lg-12">'+
                      '<div class="form-panel">'+
                        '<table class="table table-user-information">'+
                          '<thead>'+
                               '<tr>'+
                                    '<th>Concepto</th>'+
                                    '<th>Tipo de Pago</th>'+
                                    '<th>Nª de Factura</th>'+
                                    '<th>Nª de Control</th>'+
                                    '<th>Fech Factura</th>'+
                                    '<th>Precio Unitario</th>'+
                                    '<th>Cantidad</th>'+
                                    '<th>Sub Total</th>'+
                                    '<th>% Iva</th>'+
                                    '<th>Total Iva</th>'+
                               '</tr>'+
                          '</thead>';
                   for (i in data) 
                   {
                     html += '<tbody>'+
                                  '<tr>'+
                                    '<td>'+data[i].concepto+'</td>'+
                                    '<td>'+data[i].tipo_pago+'</td>'+
                                    '<td>'+data[i].numero_factura+'</td>'+
                                    '<td>'+data[i].numero_control+'</td>'+
                                    '<td>'+data[i].fecha_factura+'</td>'+
                                    '<td>'+data[i].precio_unitario+'</td>'+
                                    '<td>'+data[i].cantidad_producto+'</td>'+
                                    '<td>'+data[i].sub_total+'</td>'+
                                    '<td>'+data[i].porcentaje_iva+'</td>'+
                                    '<td>'+data[i].total_iva+'</td>'+
                                  '</tr>'+
                            '</tbody>';
                   }
                    html += '</table>'+
                    '</div>'+
                  '</div>';
                  $(div).html(html);
              }
              else
              {
                 showModal("<b>Mensajes de Alerta</b>",'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+data.respuesta+'</div>');
              }      
           }
        }
    }); 
}  

function setselect2(div)
{
    $.fn.select2.defaults.set( "theme", "bootstrap");
    $(div).select2({
        placeholder: "Seleccionar",
        language: "es",
        allowClear: true,
    });
}

function ucwords(str) 
{
    return (str + '')
    .replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function($1){
    return $1.toUpperCase();
    });
}

function MsjSistema()
{
    $.ajax({
        type: 'POST',
        url: base_url + 'login/mensajes_sistema',
        cache: false,
        async: false,
        dataType: 'json',
        success: function(data)
        {
            getMsjAlertas(data.getMsjAlertas);
        }
    });
}

function getMsjAlertas(data)
{
    if(data.length > 0)
    {
        html = '<div class="modal-dialog">'+
                      '<div class="modal-content">'+
                           '<div class="modal-header">'+
                                '<h4 class="modal-title text-center">"Mensajes De Alerta:"</h4>'+
                           '</div>'+
                           '<div class="modal-body">';
                           for (i=0;i<data.length;i++) 
                           {
                               html += '<p>'+
                                            '<strong class="text-info">De: &nbsp&nbsp&nbsp&nbsp'+ucwords(data[i].useremisor)+' </strong> <br>'+
                                            '<strong class="text-danger">Para: Usted </strong> <br>'+
                                            data[i].mensaje+' <br><br>'+
                                        '</p>';
                           }
                           html+='</div>'+
                           '<div class="modal-footer">'+
                                '<button type="submit" class="btn btn-primary" onclick="aceptar_msjalerta(1);" >Aceptar</button>'+
                           '</div>'+
                      '</div>'+
                 '</div>';
        mostrarmodalstatic("#bloquear",html);
    }
}

function aceptar_msjalerta(id)
{
    $.ajax({
        type: 'POST',
        url: base_url + 'login/mensajes_sistema', /// 1 recibido 2 leido
        data:{updatemensaje: id},
        async: false,
        cache: false,
        success: function(data)
        {
            $("#bloquear").modal('hide');
            $("#bloquear").html('');
        }
    });
}

function mostrardiv(id,sec)
{
    if(id == undefined) id = "";
    if(sec == undefined){ sec = 3; }
    $(id).show();
    $('html,body').animate({scrollTop: $(id).position().top}, 800, 'swing');

    return false;
}

function limpiardiv(div)
{
    if(div == undefined){div = "";}
    $(div).html("");
    $('html,body').animate({scrollTop: '0px'}, 800, 'swing');
}

function limpiarmsj(tiempo)
{
    if(tiempo == undefined) tiempo = 5000;
    window.setTimeout("limpiamensaje()",tiempo);
}

function limpiamensaje()
{
    $("#page"+$("#page_active").val()+" #msj_alert").html('');
}

function pagostipos(sel)
{
    if (sel.value=="Factura")
    {
       divC = document.getElementById("factura");
       divC.style.display = "";

       divT = document.getElementById("sinfactura");
       divT.style.display = "none";
    }

    if (sel.value=="Sin factura")
    {
       divC = document.getElementById("sinfactura");
       divC.style.display = "";

       divT = document.getElementById("factura");
       divT.style.display = "none";
    }
}

function sumar_cantidar()
{
    var valoruno = $('#montocompra').val();
    var resultado = parseFloat($('#montocompra').val());
    var resultadofinal = resultado * $('#cantidad').val();
    //alert('el valor sumado es'+resultadofinal);

    if(isNaN(resultadofinal))
    {
      var resultadofinal = 0;
      $("#subtotal").val(resultadofinal.toFixed(2));
    }
    else
    {
      $("#subtotal").val(resultadofinal.toFixed(2));
    }
}

function porcentaje_iva()
{
    var subtotal = parseFloat($('#subtotal').val());
    var iva = $('#iva').val();
    iva  = parseFloat(subtotal*(iva/100));

    $("#ivahidden").val(iva.toFixed(2));

    var total = (subtotal+iva);

    if(isNaN(total))
    {
        var total = 0;
        $("#ivatotal" ).html(iva.toFixed(2));
        $("#totalpagares").val(total.toFixed(2));
    }
    else
    {
        $("#ivatotal" ).html(iva.toFixed(2));
        $("#totalpagares").val(total.toFixed(2));
    }
}

function modalregistrousuario(dataform,url,div,modal,urlmostrar)
{
    $.ajax({
        type: 'POST',
        url: url,
        data: dataform,
        contentType: false,
        processData: false,
        dataType: 'json', 
        beforeSend: function ()
        {
             $(div).html('cargando <i class="fa fa-spinner"></i>');
        },
        success: function(data)
        {
            if(data.success == false) 
            {
                showModal("Atención!",data.mensaje);
            }
            else
            {
                showModal("<b>Operación Completada</b>",'<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+data.mensaje+'</div>');
                resultados('id='+data.id, urlmostrar, '#resultado');      
            }
        }
    }); 
}

function salir()
{
    loadajax('5','Saliendo del Sistema, por favor espera');
    $.ajax({
        type: "POST",
        url: base_url + "login/salir",
        cache: false,
        async: false,
        success: function(data)
        {
            setTimeout(function()
            {
                window.location = base_url + "login";
            },200);
        }
    });
}

function alertassistema(mensaje, sec)
{
    if(sec == undefined) sec = 10;
    if(mensaje == undefined) mensaje = "";

    $.blockUI({ 
              message: mensaje, 
              fadeIn: 800, 
              fadeOut: 800, 
              timeout: 3000, 
              showOverlay: false, 
              centerY: false, 
              css: 
              { 
                  width: '180px', 
                  top: '10px', 
                  left: '', 
                  right: '10px', 
                  border: 'none', 
                  padding: '5px', 
                  backgroundColor: '#000', 
                  '-webkit-border-radius': '10px', 
                  '-moz-border-radius': '10px', 
                  opacity: .6, 
                  color: '#fff' 
              } 
          }); 
      setTimeout($.unblockUI, sec * 100); 
}

function chatear(id,focuss)
{

        $("#user_chat").val(id);
        if(focuss == undefined) $("#txtmsj_chat").focus();

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/getconversation',
            data: {usuario_id: id},
            async: false,
            cache: false,
            dataType: 'json',
            success: function(data){
                $(".chat").html(data.html);
                $("#chat_username").html(data.user);
                $("#txtvisto").html(data.visto);
            }
        });
}