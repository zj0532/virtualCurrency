$(function() {
  //$('#reservation').daterangepicker();

  $(document).on("click", "#jilu_jump", function() {
    window.location.replace("/user/jilu/" + $("#jilu_jump_value").attr("value"));
  })

});
