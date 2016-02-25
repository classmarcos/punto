<?php 
$buscarcliente = array(
              'name'        => 'buscarcliente',
              'id'          => 'buscarcliente',
              'value'       => '',
              'type'        => 'text',
              'placeholder' => 'Buscar Cliente',
              'class'       => 'form-control',
              'required'    => '""'
              );
?>

<section id="main-content">
          <section class="wrapper">
          <h3 style="color:#000;"><i class="fa fa-angle-right"></i> Clientes</h3>
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">


                      <div class="row">
                         <div class="col-md-5 col-md-offset-3">
                               <div class="form-group">
                                  <label class="control-label inputs" style="color:#000;">Busqueda de Clientes</label>
                                   <div class="input-group">

                                      <?php echo form_input($buscarcliente); ?>

                                       <span class="input-group-btn">
                                           <button id="btn_buscar" class="btn btn-success" type="button">Buscar</button>
                                      </span>
                                   </div>
                               </div> 
                           </div>   
                        </div>
                    </div>

                   <div class="row">
                       <div id="busqueda"></div>
                  </div>  
             </div><!-- col-lg-12-->
        </div><!-- /row --> 
</section>   

  <script type="text/javascript">
      $(document).ready(function()
      {
        $("#buscarcliente").keyup(function(event){
          if(event.keyCode == 13){
            
           $(this).trigger("enterKey");
                event.preventDefault();
                busqueda('buscarcliente='+$('#buscarcliente').val()+ "%",'<?php echo base_url(); ?>clientes/buscarcliente','#busqueda');
           
          }
        });

         $("#btn_buscar").on('click',function(event)
         {
            event.preventDefault();
            busqueda('buscarcliente='+$('#buscarcliente').val()+ "%",'<?php echo base_url(); ?>clientes/buscarcliente','#busqueda');
        });
      });
</script>
