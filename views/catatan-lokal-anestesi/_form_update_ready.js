$("#jam-mulai").on("input", function () {
  var waktuMulai = $("#jam-mulai").val();
  var waktuSelesai = $("#jam-selesai").val();
  var hours = waktuSelesai.split(":")[0] - waktuMulai.split(":")[0];
  var minutes = waktuSelesai.split(":")[1] - waktuMulai.split(":")[1];

  minutes = minutes.toString().length < 2 ? minutes : minutes;
  if (minutes < 0) {
    hours--;
    minutes = 60 + minutes;
  }
  hours = hours.toString().length < 2 ? hours : hours;

  if (hours == "0") {
    $("#selisih").val(minutes + " Menit");
  } else {
    $("#selisih").val(hours + " Jam " + minutes + " Menit");
  }
});

$("#jam-selesai").on("input", function () {
  var waktuMulai = $("#jam-mulai").val();
  var waktuSelesai = $("#jam-selesai").val();
  var hours = waktuSelesai.split(":")[0] - waktuMulai.split(":")[0];
  var minutes = waktuSelesai.split(":")[1] - waktuMulai.split(":")[1];

  minutes = minutes.toString().length < 2 ? minutes : minutes;
  if (minutes < 0) {
    hours--;
    minutes = 60 + minutes;
  }
  hours = hours.toString().length < 2 ? hours : hours;

  if (hours == "0") {
    $("#selisih").val(minutes + " Menit");
  } else {
    $("#selisih").val(hours + " Jam " + minutes + " Menit");
  }
});

$("#medikasi").on("submit", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();
  $.ajax({
    url: baseUrl + "/medikasi-catatan-lokal-anestesi/create",
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
      $("#medikasi")[0].reset();
      $(".btn-medikasi").html("Tambah");
      $("#tbl-medikasi").load(location.href + " #tbl-medikasi");
    },
    error: function (err) {
      console.log(err);
      $(".btn-medikasi").html("Tambah");
      $("#tbl-medikasi").load(location.href + " #tbl-medikasi");
    },
  });
});

$("#form-cairan-masuk").on("submit", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();
  $.ajax({
    url: baseUrl + "/cairan-masuk-catatan-lokal-anestesi/create",
    type: "POST",
    contentType: false,
    processData: false,
    data: new FormData(this),
    dataType: "JSON",
    beforeSend: function () {
      $(".btn-cairan-masuk").html("Menyimpan...");
    },
    success: function (res) {
      console.log(res.desc);
      $("#form-cairan-masuk")[0].reset();
      $(".btn-cairan-masuk").html("Tambah");
      $("#tbl-cairan-masuk").load(location.href + " #tbl-cairan-masuk");
    },
    error: function (err) {
      console.log(err);
      $(".btn-cairan-masuk").html("Tambah");
      $("#tbl-cairan-masuk").load(location.href + " #tbl-cairan-masuk");
    },
  });
});

$("#form-cairan-keluar").on("submit", function (e) {
  e.preventDefault();
  e.stopImmediatePropagation();
  $.ajax({
    url: baseUrl + "/cairan-keluar-catatan-lokal-anestesi/create",
    type: "POST",
    contentType: false,
    processData: false,
    data: new FormData(this),
    dataType: "JSON",
    beforeSend: function () {
      $(".btn-cairan-keluar").html("Menyimpan...");
    },
    success: function (res) {
      console.log(res.desc);
      $("#form-cairan-keluar")[0].reset();
      $(".btn-cairan-keluar").html("Tambah");
      $("#tbl-cairan-keluar").load(location.href + " #tbl-cairan-keluar");
    },
    error: function (err) {
      console.log(err);
      $(".btn-cairan-keluar").html("Tambah");
      $("#tbl-cairan-keluar").load(location.href + " #tbl-cairan-keluar");
    },
  });
});

$(document).ready(function () {
  $("#cla")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var subid = btn.attr("data-subid");
      var url_update_draf =
        baseUrl + "/catatan-lokal-anestesi/save-update?subid=" + subid;
      var url_update_final =
        baseUrl + "/catatan-lokal-anestesi/save-update-final?subid=" + subid;
      var url_update_batal =
        baseUrl + "/catatan-lokal-anestesi/save-update-batal?subid=" + subid;
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
              console.log(data);
              if (data.status) {
                fmsg.s(data.msg);
                //redirect ke index
                window.location.href =
                  baseUrl + "/catatan-lokal-anestesi/index?id=" + data.data.id;
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
