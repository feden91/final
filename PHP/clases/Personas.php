<?php
require_once"accesoDatos.php";
class Persona
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
 	public $apellido;
  	public $dni;
  	public $foto;
    public $clave;
    public $correo;
    public $direccion;
    public $localidad;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function GetApellido()
	{
		return $this->apellido;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetDni()
	{
		return $this->dni;
	}
	public function GetClave()
	{
		return $this->clave;
	}
	public function GetCorreo()
	{
		return $this->correo;
	}public function GetDireccion()
	{
		return $this->clave;
	}public function Getlocalidad()
	{
		return $this->clave;
	}
	public function GetFoto()
	{
		return $this->foto;
	}

	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetApellido($valor)
	{
		$this->apellido = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetClave($valor)
	{
		$this->clave = $valor;
	}
	
	public function SetDni($valor)
	{
		$this->dni = $valor;
	}
	public function SetFoto($valor)
	{
		$this->foto = $valor;
	}
	public function SetCorreo($valor)
	{
		$this->correo = $valor;
	}
	public function SetDireccion($valor)
	{
		$this->direccion = $valor;
	}
	public function SetLocalidad($valor)
	{
		$this->localidad = $valor;
	}
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($dni=NULL)
	{
		if($dni != NULL){
			$obj = Persona::TraerUnaPersona($dni);
			
			$this->apellido = $obj->apellido;
			$this->nombre = $obj->nombre;
			$this->clave = $obj->clave;
			$this->dni = $dni;
			$this->correo = $correo;
			$this->direccion = $direccion;
			$this->localidad = $localidad;
			
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->apellido."-".$this->nombre."-".$this->clave."-".$this->dni."-".$this->foto."-".$this->correo."-".$this->direccion."-".$this->localidad;
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function TraerUnaPersona($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from persona where id =:id");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$personaBuscada= $consulta->fetchObject('persona');
		return $personaBuscada;	
					
	}
	public static function CheckearPersona($correo, $clave) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where correo =:correo AND clave =:clave");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindParam(':correo', $correo);
		$consulta->bindParam(':clave', $clave);
		$consulta->execute();
		$result = $consulta->fetchAll();
		//$usuarioBuscado= $consulta->fetchObject('persona');
		//return $usuarioBuscado;	
		
		if ($result) {
			//print("SIIII LA REPUTA!");
			return true;
		}
		else{
			//print("NOOOOO LA REPUTA!");
			return false;
		}
	}

	public static function TraerTodasLasPersonas()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("select * from persona");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasPersonas() ");
		$consulta->execute();			
		$arrPersonas= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	
		return $arrPersonas;
	}
	
	public static function BorrarPersona($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("delete from persona	WHERE id=:id");	
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL BorrarPersona(:id)");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarPersona($persona)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			/*$consulta =$objetoAccesoDato->RetornarConsulta("
				update persona 
				set nombre=:nombre,
				apellido=:apellido,
				foto=:foto
				WHERE id=:id");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();*/ 
			$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE persona SET nombre='$persona->nombre', apellido='$persona->apellido', clave='$persona->clave',  foto='$persona->foto',  correo='$persona->correo',  localidad='$persona->localidad' ,  direccion='$persona->direccion'WHERE id='$persona->id'");
			// $consulta->bindValue(':id',$persona->id, PDO::PARAM_INT);
			// $consulta->bindValue(':nombre',$persona->nombre, PDO::PARAM_STR);
			// $consulta->bindValue(':apellido', $persona->apellido, PDO::PARAM_STR);
			// $consulta->bindValue(':foto', $persona->foto, PDO::PARAM_STR);
			return $consulta->execute();
	}

//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
  public function validarusuario($usuario,$clave)
     {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           // $consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where correo='$usuario' and clave='$clave'");
            $consulta =$objetoAccesoDato->RetornarConsulta("CALL validarpersona(:nombre,:clave)");
            $consulta->bindValue(':nombre',$nombre, PDO::PARAM_INT);
            $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
             $consulta->execute(); 
            $UsuarioBuscado= $consulta->fetchObject('persona');
            return $UsuarioBuscado;

     }
	public static function InsertarPersona($persona)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		//$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into persona (nombre,apellido,dni,foto)values(:nombre,:apellido,:dni,:foto)");
		$consulta =$objetoAccesoDato->RetornarConsulta("CALL InsertarPersona (:nombre,:apellido,:localidad,:direccion,:dni,:correo,:clave,:foto)");
		$consulta->bindValue(':nombre',$persona->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $persona->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':localidad', $persona->localidad, PDO::PARAM_STR);
		$consulta->bindValue(':direccion', $persona->direccion, PDO::PARAM_STR);
		$consulta->bindValue(':dni', $persona->dni, PDO::PARAM_STR);
		$consulta->bindValue(':correo', $persona->correo, PDO::PARAM_STR);
		
		$consulta->bindValue(':clave', $persona->clave, PDO::PARAM_STR);
		
		$consulta->bindValue(':foto', $persona->foto, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	
				
	}	
//--------------------------------------------------------------------------------//



	public static function TraerPersonasTest()
	{
		$arrayDePersonas=array();

		$persona = new stdClass();
		$persona->id = "4";
		$persona->nombre = "rogelio";
		$persona->apellido = "agua";
		$persona->dni = "333333";
		$persona->foto = "333333.jpg";

		//$objetJson = json_encode($persona);
		//echo $objetJson;
		$persona2 = new stdClass();
		$persona2->id = "5";
		$persona2->nombre = "Bañera";
		$persona2->apellido = "giratoria";
		$persona2->dni = "222222";
		$persona2->foto = "222222.jpg";

		$persona3 = new stdClass();
		$persona3->id = "6";
		$persona3->nombre = "Julieta";
		$persona3->apellido = "Roberto";
		$persona3->dni = "888888";
		$persona3->foto = "888888.jpg";

		$arrayDePersonas[]=$persona;
		$arrayDePersonas[]=$persona2;
		$arrayDePersonas[]=$persona3;
		 
		

		return  $arrayDePersonas;
				
	}	


}
