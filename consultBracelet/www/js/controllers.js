app.controller('home', function($scope,$state,$cordovaNfc, $cordovaNfcUtil,$ionicPopup,bracelet) {
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

        //Use the plugins interface as you go, in a more "angular" way
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
        if (!data){
            $state.go('home');
            $ionicPopup.alert({
               title: 'Pulseira',
               template: 'Sua comanda não possui nenhum valor'
             });

        } else {
          $scope.data = data;
        }
  });
});

app.controller('description', function($scope,$state,$ionicHistory,$ionicLoading,$ionicPopup,Description){
  $ionicHistory.nextViewOptions({
      disableBack: false
  });

  $scope.data = Description;

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
          $scope.data = data;
        }
  });
});


