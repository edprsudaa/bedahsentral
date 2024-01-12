giginormal = (val) => {
  if (val == "r2") {
    $("#atas1").prop("checked", true);
    // console.log(check);
    $("#atas").show();
    $(".palsuatas").show();
    $(".palsubawah").hide();
    $("#bawah").show();
  } else {
    $(".palsuatas").hide();
    $(".palsubawah").hide();
    $("#atas").hide();
    $("#bawah").hide();
  }
};

atas = (val) => {
  let check = $("#atas1").prop("checked", true);
  $(".palsuatas").show();
  $(".palsubawah").hide();
};

bawah = (val) => {
  let check = $("#bawah1").prop("checked", true);
  $(".palsuatas").hide();
  $(".palsubawah").show();
};

jalannafas = (val) => {
  if (val == "jlnnfs1") {
    $("#tabelclass").show();
  } else {
    $("#tabelclass").hide();
  }
};

$("#ppa_pemeriksaan_laboratorium_it").on(
  "input change focus paste",
  function (e) {
    $("#ppa_pemeriksaan_laboratorium").val($(this).val());
    $("#ppa_pemeriksaan_laboratorium").prop("checked", true);
  }
);
$("#ppa_obat_yang_sedang_konsumsi_it").on(
  "input change focus paste",
  function (e) {
    $("#ppa_obat_yang_sedang_konsumsi").val($(this).val());
    $("#ppa_obat_yang_sedang_konsumsi").prop("checked", true);
  }
);
$("#ppa_riwayat_komplikasi_it").on("input change focus paste", function (e) {
  $("#ppa_riwayat_komplikasi").val($(this).val());
  $("#ppa_riwayat_komplikasi").prop("checked", true);
});
$("#ppa_jalan_nafas_it").on("input change focus paste", function (e) {
  $("#ppa_jalan_nafas").val($(this).val());
  $("#ppa_jalan_nafas").prop("checked", true);
});
$("#ppa_pemeriksaan_radiologi_it").on("input change focus paste", function (e) {
  $("#ppa_pemeriksaan_radiologi").val($(this).val());
  $("#ppa_pemeriksaan_radiologi").prop("checked", true);
});
$("#ppa_respirasi_it").on("input change focus paste", function (e) {
  $("#ppa_respirasi").val($(this).val());
  $("#ppa_respirasi").prop("checked", true);
});
$("#ppa_pemeriksaan_penunjang_it").on("input change focus paste", function (e) {
  $("#ppa_pemeriksaan_penunjang").val($(this).val());
  $("#ppa_pemeriksaan_penunjang").prop("checked", true);
});
$("#ppa_cardiovaskuler_it").on("input change focus paste", function (e) {
  $("#ppa_cardiovaskuler").val($(this).val());
  $("#ppa_cardiovaskuler").prop("checked", true);
});
$("#ppa_cardiovaskuler_1").on("input change focus paste", function (e) {
  $("#ppa_jantung").val($(this).val());
  $("#ppa_jantung").prop("checked", true);
});
$("#ppa_cardiovaskuler_2").on("input change focus paste", function (e) {
  $("#ppa_lain").val($(this).val());
  $("#ppa_lain").prop("checked", true);
});
$("#ppa_sistem_pencernaan_it").on("input change focus paste", function (e) {
  $("#ppa_sistem_pencernaan").val($(this).val());
  $("#ppa_sistem_pencernaan").prop("checked", true);
});
$("#ppa_neuromusculoscletal_it").on("input change focus paste", function (e) {
  $("#ppa_neuromusculoscletal").val($(this).val());
  $("#ppa_neuromusculoscletal").prop("checked", true);
});
$("#ppa_ginjal_it").on("input change focus paste", function (e) {
  $("#ppa_ginjal").val($(this).val());
  $("#ppa_ginjal").prop("checked", true);
});
$("#ppa_premedikasi_it").on("input change focus paste", function (e) {
  $("#ppa_premedikasi").val($(this).val());
  $("#ppa_premedikasi").prop("checked", true);
});
$("#ppa_lain_lain_it").on("input change focus paste", function (e) {
  $("#ppa_lain_lain").val($(this).val());
  $("#ppa_lain_lain").prop("checked", true);
});
$("#ppa_alergi_obat_it").on("input change focus paste", function (e) {
  $("#ppa_alergi_obat").val($(this).val());
  $("#ppa_alergi_obat").prop("checked", true);
});
$("#ppa_intruksi_lain_it").on("input change focus paste", function (e) {
  $("#ppa_intruksi_lain").val($(this).val());
  $("#ppa_intruksi_lain").prop("checked", true);
});
// END FORM CUSTOM RADIO

$(document).ready(function () {
  $("#ppa")
    .on("beforeSubmit", function (e) {
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var subid = btn.attr("data-subid");
      var url_update_draf =
        baseUrl + "/pra-anestesi-pasien/save-update?subid=" + subid;
      var url_update_final =
        baseUrl + "/pra-anestesi-pasien/save-update-final?subid=" + subid;
      var url_update_batal =
        baseUrl + "/pra-anestesi-pasien/save-update-batal?subid=" + subid;
      $.ajax({
        url: url_update_draf,
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
                      url: url_update_final,
                      type: "post",
                      dataType: "json",
                      data: post_data,
                      beforeSend: function (e) {
                        fbtn.setLoading(btn, "proses...");
                      },
                      success: function (data) {
                        if (data.status) {
                          fmsg.s(data.msg);
                          $.pjax.reload({
                            container: "#pjform",
                            timeout: false,
                          }); //pjax form
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
            } else if (data.data.konfirm_batal) {
              Swal.fire({
                title: "Anda Yakin ?",
                text: "Yakin Simpan Batalkan, Karna Dengan ini Anda Tidak Dapat Melakukan Perubahan Lagi?",
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
                  ? //AJAX SAVE BATALKAN
                    $.ajax({
                      url: url_update_batal,
                      type: "post",
                      dataType: "json",
                      data: post_data,
                      beforeSend: function (e) {
                        fbtn.setLoading(btn, "proses...");
                      },
                      success: function (data) {
                        if (data.status) {
                          fmsg.s(data.msg);
                          $.pjax.reload({
                            container: "#pjform",
                            timeout: false,
                          }); //pjax form
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
              $.pjax.reload({ container: "#pjform", timeout: false }); //pjax form
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

  $(document).on("click", ".btn-hapus-draf", function (e) {
    e.preventDefault;
    e.stopImmediatePropagation();
    var obj_url = $(this).data("url");
    Swal.fire({
      title: "Anda Yakin ?",
      text: "Yakin Hapus, Karna Dengan ini Data Tidak Akan Ditampilkan Lagi ?",
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
        ? $.ajax({
            url: obj_url,
            type: "get",
            beforeSend: function (e) {
              fbtn.setLoading($(this), "proses...");
            },
            success: function (data) {
              if (data.status) {
                fmsg.s(data.msg);
                //redirect ke index
                window.location.href =
                  baseUrl + "/pra-anestesi-pasien/index?id=" + data.data.id;
              } else {
                fmsg.w(data.msg);
              }
            },
            complete: function (e) {
              fbtn.resetLoading(
                $(this),
                '<i class="fas fa-trash-alt"></i> Hapus'
              );
            },
          })
        : t.dismiss === Swal.DismissReason.cancel;
    });
  });

  $(".btn-segarkan").on("click", function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $.pjax.reload({ container: "#pjform", timeout: false }); //pjax form
  });
});
