

<!-- COMPLEX TO DO LIST -->     
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
                                          
                                        <table class="table table-bordered">
                                          <thead> 
                                            <tr>
                                                <th>ID</th>
                                                <th>CONCEPTO</th>
                                                <th>MONTO</th>
                                                <th>PAGADO</th>
                                                <th>FECHA</th>
                                                <th>BALANCE</th>
                                                
                                            </tr>
                                            </thead>  
                                            <tbody> 
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                             
                                                   
                                                   
                                              </tr>
                                            </tbody>
                                            
                                            
                                           </table>

                                          <?php 

                                                  $balancetotal = array(
                                                                'name'        => 'balancetotal',
                                                                'id'          => 'balancetotal',
                                                                'value'       =>  '.00',
                                                                'type'        => 'text',
                                                                'placeholder' => '0.00',
                                                                'class'       => 'form-control',
                                                                'required'    => '""',
                                                                'readonly'    => 'true'
                                                                );
                                                  ?>
                                              


                                      </li>

                                          <li>
                                             <div class="col-md-5 col-md-offset-1">
                                        <div class="form-group" >
                                                  <label class="control-label inputs"><strong>Total Balance</strong> </label>
                                                   <div class="input-group" >
                                                     <span class="input-group-addon">
                                                     RD<i class="fa fa-usd"></i>
                                                    </span>
                                                   <?php echo form_input($balancetotal); ?>
                                                    </div>
                                               </div> 
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
              </div><!-- /row -->