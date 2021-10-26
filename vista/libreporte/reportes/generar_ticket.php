<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../../../conexion_reportes/r_conexion.php';
$consulta = "SELECT cita.cita_id, cita.cita_nroatencion, cita.cita_feregistro, 
CONCAT_WS(' ',medico.medico_nombre,medico.medico_apepat,medico.medico_apemat) AS medico, 
CONCAT_WS(' ',paciente.paciente_nombre,paciente.paciente_apepat,paciente.paciente_apemat) AS paciente, 
cita.cita_descripcion, 
especialidad.especialidad_nombre
FROM cita INNER JOIN medico ON cita.medico_id = medico.medico_id
INNER JOIN paciente ON     cita.paciente_id = paciente.paciente_id INNER JOIN especialidad 
ON  medico.especialidad_id = especialidad.especialidad_id WHERE cita_id='".$_GET['id']."'";

$html="

<style>
.barcode {
    padding: 1.5mm;
    margin: 0;
    vertical-align: top;
    color: black;
}
.barcodecell {
    text-align: center;
    vertical-align: middle;
}
</style>




<table style='border-collapse: collapse' boder='1'>
<tr>
    <td style='text-align: center; border-bottom:1px; border-left:0px;border-right:0px;border-top:0px;'>                                       
        <h2 style='font-size:18px;'>DATOS DE LA CITA &nbsp;&nbsp;&nbsp;&nbsp;</h2>
    </td>

    <td >                                       
    <img src='../../../assets/img/logo.png' alt='AdminLTE Logo' class='brand-image img-circle elevation-3'
style='opacity: .8'  width='35' height='35'>
    </td>
    


</tr>
</table>
-----------------------------------------------------------   <br>                                    


";

$resultado = $mysqli->query($consulta);
while ($row = $resultado->fetch_assoc()) {
    $html.="<b> Numero de Atención: </b>" .$row['cita_nroatencion'].
    " <br><b>Paciente: </b><br>".$row['paciente'].
    "<br><br><b>Medico:</b><br>".$row['medico'].
    "<br><br><b>Especialidad:</b><br>".$row['especialidad_nombre'].
    "<br><br><b>Descripción:</b><br>".$row['cita_descripcion']."
    <br>............................................. <br>
    <table>
    <tr>
        <td style='text-aling:center'><b>¡Gracias por su preferencia!</b><br></td>
    </tr>
    </table>

        Telefonos: 1111-1111 / 2222-2222<br>
    Direccion: Zacapa, Zacapa <br><br>

    <div class='barcodecell'><barcode code='".$row['cita_id']."' type='I25' class='barcode' /></div>

    ";
}

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [100, 150]]);
$mpdf->WriteHTML($html);
$mpdf->Output();