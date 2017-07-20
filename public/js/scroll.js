var height = 1;
$(function(){
  if(height == 1) {
    height == 2;
    LoggHidden();
  }
  function LoggHidden() {
    $(window).bind('mousewheel', function(e){
      if(e.originalEvent.wheelDelta /120 > 0) {
        $("#Loggin").addClass('ld');
        setTimeout(function(){
          $("body").addClass('bo');
          $("#Loggin").addClass('ldd');
        }, 300);
      }
      else{
        $("#Loggin").addClass('ld');
        setTimeout(function(){
          $("body").addClass('bo');
          $("#Loggin").addClass('ldd');
        }, 300);
      }
    });
  }
  function LoggShow() {
    $("#Loggin").removeClass('ldd');
    setTimeout(function(){
      $("body").removeClass('bo');
      $("#Loggin").removeClass('ld');
    }, 100);
  }
  $('#is').click( function () {
      height = 1;
      LoggShow();
  });
});
