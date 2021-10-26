

//variable global
var tablepaciente;


function listar_paciente() {
    tablepaciente = $("#tabla_paciente").DataTable({
        "ordering": false,
        "paging": false,
        "searching": { "regex": true },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/paciente/controlador_paciente_listar.php",
            type: 'POST'
        },
        "order":[[1,'asc']],
        "columns": [
            { "defaultContent": "" },
            { "data": "paciente_nrodocumento" },
            { "data": "paciente" },
            { "data": "paciente_direccion" },
            { "data": "paciente_sexo", 
                render: function (data, type, row) {
                if (data == 'M') {
                    return "MASCULINO";
                }else{
                    return "FEMENINO";
                }
                
            }
        
        
        },
            { "data": "paciente_fenac" },
            { "data": "paciente_movil" },
            { "data": "paciente_estatus",
                render: function (data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='badge bg-success' >" + data + "</span>";
                    }
                    if (data == 'INACTIVO') {
                        return "<span class='badge bg-danger' >" + data + "</span>";
                    }
                }
            },
           
            { "defaultContent": "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i> </button>&nbsp;" }
        ],

        "language": idioma_espanol,
        select: true
    });
    document.getElementById("tabla_paciente_filter").style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

    tablepaciente.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_paciente').DataTable().page.info();
        tablepaciente.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

}



function AbrirModalRegistro(){
    $("#modal_registro").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro").modal('show');
}


$('#tabla_paciente').on('click','.editar',function(){
    var data = tablepaciente.row($(this).parents('tr')).data();// detecta en que fila hago click y me captura los datos en la variable data
    if(tablepaciente.row(this).child.isShown()){// hace lo mismo en tamaño pequeño
        var data = tablepaciente.row(this).data();
    }
    
    $("#modal_editar").modal({ backdrop: 'static', keyboard: false })
    $("#modal_editar").modal('show');
    $("#txt_idpaciente").val(data.paciente_id);
    $("#txt_ndoc_actual_editar").val(data.paciente_nrodocumento);
    $("#txt_ndoc_nuevo_editar").val(data.paciente_nrodocumento);
    $("#txt_nombres_editar").val(data.paciente_nombre);
    $("#txt_apepat_editar").val(data.paciente_apepat);
    $("#txt_apemat_editar").val(data.paciente_apemat);
    $("#txt_direccion_editar").val(data.paciente_direccion);
    $("#txt_movil_editar").val(data.paciente_movil);
    $("#cbm_sexo_editars").val(data.paciente_sexo).trigger("change");
    $("#txt_fecnac_editar").val(data.paciente_fenac);
    $("#cbm_estatus").val(data.paciente_estatus).trigger("change");
    
})









//funcion para busqueda
function filterGlobal() {
    $('#tabla_paciente').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}


function Registrar_Paciente(){
    var nombres = $('#txt_nombres').val();
    var apepat = $('#txt_apepat').val();
    var apemat = $('#txt_apemat').val();
    var direccion = $('#txt_direccion').val();
    var movil = $('#txt_movil').val();
    var sexo = $('#cbm_sexo').val();
    var fenac = $("#txt_fecnac").val();
    var nrodocumento = $("#txt_ndoc").val();
    
    if(nombres.length==0 || apepat.length==0 || apemat.length==0 || direccion.length==0 || 
        movil.length==0 || sexo.length==0|| fenac.length==0  || nrodocumento.length==0 ){
       return Swal.fire("Mensaje de Advertencia","Llene los campos vacios","warning");
    }else{
    $.ajax({
        "url":"../controlador/paciente/controlador_paciente_registro.php",
        type: 'POST',
        data:{
            nombres:nombres,
            apepat :apepat,
            apemat:apemat,
            direccion:direccion,
            movil:movil,
            sexo:sexo, 
            fenac:fenac,
            nrodocumento:nrodocumento

        }
    }).done(function(resp){
        
        if(resp>0){
            
                if(resp==1){
                 $("#modal_registro").modal('hide');
                    listar_paciente();
                    
                 Swal.fire("Mensaje de Confirmacion"," Datos guardados correctamente","success");
                }else{
                    
                 Swal.fire("Mensaje de Advertencia","El paciente ya esta registrado","warning");
                }     

        }else{
            Swal.fire("Mensaje de Error","Lo sentimos el registro no se pudo completar","error");
        }



    })
}
}

