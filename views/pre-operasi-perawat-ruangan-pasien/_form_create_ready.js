$("#pop_riwayat_operasi_it").on("input change focus paste", function (e) {
  $("#pop_riwayat_operasi").val($(this).val());
  $("#pop_riwayat_operasi").prop("checked", true);
});

gcs = () => {
  let gcse = $("#gcs-e").val();
  let gcsm = $("#gcs-m").val();
  let gcsv = $("#gcs-v").val();
  let totalgcs = Number(gcse) + Number(gcsv) + Number(gcsm);
  $("#total-gcs").val(totalgcs);
};

$(document).ready(function () {
  var timerAjaxIcd = 0;
  var currentRequesttAjaxIcd = null; //utk cancel req pedding karna ada req new search icd
  $("#preoperasiperawatruangan-pop_masalah").atwho({
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
            url: baseUrl + "/referensi/masalah-keperawatan",
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

  $("#preoperasiperawatruangan-pop_tindakan").atwho({
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
            url: baseUrl + "/referensi/intervensi-keperawatan",
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

  $("#pre")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var url_insert_draf =
        baseUrl + "/pre-operasi-perawat-ruangan-pasien/save-insert";
      var url_insert_final =
        baseUrl + "/pre-operasi-perawat-ruangan-pasien/save-insert-final";
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
                            "/pre-operasi-perawat-ruangan-pasien?id=" +
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
                "/pre-operasi-perawat-ruangan-pasien?id=" +
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
    e.preventDefault();
    e.stopImmediatePropagation();
    $.pjax.reload({ container: "#pjform", timeout: false }); //pjax form
  });
});
