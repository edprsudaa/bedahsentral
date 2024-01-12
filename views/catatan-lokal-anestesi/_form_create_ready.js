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

$(document).ready(function () {
  $("#cla")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = new FormData(this);
      //console.log(post_data);
      var url_insert_draf = baseUrl + "/catatan-lokal-anestesi/save-insert";
      var url_insert_final =
        baseUrl + "/catatan-lokal-anestesi/save-insert-final";
      $.ajax({
        url: url_insert_draf,
        type: "POST",
        dataType: "json",
        data: new FormData(this),
        processData: false,
        contentType: false,
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
                      cache: false,
                      processData: false,
                      contentType: false,
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
                            "/catatan-lokal-anestesi?id=" +
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
                "/catatan-lokal-anestesi?id=" +
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
