<script type="text/javascript" src="../js/cita.js?rev=<?php echo time(); ?>"></script>


<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Mantenimiento de Citas</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- Condenido -->
        <div class="card-body">

            <!-- div de busqueda -->
            <div class="form-group row">
                <div class="col-lg-10">
                    <div class="input-group">

                        <i class="btn btn-success">Buscar</i> <input type="text" class="global_filter form-control me-2"
                            id="global_filter" placeholder="Ingresar datos a buscar">
                        <span class="input-group-addon"> </span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"> <i
                            class="fa fa-plus" aria-hidden="true"></i> Nuevo Registro</button>



                </div>

            </div>
            <table id="tabla_cita" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No.</th>
                        <th>Fecha</th>
                        <th>Paciente</th>
                        <th>Medico</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>No.</th>
                        <th>Fecha</th>
                        <th>Paciente</th>
                        <th>Medico</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
            </table>



        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


<!-- formulario para registar datos -->
<div class="modal lg" id="modal_registro" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;"> <b> Registro de Citas</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>


            <div class="modal-body">
                
                    <div class="col-lg-12">
                        <label for="">Paciente</label>
                        <select class="js-example-basic-single" name="state" id="cbm_paciente" style="width:100%;">
                        </select> <br> <br>
                    </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Especialidad</label>
                        <select class="js-example-basic-single" name="state" id="cbm_especialidad" style="width:100%;">
                        </select> <br>
                    </div>

                    <div class="col-lg-6">
                        
                        <label for="">Doctor</label>
                        <select class="js-example-basic-single" name="state" id="cbm_doctor" style="width:100%;">
                        </select> <br> <br> 
                    </div>
                    
                    <div class="col-lg-12">
                         <label for="">Descripción de la cita</label>
                        <textarea  id="txt_descripcion"  rows="7" class="form-control" style="resize:none">

                        </textarea>

                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Registrar_Cita()"><i
                        class="fa fa-check"><b>&nbsp;Registrar</b></i> </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"
                        aria-hidden="true"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
    </div>
</div>
<!-- /formulario para registar datos -->
<div class="modal lg" id="modal_editar" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;"> <b> Editar de Citas</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>


            <div class="modal-body">
                
                    <div class="col-lg-12">
                        <input type="text" id="txt_cita_id" hidden>
                        <label for="">Paciente</label>
                        <select class="js-example-basic-single" name="state" id="cbm_paciente_editar" style="width:100%;">
                        </select> <br> <br>
                    </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="">Especialidad</label>
                        <select class="js-example-basic-single" name="state" id="cbm_especialidad_editar" style="width:100%;">
                        </select> 
                    </div>

                    <div class="col-lg-6">
                        <br>
                        <label for="">Doctor</label>
                        <select class="js-example-basic-single" name="state" id="cbm_doctor_editar" style="width:100%;">
                        </select> <br> <br> 
                    </div>
                    <div class="col-lg-6">
                        <label for="">Estatus</label>
                        <select class="js-example-basic-single" name="state" id="cbm_estatus" style="width:100%;">
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="CANCELADA">CANCELADA</option>
                        </select> <br> <br> 
                    </div>
                    
                    <div class="col-lg-12">
                         <label for="">Descripción de la cita</label>
                        <textarea  id="txt_descripcion_editar"  rows="7" class="form-control" style="resize:none">

                        </textarea>

                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Editar_Cita()"><i
                        class="fa fa-check"><b>&nbsp;Editar</b></i> </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"
                        aria-hidden="true"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
    </div>
</div>

<!-- formulario para editar datos -->







<script>
$(document).ready(function() {
    listar_cita();
    listar_paciente_combo() ;
    listar_especialidad_combo();
    listar_paciente_combo_editar();
    listar_especialidad_combo_editar();

$( "#cbm_especialidad" ).change(function(){
    var iddoctor1=$("#cbm_especialidad").val();
    listar_doctor_combo(iddoctor1);
});
$( "#cbm_especialidad_editar" ).change(function(){
    var iddoctor=$("#cbm_especialidad_editar").val();
    listar_doctor_combo_editar(iddoctor);
});
    $('.js-example-basic-single').select2();
    $("#modal_registro").on('shown.bs.modal', function() {
        $("#txt_especialidad").focus();
    })

});
</script>