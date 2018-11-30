$(document).ready(function(){
  $("#register_cn_down_btn").on("click",function(){
    window.location.replace("/cn/user/register_2");
  });

  $("#register2_cn_down_btn").on("click",function(){
    window.location.replace("/cn/user/register_3");
  });

  $("#register3_cn_down_btn").on("click",function(){
    let stat = $("#register3_cn_select_btn").attr("value");
    if(stat == "ib"){
      window.location.replace("/cn/user/register_phone_hq_4");
    }else{
      window.location.replace("/cn/user/register_phone_bz_4");
    }
  });

  $("#register4_cn_bz_btn").on("click",function(){
    window.location.replace("/cn/user/register_bz_5");
  });

  $("#register4_cn_hq_btn").on("click",function(){
    window.location.replace("/cn/user/register_hq_5");
  });

  $("#register5_cn_down_btn").on("click",function(){
    window.location.replace("/cn/user/register_6");
  });

  $("#register6_cn_down_btn").on("click",function(){
    window.location.replace("/cn/user/register_7");
  });
});
