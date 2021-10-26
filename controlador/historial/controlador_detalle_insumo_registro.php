<?php 

   require '../../modelo/modelo_historial.php';
   $MH = new Modelo_Historial();
   $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
   $idinsumo = htmlspecialchars($_POST['idinsumo'],ENT_QUOTES,'UTF-8');
   $cantidad = htmlspecialchars($_POST['cantidad'],ENT_QUOTES,'UTF-8');

   $arreglo_insumo = explode(",",$idinsumo);//separo datos
   $arreglo_cantidad = explode(",",$cantidad);//separo datos

   for($i=0; $i<count($arreglo_insumo);$i++){ 
    $consulta =$MH->Registrar_Detalle_Insumo($id,$arreglo_insumo[$i],$arreglo_cantidad[$i] );
   }
  
   echo $consulta;
?>