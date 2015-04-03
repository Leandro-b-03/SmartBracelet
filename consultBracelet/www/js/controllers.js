app.controller('home', function($scope,$state,$cordovaNfc, $cordovaNfcUtil,$ionicHistory,$ionicPopup,bracelet) {
	$scope.inputs = {cpf: ''};
  //função para validar e redirecionar para pagina de preço.
  	$scope.getComandaByCpf = function (cpf){
  		var labelCPF = document.getElementById('input-cpf');

  		if (TestaCPF(cpf.replace(/[^\d]+/g,''))){
  			labelCPF.classList.remove("has-error");
  			$state.go('total', {param: cpf });
  		} else {
  			labelCPF.classList.add("has-error");
  		}

  	}

    $cordovaNfc.then(function(nfcInstance){

      nfcInstance.addTagDiscoveredListener(function(event){
            var id = JSON.stringify(event.tag.id);
            id = id.replace(/\,\-/g,'');
            id = id.replace(/\-/g,'');
            id = id.replace(/\,/g,'');
            id = id.replace(/\[/g,'');
            id = id.replace(/\]/g,'');
            $state.go('total', {param: id });
      })
      .then(
        //Success callback
        function(event){
            
        },
        //Fail callback
        function(err){
           $ionicPopup.alert({
               title: 'NFC',
               template: 'Por favor ligue o nfc'
             });
        });
   });
});

app.controller('total', function($scope,$state,$ionicHistory,$ionicLoading,$ionicPopup,Total) {
	$ionicHistory.nextViewOptions({
	    disableBack: false
	});
  $scope.data = Total;

  $scope.getComandaCompleta = function (id){
      $state.go('description', {id: id });
  }

  $scope.loadingIndicator = $ionicLoading.show({
      content: 'Loading Data',
      animation: 'fade-in',
      showBackdrop: false,
      width: 400,
      showDelay: 100
  });

  Total.getTotal($state.params.param).success(function(data){
    $ionicLoading.hide();
        if (data.status == 'false'){
            $state.go('home');
            $ionicPopup.alert({
               title: 'Pulseira',
               template: 'Sua comanda não possui nenhum valor'
             });

        } else {
          $scope.data = data;
        }
  })
  .error(function(){
      $ionicLoading.hide();
      $state.go('home');
      $ionicPopup.alert({
       title: 'Consulta',
       template: 'Houve um problema na consulta da comanda, por favor verifique sua internet'
     });
  });
});

app.controller('description', function($scope,$state,$ionicHistory,$ionicLoading,$ionicPopup,Description){

  $scope.loadingIndicator = $ionicLoading.show({
      content: 'Loading Data',
      animation: 'fade-in',
      showBackdrop: false,
      width: 400,
      showDelay: 100
  });

  Description.getDescription($state.params.id).success(function(data){
    $ionicLoading.hide();
        if (!data){
            $state.go('total');
            $ionicPopup.alert({
               title: 'Comanda',
               template: 'Não ha produtos na comanda.'
             });

        } else {
          $scope.produtos = data;
        }
  });
});


//functions 


function TestaCPF(strCPF) {
    var Soma;

    var Resto;

    Soma = 0;

    if (strCPF == "00000000000") return false;

    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);

    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;

    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;

    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);

    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;

    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    
    return true;
}


