<?php 
$buscarusuario = array(
              'name'        => 'buscarusuario',
              'id'          => 'buscarusuario',
              'value'       => '',
              'type'        => 'text',
              'placeholder' => 'Buscar Cliente',
              'class'       => 'form-control',
              'required'    => '""'
              );
?>

<section id="main-content">
          <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Clientes</h3>
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">


                      <div class="row">
                         <div class="col-md-5 col-md-offset-3">
                               <div class="form-group">
                                  <label class="control-label inputs">Busqueda Avanzada de Clientes</label>
                                   <div class="input-group">
                                      <span class="input-group-addon">
                                          <i class="fa fa-search-plus"></i>
                                      </span>
                                      <?php echo form_input($buscarusuario); ?>
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
         $("#buscarusuario").on('keyup',function(event)
         {
            event.preventDefault();
            busqueda('buscarusuario='+$('#buscarusuario').val(),'<?php echo base_url(); ?>usuarios/buscarusuario','#busqueda');
        });
      });
</script>
