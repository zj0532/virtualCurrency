$(function() {
  //$('#reservation').daterangepicker();

  $(document).on("click", "#tixianjilu_jump", function() {
    var tixian_zhuangtai = $("#tixianjilu_select_tixian_zhuangtai").attr("value");
    var tixian_hao = $("#tixianjilu_select_tixian_hao").attr("value");

    if(tixian_hao == ""){
      tixian_hao = null;
    }
    window.location.replace("/user/tixianjilu/" + $("#tixianjilu_jump_value").attr("value") + "/" + tixian_zhuangtai + "/" + tixian_hao);
  })

  $(document).on("click", "#tixianjilu_select", function() {
    var tixian_zhuangtai = $("#tixianjilu_select_tixian_zhuangtai").attr("value");
    var tixian_hao = $("#tixianjilu_select_tixian_hao").attr("value");

    if(tixian_hao == ""){
      tixian_hao = null;
    }
    window.location.replace("/user/tixianjilu/1/" + tixian_zhuangtai + "/" + tixian_hao);
  })
});
