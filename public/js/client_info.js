$(document).ready(function(){



    var combobox = $('#accionselect');
    var sumBalancetotal = 0;
    var input_txt_monto_pago = $('#InputMontoPagar');
    var not_many_clicks_button = 0;

    input_txt_monto_pago.prop('disabled', false);
    input_txt_monto_pago.val('');
    input_txt_monto_pago.focus();


    input_txt_monto_pago.on('keypress', function(event){
        if (event.which == 13) {
            $('#btn_pagar').trigger('click');
        }
    });

    combobox.val('0');

    var muestraModal = function(titulo, contenido, botones){
        $('#LabelModal').empty().append(titulo);
        $('#BodyModal').empty().append(contenido);
        $('#modalFooter').empty().append(botones);
        $('#infomodal').modal();
        //muestraModal("p","<p>Eso</p>",'<button type="button" class="btn btn-success">Confirmar</button>');
    }

    var tableReload = function(_type){
        $("div#pn-g").empty();

        if (_type == 0) {
            _type = "mensualidad";
        } else if (_type == 1){
            _type = "caja"
        }

        if (_type !== "2") {
            $("div#pn-g").append('<span>Cargando </span><img src="/telenordci/images/fbloader.gif" />');
            $.ajax({
                type: 'POST',
                cache: false,
                url: link_to('credit_info'),
                timeout: 15000,
                data: {parameter:contract,
                    type: _type},
                dataType: 'json',

                success: function(data, status, xml){
                    var sumnatoria = 0;
                    var header = "<table class='table table-striped table-bordered table-hover table-condensed'><thead>" +
                        "<tr><th>Concepto</th><th>Monto</th><th>Pagado</th><th>Fecha</th><th>Balance</th></tr></thead><tbody>";
                    var body = "";
                    var footer = "</tbody></table>";
                    $.each(data.rows, function(i, item) {
                        body += "<tr><td>" + item.Concepto +
                            "</td><td>" + item.Monto +
                            "</td><td>" + item.Pagado +
                            "</td><td>" + item.Fecha +
                            "</td><td>" + item.Balance +
                            "</td></tr>";
                        sumnatoria += Number(item.Balance.replace(/[^0-9\.]+/g,""));
                    });
                    sumnatoria = parseFloat(sumnatoria).toFixed(2);
                    $('#balance_generado').empty().append('Balance: RD$' + sumnatoria);

                    $("div#pn-g").empty().append(header + body + footer);


                    sumBalancetotal = data.sumBalance;

                },
                error: function(xml, status, error){
                    if(status==="timeout") {
                        alert("Opps, se agoto el tiempo de espera..., intente de nuevo.");
                        $("#generated_sumbalance").empty().append("<p class='balance' > Opps!, Intente cargar balances de nuevo.</p>");
                        sumBalancetotal = 0;
                    } else {
                        alert(status);
                        $("#generated_sumbalance").empty().append("<p class='balance' > Opps!, Intente Recargar la pagina(Presione la tecla F5)</p>");
                    }
                }/*,
                 complete: function(xml, status){

                 }*/
            });

            $.ajax({
                type: 'POST',
                cache: false,
                url: link_to('data'),
                timeout: 15000,
                data: {
                    searchString:contract},
                dataType: 'json',
                success: function(data, status, xml){
                    $("#generated_sumbalance").empty().append("<p class='balance' > Balance: <span> RD$ " + data.rows[0].Balance + "</span></p>");
                },
                error: function(xml, status, error){
                    if(status==="timeout") {
                        alert("Opps, se agoto el tiempo de espera..., intente de nuevo.");
                        $("#generated_sumbalance").empty().append("<p class='balance' > Opps!, Intente cargar balances de nuevo.</p>");
                        sumBalancetotal = 0;
                    } else {
                        alert(status);
                        $("#generated_sumbalance").empty().append("<p class='balance' > Opps!, Intente Recargar la pagina(Presione la tecla F5)</p>");
                    }
                }/*,
                 complete: function(xml, status){

                 }*/
            });
        } else{
            $("#generated_sumbalance").empty().append("<p class='balance' > Balance: <span> RD$ 200.00</span></p>");
            sumBalancetotal = 200;

        }

    }

    tableReload(0);



    combobox.change(function(){
        tableReload($(this).val());
        if (combobox.val() == 2) {
            input_txt_monto_pago.val('200');
            input_txt_monto_pago.prop('disabled', true);
        } else {
            input_txt_monto_pago.prop('disabled', false);
            input_txt_monto_pago.val('');
            input_txt_monto_pago.focus();
        }
    });

    $('#btn_impfactura').click(function(){
        $(location).attr('href',OpenInNewTab('invoice/print_invoice/' + contract + '/' + $.cookie('hoja')));
    });

    $('#btn_pagar').click(function(){
        var valor_input = input_txt_monto_pago.val();
        var val_combobox_tosend;
        switch(combobox.val()){
            case "0":
                val_combobox_tosend = 0;
                break;
            case "1":
                val_combobox_tosend = 1;
                break;
            case "2":
                val_combobox_tosend = 2;
                break;
        }


        function limpia_con_mensaje(mensaje, titulo, botones){
            input_txt_monto_pago.val('');
            input_txt_monto_pago.focus();
            muestraModal(titulo,mensaje,botones);
        }

        function recarga_pagina(contrato){
            input_txt_monto_pago.val('');
            $(location).attr('href',OpenInSelfTab('busquedacliente/redireccionando/' + contrato));
            not_many_clicks_button = 0;
        }

        function make_payment_message(mensaje, titulo){
            muestraModal(titulo,mensaje,'<button type="button" id="btn_confirm" class="btn btn-success">Pagar</button>');

            $('#infomodal').on('click', '#btn_confirm', function(){
                $('#infomodal').off('click', '#btn_confirm');
                if (not_many_clicks_button === 0) {//super codigo bajaviano
                    not_many_clicks_button = 1;
                    //window.open(real_path + 'index.php/invoice/index/' + contract,'_blank'); return;
                    var reco = 0; //Variable para saber si es una reconexion o un pago , 0 Es un pago, 1 Es una reconexion La reconexion tiene su propia funcion de pago
                    if (val_combobox_tosend === 2) {
                        reco = 1;
                    }

                    $.post(link_to('make_payment'), { type: val_combobox_tosend , mount: valor_input , contract: contract, balance_anterior: sumBalancetotal, reconexion: reco } , function(data){
                        window.open(real_path + 'index.php/invoice/print_invoice/' + contract + '/' + $.cookie('hoja'),'_blank');
                        tableReload(combobox.val());
                    });

                    $('#infomodal').modal('hide');
                    not_many_clicks_button = 0;
                    input_txt_monto_pago.val('');
                    input_txt_monto_pago.focus();
                }
            });


        }

        if (!$.isNumeric(valor_input)){
            limpia_con_mensaje('El monto a pagar deber ser un valor numerico valido: Ej: 500.00 o 500', 'Error','');
            return ;
        }
        if (valor_input < 1){
            limpia_con_mensaje('El monto a pagar debe superar el monto de RD$ 1.00', 'Error','');
            return ;
        }
        if (combobox.val() == 1 && valor_input > sumBalancetotal) {
            limpia_con_mensaje('El valor a pagar no debe ser mayor a la deuda en el pago de Caja Digital', 'Error','');
            return ;
        }

        make_payment_message('�Esta seguro que desea realizar el pago con el monto de RD$$ ' + input_txt_monto_pago.val() + '?', 'Seguridad');
    });



});