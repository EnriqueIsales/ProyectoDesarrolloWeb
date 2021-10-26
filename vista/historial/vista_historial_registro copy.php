<script type="text/javascript" src="../js/historial.js?rev=<?php echo time(); ?>"></script>


<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Mantenimiento de registro de Historial Clinico</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- Condenido -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    <label for="">Codigo Historial</label>
                    <input type="text" class="form-control" id="txt_codhistorial" disabled>
                </div>
                <div class="col-lg-8">
                    <label for="">Paciente</label>
                    <input type="text" class="form-control" id="txt_paciente" disabled>
                </div>
                <div class="col-lg-2">
                    <label for="">&nbsp;</label><br>

                    <button class="btn btn-success" onclick="AbrirModalConsulta()"> <i
                            class="fa fa-search">&nbsp;</i>Buscar Consulta</button>
                </div>

                <div class="col-lg-6">
                    <label for="">Descripcion de la Consulta</label><br>
                    <textarea name="" id="txt_desconsulta" cols="30" rows="3" disabled class="form-control"></textarea>
                </div>

                <div class="col-lg-6">
                    <label for="">Diagnostico de la Consulta</label><br>
                    <textarea name="" id="txt_diagconsulta" cols="30" rows="3" disabled class="form-control"></textarea>
                </div>
                <input type="text" id="txt_idconsulta" hidden> <br>


                <div class="col-12"> <br><br>
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
                                   <div class="row">
                                            <div class="col-lg-10">
                                            <label for=""> Seleccionar Procedimientos</label>
                                            <select class="js-example-basic-single" name="state" id="cbm_procedimiento" style="width:100%;">
                                            
                                            </select>
                                            </div>

                                            <div class="col-lg-2">
                                                <label for="">&nbsp;</label><br>
                                                <button class="btn btn-primary" style="width:100%;" onclick="Agregar_procedimiento()"><i class="fa fa-plus-square"></i>&nbsp;Agregar</button>

                                            </div>
                                        <div class=" col-lg-12 table-responsive"><br>
                                            <table id="tabla_procedimiento" style="width:100%;"  class="table">
                                                    <thead class="thead-dark">
                                                        <th>ID</th>
                                                        <th>PROCEDIMIENTO</th>
                                                        <th>ACCION</th>
                                                    </thead>
                                                    <tbody id="tbody_tabla_procedimiento">

                                                    </tbody>
                                                
                                            </table>


                                        </div>





                                   </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                            <div class="col-lg-6">
                                            <label for="">Seleccionar Insumos</label>
                                            <select class="js-example-basic-single" name="state" id="cbm_insumos" style="width:100%;">
                                            
                                            </select>
                                            </div>

                                            <div class="col-lg-2">
                                            <label for="">Stock Actual</label>
                                            <input type="text" class="form-control" id="stock_insumo" disabled>
                                            </div>
                                            <div class="col-lg-2">
                                            <label for="">Cantidad Agregar</label>
                                            <input type="text" class="form-control" id="txt_cantidad_agregar">
                                            </div>

                                            <div class="col-lg-2">
                                                <label for="">&nbsp;</label><br>
                                                <button class="btn btn-primary" style="width:100%;"><i class="fa fa-plus-square"></i>&nbsp;Agregar</button>

                                            </div>
                                   </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                <div class="row">
                                            <div class="col-lg-6">
                                            <label for="">Seleccionar Medicamentos</label>
                                            <select class="js-example-basic-single" name="state" id="cbm_medicamento" style="width:100%;">
                                            
                                            </select>
                                            </div>

                                            <div class="col-lg-2">
                                            <label for="">Stock Actual</label>
                                            <input type="text" class="form-control" id="stock_medicamento" disabled>
                                            </div>
                                            <div class="col-lg-2">
                                            <label for="">Cantidad Agregar</label>
                                            <input type="text" class="form-control" id="txt_medicantidad_agregar">
                                            </div>

                                            <div class="col-lg-2">
                                                <label for="">&nbsp;</label><br>
                                                <button class="btn btn-primary" style="width:100%;"><i class="fa fa-plus-square"></i>&nbsp;Agregar</button>

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
                <!-- /.col -->



            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


<!-- formulario para registar datos -->
<div class="modal lg" id="modal_consultas" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;"> <b> Listado de Consultas Medicas</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>


            <div class="modal-body">
                
                    <table class="col-lg-12 table-responsive">
                        <table id="tabla_consulta_historial" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Cod Historial</th>
                                    <th>Paciente</th>
                                    <th>Accion</th>

                                </tr>
                            </thead>

                        </table>
                    </table>
               
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- /formulario para registar datos -->

<!-- formulario para editar datos -->







<script>
$(document).ready(function() {
    
    $('.js-example-basic-single').select2();
    listar_insumo();
    listar_procedimiento();
    listar_medicamento();


});
</script>