function Limpiar_Campos(){
    $("#txt_insumo").val("");
    $("#txt_stock").val("");
}



function Modificar_Paciente(){
    var idpaciente = $('#txt_idpaciente').val();
    var nombres = $('#txt_nombres_editar').val();
    var apepat = $('#txt_apepat_editar').val();
    var apemat = $('#txt_apemat_editar').val();
    var direccion = $('#txt_direccion_editar').val();
    var movil = $('#txt_movil_editar').val();
    var sexo = $('#cbm_sexo_editars').val();
    var fenac = $("#txt_fecnac_editar").val();
    var nrodocumentoactual = $("#txt_ndoc_actual_editar").val();
    var nrodocumentonuevo = $("#txt_ndoc_nuevo_editar").val();
    var estatus = $("#cbm_estatus").val();
    
    if(nombres.length==0 || apepat.length==0 || apemat.length==0 || direccion.length==0 || 
        movil.length==0 || sexo.length==0|| fenac.length==0  || nrodocumentonuevo.length==0 ){
        return Swal.fire("Mensaje de Advertencia","Llene los campos vacios","warning");
    }else{
    $.ajax({
        "url":"../controlador/paciente/controlador_paciente_modificar.php",
        type: 'POST',
        data:{
            idpaciente:idpaciente,
            nombres:nombres,
            apepat :apepat,
            apemat:apemat,
            direccion:direccion,
            movil:movil,
            sexo:sexo, 
            fenac:fenac,
            nrodocumentoactual:nrodocumentoactual,
            nrodocumentonuevo:nrodocumentonuevo,
            estatus:estatus

        }
    }).done(function(resp){
        
        if(resp>0){
            
                if(resp==1){
                 $("#modal_editar").modal('hide');
                    listar_paciente();
                    
                 Swal.fire("Mensaje de Confirmacion"," Datos actualizados correctamente","success");
                }else{
                    
                 Swal.fire("Mensaje de Advertencia","El el numero de documento ya esta registrado","warning");
                }     

        }else{
            Swal.fire("Mensaje de Error","Lo sentimos el registro no se pudo completar","error");
        }



    })
}
}













function Modificar_Insumo(){
    var id = $('#txt_idinsumo').val();
    var insumoactual = $('#txt_insumo_actual_editar').val();
    var insumonuevo = $('#txt_insumo_nuevo_editar').val();
    var stock = $('#txt_stock_editar').val();
    var estatus = $('#cbm_estatus_editar').val();
    if(stock<0){
        Swal.fire("Mensaje de Advertencia","El stock no puede ser negativo","warning");
    }
    if(insumoactual.length==0 || insumonuevo.length==0 ||stock.length==0 || estatus.length==0 ){
        Swal.fire("Mensaje de Advertencia","Llene los campos vacios","warning");
    }
    $.ajax({
        "url":"../controlador/insumo/controlador_insumo_modificar.php",
        type: 'POST',
        data:{
            id:id,
            inac:insumoactual,
            innu:insumonuevo,
            st:stock,
            es:estatus

        }
    }).done(function(resp){
        
        if(resp>0){
            
            if(resp==1){
             $("#modal_editar").modal('hide');
                listar_insumo();
                
             Swal.fire("Mensaje de Confirmacion"," Datos Actualizados correctamente","success");
            }else{
                
             Swal.fire("Mensaje de Advertencia","El insumo ya esta registrado","warning");
            }     

    }else{
        Swal.fire("Mensaje de Error","Lo sentimos el registro no se pudo completar","error");
    }


    })
}