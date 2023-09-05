(function(){

  // INITIALISATION DES VARIABLES

  var inputs = $(".fut--data");
  var select = $(".select--new");
  var prixTotal = $(".total__number");
  var updatedPrice = 0;
  var prixInput = $("#commandetotal");
  var formToShow = $(".form--new-event");
  var formToHide = $(".form--know-event");

  // FONCTION D'INITIALISATION
  function setup(){
    updatePrice();
    refreshPrice();
    newEventDetection();
    checkPrice();
  }

  function checkPrice(){
    if(prixTotal.text() != 0){
      prixInput.val(prixTotal.text());
    }
  }

  function updatePrice(){
    inputs.on("input", function(){
      updatedPrice = 0;
      for(var i = 0; i < inputs.length; i++){
        var futs = inputs[i].value;
        var prix = $(inputs[i]).closest('div').find('.prix__prix').text();

        var totalPrice = futs*prix;
        updatedPrice += totalPrice;
      }

      updatedPrice = Math.round(updatedPrice*100)/100;
      prixTotal.text(updatedPrice);
      prixInput.val(updatedPrice);
    });


  }

  function refreshPrice(){
    updatedPrice = 0;
    for(var i = 0; i < inputs.length; i++){
      var futs = inputs[i].value;
      var prix = $(inputs[i]).closest('div').find('.prix__prix').text();

      var totalPrice = futs*prix;
      updatedPrice += totalPrice;
    }

    updatedPrice = Math.round(updatedPrice*100)/100;
    prixTotal.text(updatedPrice);
  }

  function newEventDetection(){
    select.on("change", function(){

      console.log(select.val());
      if(select.val() == "new"){
        formToShow.addClass("show");
        formToHide.addClass("hide");
      }else{
        formToShow.removeClass("show");
        formToHide.removeClass("hide");
      }
    });
  }

  setup();

})();
