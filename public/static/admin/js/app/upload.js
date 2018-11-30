$(function() {
  //绑定图片上传按钮
  $(document).on("change", "#btn_sfz_zm_input", function() {
    //传参数
    fileSelected($(this).attr("id"));
  });

  //绑定图片上传按钮
  $(document).on("change", "#btn_sfz_bm_input", function() {
    //传参数
    fileSelected($(this).attr("id"));
  });

  //绑定图片上传按钮
  $(document).on("change", "#btn_zz_input", function() {
    //传参数
    fileSelected($(this).attr("id"));
  });

  function fileSelected(id_no) {
    let fd = new FormData();
    //文件追到到FormData
    fd.append("userfile", $("#" + id_no)[0].files[0]);
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("load", uploadComplete, false);
    xhr.id_no = id_no;
    xhr.addEventListener("error", function() {
      alert("上传出错");
    }, false);
    xhr.addEventListener("abort", function() {
      alert("上传失败");
    }, false);
    xhr.open("POST", "/admcncp/upload");
    xhr.send(fd);
  }

  function uploadComplete(evt) {
    let json = eval('(' + evt.target.responseText + ')');
    //图片上传完成服务器相应
    if (json.status == 200) {
      switch (this.id_no) {
        case "btn_sfz_zm_input":
          $("#btn_sfz_zm_img").children("img").attr("src", json.data.img);
		  $("#shenhe_shenfenzheng_img1").attr("value",json.data.newFn); 
          $("#btn_sfz_zm_img").show();
          $("#" + this.id_no).parent().hide();
          break;
        case "btn_sfz_bm_input":
          $("#btn_sfz_bm_img").children("img").attr("src", json.data.img);
		  $("#shenhe_shenfenzheng_img2").attr("value",json.data.newFn); 
          $("#btn_sfz_bm_img").show();
          $("#" + this.id_no).parent().hide();
          break;
        case "btn_zz_input":
          $("#btn_zz_img").children("img").attr("src", json.data.img);
		  $("#shenhe_yingyezhizhao_img").attr("value",json.data.newFn); 
          $("#btn_zz_img").show();
          $("#" + this.id_no).parent().hide();
          break;
      }
    } else {
      alert(json.message);
    }
  }

  $(document).on("click", "#re_upload_zm", function() {
    $("#btn_sfz_zm_img").children("img").attr("src", "");
    $("#btn_sfz_zm_img").hide();
    $("#btn_sfz_zm_input").parent().show();
  });

  $(document).on("click", "#re_upload_bm", function() {
    $("#btn_sfz_bm_img").children("img").attr("src", "");
    $("#btn_sfz_bm_img").hide();
    $("#btn_sfz_bm_input").parent().show();
  });

  $(document).on("click", "#re_upload_zz", function() {
    $("#btn_zz_img").children("img").attr("src", "");
    $("#btn_zz_img").hide();
    $("#btn_zz_input").parent().show();
  });
});
