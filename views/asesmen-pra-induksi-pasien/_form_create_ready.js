$(document).ready(function () {
  // var timerAjaxIcd = 0;
  // var currentRequesttAjaxIcd = null;//utk cancel req pedding karna ada req new search icd
  // $("#resep-res_diagnosa").atwho({
  //     searchKey: "name",
  //     at: "@",
  //     limit: 100,
  //     displayTpl:"<li data-value='${key}'>${name}</li>",
  //     insertTpl:"${name}",
  //     callbacks: {
  //         remoteFilter: function(query, callback) {
  //             // console.log("Mengetik...");
  //             clearTimeout(timerAjaxIcd);
  //             timerAjaxIcd = setTimeout(function () {
  //                 // console.log("Mencari...");
  //                 currentRequesttAjaxIcd =$.ajax({
  //                     url:baseUrl+'/referensi/icd10',
  //                     dataType: "json",
  //                     data:{search:query},
  //                     type:"GET",
  //                     beforeSend : function()    {
  //                         if(currentRequesttAjaxIcd != null) {
  //                             currentRequesttAjaxIcd.abort();
  //                         }
  //                     },
  //                     success:function(data) {
  //                         var datas = $.map(data.data,function(value,i){
  //                             return {'id':i,'key':value+" ",'name':value}
  //                         });
  //                         callback(datas)
  //                     }
  //                 })
  //             },1000);
  //         }
  //     }
  // });

  // FORM CUSTOM RADIO
  $("#api_riwayat_anestesi_it").on("input change focus paste", function (e) {
    $("#api_riwayat_anestesi").val($(this).val());
    $("#api_riwayat_anestesi").prop("checked", true);
  });
  $("#api_persiapan_transfusi_it").on("input change focus paste", function (e) {
    $("#api_persiapan_transfusi").val($(this).val());
    $("#api_persiapan_transfusi").prop("checked", true);
  });
  $("#api_puasa_it").on("input change focus paste", function (e) {
    $("#api_puasa").val($(this).val());
    $("#api_puasa").prop("checked", true);
  });
  // END FORM CUSTOM RADIO

  $("#api")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var url_insert_draf = baseUrl + "/asesmen-pra-induksi-pasien/save-insert";
      var url_insert_final =
        baseUrl + "/asesmen-pra-induksi-pasien/save-insert-final";
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
                            "/asesmen-pra-induksi-pasien?id=" +
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
                "/asesmen-pra-induksi-pasien?id=" +
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
});
