<script type="text/javascript" src="../js/historial.js?rev=<?php echo time(); ?>"></script>


<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Mantenimiento de Historial Clinico</h3>

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

                    <button class="btn btn-success" style="width:100%" onclick="listar_historial()"> <i
                            class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                <div class="col-lg-2">
                    <label for="">&nbsp;</label> <br>

                    <button class="btn btn-danger" style="width:100%"
                        onclick="cargar_contenido('contenido_principal','historial/vista_historial_registro.php')"> <i
                            class="fa fa-plus" aria-hidden="true"></i> Nuevo Registro</button>
                </div>

            </div>
            <table class="col-lg-12 table-responsive">
                <table id="tabla_historial" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>No. Documento</th>
                            <th>Paciente</th>
                            <th>Diagnostico</th>
                            <th>Detalles</th>
                            <th>Generar PDF</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>No. Documento</th>
                            <th>Paciente</th>
                            <th>Diagnostico</th>
                            <th>Detalles</th>
                            <th>Generar PDF</th>

                        </tr>
                    </tfoot>
                </table>
            </table>





        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


<!-- formulario para registar datos 
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
-->
<!-- /formulario para registar datos -->
<div class="modal lg" id="modal_detalle" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;"> <b> Detalle</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>
            <div class="modal-body">


                <div class="col-lg-12"> 
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1"
                                        data-toggle="tab">Procedimiento</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Insumo</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#tab_3"
                                        data-toggle="tab">Medicamentos</a></li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">

                                    <table class="col-lg-12 table-responsive">
                                        <table id="tabla_procedimiento" class="display responsive nowrap"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </table>


                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">

                                        <table class="col-lg-12 table-responsive">
                                            <table id="tabla_insumo" class="display responsive nowrap"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Insumo</th>
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Insumo</th>
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </table>


                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    <div class="row">

                                        <table class="col-lg-12 table-responsive">
                                            <table id="tabla_medicamento" class="display responsive nowrap"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Medicamento</th>
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Medicamento</th>
                                                        <th>Cantidad</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </table>


                                    </div>

                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- ./card -->
            </div>

        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>
</div>
<!-- formulario para editar datos -->

<!-- mostrar diagnostico -->
<div class="modal lg" id="modal_diagnostico" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;"> <b> Diagnostico</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <textarea class="form-control" id="txt_diagnostico_fua" rows="3" disabled></textarea>
                    </div>



                </div>

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- //mostrar diagnostico -->







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

    listar_historial();


    $("#modal_registro").on('shown.bs.modal', function() {
        $("#txt_especialidad").focus();
    })

});
</script>