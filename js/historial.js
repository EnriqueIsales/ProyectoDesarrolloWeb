

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
            { "defaultContent": "<button style='font-size:13px;' type='button' class='verdetalle btn btn-default' title='detalles'><i class='fa fa-eye'></i> </button>" },
            { "data": "fua_id",
            render: function (data, type, row) {
               return "<button style='font-size:13px;' type='button' class='pdf btn btn-danger' title='pdf'><i class='fa fa-print'></i> </button>"
             }
        }
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





$('#tabla_historial').on('click','.diagnostico',function(){
    var data = tablehistorial.row($(this).parents('tr')).data();// detecta en que fila hago click y me captura los datos en la variable data
    if(tablehistorial.row(this).child.isShown()){// hace lo mismo en tamaño pequeño
        var data = tablehistorial.row(this).data();
    }
    
    $("#modal_diagnostico").modal({ backdrop: 'static', keyboard: false })
    $("#modal_diagnostico").modal('show');
    $("#txt_diagnostico_fua").val(data.consulta_diagnostico);  
})

/////////-----------------------------------
$('#tabla_historial').on('click','.pdf',function(){
    var data = tablehistorial.row($(this).parents('tr')).data();// detecta en que fila hago click y me captura los datos en la variable data
    if(tablehistorial.row(this).child.isShown()){// hace lo mismo en tamaño pequeño
        var data = tablehistorial.row(this).data();
    }

    window.open("../vista/libreporte/reportes/generar_fua.php?id="+parseInt(data.fua_id)+"#zoom=100%",
    "Ticket","scrollbars=NO"); 
})



$('#tabla_historial').on('click','.verdetalle',function(){
    var data = tablehistorial.row($(this).parents('tr')).data();// detecta en que fila hago click y me captura los datos en la variable data
    if(tablehistorial.row(this).child.isShown()){// hace lo mismo en tamaño pequeño
        var data = tablehistorial.row(this).data();
    }
    
    $("#modal_detalle").modal({ backdrop: 'static', keyboard: false })
    $("#modal_detalle").modal('show');
    listar_procedimiento_detalle(data.fua_id); 
    listar_insumo_detalle(data.fua_id);
    listar_medicamento_detalle(data.fua_id);
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
            var id = $("#cbm_insumos").val();

            traerStockIsumo(id);
           


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
            var id =$("#cbm_medicamento").val();
            traerStockMedicamento(id);
        } else {
            cadena += "<option value='' >No Se encontraron Registros</option>";
            $("#cbm_medicamento").html(cadena);
         }
    })
}


function Agregar_procedimiento (){
    var idprocedimiento= $("#cbm_procedimiento").val();
    var procedimiento = $("#cbm_procedimiento option:selected").text();
    if(idprocedimiento==""){
        return Swal.fire("Mensaje de Advertiencia","No hay procedimientos disponibles","warning");

    }


     if(verificaridd(idprocedimiento)){
        
        return Swal.fire("Mensaje de Advertiencia","El procedimiento ya fue agregado a la tabla","warning");
    }


    var datos_agregar = "<tr>";
    datos_agregar+="<td for='id'>"+idprocedimiento+" </td>";
    datos_agregar+="<td >"+procedimiento+" </td>";
    datos_agregar+="<td> <button class='btn btn-danger' onclick='remove(this)' ><i class='fa fa-trash' aria-hidden='true'></i></button> </td>";
    datos_agregar+="</tr>";
    $("#tbody_tabla_procedimiento").append(datos_agregar);

}

function verificaridd(id){
    
    let idverificar = document.querySelectorAll('#tabla_procedimiento td[for="id"]');
    return [].filter.call(idverificar, td=> td.textContent === id).length===1;
    
}

function remove(t){
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    

}




function traerStockMedicamento(idmedicamento) {
    $.ajax({
        "url": "../controlador/historial/controlador_traer_stock_medicamento.php",
        type: 'POST',
        data: {
            idmedicamento:idmedicamento

        }
        
    }).done(function (resp) {
        
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            $("#stock_medicamento").val(data[0][1]);
            
           
        } else {
            return Swal.fire("Mensaje de Error","No se pudo traer el stock","error");
         }
    })
}




function traerStockIsumo(idinsumo) {
    $.ajax({
        "url": "../controlador/historial/controlador_traer_stock_insumo.php",
        type: 'POST',
        data: {
            idinsumo:idinsumo

        }
        
    }).done(function (resp) {
              
        var data = JSON.parse(resp);
        var cadena = "";
        if (data.length > 0) {
            $("#stock_insumo").val(data[0][1]);
            
           
        } else {
            return Swal.fire("Mensaje de Error","No se pudo traer el stock","error");
         }
    })
}




