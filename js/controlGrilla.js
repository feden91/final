app.controller('controlGrilla', function($scope, $http,factoryProducto,$auth,$filter,$timeout) {
 if($auth.isAuthenticated())
   {  
        $scope.usuarioLogeado=$auth.getPayload();

   }
 
   $scope.$on('$viewContentLoaded',function(){
 



      $scope.myValue = false;
      $timeout(function() {
         $scope.myValue = true;
      }, 2000);
      console.log($scope.myValue);
      
       $scope.myValue2 = true;
      $timeout(function() {
         $scope.myValue2 = false;
      }, 2000);
      console.log($scope.myValue2);
   });
   
   console.log($scope.usuarioLogeado);
   $scope.retornarcant=function(){
    return $http.get('http://bicicleteriaalsina.000webhostapp.com/Datos/comprasXmes/')
    .then(function(respuesta) {       
      
                //$scope.ListadoPersonas = respuesta.data.listado;
                return respuesta.data.listado;
      
               //console.log(respuesta.data);
      
            });};

            console.log($scope.retornarcant());

    factoryProducto.mostrarGrilla("otro").then(function(respuesta){
    $scope.ListadoProductos=respuesta;
  });

  $scope.refreshData = function() {
    $scope.ListadoProductos.data = $filter('filter')($scope.data, $scope.searchText);
  };

$scope.Borrar=function(producto){

    console.log(producto);

    var data = producto.codigo;
    
    $http.post('http://bicicleteriaalsina.000webhostapp.com/Datos/BorrarProducto/'+data)
   .then(function(respuesta) {       
           //aca se ejetuca si retorno sin errores        
           console.log(respuesta.data);
           // $http.get('http://localhost/PersonasFinal/Datos/traerUsuarios/')
           // .then(bien, mal);

             factoryProducto.mostrarGrilla("otro").then(function(respuesta){
              $scope.ListadoProductos=respuesta;
             });

      },function errorCallback(response) {
           $scope.ListadoProductos= [];
          console.log( response);
     });
}
});




app.factory('factoryProducto',function(servicioProducto){

    var producto={
      // nombre:'Leandro',
      // nombreApellido:'Leandro Cannarozzi',
      mostrarGrilla:function(dato){
          this.nombre=dato;
          return servicioProducto.retornarProductos().then(function(respuesta){
                  return respuesta;

          });
          //console.log("Este es mi nombre: "+dato);
      }
  };
    return producto;
});

app.service('servicioProducto',function($http){
var listado;

  this.retornarProductos=function(){
      return $http.get('http://bicicleteriaalsina.000webhostapp.com/Datos/traerProductos/')
        .then(function(respuesta) {       

          //$scope.ListadoPersonas = respuesta.data.listado;
          return respuesta.data.listado;

         //console.log(respuesta.data);

      });

  };


});