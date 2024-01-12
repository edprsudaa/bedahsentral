// $("#ku_dipasang_oleh").hide();
// $("#jikaya").hide();
kateterurin = (val) => {
  if (val == "r1") {
    let check = $("#customRadio0").prop("checked", true);
    $("#jikaya").show();
    $("#ku_dipasang_oleh").show();
  } else if (val == "r0") {
    $("#jikaya").hide();
    $("#ku_dipasang_oleh").hide();
  }
};

dalamok = (val) => {
  if (val == "customRadio0") {
    $("#ku_dipasang_oleh").show();
  } else {
    $("#jikaya").show();
    $("#ku_dipasang_oleh").hide();
  }
};

esu = (val) => {
  if (val == "esu0") {
    $("#esudipasang").show();
  } else {
    $("#esudipasang").hide();
  }
};

up = (val) => {
  if (val == "up0") {
    $("#up").show();
  } else {
    $("#up").hide();
  }
};

$(".btn-cetak").click(function () {
  let id = $(this).data("id");
  var w = window.open(
    "/cetak/cetak-intra-operasi?intra_id=" + id,
    "",
    "height=1000,width=700"
  );

  if (window.focus) {
    w.focus();
  } else {
    fmsg.w("Dokumen Gagal Dicetak");
  }
});

// FORM CUSTOM RADIO
$("#iop_jenis_pembiusan_it").on("input change focus paste", function (e) {
  $("#iop_jenis_pembiusan").val($(this).val());
  $("#iop_jenis_pembiusan").prop("checked", true);
});
$("#iop_kateter_urin_it").on("input change focus paste", function (e) {
  $("#iop_kateter_urin").val($(this).val());
  $("#iop_kateter_urin").prop("checked", true);
});
$("#iop_tourniquet_it").on("input change focus paste", function (e) {
  $("#iop_tourniquet").val($(this).val());
  $("#iop_tourniquet").prop("checked", true);
});
$("#iop_implant_it").on("input change focus paste", function (e) {
  $("#iop_implant").val($(this).val());
  $("#iop_implant").prop("checked", true);
});
$("#iop_drainage_it").on("input change focus paste", function (e) {
  $("#iop_drainage").val($(this).val());
  $("#iop_drainage").prop("checked", true);
});
$("#iop_irigasi_luka_it").on("input change focus paste", function (e) {
  $("#iop_irigasi_luka").val($(this).val());
  $("#iop_irigasi_luka").prop("checked", true);
});
$("#iop_tamplon_it").on("input change focus paste", function (e) {
  $("#iop_tamplon").val($(this).val());
  $("#iop_tamplon").prop("checked", true);
});
$("#iop_pemeriksaan_jaringan_it").on("input change focus paste", function (e) {
  $("#iop_pemeriksaan_jaringan").val($(this).val());
  $("#iop_pemeriksaan_jaringan").prop("checked", true);
});
$("#iop_posisi_kanul_intravena_it").on(
  "input change focus paste",
  function (e) {
    $("#iop_posisi_kanul_intravena").val($(this).val());
    $("#iop_posisi_kanul_intravena").prop("checked", true);
  }
);
$("#iop_pemeriksaan_kulit_pasca_bedah_it").on(
  "input change focus paste",
  function (e) {
    $("#iop_pemeriksaan_kulit_pasca_bedah").val($(this).val());
    $("#iop_pemeriksaan_kulit_pasca_bedah").prop("checked", true);
  }
);
$("#iop_pemeriksaan_kulit_pra_bedah_it").on(
  "input change focus paste",
  function (e) {
    $("#iop_pemeriksaan_kulit_pra_bedah").val($(this).val());
    $("#iop_pemeriksaan_kulit_pra_bedah").prop("checked", true);
  }
);
$("#iop_lok_ntrl_elektroda_it").on("input change focus paste", function (e) {
  $("#iop_lok_ntrl_elektroda").val($(this).val());
  $("#iop_lok_ntrl_elektroda").prop("checked", true);
});
$("#iop_insisi_kulit_it").on("input change focus paste", function (e) {
  $("#iop_insisi_kulit").val($(this).val());
  $("#iop_insisi_kulit").prop("checked", true);
});
$("#pop_riwayat_operasi_it").on("input change focus paste", function (e) {
  $("#pop_riwayat_operasi").val($(this).val());
  $("#pop_riwayat_operasi").prop("checked", true);
});

$("#selisih").click(function () {
  var d = $("#mulai-anestesi").val();
  var menit = Number(d.split(":")[1]) + 5;
  var menitasli = Number(d.split(":")[1]);
  var getjam = Number(d.split(":")[0]);
  console.log(getjam);
  var conv = menit.toString();

  if (conv.length == 1) {
    var hasilmenit = "0" + conv;
    var jam = d.split(":")[0];
    var hasil = jam + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 55 && getjam == 0) {
    var hasilmenit = "00";
    var hasil = "01" + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 56 && getjam == 0) {
    var hasilmenit = "01";
    var hasil = "01" + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 57 && getjam == 0) {
    var hasilmenit = "02";
    var jam = "01";
    var hasil = jam + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 58 && getjam == 0) {
    var hasilmenit = "03";
    var hasil = "01" + ":" + hasilmenit;
    $("#selisih").val(hasil);
  } else if (menitasli == 59 && getjam == 0) {
    var hasilmenit = "04";
    var hasil = "01" + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 55) {
    var hasilmenit = "00";
    var jam = d.split(":")[0];
    var hasil = Number(jam) + 1 + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 56) {
    var hasilmenit = "01";
    var jam = d.split(":")[0];
    var hasil = Number(jam) + 1 + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 57) {
    var hasilmenit = "02";
    var jam = d.split(":")[0];
    var hasil = Number(jam) + 1 + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 58) {
    var hasilmenit = "03";
    var jam = d.split(":")[0];
    var hasil = Number(jam) + 1 + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else if (menitasli == 59) {
    var hasilmenit = "04";
    var jam = d.split(":")[0];
    var hasil = Number(jam) + 1 + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  } else {
    var hasilmenit = Number(d.split(":")[1]) + 5;
    var jam = d.split(":")[0];
    var hasil = jam + ":" + hasilmenit;
    $("#selisih").val(hasil.toString());
  }
});

$(document).ready(function () {
  var timerAjaxIcd = 0;
  var currentRequesttAjaxIcd = null; //utk cancel req pedding karna ada req new search icd
  $("#intraoperasiperawat-iop_masalah").atwho({
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
  $("#intraoperasiperawat-iop_tindakan").atwho({
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

  $("#iop")
    .on("beforeSubmit", function (e) {
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var subid = btn.attr("data-subid");
      var url_update_draf =
        baseUrl + "/intra-operasi-perawat-pasien/save-update?subid=" + subid;
      var url_update_final =
        baseUrl +
        "/intra-operasi-perawat-pasien/save-update-final?subid=" +
        subid;
      var url_update_batal =
        baseUrl +
        "/intra-operasi-perawat-pasien/save-update-batal?subid=" +
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
                  "/intra-operasi-perawat-pasien/index?id=" +
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
