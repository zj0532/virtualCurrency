$(function() {
  //$('#reservation').daterangepicker();

  $(document).on("click", "#zhangdan_jump", function() {
    var dd_zt = $("#zhangdan_select_dingdan_zhuangtai").attr("value");
    var time_start = $("#reservation").val();
    var time_end = $("#reservation2").val();
    var sh_dingdanhao = $("#zhangdan_select_sh_dingdanhao").attr("value");

    if(time_start == ""){
      time_start = null;
    }
    if(time_end == ""){
      time_end = null;
    }
    if(sh_dingdanhao == ""){
      sh_dingdanhao = null;
    }
    window.location.replace("/user/zhangdan/" + $("#zhangdan_jump_value").attr("value") + "/" + dd_zt + "/" + time_start + "/" + time_end + "/" + sh_dingdanhao);
  })

  $(document).on("click", "#zhangdan_select", function() {
    var dd_zt = $("#zhangdan_select_dingdan_zhuangtai").attr("value");
    var time_start = $("#reservation").attr("value");
    var time_end = $("#reservation2").attr("value");
    var sh_dingdanhao = $("#zhangdan_select_sh_dingdanhao").attr("value");

    if(time_start == ""){
      time_start = null;
    }
    if(time_end == ""){
      time_end = null;
    }
    if(sh_dingdanhao == ""){
      sh_dingdanhao = null;
    }
    window.location.replace("/user/zhangdan/1/" + dd_zt + "/" + time_start + "/" + time_end + "/" + sh_dingdanhao);
  })
});
