<?php 
include "clases/personas.php";
include "clases/Productos.php";
// $_GET['accion'];

if ( !empty( $_FILES ) ) {
    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
    // $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    $uploadPath = "../". DIRECTORY_SEPARATOR . 'fotos' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
    move_uploaded_file( $tempPath, $uploadPath );
    $answer = array( 'answer' => 'Archivo Cargado!' );
    $json = json_encode( $answer );
    echo $json;
}

elseif(isset($_GET['accion']))
{
	$accion=$_GET['accion'];
	if($accion=="traer")
	{
		$respuesta= array();
		//$respuesta['listado']=Persona::TraerPersonasTest();
		$respuesta['listado']=producto::TraerTodasLosProductos();
		//var_dump(Persona::TraerTodasLasPersonas());
		$arrayJson = json_encode($respuesta);
		echo  $arrayJson;
	}


	

}
else{
//var_dump($_REQUEST);


	/*esto es para cuando se configura el headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	POR EJEMPLO 
	$http.post("PHP/nexo.php",{accion :"borrar",persona:persona},{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
 .then(function(respuesta) {       
         //aca se ejetuca si retorno sin errores        
         console.log(respuesta.data);

    },function errorCallback(response) {        
        //aca se ejecuta cuando hay errores
        console.log( response);           
    });
	*/

	// echo "<br> datos pasados por post";
	// var_dump($_POST);





	
	/*
	esto es para cuando se pasan los datos por json
	por ejemplo
	$http.post('PHP/nexo.php', { datos: {accion :"insertar",persona:$scope.persona}})
 	  .then(function(respuesta) {     	
 		     //aca se ejetuca si retorno sin errores      	
      	 console.log(respuesta.data);

    },function errorCallback(response) {     		
     		//aca se ejecuta cuando hay errores
     		console.log( response);     			
 	  });*/

	$DatosPorPost = file_get_contents("php://input");
	$respuesta = json_decode($DatosPorPost);
	var_dump($respuesta);

	switch ($respuesta->datos->accion) {
		case 'borrar':
			echo"Voy a borrar";
			producto::BorrarProducto($respuesta->datos->producto);
			break;
		
		case 'insertar':
			echo"Voy a guardar";
			producto::InsertarProducto($respuesta->datos->producto);
			break;

		case 'modificar':
			echo"Voy a modificar un producto";
			$respuesta= producto::ModificarProducto($respuesta->datos->producto);
			break;

		case 'borrarc':
			echo"Voy a borrar";
			compra::BorrarCompra($respuesta->datos->producto);
			break;
		
		case 'insertar':
			echo"Voy a guardar";
			compra::InsertarCompra($respuesta->datos->compra);
			break;

		case 'modificar':
			echo"Voy a modificar un producto";
			$respuesta= compra::ModificarCompra($respuesta->datos->producto);
			break;

case 'borraru':
			echo"Voy a borrar";
			persona::BorrarPersona($respuesta->datos->persona);
			break;
		
		case 'insertaru':
			echo"Voy a guardar";
			persona::InsertarPersona($respuesta->datos->persona);
			break;

		case 'modificaru':
			echo"Voy a modificar un producto";
			$respuesta= persona::ModificarPersona($respuesta->datos->persona);
			break;

		default:
			# code...
			break;
	}


	//echo $respuesta->datos->persona->nombre;




}



 ?>