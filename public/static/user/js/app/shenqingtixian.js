$(function() {
  //绑定图片上传按钮
  $(document).on("click", "#btn_shenqingtixian", function() {
    //传参数
    $.post("/user/shenqingtixian", {
      tixian_jine: $("#ipt_sqtx_tixian_jine").attr("value")
    }, function(data, status) {
      switch (data.status) {
        case "200":

          window.location.replace("/user/tixianjilu/1/3/null");
          alert(data.message);
          break;
        case "201":
          window.location.replace("/user/login");
          break;
        case "500":
          alert("提现异常");
          break;
        default:
          alert(data.message);
      }
    });
  });



   $("#ipt_sqtx_tixian_jine").bind("input propertychange change",function(event){
     var jine = parseInt($("#ipt_sqtx_tixian_jine").val());
     var shouxufei = parseInt($("#ipt_sqtx_shoukuan_shouxufei").val());

     var zonge = jine + shouxufei;
     $("#ipt_sqtx_tixian_help").text("提现金额"+ jine + "元 提现手续费"+ shouxufei +"元 实际支出金额" + zonge +"元");
   });
});
