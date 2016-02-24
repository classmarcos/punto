<?php 
  if(isset($filas["error"]))
  {
      echo "Actualmente no hay Registros";
  }//V0400201A
  else
  {
  ?>

  

<!-- COMPLEX TO DO LIST --> 
<ol class="breadcrumb">
                          <li class="active">Detalle Cliente </span> </li>
                          <li class="active">Total Mensualidad <i class="fa fa-money"></i> <span class="badge bg-theme">RD$<?php //echo APERTURACAJA ?></span></li>
                          <li class="active">Total Caja <i class="fa fa-money"></i> <span class="badge bg-theme">RD$<?php //echo CAJACHICA ?></span></li>
                          <li class="active">Balance Total <i class="fa fa-money"></i> <span class="badge bg-theme">RD$ <?=$Balance?></span></li>
                          
                           </ol>    
              <div class="row mt">
                  <div class="col-md-12">

                      <section class="task-panel tasks-widget">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa  fa-table"></i> Detalle de Pendientes</h5></div>
                          <br>
                    </div>
                          <div class="panel-body">
                              <div class="task-content">

                                  <ul class="task-list">

                                  <li>
                                    <div class="col-md-5 col-md-offset-1">
                                       <div class="form-group">
                                          <label class="control-label inputs">Acci&oacute;n</label>
                                           <div class="input-group">
                                             <span class="input-group-addon">
                                              <i class="fa fa-list-alt"></i>
                                            </span>
                                             <select name="menu" class="form-control">

                                                 <option value="fc" >Pago Mensualidad</option>
                                                 <option value="sb">Caja Digital</option>

                                             </select>
                                            </div>
                                       </div>  
                                     </div>
                                  </li>
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
                                            <?php foreach($filas as $r):?>
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
                                            
                                             <?php endforeach;?>
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

