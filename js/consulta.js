

//variable global
var tableconsulta;


function listar_consulta() {
    var fechainicio = $("#txt_fechainicio").val();
    var fechafin = $("#txt_fechafin").val();
    tableconsulta = $("#tabla_consulta_medica").DataTable({
        "ordering": false,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/consulta/controlador_consulta_listar.php",
            type: 'POST',
            data: {
                    fechainicio:fechainicio,
                    fechafin:fechafin

            }
        },
        "order":[[1,'asc']],
        "columns": [
            { "defaultContent": "" },
            { "data": "paciente_nrodocumento" },
            { "data": "paciente" },
            { "data": "consulta_fereregistro" },
            { "data": "medico" },
            { "data": "especialidad_nombre" },
            { "data": "consulta_estatus",
                render: function (data, type, row) {
                    if (data == 'PENDIENTE') {
                        return "<span class='badge bg-primary' >" + data + "</span>";

                    }else if(data=='CANCELADO'){
                        return "<span class='badge bg-danger' >" + data + "</span>";
                    }else {
                        return "<span class='badge bg-success' >" + data + "</span>";
                    }
                 }
            },
           
            { "defaultContent": "<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='editar'><i class='fa fa-edit'></i> </button>&nbsp;" }
        ],

        "language": idioma_espanol,
        select: true
    });


    tableconsulta.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_consulta_medica').DataTable().page.info();
        tableconsulta.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

}





$('#tabla_consulta_medica').on('click','.editar',function(){
    var data = tableconsulta.row($(this).parents('tr')).data();// detecta en que fila hago click y me captura los datos en la variable data
    if(tableconsulta.row(this).child.isShown()){// hace lo mismo en tamaño pequeño
        var data = tableconsulta.row(this).data();
    }
    
    $("#modal_editar").modal({ backdrop: 'static', keyboard: false })
    $("#modal_editar").modal('show');
    $("#txt_consulta_id").val(data.consulta_id);
    $("#txt_paciente_consulta_editar").val(data.paciente);
    $("#txt_descripcion_consultaeditar").val(data.consulta_descripcion);
    $("#txt_diagnostico_consultaeditar").val(data.consulta_diagnostico);


    
})



function listar_paciente_combo_consulta() {
    $.ajax({
        "url": "../controlador/consulta/controlador_combo_paciente_cita_listar.php",
        type: 'POST'

    }).done(function (resp) {
                
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
               
                    cadena += "<option value='" + data[i][0] + "' > No. Atención" + data[i][1] + " - Paciente: "+data[i][2] + "</option>";" </option>";
                
                
            }
            $("#cbm_paciente_consulta").html(cadena);
           
           

        } else {
            cadena += "<option value='' >No Se encontraron Registros</option>";
            $("#cbm_paciente_consulta").html(cadena);
           
            
        }



    })

}


function Registrar_Consulta(){
    var idpaciente = $('#cbm_paciente_consulta').val();
    var descripcion = $('#txt_descripcion_consulta').val();
    var diagnostico = $('#txt_diagnostico_consulta').val();

    if(idpaciente.length==0 || descripcion.length==0|| diagnostico.length==0  ){
        return Swal.fire("Mensaje de Advertencia","Llene los campos vacios","warning");
    }else{
    $.ajax({
        "url":"../controlador/consulta/controlador_consulta_registro.php",
        type: 'POST',
        data:{
            idpaciente:idpaciente,
            descripcion:descripcion,
            diagnostico:diagnostico

        }
    }).done(function(resp){
        if(resp>0){       
            
            $("#modal_registro").modal('hide');    
            listar_consulta();
            Swal.fire("Mensaje de Confirmacion","Consulta Registrada Correctamente","success");
   
        }else{
            Swal.fire("Mensaje de Error","Lo sentimos el registro no se pudo completar","error");
        }



    })
}
}




function Editar_Consulta(){

    var idconsulta = $('#txt_consulta_id').val();
    var descripcion = $('#txt_descripcion_consultaeditar').val();
    var diagnostico = $('#txt_diagnostico_consultaeditar').val();

    if(idconsulta.length==0 || descripcion.length==0|| diagnostico.length==0  ){
        return Swal.fire("Mensaje de Advertencia","Llene los campos vacios","warning");
    }else{
    $.ajax({
        "url":"../controlador/consulta/controlador_consulta_modificar.php",
        type: 'POST',
        data:{
            idconsulta:idconsulta,
            descripcion:descripcion,
            diagnostico:diagnostico

        }
    }).done(function(resp){
        
        if(resp>0){       
            
            $("#modal_editar").modal('hide');    
            listar_consulta();
            Swal.fire("Mensaje de Confirmacion","Datos Actualizados","success");
   
        }else{
            Swal.fire("Mensaje de Error","Lo sentimos el registro no se pudo completar","error");
        }



    })
}
}