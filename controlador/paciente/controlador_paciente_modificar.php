<?php 

    require '../../modelo/modelo_paciente.php';

    $MP = new Modelo_Paciente();//instanciamos
    $idpaciente = htmlspecialchars($_POST['idpaciente'],ENT_QUOTES,'UTF-8');
    $nombres = htmlspecialchars($_POST['nombres'],ENT_QUOTES,'UTF-8');
    $apepat= htmlspecialchars($_POST['apepat'],ENT_QUOTES,'UTF-8');
    $apemat= htmlspecialchars($_POST['apemat'],ENT_QUOTES,'UTF-8');
    $direccion= htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
    $movil= htmlspecialchars($_POST['movil'],ENT_QUOTES,'UTF-8');
    $sexo= htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8');
    $fenac= htmlspecialchars($_POST['fenac'],ENT_QUOTES,'UTF-8');
    $nrodocumentoactual = htmlspecialchars($_POST['nrodocumentoactual'],ENT_QUOTES,'UTF-8');
    $nrodocumentonuevo = htmlspecialchars($_POST['nrodocumentonuevo'],ENT_QUOTES,'UTF-8');
    $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');


    $consulta =$MP->Modificar_Paciente($idpaciente,$nombres,$apepat,$apemat,$direccion,$movil,$sexo,$fenac,$nrodocumentoactual,$nrodocumentonuevo,$estatus);
    echo $consulta;

?>