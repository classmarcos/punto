<?php 
  if(isset($mensualidad["error"]) && isset($caja["error"]))
  {
      echo "Actualmente no hay Registros";
  }//V0400201A   - color: #449d44
  else
  {
  ?>

<style type="text/css">
  #efectivo{
    text-align:right;
  }
  #texto{
    background-color: #FF6C10;
}
</style>

<!-- COMPLEX TO DO LIST --> 
<ol class="breadcrumb">
  <li class="active">Contrato <span class="badge bg-theme"> <?=$Contrato?></span> </li>
  <li class="active">Balance Mensualidad <i class="fa fa-money"></i> <span class="badge bg-theme">RD$<?=$BalanceMensualidad ?></span></li>
  <li class="active">Balance Caja <i class="fa fa-money"></i> <span class="badge bg-theme">RD$<?=$BalanceCaja ?></span></li>
  <li class="active">Balance Total <i class="fa fa-money"></i> <span class="badge bg-theme">RD$ <?=$Balance?></span></li>
  
</ol>    
<div class="row mt">
  <div class="col-md-12">
    <section class="task-panel tasks-widget">
        <div class="panel-body" >
            <div class="task-content" style="overflow-x:auto;height: 200px;overflow-y: auto;">       
              <table id="example" class="table table-bordered ">
                  <thead> 
                    <tr>  
                      <th id="texto">CONCEPTO</th>
                      <th id="texto">TIPO</th>
                      <th id="texto">FECHA</th>
                      <th id="texto">BALANCE</th>        
                    </tr>
                  </thead>   
                  <tbody> 
                    <?php if(!isset($mensualidad["error"])){
                        foreach($mensualidad as $r):?>
                          <tr>
                              <td> <?=$r->Concepto?> </td>
                              <td>MENSUALIDAD</td>
                              <td> <?=$r->Fecha?>     </td>
                              <td id="efectivo"> <?=$r->Balance?>   </td>
                          </tr>

                        <?php endforeach;}?> 
                  </tbody>
                  <tbody>
                    <?php if(!isset($caja["error"])){
                      foreach($caja as $r):?>
                        <tr>
                          <td> <?=$r->Concepto?> </td>
                          <td>CAJA DIGITAL</td>
                          <td> <?=$r->Fecha?>     </td>
                          <td style="text-align:right;"> <?=$r->Balance?>   </td>
                        </tr>
                      <?php endforeach;}?>  
                  </tbody>
              </table>    
            </div>    
        </div>
      </section>
  </div><!-- /col-md-12-->
   
<?php    
}
?>
</div><!-- /row -->