////////////////////AGREGAR INSUMOS///////////////////////

function Agregar_Insumo(){
    var idinsumo= $("#cbm_insumos").val();
    var insumo = $("#cbm_insumos option:selected").text();
    var cantidadactual = $("#stock_insumo").val();
    var cantidadingresada = $("#txt_cantidad_agregar").val();

    if(parseInt(cantidadingresada) > parseInt(cantidadactual)){
        return Swal.fire("Mensaje de Advertiencia","No tiene stock suficiente de insumos","warning");

    }



    if(idinsumo==""){
        return Swal.fire("Mensaje de Advertiencia","No hay insumos disponibles","warning");

    }


     if(verificaridinsumo(idinsumo)){
        
        return Swal.fire("Mensaje de Advertiencia","El procedimiento ya fue agregado a la tabla","warning");
    }


    var datos_agregar = "<tr>";
    datos_agregar+="<td for='id'>"+idinsumo+" </td>";
    datos_agregar+="<td >"+insumo+" </td>";
    datos_agregar+="<td >"+cantidadingresada+" </td>";
    datos_agregar+="<td> <button class='btn btn-danger' onclick='remove(this)' ><i class='fa fa-trash' aria-hidden='true'></i></button> </td>";
    datos_agregar+="</tr>";
    $("#tbody_tabla_insumo").append(datos_agregar);

}

function verificaridinsumo(id){
    
    let idverificar = document.querySelectorAll('#tabla_insumo td[for="id"]');
    return [].filter.call(idverificar, td=> td.textContent === id).length===1;
    
}

function removeinsumo(t){
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    

}



////////////////////AGREGAR MEDICAMENTOS///////////////////////

function Agregar_Medicamentos(){
    var idmedicamento= $("#cbm_medicamento").val();
    var medicamento = $("#cbm_medicamento option:selected").text();
    var cantidadactual = $("#stock_medicamento").val();
    var cantidadingresada = $("#txt_medicantidad_agregar").val();

    if(parseInt(cantidadingresada) > parseInt(cantidadactual)){
        return Swal.fire("Mensaje de Advertiencia","No tiene stock suficiente de medicamento","warning");

    }



    if(idmedicamento==""){
        return Swal.fire("Mensaje de Advertiencia","No hay insumos disponibles","warning");

    }


     if(verificaridmedicamento(idmedicamento)){
        
        return Swal.fire("Mensaje de Advertiencia","El procedimiento ya fue agregado a la tabla","warning");
    }


    var datos_agregar = "<tr>";
    datos_agregar+="<td for='id'>"+idmedicamento+" </td>";
    datos_agregar+="<td >"+medicamento+" </td>";
    datos_agregar+="<td >"+cantidadingresada+" </td>";
    datos_agregar+="<td> <button class='btn btn-danger' onclick='remove(this)' ><i class='fa fa-trash' aria-hidden='true'></i></button> </td>";
    datos_agregar+="</tr>";
    $("#tbody_tabla_medicamento").append(datos_agregar);

}

function verificaridmedicamento(id){
    
    let idverificar = document.querySelectorAll('#tabla_medicamento td[for="id"]');
    return [].filter.call(idverificar, td=> td.textContent === id).length===1;
    
}

function removemedicamento(t){
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    

}


/////////////////////registrar historial //////////////////////////////////

function Registrar_Historial(){
    var idhistorial =$("#txt_codhistorial").val();
    var idconsulta =$("#txt_idconsulta").val();
    if(idhistorial.length==0 ||idconsulta.length==0   ){
        return Swal.fire("Mensaje de Advertencia","No tiene un idhistorial o idConsulta","warning");

    }

    $.ajax({
        "url":"../controlador/historial/controlador_fua_registro.php",
        type: 'POST',
        data:{
            idhistorial:idhistorial,
            idconsulta:idconsulta


        }
    }).done(function(resp){
        if(resp>0){           
            Registrar_detalle_procedimiento(parseInt(resp));
            Registrar_detalle_medicamento(parseInt(resp));
            Registrar_detalle_insumo(parseInt(resp));
            Swal.fire("Mensaje de Confirmacion","Datos Registrados correctamente","success").then((value)=>{
                $("#contenido_principal").load("historial/vista_historial_registro.php");
            });

        }else{
            Swal.fire("Mensaje de Error","Lo sentimos el registro no se pudo completar","error");
        }



    })

}


