$(function() {
  //$('#reservation').daterangepicker();

  $(document).on("click", "#zijinliushui_jump", function() {
    var zijinliushui_zhuangtai = $("#zijinliushui_select_zhuangtai").attr("value");
    var zijinliushui_hao = $("#zijinliushui_select_hao").attr("value");

    if(zijinliushui_hao == ""){
      zijinliushui_hao = null;
    }
    window.location.replace("/user/zijinliushui/" + $("#zijinliushui_jump_value").attr("value") + "/" + zijinliushui_zhuangtai + "/" + zijinliushui_hao);
  })

  $(document).on("click", "#zijinliushui_select", function() {
    var zijinliushui_zhuangtai = $("#zijinliushui_select_zhuangtai").attr("value");
    var zijinliushui_hao = $("#zijinliushui_select_hao").attr("value");

    if(zijinliushui_hao == ""){
      zijinliushui_hao = null;
    }
    window.location.replace("/user/zijinliushui/1/" + zijinliushui_zhuangtai + "/" + zijinliushui_hao);
  })
});
