$(document).ready(function(){
  $("#register_en_down_btn").on("click",function(){
    window.location.replace("/en/user/register_2");
  });

  $("#register2_en_down_btn").on("click",function(){
    window.location.replace("/en/user/register_3");
  });

  $("#register3_en_down_btn").on("click",function(){
    let stat = $("#register3_en_select_btn").attr("value");
    if(stat == "ib"){
      window.location.replace("/en/user/register_phone_hq_4");
    }else{
      window.location.replace("/en/user/register_phone_bz_4");
    }
  });

  $("#register4_en_bz_btn").on("click",function(){
    window.location.replace("/en/user/register_bz_5");
  });

  $("#register4_en_hq_btn").on("click",function(){
    window.location.replace("/en/user/register_hq_5");
  });

  $("#register5_en_down_btn").on("click",function(){
    window.location.replace("/en/user/register_6");
  });

  $("#register6_en_down_btn").on("click",function(){
    window.location.replace("/en/user/register_7");
  });
});
