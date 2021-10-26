<?php
session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location: ../../../vista/login.php');
}


?>

<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../../../conexion_reportes/r_conexion.php';

$consulta = "SELECT
fua.fua_id, 
consulta.consulta_descripcion, 
consulta.consulta_diagnostico, 
paciente.paciente_nombre, 
paciente.paciente_apepat, 
paciente.paciente_apemat, 
paciente.paciente_direccion, 
paciente.paciente_movil, 
paciente.paciente_sexo, 
paciente.paciente_nrodocumento, 
especialidad.especialidad_nombre, 
cita.cita_descripcion, 
cita.cita_id, 
medico.medico_nombre, 
medico.medico_apepat, 
medico.medico_apemat
FROM
fua
INNER JOIN
consulta
ON 
    fua.consulta_id = consulta.consulta_id
INNER JOIN
cita
ON 
    consulta.cita_id = cita.cita_id
INNER JOIN
paciente
ON 
    cita.paciente_id = paciente.paciente_id
INNER JOIN
especialidad
ON 
    cita.especialidad_id = especialidad.especialidad_id
INNER JOIN
medico
ON 
    cita.medico_id = medico.medico_id  where fua.fua_id ='".$_GET['id']."'";

$resultado = $mysqli->query($consulta);
while ($row = $resultado->fetch_assoc()) {


$html='  
<html lang="es"> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<div style="text-align:center"><h1>REPORTES DE FORMULARIO</h1></div>

            <div style="float:left; width:160px;">

            <span><b>DPI: </b> '.utf8_encode( $row['paciente_nrodocumento']).'</span> <br>

            </div>

            <div style="float:left; width:400px;">
            <span><b>PACIENTE: </b> '.utf8_encode( $row['paciente_nombre'].' '.$row['paciente_apepat'].' '.$row['paciente_apemat']).'</span><br>
            </div>

            <div style="float:left; width:120px;">
                 <span><b>SEXO: </b> '.utf8_encode( $row['paciente_sexo']).'</span> <br><br>
            </div>

            
            <div style="float:left; width:600px;">
                 <span><b>DIRECCIÓN: </b> '.utf8_encode( $row['paciente_direccion']).'</span> <br><br><br>
            </div>


            <div style=" width:600px; text-align:center">
                        <h2>DATOS DE LA CITA</h2>
             </div>

             <div style="float:left; width:120px;">

             <span><b>No. Cita: </b> '.utf8_encode( $row['cita_id']).'</span> <br><br>
 
             </div>
             <div style="float:left; width:300px;">

             <span><b>Medico: </b> '.utf8_encode( $row['medico_nombre'].' '.$row['medico_apepat'].' '.$row['medico_apemat']).'</span><br>
 
             </div>
             

             <div style="float:left; width:200px;">
             <span><b>Especialidad: </b> '.utf8_encode( $row['especialidad_nombre']).'</span> <br><br>
             </div>


 
             </div>

             <div style="float:left; width:450px;">
             <span><b>Descripción  de la Cita: </b> '.utf8_encode( $row['cita_descripcion']).'</span> <br><br><br>
             </div>


             <div style=" width:600px; text-align:center">
             <h2>DATOS DE LA CONSULTA MEDICA</h2> <br><br>
            </div>


            <div style="float:left; width:800px;">
            <span><b>Descripción de la Cita: </b> '.utf8_encode( $row['consulta_descripcion']).'</span> <br><br>
            </div>



            </div>

            <div style="float:left; width:850px;">
            <span><b>Diagnostico de la Consulta: </b> '.utf8_encode( $row['consulta_diagnostico']).'</span> <br>
            </div>

            </div>

            <div style="width:700px; text-align:center"><br>
            <h2>MEDICAMENTOS</h2>
            
            </div>

            <table style="width:100%; border-collapse:collapse" border="1">
            
            <thead>
            <tr bgcolor="#C0C0C0">
            <th>#</th>
            <th>Medicamento</th>
            <th>Cantidad</th>
            </tr>
            </thead>';
            
            $consultamedicamento = " SELECT
            detalle_medicamento.datame_cantidad, 
            medicamento.medicamento_nombre
        FROM
            detalle_medicamento
            INNER JOIN
            medicamento
            ON 
                detalle_medicamento.medicamento_id = medicamento.medicamento_id
                where detalle_medicamento.fua_id ='".$_GET['id']."'";
            
            $resultadomedicamento = $mysqli->query($consultamedicamento);
            $contadormedicamento=0;
            while ($rowmedicamento = $resultadomedicamento->fetch_assoc()) {
                $contador++;
                $html.=' <tr>
                
                <td style="text-align: center">'.$contador.'</td>
                <td style="text-align: center">'.$rowmedicamento['medicamento_nombre'].'</td>
                <td style="text-align: center">'.$rowmedicamento['datame_cantidad'].'</td>
                
                
              
                
                
                ';
            }
            $html.=' </tr> <tbody>
                    </tbody>
                    </table>

                    <div style="width:700px; text-align:center"><br>
                    <h2>INSUMOS</h2>
                    
                    </div>
        
                    <table style="width:100%; border-collapse:collapse" border="1">
                    
                    <thead>
                    <tr bgcolor="#C0C0C0">
                    <th>#</th>
                    <th>Insumo</th>
                    <th>Cantidad</th>
                    </tr>
                    </thead>

  
';

            
            $consultainsumo= " SELECT
            detalle_insumo.detain_cantidad, 
            insumo.insumo_nombre, 
            detalle_insumo.fua_id
        FROM
            insumo
            INNER JOIN
            detalle_insumo
            ON 
                insumo.insumo_id = detalle_insumo.insumo_id
                where detalle_insumo.fua_id ='".$_GET['id']."'";
            
            $resultadoinsumo = $mysqli->query($consultainsumo);
            $contadorinsumo=0;
            while ($rowinsumo = $resultadoinsumo->fetch_assoc()) {
                $contadorinsumo++;
                $html.=' <tr>
                
                <td style="text-align: center">'.$contadorinsumo.'</td>
                <td style="text-align: center">'.$rowinsumo['insumo_nombre'].'</td>
                <td style="text-align: center">'.$rowinsumo['detain_cantidad'].'</td>
                
                
              
                
                
                ';
            }
            $html.=' </tr> <tbody>
                    </tbody>
                    </table> <div style="width:700px; text-align:center"><br>
                    <h2>PROCEDIMIENTO</h2>
                    
                    </div>
        
                    <table style="width:100%; border-collapse:collapse" border="1">
                    
                    <thead>
                    <tr bgcolor="#C0C0C0">
                        <th>#</th>
                        <th>Procedimiento</th>
                    </tr>
                    </thead>
                
                ';
                $consultainsumo= " SELECT
                procedimiento.procedimiento_nombre, 
                detalle_procedimiento.fua_id
            FROM
                procedimiento
                INNER JOIN
                detalle_procedimiento
                ON 
                    procedimiento.procedimiento_id = detalle_procedimiento.procedimiento_id
                where detalle_procedimiento.fua_id ='".$_GET['id']."'";
            
            $resultadoinsumo = $mysqli->query($consultainsumo);
            $contadorprocedimiento=0;
            while ($rowinsumo = $resultadoinsumo->fetch_assoc()) {
                $contadorprocedimiento++;
                $html.=' <tr>
                
                <td style="text-align: center">'.$contadorprocedimiento.'</td>
                <td style="text-align: center">'.$rowinsumo['procedimiento_nombre'].'</td>
                
                
                                             
                
                ';
            }
            $html.=' </tr> <tbody>
                    </tbody>
                    </table></html>' ;
                }

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();