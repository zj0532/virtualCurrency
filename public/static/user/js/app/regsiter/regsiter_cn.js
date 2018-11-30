$(document).ready(function() {
  $("#register_cn_down_btn").on("click", function() {
    $.post("/user/regsiter/1_phone", {
      shoujihao: $("#register_cn_1_shoujihao_ipt").attr("value"),
      yanzhengma: $("#register_cn_1_yanzhengma_ipt").attr("value"),
      mima: $("#register_cn_1_mima_btn").attr("value"),
      yaoqingma: $("#register_cn_1_yaoqingma_btn").attr("value")
    }, function(data, status) {
      switch (data.status) {
        case 200:
          window.location.replace("/cn/user/register_2");
          break;
        default:
          alert(data.message);
      }
    });
  });
  get_sheng();
  get_shi(110000);
  get_diqu(110100);
  get_hangye(0);
  get_guojia();
  $("#register_cn_2_shengfen_slt").on("change", function() {
    get_sf_shi($(this).attr("value"));
  })

  $("#register_cn_2_chengshi_slt").on("change", function() {
    get_sf_diqu($(this).attr("value"));
  })

  $("#register_cn_2_danweidz_slt").on("change", function() {
    get_dwsf_shi($(this).attr("value"));
  })

  $("#register_cn_2_danweichengshi_slt").on("change", function() {
    get_dwsf_diqu($(this).attr("value"));
  })

  $("#register_cn_2_hangyes_slt").on("change", function() {
    get_zhiwei($(this).attr("value"));
  })

  $("#register_cn_2_guojijuzhu_cek").on("change", function() {
    if ($(this).prop("checked")) {
      $("#register_cn_2_fdjzg_info").hide();
    } else {
      $("#register_cn_2_fdjzg_info").show();
    };
  })

  $("#register_cn_2_guojichusheng_cek").on("change", function() {
    if ($(this).prop("checked")) {
      $("#register_cn_2_guojichusheng_info").hide();
    } else {
      $("#register_cn_2_guojichusheng_info").show();
    };
  })

  $("#register_cn_2_guojimeiguo_cek").on("change", function() {
    if ($(this).prop("checked")) {
      $("#register_cn_2_guojimeiguo_info").hide();
    } else {
      $("#register_cn_2_guojimeiguo_info").show();
    };
  })

  $("#register_cn_2_shenfenzm1_chk").on("click", function() {
    $("#register_cn_2_sfzmzz_h3").hide();
    $("#register_cn_2_sfzmzzlx_h3").hide();
    $("#register_cn_2_sfzmzzlx_slt").hide();
    $("#register_cn_2_sfzmzzlx_warning").hide();
    $("#register_cn_2_shenfenzm2_chk").prop("checked", '');

  })
  $("#register_cn_2_shenfenzm2_chk").on("click", function() {
    $("#register_cn_2_sfzmzz_h3").show();
    $("#register_cn_2_sfzmzzlx_h3").show();
    $("#register_cn_2_sfzmzzlx_slt").show();
    $("#register_cn_2_sfzmzzlx_warning").show();
    $("#register_cn_2_shenfenzm1_chk").prop("checked", '');
  })

  $("#register_cn_2_sfzmzzlxs_slt").on("change", function() {

    switch ($(this).attr("value")) {
      case "0":
        $("#register_cn_2_sfzmzzlx_warning").html("使用【房产证】作为地址证明需要在最后一步上传包含您填写的地址【房产证】的文件，无法提供将会影响后续的开户进展和交易功能");
        break;
      case "1":
        $("#register_cn_2_sfzmzzlx_warning").html("使用【银行结单】作为地址证明需要在最后一步上传包含您填写的地址【银行结单】的文件，无法提供将会影响后续的开户进展和交易功能");
        break;
      case "2":
        $("#register_cn_2_sfzmzzlx_warning").html("使用【驾照】作为地址证明需要在最后一步上传包含您填写的地址【驾照】的文件，无法提供将会影响后续的开户进展和交易功能");
        break;
      case "3":
        $("#register_cn_2_sfzmzzlx_warning").html("使用【户口本】作为地址证明需要在最后一步上传包含您填写的地址【户口本】的文件，无法提供将会影响后续的开户进展和交易功能");
        break;
      case "4":
        $("#register_cn_2_sfzmzzlx_warning").html("使用【水电费账单】作为地址证明需要在最后一步上传包含您填写的地址【水电费账单】的文件，无法提供将会影响后续的开户进展和交易功能");
        break;
    }
  })

  $("#register_cn_2_qinshusj1_ipt").on("click", function() {
    $("#register_cn_2_qinshusj_ipt").show();
    $("#register_cn_2_qinshusj2_ipt").prop("checked", '');
  })

  $("#register_cn_2_qianlianr2_ipt").on("click", function() {
    $("#register_cn_2_qianlianr_ipt").hide();
    $("#register_cn_2_qianlianr1_ipt").prop("checked", '');
  })

  $("#register_cn_2_qianlianr1_ipt").on("click", function() {
    $("#register_cn_2_qianlianr_ipt").show();
    $("#register_cn_2_qianlianr2_ipt").prop("checked", '');
  })

  $("#register_cn_2_qinshusj2_ipt").on("click", function() {
    $("#register_cn_2_qinshusj_ipt").hide();
    $("#register_cn_2_qinshusj1_ipt").prop("checked", '');
  })


  $("#register_cn_2_jiuyeqk_slt").on("change", function() {

    switch ($(this).attr("value")) {
      case "0":
          $("#register_cn_2_youshouru_div").show();
          $("#register_cn_2_meishouru_div").hide();
          $("#register_cn_2_jiuyeqk_slt_error").hide();
        break;
      case "1":
          $("#register_cn_2_youshouru_div").show();
          $("#register_cn_2_meishouru_div").hide();
          $("#register_cn_2_jiuyeqk_slt_error").hide();
         break;
      case "2":
          $("#register_cn_2_youshouru_div").show();
          $("#register_cn_2_meishouru_div").hide();
          $("#register_cn_2_jiuyeqk_slt_error").hide();
         break;
      case "3":
          $("#register_cn_2_youshouru_div").hide();
          $("#register_cn_2_meishouru_div").show();
          $("#register_cn_2_jiuyeqk_slt_error").show();
         break;
      case "4":
          $("#register_cn_2_youshouru_div").hide();
          $("#register_cn_2_meishouru_div").show();
          $("#register_cn_2_jiuyeqk_slt_error").show();
         break;
      case "5":
         $("#register_cn_2_youshouru_div").hide();
         $("#register_cn_2_meishouru_div").show();
         $("#register_cn_2_jiuyeqk_slt_error").show();
        break;
      case "6":
         $("#register_cn_2_youshouru_div").hide();
         $("#register_cn_2_meishouru_div").show();
         $("#register_cn_2_jiuyeqk_slt_error").show();
         break;
    }
  })
  $("#register_cn_2_meishouru_add").on("click", function() {
    if($("#register_cn_2_meishouru_count").attr("value") <10){
      $("#register_cn_2_meishouru_add").before('<div class="income-item">\
        <div class="form-group has-error">\
          <select required="" class="form-control" type="select">\
            <option value="d">收入类型</option><option value="0">咨询费</option>\
            <option value="1">残障补助</option><option value="2">遗产继承</option>\
            <option value="3">利息</option><option value="4">房地产</option>\
            <option value="5">租金</option><option value="6">离职金</option>\
            <option value="7">配偶</option><option value="8">交易与投资</option>\
            <option value="9">失业补助</option><option value="10">退休金</option>\
          </select>\
          </div>\
          <div class="form-group percent-control has-error">\
            <input required="" pattern="/^[0-9]+$/" placeholder="收入占比" class="form-control" type="text" name="2.percent" value="">\
            <div class="percent">%</div>\
          </div>\
          <a href="javascript:;" class="remove disabled rg_dle" title="不可删除" style="margin-left: 20px;">删除</a>\
      </div>');
      let no = $("#register_cn_2_meishouru_count").attr("value");
      $("#register_cn_2_meishouru_count").attr("value",parseInt(no)+1);
      if($("#register_cn_2_meishouru_count").attr("value") >1){
        $(".rg_dle").removeClass("disabled");
        $(".rg_dle").css("color","red");
      }
    }
  })

  //就业情况
  $(document).on("click",".rg_dle", function() {
    if($("#register_cn_2_meishouru_count").attr("value") >1){
      $(this).parent().remove();
      let no = $("#register_cn_2_meishouru_count").attr("value");
      $("#register_cn_2_meishouru_count").attr("value",parseInt(no)-1);
    }
    if($("#register_cn_2_meishouru_count").attr("value") == 1){
      $(".rg_dle").css("color","#aaa");
      $(".rg_dle").addClass("disabled");
    }
  })

  //点击继续
  $("#register2_cn_down_btn").on("click", function() {
    if($("#register_cn_2_guojimeiguo_cek ").prop("checked") == false){
      alert("很抱歉，法定的美国居民暂时不能在老虎证券开户，请您谅解！");
      return 0;
    }
    // alert($("#register_cn_2_diqu_slt option:selected").text());
    // return 0;
    $.post("/user/regsiter/2", {
      xingming: $("#register_cn_2_xingming_ipt").attr("value"),
      xing_py: $("#register_cn_2_xing_py_ipt").attr("value"),
      ming_py: $("#register_cn_2_ming_py_ipt").attr("value"),
      guojia: $("#register_cn_2_guojia_slt").attr("value"),
      guojijuzhu: $("#register_cn_2_guojijuzhu_cek").attr("value"),
      fdjzg: $("#register_cn_2_fdjzg_slt").attr("value"),
      guojichusheng: $("#register_cn_2_guojichusheng_cek").attr("value"),
      guojichusheng_slt: $("#register_cn_2_guojichusheng_slt").attr("value"),
      nsjuzhudi: $("#register_cn_2_nsjuzhudi_slt").attr("value"),
      shenfenzhenghao: $("#register_cn_2_shenfenzhenghao_ipt").attr("value"),
      shenfenzm1: $("#register_cn_2_shenfenzm1_chk").attr("value"),
      sfzmzzlxs: $("#register_cn_2_sfzmzzlxs_slt").attr("value"),
      shengfen: $("#register_cn_2_shengfen_slt").attr("value"),
      shengfen_text: $("#register_cn_2_shengfen_slt option:selected").text(),
      chengshi: $("#register_cn_2_chengshi_slt").attr("value"),
      chengshi_text: $("#register_cn_2_chengshi_slt option:selected").text(),
      diqu: $("#register_cn_2_diqu_slt").attr("value"),
      diqu_text: $("#register_cn_2_diqu_slt option:selected").text(),
      xxdizhi: $("#register_cn_2_xxdizhi_ipt").attr("value"),
      jiatinggs: $("#register_cn_2_jiatinggs_slt").attr("value"),
      hunyinzk: $("#register_cn_2_hunyinzk_slt").attr("value"),
      jiuyeqk: $("#register_cn_2_jiuyeqk_slt").attr("value"),

      hangyes: $("#register_cn_2_hangyes_slt").attr("value"),
      zhiweis: $("#register_cn_2_zhiweis_slt").attr("value"),
      danweimc: $("#register_cn_2_danweimc_ipt").attr("value"),
      danweidz: $("#register_cn_2_danweidz_slt").attr("value"),
      danweichengshi: $("#register_cn_2_danweichengshi_slt").attr("value"),
      danweidq: $("#register_cn_2_danweidq_slt").attr("value"),
      danweixx: $("#register_cn_2_danweixx_ipt").attr("value"), 
      hunyinzk: $("#register_cn_2_hunyinzk_slt").attr("value"),
      hunyinzk: $("#register_cn_2_hunyinzk_slt").attr("value"),
      hunyinzk: $("#register_cn_2_hunyinzk_slt").attr("value"),
      hunyinzk: $("#register_cn_2_hunyinzk_slt").attr("value"),
    }, function(data, status) {
      switch (data.status) {
        case 200:
          window.location.replace("/cn/user/register_2");
          break;
        default:
          alert(data.message);
      }
    });
  });

//-----------------------------------------------------
//-----------------------------------------------------
//-----------------------------------------------------
//-----------------------------------------------------
//-----------------------------------------------------
//-----------------------------------------------------
  $("#register3_cn_down_btn").on("click", function() {
    let stat = $("#register3_cn_select_btn").attr("value");
    if (stat == "ib") {
      window.location.replace("/cn/user/register_phone_hq_4");
    } else {
      window.location.replace("/cn/user/register_phone_bz_4");
    }
  });

  $("#register4_cn_bz_btn").on("click", function() {
    window.location.replace("/cn/user/register_bz_5");
  });

  $("#register4_cn_hq_btn").on("click", function() {
    window.location.replace("/cn/user/register_hq_5");
  });

  $("#register5_cn_down_btn").on("click", function() {
    window.location.replace("/cn/user/register_6");
  });

  $("#register6_cn_down_btn").on("click", function() {
    window.location.replace("/cn/user/register_7");
  });

  function get_sheng() {
    $("#register_cn_2_shengfen_slt").empty();
    $("#register_cn_2_danweidz_slt").empty();

    $.post("/user/regsiter/2_get_sheng", {}, function(data, status) {
      if (data.status == 200) {
        for (sheng in data.message) {
          $("#register_cn_2_shengfen_slt").append('<option value="' + data.message[sheng]["reg_id"] + '">' + data.message[sheng]["reg_name"] + '</option>');
          $("#register_cn_2_danweidz_slt").append('<option value="' + data.message[sheng]["reg_id"] + '">' + data.message[sheng]["reg_name"] + '</option>');
        }
      }
    });
  }

  function get_shi($name) {
    $("#register_cn_2_chengshi_slt").empty();
    $("#register_cn_2_danweichengshi_slt").empty();

    $.post("/user/regsiter/2_get_shi", {
      sheng: $name
    }, function(data, status) {
      if (data.status == 200) {
        for (sheng in data.message) {
          $("#register_cn_2_chengshi_slt").append('<option value="' + data.message[sheng]["reg_id"] + '">' + data.message[sheng]["reg_name"] + '</option>');
          $("#register_cn_2_danweichengshi_slt").append('<option value="' + data.message[sheng]["reg_id"] + '">' + data.message[sheng]["reg_name"] + '</option>');
        }
      }
    });
  }

  function get_diqu($name) {
    $("#register_cn_2_diqu_slt").empty();
    $("#register_cn_2_danweidq_slt").empty();

    $.post("/user/regsiter/2_get_diqu", {
      shi: $name
    }, function(data, status) {
      if (data.status == 200) {
        for (shi in data.message) {
          $("#register_cn_2_diqu_slt").append('<option value="' + data.message[shi]["reg_id"] + '">' + data.message[shi]["reg_name"] + '</option>');
          $("#register_cn_2_danweidq_slt").append('<option value="' + data.message[shi]["reg_id"] + '">' + data.message[shi]["reg_name"] + '</option>');
        }
      }
    });
  }

  function get_sf_shi($name) {
    $("#register_cn_2_chengshi_slt").empty();

    $.post("/user/regsiter/2_get_shi", {
      sheng: $name
    }, function(data, status) {
      if (data.status == 200) {
        get_sf_diqu(data.message[0]["reg_id"]);
        for (sheng in data.message) {
          $("#register_cn_2_chengshi_slt").append('<option value="' + data.message[sheng]["reg_id"] + '">' + data.message[sheng]["reg_name"] + '</option>');
        }
      }
    });
  }

  function get_sf_diqu($name) {
    $("#register_cn_2_diqu_slt").empty();

    $.post("/user/regsiter/2_get_diqu", {
      shi: $name
    }, function(data, status) {
      if (data.status == 200) {
        for (shi in data.message) {
          $("#register_cn_2_diqu_slt").append('<option value="' + data.message[shi]["reg_id"] + '">' + data.message[shi]["reg_name"] + '</option>');
        }
      }
    });
  }

  function get_dwsf_shi($name) {
    $("#register_cn_2_danweichengshi_slt").empty();

    $.post("/user/regsiter/2_get_shi", {
      sheng: $name
    }, function(data, status) {
      if (data.status == 200) {
        get_dwsf_diqu(data.message[0]["reg_id"]);
        for (sheng in data.message) {
          $("#register_cn_2_danweichengshi_slt").append('<option value="' + data.message[sheng]["reg_id"] + '">' + data.message[sheng]["reg_name"] + '</option>');
        }
      }
    });
  }

  function get_dwsf_diqu($name) {
    $("#register_cn_2_danweidq_slt").empty();

    $.post("/user/regsiter/2_get_diqu", {
      shi: $name
    }, function(data, status) {
      if (data.status == 200) {
        for (shi in data.message) {
          $("#register_cn_2_danweidq_slt").append('<option value="' + data.message[shi]["reg_id"] + '">' + data.message[shi]["reg_name"] + '</option>');
        }
      }
    });
  }

  function get_hangye($name) {
    $("#register_cn_2_hangyes_slt").empty();

    $.post("/user/regsiter/2_get_hangye", {
      parent: $name
    }, function(data, status) {
      if (data.status == 200) {
        get_zhiwei(data.message[0]["hy_id"]);
        for (sheng in data.message) {
          $("#register_cn_2_hangyes_slt").append('<option value="' + data.message[sheng]["hy_id"] + '">' + data.message[sheng]["hy_name"] + '</option>');
        }
      }
    });
  }

  function get_zhiwei($name) {
    $("#register_cn_2_zhiweis_slt").empty();

    $.post("/user/regsiter/2_get_zhiwei", {
      parent: $name
    }, function(data, status) {
      if (data.status == 200) {
        for (sheng in data.message) {
          $("#register_cn_2_zhiweis_slt").append('<option value="' + data.message[sheng]["hy_id"] + '">' + data.message[sheng]["hy_name"] + '</option>');
        }
      }
    });
  }

  function get_guojia() {
    $("#register_cn_2_guojia_slt").empty();
    $("#register_cn_2_nsjuzhudi_slt").empty();

    $.post("/user/regsiter/2_get_guojia", {}, function(data, status) {
      if (data.status == 200) {
        for (sheng in data.message) {
          $("#register_cn_2_guojia_slt").append('<option value="' + data.message[sheng]["cou_id"] + '">' + data.message[sheng]["cou_zh_name"] + '</option>');
          $("#register_cn_2_nsjuzhudi_slt").append('<option value="' + data.message[sheng]["cou_id"] + '">' + data.message[sheng]["cou_zh_name"] + '</option>');
          $("#register_cn_2_fdjzg_slt").append('<option value="' + data.message[sheng]["cou_id"] + '">' + data.message[sheng]["cou_zh_name"] + '</option>');
          $("#register_cn_2_guojichusheng_slt").append('<option value="' + data.message[sheng]["cou_id"] + '">' + data.message[sheng]["cou_zh_name"] + '</option>');
        }
      }
    });
  }
});
