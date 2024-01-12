cek_jumlah = () => {
  // PISAU
  let pjki_tangkai_pisau_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tangkai_pisau_hitungan_pertama"
  ).val();
  let pjki_tangkai_pisau_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tangkai_pisau_tambahan_slma_operasi"
  ).val();
  let pjki_tangkai_pisau_jumlah =
    Number(pjki_tangkai_pisau_hitungan_pertama) +
    Number(pjki_tangkai_pisau_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_tangkai_pisau_jumlah").val(
    pjki_tangkai_pisau_jumlah
  );
  // SISA
  let pjki_tangkai_pisau_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tangkai_pisau_dipakai"
  ).val();
  let pjki_tangkai_pisau_sisa =
    Number(pjki_tangkai_pisau_jumlah) - Number(pjki_tangkai_pisau_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_tangkai_pisau_sisa").val(
    pjki_tangkai_pisau_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_pinset_anatomis_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pinset_anatomis_hitungan_pertama"
  ).val();
  let pjki_pinset_anatomis_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pinset_anatomis_tambahan_slma_operasi"
  ).val();
  let pjki_pinset_anatomis_jumlah =
    Number(pjki_pinset_anatomis_hitungan_pertama) +
    Number(pjki_pinset_anatomis_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_pinset_anatomis_jumlah").val(
    pjki_pinset_anatomis_jumlah
  );
  // SISA
  let pjki_pinset_anatomis_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pinset_anatomis_dipakai"
  ).val();
  let pjki_pinset_anatomis_sisa =
    Number(pjki_pinset_anatomis_jumlah) - Number(pjki_pinset_anatomis_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_pinset_anatomis_sisa").val(
    pjki_pinset_anatomis_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_pinset_chrirurgis_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pinset_chrirurgis_hitungan_pertama"
  ).val();
  let pjki_pinset_chrirurgis_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pinset_chrirurgis_tambahan_slma_operasi"
  ).val();
  let pjki_pinset_chrirurgis_jumlah =
    Number(pjki_pinset_chrirurgis_hitungan_pertama) +
    Number(pjki_pinset_chrirurgis_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_pinset_chrirurgis_jumlah").val(
    pjki_pinset_chrirurgis_jumlah
  );
  // SISA
  let pjki_pinset_chrirurgis_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pinset_chrirurgis_dipakai"
  ).val();
  let pjki_pinset_chrirurgis_sisa =
    Number(pjki_pinset_chrirurgis_jumlah) -
    Number(pjki_pinset_chrirurgis_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_pinset_chrirurgis_sisa").val(
    pjki_pinset_chrirurgis_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_gunting_benang_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_gunting_benang_hitungan_pertama"
  ).val();
  let pjki_gunting_benang_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_gunting_benang_tambahan_slma_operasi"
  ).val();
  let pjki_gunting_benang_jumlah =
    Number(pjki_gunting_benang_hitungan_pertama) +
    Number(pjki_gunting_benang_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_gunting_benang_jumlah").val(
    pjki_gunting_benang_jumlah
  );
  // SISA
  let pjki_gunting_benang_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_gunting_benang_dipakai"
  ).val();
  let pjki_gunting_benang_sisa =
    Number(pjki_gunting_benang_jumlah) - Number(pjki_gunting_benang_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_gunting_benang_sisa").val(
    pjki_gunting_benang_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_gunting_jaringan_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_gunting_jaringan_hitungan_pertama"
  ).val();
  let pjki_gunting_jaringan_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_gunting_jaringan_tambahan_slma_operasi"
  ).val();
  let pjki_gunting_jaringan_jumlah =
    Number(pjki_gunting_jaringan_hitungan_pertama) +
    Number(pjki_gunting_jaringan_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_gunting_jaringan_jumlah").val(
    pjki_gunting_jaringan_jumlah
  );
  // SISA
  let pjki_gunting_jaringan_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_gunting_jaringan_dipakai"
  ).val();
  let pjki_gunting_jaringan_sisa =
    Number(pjki_gunting_jaringan_jumlah) -
    Number(pjki_gunting_jaringan_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_gunting_jaringan_sisa").val(
    pjki_gunting_jaringan_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_mosquito_pean_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_mosquito_pean_hitungan_pertama"
  ).val();
  let pjki_mosquito_pean_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_mosquito_pean_tambahan_slma_operasi"
  ).val();
  let pjki_mosquito_pean_jumlah =
    Number(pjki_mosquito_pean_hitungan_pertama) +
    Number(pjki_mosquito_pean_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_mosquito_pean_jumlah").val(
    pjki_mosquito_pean_jumlah
  );
  // SISA
  let pjki_mosquito_pean_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_mosquito_pean_dipakai"
  ).val();
  let pjki_mosquito_pean_sisa =
    Number(pjki_mosquito_pean_jumlah) - Number(pjki_mosquito_pean_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_mosquito_pean_sisa").val(
    pjki_mosquito_pean_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_pean_lurus_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pean_lurus_hitungan_pertama"
  ).val();
  let pjki_pean_lurus_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pean_lurus_tambahan_slma_operasi"
  ).val();
  let pjki_pean_lurus_jumlah =
    Number(pjki_pean_lurus_hitungan_pertama) +
    Number(pjki_pean_lurus_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_pean_lurus_jumlah").val(
    pjki_pean_lurus_jumlah
  );
  // SISA
  let pjki_pean_lurus_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pean_lurus_dipakai"
  ).val();
  let pjki_pean_lurus_sisa =
    Number(pjki_pean_lurus_jumlah) - Number(pjki_pean_lurus_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_pean_lurus_sisa").val(
    pjki_pean_lurus_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_pean_bengkok_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pean_bengkok_hitungan_pertama"
  ).val();
  let pjki_pean_bengkok_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pean_bengkok_tambahan_slma_operasi"
  ).val();
  let pjki_pean_bengkok_jumlah =
    Number(pjki_pean_bengkok_hitungan_pertama) +
    Number(pjki_pean_bengkok_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_pean_bengkok_jumlah").val(
    pjki_pean_bengkok_jumlah
  );
  // SISA
  let pjki_pean_bengkok_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_pean_bengkok_dipakai"
  ).val();
  let pjki_pean_bengkok_sisa =
    Number(pjki_pean_bengkok_jumlah) - Number(pjki_pean_bengkok_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_pean_bengkok_sisa").val(
    pjki_pean_bengkok_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_duk_klem_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_duk_klem_hitungan_pertama"
  ).val();
  let pjki_duk_klem_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_duk_klem_tambahan_slma_operasi"
  ).val();
  let pjki_duk_klem_jumlah =
    Number(pjki_duk_klem_hitungan_pertama) +
    Number(pjki_duk_klem_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_duk_klem_jumlah").val(
    pjki_duk_klem_jumlah
  );
  // SISA
  let pjki_duk_klem_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_duk_klem_dipakai"
  ).val();
  let pjki_duk_klem_sisa =
    Number(pjki_duk_klem_jumlah) - Number(pjki_duk_klem_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_duk_klem_sisa").val(
    pjki_duk_klem_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_needle_holder_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_needle_holder_hitungan_pertama"
  ).val();
  let pjki_needle_holder_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_needle_holder_tambahan_slma_operasi"
  ).val();
  let pjki_needle_holder_jumlah =
    Number(pjki_needle_holder_hitungan_pertama) +
    Number(pjki_needle_holder_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_needle_holder_jumlah").val(
    pjki_needle_holder_jumlah
  );
  // SISA
  let pjki_needle_holder_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_needle_holder_dipakai"
  ).val();
  let pjki_needle_holder_sisa =
    Number(pjki_needle_holder_jumlah) - Number(pjki_needle_holder_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_needle_holder_sisa").val(
    pjki_needle_holder_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_kocher_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kocher_hitungan_pertama"
  ).val();
  let pjki_kocher_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kocher_tambahan_slma_operasi"
  ).val();
  let pjki_kocher_jumlah =
    Number(pjki_kocher_hitungan_pertama) +
    Number(pjki_kocher_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_kocher_jumlah").val(
    pjki_kocher_jumlah
  );
  // SISA
  let pjki_kocher_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kocher_dipakai"
  ).val();
  let pjki_kocher_sisa =
    Number(pjki_kocher_jumlah) - Number(pjki_kocher_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_kocher_sisa").val(pjki_kocher_sisa);
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_tambahan_1_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tambahan_1_hitungan_pertama"
  ).val();
  let pjki_tambahan_1_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tambahan_1_tambahan_slma_operasi"
  ).val();
  let pjki_tambahan_1_jumlah =
    Number(pjki_tambahan_1_hitungan_pertama) +
    Number(pjki_tambahan_1_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_tambahan_1_jumlah").val(
    pjki_tambahan_1_jumlah
  );
  // SISA
  let pjki_tambahan_1_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tambahan_1_dipakai"
  ).val();
  let pjki_tambahan_1_sisa =
    Number(pjki_tambahan_1_jumlah) - Number(pjki_tambahan_1_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_tambahan_1_sisa").val(
    pjki_tambahan_1_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_tambahan_2_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tambahan_2_hitungan_pertama"
  ).val();
  let pjki_tambahan_2_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tambahan_2_tambahan_slma_operasi"
  ).val();
  let pjki_tambahan_2_jumlah =
    Number(pjki_tambahan_2_hitungan_pertama) +
    Number(pjki_tambahan_2_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_tambahan_2_jumlah").val(
    pjki_tambahan_2_jumlah
  );
  // SISA
  let pjki_tambahan_2_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_tambahan_2_dipakai"
  ).val();
  let pjki_tambahan_2_sisa =
    Number(pjki_tambahan_2_jumlah) - Number(pjki_tambahan_2_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_tambahan_2_sisa").val(
    pjki_tambahan_2_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_needle_atrumatic_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_needle_atrumatic_hitungan_pertama"
  ).val();
  let pjki_needle_atrumatic_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_needle_atrumatic_tambahan_slma_operasi"
  ).val();
  let pjki_needle_atrumatic_jumlah =
    Number(pjki_needle_atrumatic_hitungan_pertama) +
    Number(pjki_needle_atrumatic_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_needle_atrumatic_jumlah").val(
    pjki_needle_atrumatic_jumlah
  );
  // SISA
  let pjki_needle_atrumatic_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_needle_atrumatic_dipakai"
  ).val();
  let pjki_needle_atrumatic_sisa =
    Number(pjki_needle_atrumatic_jumlah) -
    Number(pjki_needle_atrumatic_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_needle_atrumatic_sisa").val(
    pjki_needle_atrumatic_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_kassa_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kassa_hitungan_pertama"
  ).val();
  let pjki_kassa_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kassa_tambahan_slma_operasi"
  ).val();
  let pjki_kassa_jumlah =
    Number(pjki_kassa_hitungan_pertama) +
    Number(pjki_kassa_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_kassa_jumlah").val(
    pjki_kassa_jumlah
  );
  // SISA
  let pjki_kassa_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kassa_dipakai"
  ).val();
  let pjki_kassa_sisa = Number(pjki_kassa_jumlah) - Number(pjki_kassa_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_kassa_sisa").val(pjki_kassa_sisa);
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_roll_kassa_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_roll_kassa_hitungan_pertama"
  ).val();
  let pjki_roll_kassa_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_roll_kassa_tambahan_slma_operasi"
  ).val();
  let pjki_roll_kassa_jumlah =
    Number(pjki_roll_kassa_hitungan_pertama) +
    Number(pjki_roll_kassa_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_roll_kassa_jumlah").val(
    pjki_roll_kassa_jumlah
  );
  // SISA
  let pjki_roll_kassa_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_roll_kassa_dipakai"
  ).val();
  let pjki_roll_kassa_sisa =
    Number(pjki_roll_kassa_jumlah) - Number(pjki_roll_kassa_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_roll_kassa_sisa").val(
    pjki_roll_kassa_sisa
  );
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_depper_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_depper_hitungan_pertama"
  ).val();
  let pjki_depper_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_depper_tambahan_slma_operasi"
  ).val();
  let pjki_depper_jumlah =
    Number(pjki_depper_hitungan_pertama) +
    Number(pjki_depper_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_depper_jumlah").val(
    pjki_depper_jumlah
  );
  // SISA
  let pjki_depper_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_depper_dipakai"
  ).val();
  let pjki_depper_sisa =
    Number(pjki_depper_jumlah) - Number(pjki_depper_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_depper_sisa").val(pjki_depper_sisa);
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_kacang_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kacang_hitungan_pertama"
  ).val();
  let pjki_kacang_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kacang_tambahan_slma_operasi"
  ).val();
  let pjki_kacang_jumlah =
    Number(pjki_kacang_hitungan_pertama) +
    Number(pjki_kacang_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_kacang_jumlah").val(
    pjki_kacang_jumlah
  );
  // SISA
  let pjki_kacang_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_kacang_dipakai"
  ).val();
  let pjki_kacang_sisa =
    Number(pjki_kacang_jumlah) - Number(pjki_kacang_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_kacang_sisa").val(pjki_kacang_sisa);
  ////////////////////////////////////////////////////////////////////////////// PISAU
  let pjki_lidi_waten_hitungan_pertama = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_lidi_waten_hitungan_pertama"
  ).val();
  let pjki_lidi_waten_tambahan_slma_operasi = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_lidi_waten_tambahan_slma_operasi"
  ).val();
  let pjki_lidi_waten_jumlah =
    Number(pjki_lidi_waten_hitungan_pertama) +
    Number(pjki_lidi_waten_tambahan_slma_operasi);
  $("#penggunaanjumlahkasadaninstrumen-pjki_lidi_waten_jumlah").val(
    pjki_lidi_waten_jumlah
  );
  // SISA
  let pjki_lidi_waten_dipakai = $(
    "#penggunaanjumlahkasadaninstrumen-pjki_lidi_waten_dipakai"
  ).val();
  let pjki_lidi_waten_sisa =
    Number(pjki_lidi_waten_jumlah) - Number(pjki_lidi_waten_dipakai);
  $("#penggunaanjumlahkasadaninstrumen-pjki_lidi_waten_sisa").val(
    pjki_lidi_waten_sisa
  );
};

$(document).ready(function () {
  $("#pjki")
    .on("beforeSubmit", function (e) {
      e.preventDefault();
      var btn = $(".btn-submit");
      fbtn.setLoading(btn, "proses...");
      var post_data = $(this).serialize();
      var url_insert_draf =
        baseUrl + "/penggunaan-jumlah-kasa-dan-instrumen-pasien/save-insert";
      var url_insert_final =
        baseUrl +
        "/penggunaan-jumlah-kasa-dan-instrumen-pasien/save-insert-final";
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
                            "/penggunaan-jumlah-kasa-dan-instrumen-pasien?id=" +
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
                "/penggunaan-jumlah-kasa-dan-instrumen-pasien?id=" +
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
