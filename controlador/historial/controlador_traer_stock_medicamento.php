<?php 

    require '../../modelo/modelo_historial.php';
     $MH = new Modelo_Historial();

    $idmedicamento = htmlspecialchars($_POST['idmedicamento'],ENT_QUOTES,'UTF-8');
        $consulta =$MH->traerstockMedicamento($idmedicamento);

        echo json_encode($consulta);
?>