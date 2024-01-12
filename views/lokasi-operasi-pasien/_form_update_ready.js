$(document).ready(function () {
  $("#mlo")
    .on("beforeSubmit", function (e) {
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var subid = btn.attr("data-subid");
      var url_update_draf =
        baseUrl + "/lokasi-operasi-pasien/save-update?subid=" + subid;
      var url_update_final =
        baseUrl + "/lokasi-operasi-pasien/save-update-final?subid=" + subid;
      var url_update_batal =
        baseUrl + "/lokasi-operasi-pasien/save-update-batal?subid=" + subid;
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
                  baseUrl + "/lokasi-operasi-pasien/index?id=" + data.data.id;
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
