<!--header start-->
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
 
    <a href="#" class="logo" style="color:black;"><b>TELENORD</b></a>
    


    <div class="top-menu">
        <ul class="nav pull-right top-menu">

            <!--  <li><a class="logout" href="javascript:void(0)" class="btn btn-default btn-xs" onclick="modal('','<?php echo base_url(); ?>admin/cambiar_clave','.modal-body','.modal')"><i class="fa fa-key"></i> Cambio de clave</a></li>-->
            <li><a class="logout" href="javascript:void(0)"  onclick="salir()"><i class="fa fa-times"></i> Salir</a></li>

        </ul>
    </div>

</header>
<!--header end-->

<script language="javascript">
    
/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.body.style.backgroundColor = "white";
}
</script>