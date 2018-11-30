$(".form-signin").on("click", "#btn_login", function() {
  $.post("/user/login",{
    yonghuming:$("#ipt_user_id").attr("value"),
    mima:$("#ipt_password").attr("value")
  },function(data,status){
    switch (data.status) {
      case 200:
        alert(data.message);
        window.location.replace("/user/");
        break;
      default:
        alert(data.message);
    }
  });
});

$(document).on("click", "#btn_quit", function() {
  $.post("/user/quit",{
  },function(data,status){
    switch (data.status) {
      case 200:
        alert(data.message);
        window.location.replace("/user/");
        break;
      default:
        alert("退出失败");
    }
  });
});

$(".form-signin").on("click", "#btn_r_register", function() {
  if($("#ipt_r_user_id").attr("value") == ""){
    alert("用户名不能为空");
    return 0;
  }
  if($("#ipt_r_password").attr("value") == ""){
    alert("密码不能为空");
    return 0;
  }
  if($("#ipt_r_password").attr("value") != $("#ipt_r_password_re").attr("value")){
    alert("两次输入密码 不一致");
    return 0;
  }
  $.post("/user/register",{
    yonghuming:$("#ipt_r_user_id").attr("value"),
    mima:$("#ipt_r_password").attr("value")
  },function(data,status){
    switch (data.status) {
      case 200:
        alert(data.message);
        window.location.replace("/user/");
        break;
      default:
        alert(data.message);
    }
  });
});
