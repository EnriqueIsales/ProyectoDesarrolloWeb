<?php 

   require '../../modelo/modelo_historial.php';
   $MH = new Modelo_Historial();
   $idinsumo = htmlspecialchars($_POST['idinsumo'],ENT_QUOTES,'UTF-8');
   $consulta =$MH->TraerstockInsumo($idinsumo);
   echo json_encode($consulta);
?>