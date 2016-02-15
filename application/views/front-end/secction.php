<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12 main-chart">

                <ol class="breadcrumb">
                    <li class="active">Principal</li>
                    <li class="active">Apertura de Caja <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo APERTURACAJA ?></span></li>
                    <li class="active">Caja chica <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo CAJACHICA ?></span></li>
                    <li class="active">Monto Maximo <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo MONTOMAXIMO ?></span></li>
                    <li class="active">Monto Minimo <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo MONTOMINIMO ?></span></li>
                </ol>

                <div class="row mt">
                    <!-- SERVER STATUS PANELS -->
                    <div class="col-md-3 col-sm-3 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>Generar compras</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p><i class="fa fa-heart"></i> 1</p>
                                </div>
                                <div class="col-sm-6 col-xs-6"></div>
                            </div>
                            <div class="centered">
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>admin/registro_compras','#resultado')"><img src="assets/img/venta.png" width="120"></a>
                            </div>
                        </div>
                    </div><!-- /col-md-4 -->


                    <div class="col-md-3 col-sm-3 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>Caja chica</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p><i class="fa fa-heart"></i> 2</p>
                                </div>
                                <div class="col-sm-6 col-xs-6"></div>
                            </div>
                            <div class="centered">
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>admin/configurar_caja','#resultado')"><img src="assets/img/cuenta.png" width="120"></a>
                            </div>
                        </div>
                    </div><!-- /col-md-4 -->

                    <div class="col-md-3 col-sm-3 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>Reponer caja</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p><i class="fa fa-heart"></i> 3</p>
                                </div>
                                <div class="col-sm-6 col-xs-6"></div>
                            </div>
                            <div class="centered">
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>admin/reponer_caja','#resultado')"><img src="assets/img/monei.png" width="120"></a>
                            </div>
                        </div>
                    </div><!-- /col-md-4 -->

                    <div class="col-md-3 col-sm-3 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>Cierre de Caja</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p><i class="fa fa-heart"></i> 4</p>
                                </div>
                                <div class="col-sm-6 col-xs-6"></div>
                            </div>
                            <div class="centered">
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>admin/reporte_cierre_caja','#resultado')"><img src="assets/img/cashbox.png" width="120"></a>
                            </div>
                        </div>
                    </div><!-- /col-md-4 -->

                    <div class="col-md-3 col-sm-3 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>Reportes Grafico</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p><i class="fa fa-heart"></i> 5</p>
                                </div>
                                <div class="col-sm-6 col-xs-6"></div>
                            </div>
                            <div class="centered">
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>admin/reporte_contables','#resultado')"><img src="assets/img/report.png" width="120"></a>
                            </div>
                        </div>
                    </div><!-- /col-md-4 -->

                    <div class="col-md-3 col-sm-3 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>Reportes de Gastos</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p><i class="fa fa-heart"></i> 6</p>
                                </div>
                                <div class="col-sm-6 col-xs-6"></div>
                            </div>
                            <div class="centered">
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>admin/reportes_grupos','#resultado')"><img src="assets/img/gastos.png" width="120"></a>
                            </div>
                        </div>
                    </div><!-- /col-md-4 -->

                    <div class="col-md-3 col-sm-3 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>Reportes de Ingresos Egresos</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p><i class="fa fa-heart"></i> 7</p>
                                </div>
                                <div class="col-sm-6 col-xs-6"></div>
                            </div>
                            <div class="centered">
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>admin/reporte_ingreso_egresos','#resultado')"><img src="assets/img/Income-128.png" width="120"></a>
                            </div>
                        </div>
                    </div><!-- /col-md-4 -->

                    <div class="col-md-3 col-sm-3 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>Consulta de Ventas</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6 goleft">
                                    <p><i class="fa fa-heart"></i> 8</p>
                                </div>
                                <div class="col-sm-6 col-xs-6"></div>
                            </div>
                            <div class="centered">
                                <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>admin/consultar_compras2','#resultado')"><img src="assets/img/consultarfecha.png" width="120"></a>
                            </div>
                        </div>
                    </div><!-- /col-md-4 -->


                </div><!-- /row -->
            </div>
    </section>