<?php 

    require '../../modelo/modelo_historial.php';

    $MH = new Modelo_Historial();//instanciamos

    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');


    $consulta =$MH->listar_detalle_medicamento($id);
    if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
		    "sEcho": 1,
		    "iTotalRecords": "0",
		    "iTotalDisplayRecords": "0",
		    "aaData": []
		}';
    }
?>