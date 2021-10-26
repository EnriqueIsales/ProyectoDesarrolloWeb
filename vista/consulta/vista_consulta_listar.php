<script type="text/javascript" src="../js/consulta.js?rev=<?php echo time(); ?>"></script>


<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Mantenimiento de Consulta Medica</h3>

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
                <div class="col-lg-4">
                    <label for="">Fecha Inicio</label>
                    <input type="date" name="" class="form-control" id="txt_fechainicio">

                </div>
                <div class="col-lg-4">
                    <label for="">Fecha Fin</label>
                    <input type="date" name="" class="form-control" id="txt_fechafin">

                </div>
                <div class="col-lg-2">
                    <label for="">&nbsp;</label> <br>

                    <button class="btn btn-success" style="width:100%" onclick="listar_consulta()"> <i
                            class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                <div class="col-lg-2">
                    <label for="">&nbsp;</label> <br>

                    <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"> <i
                            class="fa fa-plus" aria-hidden="true"></i> Nuevo Registro</button>
                </div>

            </div>
            <table id="tabla_consulta_medica" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Documento</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Doctor</th>
                        <th>Especialista</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>No. Documento</th>
                        <th>Paciente</th>
                        <th>Fecha</th>
                        <th>Doctor</th>
                        <th>Especialista</th>
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
                <h4 class="modal-title" style="text-align: center;"> <b> Registro de Consulta Medica</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>


            <div class="modal-body">

                <div class="col-lg-12">
                    <label for="">Paciente</label>
                    <select class="js-example-basic-single" name="state" id="cbm_paciente_consulta" style="width:100%;">
                    </select> <br> <br>
                </div>


                <div class="col-lg-12">
                    <label for="">Descripción de la cita</label>
                    <textarea id="txt_descripcion_consulta" rows="7" class="form-control" style="resize:none">
                        </textarea>
                </div>
                <div class="col-lg-12">
                    <label for="">Diagnostico</label>
                    <textarea id="txt_diagnostico_consulta" rows="7" class="form-control" style="resize:none">
                        </textarea>
                </div>



            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Registrar_Consulta()"><i
                        class="fa fa-check"><b>&nbsp;Registrar</b></i>
                </button>
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
                <h4 class="modal-title" style="text-align: center;"> <b> Editar Consulta Medica</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>


            <div class="modal-body">

                <div class="col-lg-12">
                    <input type="text" id="txt_consulta_id" hidden>
                    <label for="">Paciente</label>
                    <input type="text" id="txt_paciente_consulta_editar" readonly class="form-control">    
                     <br> <br>
                </div>


                <div class="col-lg-12">
                    <label for="">Descripción de la cita</label>
                    <textarea id="txt_descripcion_consultaeditar" rows="7" class="form-control" style="resize:none">
                        </textarea>
                </div>
                <div class="col-lg-12">
                    <label for="">Diagnostico</label>
                    <textarea id="txt_diagnostico_consultaeditar" rows="7" class="form-control" style="resize:none">
                        </textarea>
                </div>



            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Editar_Consulta()"><i
                        class="fa fa-check"><b>&nbsp;Modificar</b></i>
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"
                        aria-hidden="true"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
    </div>
</div>

<!-- formulario para editar datos -->







<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    var n = new Date();
    var y = n.getFullYear();
    var m = n.getMonth() + 1;
    var d = n.getDate();
    if (d < 10) {
        d = '0' + d;
    }

    if (m < 10) {
        m = '0' + m;
    }

    document.getElementById("txt_fechainicio").value = y + "-" + m + "-" + d;
    document.getElementById("txt_fechafin").value = y + "-" + m + "-" + d;

    listar_consulta();
    listar_paciente_combo_consulta();

    $("#modal_registro").on('shown.bs.modal', function() {
        $("#txt_especialidad").focus();
    })

});
</script>