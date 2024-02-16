$(document).ready(function () {
  var timerAjaxIcd = 0;
  var currentRequesttAjaxIcd = null; //utk cancel req pedding karna ada req new search icd
  $("#timoperasi-to_diagnosa_medis_pra_bedah").atwho({
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
            url: baseUrl + "/referensi/icd10",
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

  $("#timoperasi-to_diagnosa_medis_pasca_bedah").atwho({
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
            url: baseUrl + "/referensi/icd10",
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

  $("#timoperasi-to_tindakan_operasi").atwho({
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
            url: baseUrl + "/referensi/tindakan",
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

  $("#af").on("keyup keypress", function (e) {
    let keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });

  $(".dynamicform_wrapper").on("afterInsert", function (e, item) {
    $(".dynamicform_wrapper .form-options-item").each(function (index) {
      $(this)
        .find(".nomor")
        .html(index + 1);
      $(".field-timoperasidetail-" + index + "-tod_jo_id > span").addClass(
        "input-sm"
      );
      $(".field-timoperasidetail-" + index + "-tod_pgw_id > span").addClass(
        "input-sm"
      );
    });
    let lastIndex = $(".dynamicform_wrapper .form-options-item").length - 1;
    $(".field-timoperasidetail-" + lastIndex + "-tod_jo_id > span").addClass(
      "input-sm"
    );
    $("#timoperasidetail-" + lastIndex + "-tod_jo_id")
      .val(null)
      .trigger("change");
    $("#timoperasidetail-" + lastIndex + "-tod_jo_id").select2("open");

    $(".field-timoperasidetail-" + lastIndex + "-tod_pgw_id > span").addClass(
      "input-sm"
    );
    $("#timoperasidetail-" + lastIndex + "-tod_pgw_id")
      .val(null)
      .trigger("change");
    $("#timoperasidetail-" + lastIndex + "-tod_pgw_id").select2("open");
    // TDK digunakan karna multiselect true
    // $(item).find("select[name*='[resd_obat_id]']").on('select2:select', function (e) {
    //     let index = $(this).closest("tr").index()
    //     let obatDipilih = e.params.data
    //     // cek obat sudah dipilih/belum
    //     let dipilih = 0
    //     $('.dynamicform_wrapper .form-options-item').each(function (e) {
    //         let obat_sudah_dipilih = $(this).find("select[name*='[resd_obat_id]']").val()
    //         if (obat_sudah_dipilih == obatDipilih.id) {
    //             dipilih++
    //             if (dipilih>1) {
    //                 return false
    //             }
    //         }
    //     })
    //     // console.log(dipilih)
    //     if (dipilih>1) {
    //         $(`#resepdetail-${index}-resd_obat_id`).val(null).trigger("change")
    //         $(`#resepdetail-${index}-resd_jumlah_stok`).val(null).trigger("change")
    //         $(`#resepdetail-${index}-resd_obat_id`).select2("open")
    //         fmsg.w('Upps, Obat Sudah Dipilih Sebelumnya...')
    //     } else {
    //         $(`#resepdetail-${index}-resd_jumlah_stok`).val(obatDipilih.stok).trigger("change")
    //         $(`#resepdetail-${index}-resd_jumlah`).focus()
    //     }
    // })
  });

  $(".dynamicform_wrapper").on("afterDelete", function (e) {
    $(".dynamicform_wrapper .form-options-item").each(function (index) {
      $(this)
        .find(".nomor")
        .html(index + 1);
    });
  });

  $("#af")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var url_insert_draf = baseUrl + "/tim-operasi/save-insert";
      var url_insert_final = baseUrl + "/tim-operasi/save-insert-final";
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
                            "/tim-operasi?id=" +
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
              window.location.href = baseUrl + "/layanan-operasi/index";

              // window.location.href =
              //   baseUrl +
              //   "/tim-operasi?id=" +
              //   data.data.id +
              //   "&subid" +
              //   data.data.subid;
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

  $(document).on("change", "#rm_pasien", function (e) {
    let id_layanan = $("#rm_pasien").val();
    $.post(
      baseUrl + "/tim-operasi/cari-data-operasi",
      {
        id_layanan: id_layanan,
      },
      function (data) {
        let datatabel = "";
        let no = 1;
        var res = JSON.parse(data);

        if (res.status) {
          datatabel += `<tr>
                          <td colspan="4" style="background-color:green"></td>
                        </tr>`;

          res.data.map((datat) => {
            // Misalkan datat.tanggal berisi tanggal dalam format "yyyy-mm-dd"
            let split_tgl = datat.tanggal.split("-");
            let tgl = split_tgl[2] + "-" + split_tgl[1] + "-" + split_tgl[0];

            datatabel += `<tr>
                            <td rowspan="4">${no++}.</td>
                            <td style="width:29%;">No.Registrasi</td>
                            <td style="width:1%;">:</td>
                            <td><b>${datat.reg_kode}</b></td>
                          </tr>
                          <tr>
                            <td>Tanggal Operasi</td>
                            <td>:</td>
                            <td><b>${tgl}</b></td>
                          </tr>
                          <tr>
                            <td>Tindakan</td>
                            <td>:</td>
                            <td><b>${datat.tindakan}</b></td>
                          </tr>
                          <tr>
                            <td>Ruangan</td>
                            <td>:</td>
                            <td><b>${datat.unit}</b></td>
                          </tr>
                          <tr>
                            <td colspan="4" style="background-color:green"></td>
                          </tr>
                          `;
          });
        } else {
          datatabel = `<tr>
                        <td style="background-color:green"></td>
                      </tr>
                      <tr>
                        <td class="text-center">${res.data}</td>
                      </tr>
                      <tr>
                        <td style="background-color:green"></td>
                      </tr>`;
        }

        $("#datatabel").html(datatabel);
      }
    );
  });
});
