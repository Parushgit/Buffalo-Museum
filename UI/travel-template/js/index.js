var placesApp = angular.module("places", []);
placesApp.controller("galleryController", function($scope) {
  $scope.bigText = 'Cancún'
  $scope.items = [
    { 'name': 'Dinosaur',
    'img': 'https://static.tumblr.com/ac57cca5ffec9ecdd27f52636134b9c4/pg2nbji/QBIog12jv/tumblr_static_tumblr_static_bb3du6uu9x4ww808w488gg0ok_640.jpg',
    'cover': 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Madre_e_hija_disfrutando_de_la_playa_de_Newport%2C_California.JPG/1200px-Madre_e_hija_disfrutando_de_la_playa_de_Newport%2C_California.JPG',},
    { 'name': 'Elephant',
    'img': 'http://2.bp.blogspot.com/-qBQeLAjN098/VKEFUEsBRuI/AAAAAAAAPqA/6-bRjRHoSXk/s1600/bacalar-laguna-01.jpg',
    'cover': 'http://www.azul36.com.mx/wp-content/uploads/2016/04/Hotel-azul-36-hotel-en-bacalar-laguna-de-bacalar.jpg',},
    { 'name': 'Tiger',
    'img': 'http://www.loscabosjournal.com.mx/portals/0/Todo%20Mexico/campeche_1.jpg',
    'cover': 'https://www.visitmexico.com/viajemostodospormexico/assets/uploads/destinos/campeche_destinos-principales_campeche_01.jpg',},
    { 'name': 'Lion',
    'img': 'http://terceravia.mx/wp-content/uploads/2016/04/tumblr_nvnpujBTJd1ut7f7yo1_1280.jpg',
    'cover': 'http://www.visitacapulco.travel/libraries/uploaded/template/acapulco/images/backs/header_2.jpg',},
    { 'name': 'Whale',
    'img': 'https://static.tumblr.com/37966c51b833d9e6854f9d94d88fe26d/byizezi/PTCncbibj/tumblr_static_tumblr_static_6s9uh0po39gkoww0wsw8g0g0g_640.jpg',
    'cover': 'https://www.visitmexico.com/sites/default/files/styles/extralarge/public/field/image/2017/01/tlaxcala_destinos-principales_tlaxcala_04.jpg?itok=jb8XDKoL',},
    { 'name': 'Panda',
    'img': 'https://68.media.tumblr.com/tumblr_m6oamaxRPP1rsbta0o1_1280.jpg',
    'cover': 'http://www.hotelprincipadotijuana.com.mx/Aero/antros/Tijuana.jpg',},
    { 'name': 'Leopard',
    'img': 'http://68.media.tumblr.com/b63090e5c6aa1dfc8d7aa1a12e6ca6cf/tumblr_nxo4rn76iS1sxnchjo1_500.jpg',
    'cover': 'http://www.playasmexico.com.mx/IMG/arton1607.jpg',},
  ];

  $scope.cover = function(name, img)
  {
    $scope.bigText = name
    var el = angular.element('#cover');
    el.attr('style', 'background-image:url("'+img+'");');
    el.addClass('bgChange')
    $('html, body').animate({
      scrollTop: 0
    }, 450);
  }
  
  $scope.addRow = function(){
    $scope.companies.push({'name':$scope.name, 'employees': $scope.employees, 'headoffice':$scope.headoffice });
    $scope.name='';
    $scope.employees='';
    $scope.headoffice='';
  }

  $scope.removeRow = function(name){
    var index = -1;		
    var comArr = eval( $scope.companies );
    for( var i = 0; i < comArr.length; i++ ) {
      if( comArr[i].name === name ) {
        index = i;
        break;
      }
    }
    if( index === -1 ) {
      alert( "Something gone wrong" );
    }
    $scope.companies.splice(index, 1);	
  }
});