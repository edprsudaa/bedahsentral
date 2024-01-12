$(".btn-cetak").on("click", function () {
  var id = $(this).data("id");
  var w = window.open(
    "/cetak/cetak-laporan-anestesi?laporan_id=" + id,
    "",
    "height=1000,width=700"
  );
  if (window.focus) {
    w.focus();
  } else {
    fmsg.w("Dokumen Gagal Dicetak");
  }
});

$(document).ready(function () {
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

  $("#api")
    .on("beforeSubmit", function (e) {
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var subid = btn.attr("data-subid");
      var url_update_draf =
        baseUrl + "/asesmen-pra-induksi-pasien/save-update?subid=" + subid;
      var url_update_final =
        baseUrl +
        "/asesmen-pra-induksi-pasien/save-update-final?subid=" +
        subid;
      var url_update_batal =
        baseUrl +
        "/asesmen-pra-induksi-pasien/save-update-batal?subid=" +
        subid;
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
                  baseUrl +
                  "/asesmen-pra-induksi-pasien/index?id=" +
                  data.data.id;
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

$("#form-medikasi").on("submit", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();
  $.ajax({
    url: baseUrl + "/pemberian-obat-premedikasi-anestesi/create",
    type: "POST",
    contentType: false,
    processData: false,
    data: new FormData(this),
    dataType: "JSON",
    beforeSend: function () {
      $(".btn-medikasi").html("Menyimpan...");
    },
    success: function (res) {
      console.log(res.desc);
      $("#form-medikasi")[0].reset();
      $(".btn-medikasi").html("Tambah");
      $("#tbl-medikasi").load(location.href + " #tbl-medikasi");
      $("#pemberianobatpremedikasianestesi-popa_id").val("");
    },
    error: function (err) {
      console.log(err);
      $(".btn-medikasi").html("Tambah");
      $("#tbl-medikasi").load(location.href + " #tbl-medikasi");
      $("#pemberianobatpremedikasianestesi-popa_id").val("");
    },
  });
});
