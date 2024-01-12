$(document).ready(function () {
  var timerAjaxIcd = 0;
  var currentRequesttAjaxIcd = null; //utk cancel req pedding karna ada req new search icd

  $("#timoperasi-to_diagnosa_medis_pra_bedah").atwho({
    searchKey: "name",
    at: "@",
    limit: 100,
    displayTpl: "<li data-value='${key}'>${name}</li>",
    insertTpl: "${name}",
    callbacks: {
      remoteFilter: function (query, callback) {
        // console.log("Mengetik...");
        clearTimeout(timerAjaxIcd);
        timerAjaxIcd = setTimeout(function () {
          // console.log("Mencari...");
          currentRequesttAjaxIcd = $.ajax({
            url: baseUrl + "/referensi/icd10",
            dataType: "json",
            data: { search: query },
            type: "GET",
            beforeSend: function () {
              if (currentRequesttAjaxIcd != null) {
                currentRequesttAjaxIcd.abort();
              }
            },
            success: function (data) {
              var datas = $.map(data.data, function (value, i) {
                return { id: i, key: value + " ", name: value };
              });
              callback(datas);
            },
          });
        }, 1000);
      },
    },
  });

  $("#timoperasi-to_diagnosa_medis_pasca_bedah").atwho({
    searchKey: "name",
    at: "@",
    limit: 100,
    displayTpl: "<li data-value='${key}'>${name}</li>",
    insertTpl: "${name}",
    callbacks: {
      remoteFilter: function (query, callback) {
        // console.log("Mengetik...");
        clearTimeout(timerAjaxIcd);
        timerAjaxIcd = setTimeout(function () {
          // console.log("Mencari...");
          currentRequesttAjaxIcd = $.ajax({
            url: baseUrl + "/referensi/icd10",
            dataType: "json",
            data: { search: query },
            type: "GET",
            beforeSend: function () {
              if (currentRequesttAjaxIcd != null) {
                currentRequesttAjaxIcd.abort();
              }
            },
            success: function (data) {
              var datas = $.map(data.data, function (value, i) {
                return { id: i, key: value + " ", name: value };
              });
              callback(datas);
            },
          });
        }, 1000);
      },
    },
  });

  $("#timoperasi-to_tindakan_operasi").atwho({
    searchKey: "name",
    at: "@",
    limit: 100,
    displayTpl: "<li data-value='${key}'>${name}</li>",
    insertTpl: "${name}",
    callbacks: {
      remoteFilter: function (query, callback) {
        // console.log("Mengetik...");
        clearTimeout(timerAjaxIcd);
        timerAjaxIcd = setTimeout(function () {
          // console.log("Mencari...");
          currentRequesttAjaxIcd = $.ajax({
            url: baseUrl + "/referensi/tindakan",
            dataType: "json",
            data: { search: query },
            type: "GET",
            beforeSend: function () {
              if (currentRequesttAjaxIcd != null) {
                currentRequesttAjaxIcd.abort();
              }
            },
            success: function (data) {
              var datas = $.map(data.data, function (value, i) {
                return { id: i, key: value + " ", name: value };
              });
              callback(datas);
            },
          });
        }, 1000);
      },
    },
  });

  $(".dynamicform_wrapper").on("afterInsert", function (e, item) {
    $(".dynamicform_wrapper .form-options-item").each(function (index) {
      $(this)
        .find(".nomor")
        .html("R" + (index + 1));
      $(this)
        .find(".nomor-form")
        .val("R" + (index + 1));
      $(".field-timoperasidetail-" + index + "-tod_jo_id > span").addClass(
        "input-sm"
      );
      $(".field-timoperasidetail-" + index + "-tod_pgw_id > span").addClass(
        "input-sm"
      );
    });
    let lastIndex = $(".dynamicform_wrapper .form-options-item").length - 1;
    $(".field-timoperasidetail-" + lastIndex + "-tod_jo_id > span").addClass(
      "input-sm"
    );
    $("#timoperasidetail-" + lastIndex + "-tod_jo_id")
      .val(null)
      .trigger("change");
    $("#timoperasidetail-" + lastIndex + "-tod_jo_id").select2("open");
    $("#timoperasidetail-" + lastIndex + "-tod_pgw_id")
      .val(null)
      .trigger("change");
  });

  $(".dynamicform_wrapper").on("afterDelete", function (e) {
    $(".dynamicform_wrapper .form-options-item").each(function (index) {
      $(this)
        .find(".nomor")
        .html("R" + (index + 1));
      $(this)
        .find(".nomor-form")
        .val("R" + (index + 1));
      $(".field-timoperasidetail-" + index + "-tod_jo_id > span").addClass(
        "input-sm"
      );
      $(".field-timoperasidetail-" + index + "-tod_pgw_id > span").addClass(
        "input-sm"
      );
    });
  });

  $(".dynamicform_wrapper").on("afterDelete", function (e) {
    $(".dynamicform_wrapper .form-options-item").each(function (index) {
      $(this)
        .find(".nomor")
        .html(index + 1);
    });
  });

  $("#af")
    .on("beforeSubmit", function (e) {
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var subid = btn.attr("data-subid");
      var url_update_draf = baseUrl + "/tim-operasi/save-update?subid=" + subid;
      $.ajax({
        url: url_update_draf,
        type: "post",
        dataType: "json",
        data: post_data,
        beforeSend: function (e) {
          fbtn.setLoading(btn, "proses...");
        },
        success: function (data) {
          console.log(data);
          if (data.status) {
            //msg success save draf
            fmsg.s(data.msg);
            // window.location.href =
            //   baseUrl +
            //   "/tim-operasi/update?id=" +
            //   data.data.id +
            //   "&subid=" +
            //   subid;
            $.pjax.reload({ container: "#pjform", timeout: false });
          } else {
            if (data.data) {
              fmsg.w(data.msg + " : " + JSON.stringify(data.data));
            } else {
              fmsg.w(data.msg);
            }
          }
        },
        complete: function (e) {
          fbtn.resetLoading(btn, '<i class="fas fa-save"></i> Simpan');
        },
      });
    })
    .on("submit", function (e) {
      e.preventDefault();
    });

  $(".btn-segarkan").on("click", function (e) {
    e.preventDefault;
    e.stopImmediatePropagation();
    $.pjax.reload({ container: "#pjform", timeout: false }); //pjax form
  });
});
