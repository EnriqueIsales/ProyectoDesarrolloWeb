

//variable global
var tablehistorial;


function listar_historial() {
    var fechainicio = $("#txt_fechainicio").val();
    var fechafin = $("#txt_fechafin").val();

    tablehistorial = $("#tabla_historial").DataTable({
        "ordering": false,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/historial/controlador_historial_listar.php",
            type: 'POST',
            data: {
                    fechainicio:fechainicio,
                    fechafin:fechafin

            }
        },
        "order":[[1,'asc']],
        "columns": [
            { "defaultContent": "" },
            { "data": "fua_fregistro" },
            { "data": "paciente_nrodocumento" },
            { "data": "paciente" },
            { "defaultContent": "<button style='font-size:13px;' type='button' class='diagnostico btn btn-default' title='diagnostico'><i class='fa fa-eye'></i> </button>" },
            { "defaultContent": "<button style='font-size:13px;' type='button' class='verdetalle btn btn-default' title='detalles'><i class='fa fa-eye'></i> </button>" }
        ],

        "language": idioma_espanol,
        select: true
    });


    tablehistorial.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_historial').DataTable().page.info();
        tablehistorial.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

}





$('#tabla_historial').on('click','.editar',function(){
    var data = tablehistorial.row($(this).parents('tr')).data();// detecta en que fila hago click y me captura los datos en la variable data
    if(tablehistorial.row(this).child.isShown()){// hace lo mismo en tamaño pequeño
        var data = tablehistorial.row(this).data();
    }
    
    $("#modal_editar").modal({ backdrop: 'static', keyboard: false })
    $("#modal_editar").modal('show');
    $("#txt_consulta_id").val(data.consulta_id);
    $("#txt_paciente_consulta_editar").val(data.paciente);
    $("#txt_descripcion_consultaeditar").val(data.consulta_descripcion);
    $("#txt_diagnostico_consultaeditar").val(data.consulta_diagnostico);


    
})



//////////////////////////////////// FUNCIONES DEL REGISTRO HISTORIAL////////////////////////////////

function AbrirModalConsulta(){
    $("#modal_consultas").modal({ backdrop: 'static', keyboard: false })
    $("#modal_consultas").modal('show');
    listar_consulta_historial() ;
}




var tableconsultahistorial;


function listar_consulta_historial() {
    tableconsultahistorial = $("#tabla_consulta_historial").DataTable({
        "ordering": false,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/historial/controlador_historial_consultar_listar.php",
            type: 'POST'
        },
        "order":[[1,'asc']],
        "columns": [
            { "defaultContent": "" },
            { "data": "consulta_fereregistro" },
            { "data": "paciente_nrodocumento" },
            { "data": "paciente" },
            { "defaultContent": "<button style='font-size:13px;' type='button' class='enviar btn btn-success' title='enviar'><i class='fa fa-check-square'></i>&nbsp; Enviar </button>" }
           
        ],

        "language": idioma_espanol,
        select: true
    });


    tableconsultahistorial.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_consulta_historial').DataTable().page.info();
        tableconsultahistorial.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

}




$('#tabla_consulta_historial').on('click','.enviar',function(){
    var data = tableconsultahistorial.row($(this).parents('tr')).data();// detecta en que fila hago click y me captura los datos en la variable data
    if(tableconsultahistorial.row(this).child.isShown()){// hace lo mismo en tamaño pequeño
        var data = tableconsultahistorial.row(this).data();
    }

    $("#txt_codhistorial").val(data.historia_id);
    $("#txt_paciente").val(data.paciente);
    $("#txt_desconsulta").val(data.consulta_descripcion);
    $("#txt_diagconsulta").val(data.consulta_diagnostico);
    $("#txt_idconsulta").val(data.consulta_id);

    $("#modal_consultas").modal('hide');

        
})





function listar_insumo() {
    $.ajax({
        "url": "../controlador/historial/controlador_combo_insumo_listar.php",
        type: 'POST'

    }).done(function (resp) {
        
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                    cadena += "<option value='" + data[i][0] + "' >" + data[i][1] + "</option>";         
            }
            $("#cbm_insumos").html(cadena);
        } else {
            cadena += "<option value='' >No Se encontraron Registros</option>";
            $("#cbm_insumos").html(cadena);
         }
    })
}


function listar_procedimiento() {
    $.ajax({
        "url": "../controlador/historial/controlador_combo_procedimiento_listar.php",
        type: 'POST'

    }).done(function (resp) {  
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
               
                    cadena += "<option value='" + data[i][0] + "' >" + data[i][1] + "</option>";
             
            }
            $("#cbm_procedimiento").html(cadena);
        
        } else {
            cadena += "<option value='' >No Se encontraron Registros</option>";
            $("#cbm_procedimiento").html(cadena);
         }
    })
}



function listar_medicamento() {
    $.ajax({
        "url": "../controlador/historial/controlador_combo_medicamento_listar.php",
        type: 'POST'

    }).done(function (resp) {
        
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) { 
                    cadena += "<option value='" + data[i][0] + "' >" + data[i][1] + "</option>";
            }
            $("#cbm_medicamento").html(cadena);
        } else {
            cadena += "<option value='' >No Se encontraron Registros</option>";
            $("#cbm_medicamento").html(cadena);
         }
    })
}


function Agregar_procedimiento(){
    var idprocedimiento= $("#cbm_procedimiento").val();
    var procedimiento = $("#cbm_procedimiento option:selected").text();
    if(idprocedimiento==""){
        return Swal.fire("Mensaje de Advertiencia","No hay procedimientos disponibles","warning");

    }


    if(verificarid(idprocedimiento)){
        alert("estoy aca");
        return Swal.fire("Mensaje de Advertiencia","El procedimiento ya fue agregado a la tabla","warning");
    }


    var datos_agregar = "<tr>";
    datos_agregar+="<td for='id'>"+idprocedimiento+" </td>";
    datos_agregar+="<td >"+procedimiento+" </td>";
    datos_agregar+="<td> <button class='btn btn-danger' onclick='remove(this)' ><i class='fa fa-trash' aria-hidden='true'></i></button> </td>";
    datos_agregar+="</tr>";
    $("#tbody_tabla_procedimiento").append(datos_agregar);

}

function verificarid(id){
    
    let idverificar = document.querySelectorAll('#tabla_procedimiento td[for="id"]');
    
    return [].filter.call(idverificar, td=> td.textContent === id).length===1;
}



