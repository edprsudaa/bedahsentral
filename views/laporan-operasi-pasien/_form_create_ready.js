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

  if (waktuSelesai) {
    if (hours == "0") {
      $("#selisih").val(minutes + " Menit");
    } else {
      $("#selisih").val(hours + " Jam " + minutes + " Menit");
    }
  } else {
    $("#selisih").val("Silahkan isi jam selesai!");
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

  if (waktuMulai) {
    if (hours == "0") {
      $("#selisih").val(minutes + " Menit");
    } else {
      $("#selisih").val(hours + " Jam " + minutes + " Menit");
    }
  } else {
    $("#selisih").val("Silahkan isi jam mulai!");
  }
});

$(document).ready(function () {
  $("#lap")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      let mulai = $("#jam-mulai").val();
      let selesai = $("#jam-selesai").val();

      if (mulai != "" && selesai != "") {
        var btn = $(".btn-submit");
        fbtn.setLoading(btn, "proses...");
        var post_data = new FormData(this);
        //console.log(post_data);
        var url_insert_draf = baseUrl + "/laporan-operasi-pasien/save-insert";
        var url_insert_final =
          baseUrl + "/laporan-operasi-pasien/save-insert-final";
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
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Ya!",
                  cancelButtonText: "Tidak!",
                  customClass: {
                    confirmButton: "btn btn-success mt-2",
                    cancelButton: "btn btn-danger ml-2 mt-2",
                  },
                  buttonsStyling: false,
                  // showLoaderOnConfirm: true,
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
                              "/laporan-operasi-pasien?id=" +
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
                  "/laporan-operasi-pasien?id=" +
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
      } else {
        Swal.fire({
          title: "Gagal Menyimpan!",
          text: "Silahkan Lengkapi Jam Mulai dan Jam Selesai Terlebih Dahulu!",
          icon: "error",
          showConfirmButton: false,
          showCancelButton: true,
          buttonsStyling: false,
          cancelButtonText: "Ya, Akan saya lengkapi",
          customClass: {
            cancelButton: "btn btn-danger",
          },
        });
      }
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
