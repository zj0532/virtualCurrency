$(function() {

  $(document).on("click", "#btn_xiugaimima", function() {
    //传参数
    if($("#ipt_xgmm_xinmima_2").attr("value") != $("#ipt_xgmm_xinmima_1").attr("value")){
      alert("两次新密码不一致");
      return 0;
    }
    $.post("/user/xiugaimima", {
      jiumima: $("#ipt_xgmm_jiumima").attr("value"),
      xinmima: $("#ipt_xgmm_xinmima_2").attr("value")
    }, function(data, status) {
      switch (data.status) {
        case 200:
          alert(data.message);
          break;
        case 201:
          alert(data.message);
          window.location.replace("/user/login");
          break;
        case 202:
          alert(data.message); 
          break;
        default:
          alert(data.message);
      }
    });
  });


});
