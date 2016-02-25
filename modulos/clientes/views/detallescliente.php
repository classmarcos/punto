<?php 
  if(isset($mensualidad["error"]) && isset($caja["error"]))
  {
      echo "Actualmente no hay Registros";
  }//V0400201A   - color: #449d44
  else
  {
  ?>



<!-- COMPLEX TO DO LIST --> 
<ol class="breadcrumb">
                          <li class="active">Detalle Contrato <span class="badge bg-theme"> <?=$Contrato?></span> </li>
                          <li class="active">Balance Mensualidad <i class="fa fa-money"></i> <span class="badge bg-theme">RD$<?=$BalanceMensualidad ?></span></li>
                          <li class="active">Balance Caja <i class="fa fa-money"></i> <span class="badge bg-theme">RD$<?=$BalanceCaja ?></span></li>
                          <li class="active">Balance Total <i class="fa fa-money"></i> <span class="badge bg-theme">RD$ <?=$Balance?></span></li>
                          
                           </ol>    
              <div class="row mt">
                  <div class="col-md-12">

                      <section class="task-panel tasks-widget">
                    <div class="panel-heading">
                          <div class="pull-left"><h5 style="color:#000;"><i class="fa  fa-table"></i> Detalle de Pendientes</h5></div>
                          <br>
                    </div>
                          <div class="panel-body">
                              <div class="task-content">

                                  <ul class="task-list">

                                  
                                      <li>
                                        
                                        <table class="table table-bordered">
                                          <thead> 
                                            <tr>
                                                <th>NUMERO</th>
                                                <th>CONCEPTO</th>
                                                <th>MONTO</th>
                                                <th>PAGADO</th>
                                                <th>FECHA</th>
                                                <th>BALANCE</th>
                                                
                                            </tr>
                                            </thead>  
                                            <?php if(!isset($mensualidad["error"])){
                                              foreach($mensualidad as $r):?>
                                            <tbody> 
                                            <tr>

                                                <td> <?=$r->Numero?>   </td>
                                                <td> <?=$r->Concepto?> </td>
                                                <td> <?=$r->Monto?>     </td>
                                                <td> <?=$r->Pagado?>    </td>
                                                <td> <?=$r->Fecha?>     </td>
                                                <td> <?=$r->Balance?>   </td>
    
                                              </tr>

                                            </tbody>
                                            
                                             <?php endforeach;}?>

                                            <?php if(!isset($caja["error"])){
                                              foreach($caja as $r):
                                                
                                            ?>
                                            <tbody> 
                                            <tr>

                                                <td> <?=$r->Numero?>   </td>
                                                <td> <?=$r->Concepto?> </td>
                                                <td> <?=$r->Monto?>     </td>
                                                <td> <?=$r->Pagado?>    </td>
                                                <td> <?=$r->Fecha?>     </td>
                                                <td> <?=$r->Balance?>   </td>
    
                                              </tr>

                                            </tbody>
                                            
                                             <?php endforeach;}?>
                                           </table>


                                      </li>

                                          </div>
                                          </li>



                                          <?php //$datos = $this->global_model->obtener_rango_fecha('fecha_registro','fecha_registro','2015','fecha_registro','fecha_registro','id','ASC','monto');?>

                                          <!--
                                                   
                                          <table class="table table-bordered">
                                          <thead> 
                                            <tr>
                                               <th>AÑO</th>
                                                <th>MES</th>
                                                <th>TOLTA POR MES</th>
                                          
                                                
                                            </tr>
                                            </thead> 
                                            <?php foreach($datos as $r):?>
                                            <tbody> 
                                            <tr>
                                               
                                                <td><?= $r->anio?></td>
                                                <td><?= $r->mes?></td>
                                                <td><?= $r->montos?></td>
                         
                                              </tr>
                                            </tbody>

                                            <?php endforeach;?>  
                                           </table>

                                                            
                                                     
                                                    -->
                                  </ul>
                              </div>
                          </div>
                      </section>
                  </div><!-- /col-md-12-->
                   
 <?php    
  }
  ?>
              </div><!-- /row -->

