$(document).ready(function () {
  $(".btn-cetak").on("click", function () {
    var url = $(this).data("url");
    var w = window.open(url, "", "height=1000,width=700");
    if (window.focus) {
      w.focus();
    } else {
      fmsg.w("Dokumen Gagal Dicetak");
    }
  });

  $(".btn-segarkan").on("click", function (e) {
    e.preventDefault;
    e.stopImmediatePropagation();
    $.pjax.reload({ container: "#pjform", timeout: false }); //pjax form
  });

  $(".btn-hapus").on("click", function (e) {
    e.preventDefault;
    e.stopImmediatePropagation();

    var url = $(this).data("url");
    Swal.fire({
      title: "Anda Yakin ?",
      text: "Yakin Hapus, Karna Dengan ini Data Tidak Akan Ditampilkan Lagi ?",
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
        ? $.ajax({
            url: url,
            type: "get",
            dataType: "json",
            beforeSend: function (e) {
              fbtn.setLoading($(this), "proses...");
            },
            success: function (data) {
              // console.log(data);
              if (data.status) {
                fmsg.s(data.desc);
                //redirect ke index
                $.pjax.reload({ container: "#pjform", timeout: false });
                // window.location.href =
                //   baseUrl + "/askan-pra-anestesi/index?id=" + data.data.id;
              } else {
                fmsg.w(data.desc);
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

  $("#bat")
    .on("beforeSubmit", function (e) {
      e.preventDefault();

      $(".btn").attr("disabled", true);
      $(".btn-simpan").html("Menyimpan...");
      // var data = new FormData(this);
      var data = $(this).serialize();
      var url = $(".btn-simpan").data("url");
      $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: data,
        // processData: false,
        // contentType: false,
        beforeSend: function (e) {
          $(".btn-simpan").html("Menyimpan...");
        },
        success: function (data) {
          // var res = JSON.parse(data);
          if (data.status) {
            toastr
              .success(data.desc)
              .css({ width: "400px", "max-width": "400px" });
            // reload
            $.pjax.reload({ container: "#pjform", timeout: false });
            // window.location.href =
            //   baseUrl + "/pembatalan-operasi/index?id=" + data.id_layanan;
          } else {
            toastr
              .error(data.desc)
              .css({ width: "400px", "max-width": "400px" });
          }
        },
        complete: function (e) {
          $(".btn-simpan").html("Simpan");
          $(".btn").attr("disabled", false);
        },
      });
    })
    .on("submit", function (e) {
      e.preventDefault();
    });
});