function Registrar_detalle_procedimiento(id){
    var count=0;
    var arrelgo_idprocedimiento= new Array();
    $("#tabla_procedimiento tbody#tbody_tabla_procedimiento tr").each(function(){
        arrelgo_idprocedimiento.push($(this).find('td').eq(0).text());
     count++;

    })
    var idprocedimiento = arrelgo_idprocedimiento.toString();
    if(count==0){
        return;

    }
    $.ajax({
        "url":"../controlador/historial/controlador_detalle_procedimiento_registro.php",
        type: 'POST',
        data:{
            id:id,
            idprocedimiento:idprocedimiento


        }
    }).done(function(resp){
        console.log(resp);

    })

}


function Registrar_detalle_medicamento(id){
    var count=0;
    var arrelgo_idmedicamento= new Array();
    var arrelgo_cantidad= new Array();
    $("#tabla_medicamento tbody#tbody_tabla_medicamento tr").each(function(){
        arrelgo_idmedicamento.push($(this).find('td').eq(0).text());
        arrelgo_cantidad.push($(this).find('td').eq(2).text());
     count++;

    })
    var idmedicamento = arrelgo_idmedicamento.toString();
    var cantidad = arrelgo_cantidad.toString();

    if(count==0){
        return;

    }
    $.ajax({
        "url":"../controlador/historial/controlador_detalle_medicamento_registro.php",
        type: 'POST',
        data:{
            id:id,
            idmedicamento:idmedicamento,
            cantidad:cantidad


        }
    }).done(function(resp){
        console.log(resp);

    })

}

function Registrar_detalle_insumo(id){
    var count=0;
    var arrelgo_idisumo= new Array();
    var arrelgo_cantidad= new Array();
    $("#tabla_insumo tbody#tbody_tabla_insumo tr").each(function(){
        arrelgo_idisumo.push($(this).find('td').eq(0).text());
        arrelgo_cantidad.push($(this).find('td').eq(2).text());
     count++;

    })
    var idinsumo = arrelgo_idisumo.toString();
    var cantidad = arrelgo_cantidad.toString();

    if(count==0){
        return;

    }
    $.ajax({
        "url":"../controlador/historial/controlador_detalle_insumo_registro.php",
        type: 'POST',
        data:{
            id:id,
            idinsumo:idinsumo,
            cantidad:cantidad


        }
    }).done(function(resp){
        console.log(resp);

    })

}

///////////////////////////////////////////////

//variable global
var tableprocedimiento;


function listar_procedimiento_detalle(idfua) {
    tableprocedimiento = $("#tabla_procedimiento").DataTable({
        "ordering": false,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/historial/controlador_detalleprecedimiento_listar.php",
            type: 'POST',
            data:{
                id:idfua
            }
        },
        "order":[[1,'asc']],
        "columns": [
            { "defaultContent": "" },
            { "data": "procedimiento_nombre" },
         
        ],

        "language": idioma_espanol,
        select: true
    });


    tableprocedimiento.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_procedimiento').DataTable().page.info();
        tableprocedimiento.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

}

////--------------------------------////


//variable global
var tableinsumo;


function listar_insumo_detalle(idfua) {
    tableinsumo = $("#tabla_insumo").DataTable({
        "ordering": false,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/historial/controlador_detalleinsumo_listar.php",
            type: 'POST',
            data:{
                id:idfua
            }
        },
        "order":[[1,'asc']],
        "columns": [
            { "defaultContent": "" },
            { "data": "insumo_nombre" },
            { "data": "detain_cantidad" }
         
        ],

        "language": idioma_espanol,
        select: true
    });


    tableinsumo.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_insumo').DataTable().page.info();
        tableinsumo.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

}




//variable global
var tablemedicamento;


function listar_medicamento_detalle(idfua) {
    tablemedicamento = $("#tabla_medicamento").DataTable({
        "ordering": false,
        "paging": true,
        "searching": { "regex": true },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controlador/historial/controlador_detalleMedicamento_listar.php",
            type: 'POST',
            data:{
                id:idfua
            }
        },
        "order":[[1,'asc']],
        "columns": [
            { "defaultContent": "" },
            { "data": "medicamento_nombre" },
            { "data": "datame_cantidad" }
         
        ],

        "language": idioma_espanol,
        select: true
    });


    tablemedicamento.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_medicamento').DataTable().page.info();
        tablemedicamento.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

}