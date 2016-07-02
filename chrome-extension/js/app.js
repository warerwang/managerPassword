/**
 * Created by yadongwang on 16/7/2.
 */
angular.module('chrome', ['LocalStorageModule', 'ng-clipboard'])
  .controller('MainCtrl', function($scope, $http, $rootScope, localStorageService, $timeout){
    if($rootScope.token){
      $rootScope.isGuest = false;
    }else{
      var token = localStorageService.get('password-token');
      if(token){
        $rootScope.isGuest = false;
        $rootScope.token = token;
      }else{
        $rootScope.isGuest = true;
      }
    }
    $scope.keyword = '';
    $scope.accounts = [];
    //$scope.showSuccess = function(message, timer){
    //  $scope.successMessage = message;
    //  if(timer){
    //    $timeout(function(){
    //      $scope.successMessage = '';
    //    }, timer);
    //  }
    //};
    $scope.getPassword = function(encryptPassword){
      var encrypt = new JSEncrypt();
      encrypt.setPrivateKey($scope.priKey);
      if($scope.priKey){
        var password = encrypt.decrypt(encryptPassword);
        return password;
      }else{
        return "请先设置私钥!";
      }
    };
    $scope.search = function(){
      var token = $rootScope.token;
      var url = 'http://password.warphp.com/password?access-token=' + token + '&k=' + $scope.keyword;
      $http.get(url).then(function(res){
        $scope.accounts = res.data;
      },function(data){
        if(data.status == 401){
          $scope.signOut();
        }else{
          console.log(data);
        }
      });
    };
    $scope.search();
    chrome && chrome.storage && chrome.storage.local && chrome.storage.local.get('privateKey', function(data){
      $scope.priKey = data.privateKey;
      $scope.$apply();
    });
    $scope.savePriKey = function(){
      chrome.storage.local.set({'privateKey': $scope.priKey}, function() {});
    };
    $scope.signOut = function(){
      localStorageService.remove('password-token');
      $rootScope.isGuest = true;
      $rootScope.token = null;
    };

    $scope.randomPasswordLength = 12;
    $scope.randomPasswordSpecial = false;
    $scope.generatePassword = function(){
      var text=['abcdefghijklmnopqrstuvwxyz','ABCDEFGHIJKLMNOPQRSTUVWXYZ','1234567890'];
      if($scope.randomPasswordSpecial){
        text.push('~!@#$%^&*()_+";-,./?<>');
      }
      var rand = function(min, max){
        return Math.floor(Math.max(min, Math.random() * (max+1)));
      };
      var len = $scope.randomPasswordLength;
      var pw = '';
      for(var i=0; i<len; ++i)
      {
        var strpos = rand(0, text.length-1);
        pw += text[strpos].charAt(rand(0, text[strpos].length));
      }
      $scope.randomPassword = pw;
    };
    $scope.generatePassword();

    $scope.newAccount = {

    };
    $scope.saveAccount = function(){
      console.log($scope.newAccount);
      var token = $rootScope.token;
      var url = 'http://password.warphp.com/password?access-token=' + token;
      $http.post(url, $scope.newAccount).then(function(res){
        $scope.newAccount = {}
      },function(res){
        $scope.error = res.data.message;
      });

    };

  })
  .controller('LoginCtrl', function($scope, $rootScope, $http, localStorageService){
    $scope.submit = function(){
      console.log($scope.rememberMe);
      var password = $scope.password;
      var email = $scope.email;
      var url = 'http://password.warphp.com/password/token?password=' + password + '&email=' + email;
      $http.get(url).then(function(res){
        if($scope.rememberMe){
          localStorageService.set('password-token', res.data);
        }
        $rootScope.isGuest = false;
        $rootScope.token = res.data;
        //$rootScope.$apply();
      },function(res){
        $scope.error = res.data.message;
      });
    }
  });