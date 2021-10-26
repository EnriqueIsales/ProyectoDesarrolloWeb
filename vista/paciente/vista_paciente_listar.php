<script type="text/javascript" src="../js/paciente.js?rev=<?php echo time(); ?>"></script>


<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Mantenimiento de Pacientes</h3>

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


            <table id="tabla_paciente" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Documento</th>
                        <th>Paciente</th>
                        <th>Dirección</th>
                        <th>Sexo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Celular</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>No. Documento</th>
                        <th>Paciente</th>
                        <th>Dirección</th>
                        <th>Sexo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Celular</th>
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

<!-- registro-->

<div class="modal fade" id="modal_registro" role="dialog">
    <div class="modal-dialog modal-12">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" style="text-align: center;"> <b> Registro de Paciente</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">No. de documento</label>
                        <input type="text" class="form-control" id="txt_ndoc" placeholder="Ingrese documento"
                            onkeypress="return soloNumeros(event)">
                        <br>
                    </div>

                    <div class="col-lg-6">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" id="txt_nombres" placeholder="Ingrese Nombre">
                        <br>
                    </div>

                    <div class="col-lg-6">
                        <label for="">Primer Apellido</label>
                        <input type="text" class="form-control" id="txt_apepat" placeholder="Ingrese Primer Apellido"
                            maxlength="50" onkeypress="return soloLetras(event)">
                        <br>

                    </div>
                    <div class="col-lg-6">
                        <label for="">Segundo Apellido</label>
                        <input type="text" class="form-control" id="txt_apemat" placeholder="Ingrese Segundo apellido"
                            maxlength="50" onkeypress="return soloLetras(event)">
                        <br>
                    </div>

                    <div class="col-lg-12">
                        <label for="">Dirección</label>
                        <input type="text" class="form-control" id="txt_direccion" placeholder="Ingrese Dirección">
                        <br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Movil</label>
                        <input type="text" class="form-control" id="txt_movil" placeholder="Ingrese el numero"
                            onkeypress="return soloNumeros(event)">
                        <br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Sexo</label>
                        <select class="js-example-basic-single" name="state" id="cbm_sexo" style="width:100%;">
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select> <br> <br>
                    </div>

                    <div class="col-lg-8">
                        <label for="">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="txt_fecnac">
                        <br>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Registrar_Paciente()"><i
                        class="fa fa-check"><b>&nbsp;Registrar</b></i> </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"
                        aria-hidden="true"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
    </div>
</div>

<!-- /registro-->

<!-- editar-->
<div class="modal fade" id="modal_editar" role="dialog">
    <div class="modal-dialog modal-12">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" style="text-align: center;"> <b> Modificar  Paciente</b></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <input type="text" id="txt_idpaciente" hidden>
                    <div class="col-lg-6">
                        <label for="">No. de documento</label>
                        <input type="text" id="txt_ndoc_actual_editar" hidden
                            onkeypress="return soloNumeros(event)">
                            <input type="text" class="form-control" id="txt_ndoc_nuevo_editar" placeholder="Ingrese documento"
                            onkeypress="return soloNumeros(event)">
                        <br>
                    </div>

                    <div class="col-lg-6">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" id="txt_nombres_editar" placeholder="Ingrese Nombre">
                        <br>
                    </div>

                    <div class="col-lg-6">
                        <label for="">Primer Apellido</label>
                        <input type="text" class="form-control" id="txt_apepat_editar" placeholder="Ingrese Primer Apellido"
                            maxlength="50" onkeypress="return soloLetras(event)">
                        <br>

                    </div>
                    <div class="col-lg-6">
                        <label for="">Segundo Apellido</label>
                        <input type="text" class="form-control" id="txt_apemat_editar" placeholder="Ingrese Segundo apellido"
                            maxlength="50" onkeypress="return soloLetras(event)">
                        <br>
                    </div>

                    <div class="col-lg-12">
                        <label for="">Dirección</label>
                        <input type="text" class="form-control" id="txt_direccion_editar" placeholder="Ingrese Dirección">
                        <br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Movil</label>
                        <input type="text" class="form-control" id="txt_movil_editar" placeholder="Ingrese el numero"
                            onkeypress="return soloNumeros(event)">
                        <br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Sexo</label>
                        <select class="js-example-basic-single" name="state" id="cbm_sexo_editars" style="width:100%;">
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select> <br> <br>
                    </div>

                    <div class="col-lg-6">
                        <label for="">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="txt_fecnac_editar">
                        <br>
                    </div>
                    <div class="col-lg-6">
                        <label for="">Estatus</label>
                        <select class="js-example-basic-single" name="state" id="cbm_estatus" style="width:100%;">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                        </select> <br> <br>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="Modificar_Paciente()"><i
                        class="fa fa-check"><b>&nbsp;Actualizar</b></i> </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"
                        aria-hidden="true"><b>&nbsp;Cerrar</b></i></button>
            </div>
        </div>
    </div>
</div>

<!-- /.editar-->







<script>
$(document).ready(function() {
    listar_paciente();
    $('.js-example-basic-single').select2();
    $("#modal_registro").on('shown.bs.modal', function() {
        $("#txt_ndoc").focus();
    })

});
</script>