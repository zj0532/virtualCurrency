$(function() {
  //绑定图片上传按钮
  $(document).on("click", "#btn_authen", function() {
    //传参数
    $.post("/user/authen", {
      shanghuming: $("#ipt_shanghuming").attr("value"),
      shenhe_shenfenzheng_hao: $("#ipt_shenhe_shenfenzheng_hao").attr("value"),
      shenhe_shenfenzheng_img1: $("#btn_shenhe_shenfenzheng_img1").children("img").attr("src"),
      shenhe_shenfenzheng_img2: $("#btn_shenhe_shenfenzheng_img2").children("img").attr("src"),
      shenhe_yingyezhizhao_img: $("#btn_shenhe_yingyezhizhao_img").children("img").attr("src"),
      shenhe_shoujihao: $("#ipt_shenhe_shoujihao").attr("value"),
      shoukuan_ren: $("#ipt_shoukuan_ren").attr("value"),
      shoukuan_zhanghu: $("#ipt_shoukuan_zhanghu").attr("value"),
      shoukuan_qudao: $("#ipt_shoukuan_qudao").attr("value"),
      shoukuan_beizhu: $("#ipt_shoukuan_beizhu").attr("value"),
      shanghu_huitiao: $("#ipt_shanghu_huitiao").attr("value"),
      bai_ip: $("#ipt_bai_ip").attr("value"),
    }, function(data, status) {
      switch (data.status) {
        case 200:
          alert(data.message);
          window.location.replace("/user/authen");
          break;
        case 201:
          alert(data.message);
          window.location.replace("/user/login");
          break;
        case 202:
          alert(data.message);
          window.location.replace("/user/authen");
          break;
        case 203:
          alert(data.message);
          window.location.replace("/user/authen");
          break;
        default:
          alert(data.message);
      }
    });
  });


});
