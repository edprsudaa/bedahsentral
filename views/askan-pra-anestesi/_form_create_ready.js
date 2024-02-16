$(document).ready(function () {
  $("#apa")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var url_insert_draf = baseUrl + "/askan-pra-anestesi/save-insert";
      var url_insert_final = baseUrl + "/askan-pra-anestesi/save-insert-final";
      $.ajax({
        url: url_insert_draf,
        type: "post",
        dataType: "json",
        data: post_data,
        beforeSend: function (e) {
          fbtn.setLoading(btn, "proses...");
        },
        success: function (data) {
          if (data.status) {
            if (data.data.konfirm_final) {
              Swal.fire({
                title: "Anda Yakin ?",
                text: "Yakin Simpan Final, Karna Dengan ini Anda Tidak Dapat Melakukan Perubahan Lagi?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1,
                showLoaderOnConfirm: true,
              }).then(function (t) {
                t.value
                  ? //AJAX SAVE FINAL
                    $.ajax({
                      url: url_insert_final,
                      type: "post",
                      dataType: "json",
                      data: post_data,
                      beforeSend: function (e) {
                        fbtn.setLoading(btn, "proses...");
                      },
                      success: function (data) {
                        if (data.status) {
                          fmsg.s(data.msg);
                          //direct ke url edit
                          window.location.href =
                            baseUrl +
                            "/askan-pra-anestesi?id=" +
                            data.data.id +
                            "&subid" +
                            data.data.subid;
                        } else {
                          if (data.data) {
                            fmsg.w(
                              data.msg + " : " + JSON.stringify(data.data)
                            );
                          } else {
                            fmsg.w(data.msg);
                          }
                        }
                      },
                      complete: function (e) {
                        fbtn.resetLoading(
                          btn,
                          '<i class="fas fa-save"></i> Simpan'
                        );
                      },
                    })
                  : t.dismiss === Swal.DismissReason.cancel;
              });
            } else {
              //msg success save draf
              fmsg.s(data.msg);
              //direct ke url edit
              window.location.href =
                baseUrl +
                "/askan-pra-anestesi?id=" +
                data.data.id +
                "&subid" +
                data.data.subid;
            }
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
  $("#apa_respirasi_it").on("input change focus paste", function (e) {
    $("#apa_respirasi").val($(this).val());
    $("#apa_respirasi").prop("checked", true);
  });
  $("#apa_renal_endokrin_it").on("input change focus paste", function (e) {
    $("#apa_renal_endokrin").val($(this).val());
    $("#apa_renal_endokrin").prop("checked", true);
  });
  $("#apa_hepato_it").on("input change focus paste", function (e) {
    $("#apa_hepato").val($(this).val());
    $("#apa_hepato").prop("checked", true);
  });
  $("#apa_kardiovaskular_it").on("input change focus paste", function (e) {
    $("#apa_kardiovaskular").val($(this).val());
    $("#apa_kardiovaskular").prop("checked", true);
  });
  $("#apa_neuro_it").on("input change focus paste", function (e) {
    $("#apa_neuro").val($(this).val());
    $("#apa_neuro").prop("checked", true);
  });
  $("#apa_lain_lain_it").on("input change focus paste", function (e) {
    $("#apa_lain_lain").val($(this).val());
    $("#apa_lain_lain").prop("checked", true);
  });
  $("#apa_pendarahan_it").on("input change focus paste", function (e) {
    $("#apa_pendarahan").val($(this).val());
    $("#apa_pendarahan").prop("checked", true);
  });
});
