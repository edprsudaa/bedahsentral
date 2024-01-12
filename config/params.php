<?php

return [
  'bsVersion' => '4.x',
  'app' => [
    'id' => 19,
    'shortName' => 'OBS',
    'longName' => 'Operasi Bedah Sentral',
    'fullName' => 'Operasi Bedah Sentral',
    'version' => 'V.1.0',
    'createAt' => '2022'
  ],
  'client' => [
    'shortName' => 'RSUD ARIFIN ACHMAD',
    'longName' => ' RSUD ARIFIN ACHMAD',
    'fullName' => 'RSUD ARIFIN ACHMAD',
    'address' => ' Jl. Diponegoro No.01',
    'telp' => '(07xx) - 2xxx, 2xxx',
    'fax' => '(07xx) - 2xxx',
    'website' => 'http://rsudarifinachmad.riau.go.id',
    'email' => 'admin@rsudarifinachmad.riau.go.id'
  ],
  'owner' => [
    'shortName' => 'RSUD ARIFIN ACHMAD',
    'longName' => ' RSUD ARIFIN ACHMAD',
    'fullName' => 'RSUD ARIFIN ACHMAD',
    'address' => ' Jl. Diponegoro No.01',
    'telp' => '(07xx) - 2xxx, 2xxx',
    'fax' => '(07xx) - 2xxx',
    'website' => 'http://rsudarifinachmad.riau.go.id',
    'email' => 'admin@rsudarifinachmad.riau.go.id'
  ],
  'setting' => [
    'kota_rs' => 'Pekanbaru',
    'adminlte' =>
    [
      'bg_color_style' => '#007bff', #28a745=>green, #e83e8c=>pink
      'color_style' => '#ffffff',
      'navbar_class' => 'main-header navbar navbar-expand navbar-white navbar-light',
      'body_class' => 'sidebar-mini layout-fixed layout-navbar-fixed accent-blue text-sm',
      'body_class_collapse' => 'sidebar-mini layout-fixed sidebar-collapse text-sm',
      'aside_sidebar_class' => 'main-sidebar sidebar-dark-secondary elevation-4',
      'card' => 'card card-outline card-info',
      'code_color_style2' => [
        'bg' => '#ffffff',
        'color' => '#007bff'
      ]
    ],
    // 'adminlte' =>
    // [
    //   'bg_color_style' => '#28a745',
    //   'color_style' => '#ffffff',
    //   'navbar_class' => 'main-header navbar navbar-expand navbar-dark navbar-green text-sm',
    //   'body_class' => 'sidebar-mini layout-fixed layout-navbar-fixed accent-green text-sm',
    //   'body_class_collapse' => 'sidebar-mini layout-fixed sidebar-collapse accent-green text-sm',
    //   'aside_sidebar_class' => 'main-sidebar elevation-4 sidebar-light-green',
    //   'card' => 'card card-outline card-success',
    //   'code_color_style2' => [
    //     'bg' => '#ffffff',
    //     'color' => '#28a745'
    //   ]
    // ],
    'paging' => [
      'size' => [
        'short' => 5,
        'medium' => 10,
        'long' => 20
      ]
    ],
    'iframe' => [
      'body_class' => 'accent-green text-sm',
    ],
    'msg_chk_allow_crud_medis_pasien' => 'Data Tidak Dapat Dihapus Lagi',
    'mapping_doc_item_clinical' => [

      'DM_0000100' => 100, //Pre operasi perawat Ruangan
      'DM_0000101' => 101, //intra operasi
      'DM_0000102' => 102, //Post operasi perawat
      'DM_0000103' => 103, //penggunaan jumlah kasa dan instrument
      'DM_0000104' => 104, //Laporan operasi
      'DM_0000105' => 105, //serah terima ruangan
      'DM_0000106' => 106, //check list keselamatan OK
      'DM_0000107' => 107, //Inform concent tindakan dokter
      'DM_0000108' => 108, //Pre operasi perawat OK
      'DM_0000109' => 109, //Pre Operasi perawat Anestesi
      'DM_0000110' => 110, //Pra Anestesi
      'DM_0000111' => 111, //Asesmen pra induksi
      'DM_0000112' => 112, //Intra Anestesi
      'DM_0000113' => 113, //Post Anestesi
      'DM_0000114' => 114, //Lokasi Operasi
      'DM_0000115' => 115, //Askep pre operasi perawat
      'DM_0000116' => 116, //Lembar Edukasi Tindakan Anestesi
    ],
    //RSAA
    'kop_doc' => [
      'nama' => 'PEMERINTAH PROVINSI RIAU',
      'namasub' => 'RSUD ARIFIN ACHMAD',
      'alamat' => 'JLN. DIPONEGORO NO. 2',
      'telp' => 'TELP. 23418, 21618, 21657 FAX. 20253',
      'kota' => 'PEKANBARU',
      'logo1' => '/images/logo_riau.png',
      'logo2' => '/images/logo.png',
      'logo3' => '/images/logo_kars.png'
    ],
    'odontogram' => '/app/images/odontogram.PNG',
    'doc' => [
      'bg_batal' => '/app/images/batal-transparan-min.png'
    ],
    'show_stock_obat_depo' => true,
  ],
  'hail812/yii2-adminlte3' => [
    'pluginMap' => [
      'icheck-bootstrap' => [
        'css' => 'icheck-bootstrap/icheck-bootstrap.min.css',
      ],
      'overlayScrollbars' => [
        'css' => 'overlayScrollbars/css/OverlayScrollbars.min.css',
        'js' => 'overlayScrollbars/js/jquery.overlayScrollbars.min.js',
      ],
      // 'pace' => [
      //   'css' => 'pace-progress/themes/green/pace-theme-corner-indicator.css',
      //   'js' => 'pace-progress/pace.min.js'
      // ],
      'pace' => [
        'css' => 'pace-progress/themes/black/pace-theme-center-circle.css',
        'js' => 'pace-progress/pace.min.js'
      ],
      'pace-iframe' => [
        'css' => 'pace-progress/themes/green/pace-theme-flat-top.css',
        'js' => 'pace-progress/pace.min.js'
      ],
      'popper' => [
        'js' => 'popper/umd/popper.min.js'
      ],
      'sweetalert2' => [
        'css' => 'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        'js' => 'sweetalert2/sweetalert2.min.js'
      ],
      'toastr' => [
        'css' => ['toastr/toastr.min.css'],
        'js' => ['toastr/toastr.min.js']
      ],
      'jquery' => [
        'css' => [],
        'js' => ['jquery/jquery.min.js']
      ],
      'jquery-ui' => [
        'css' => ['jquery-ui/jquery-ui.min.css'],
        'js' => ['jquery-ui/jquery-ui.min.js']
      ],
      'jquery-validation' => [
        'css' => [],
        'js' => ['jquery-validation/jquery-validate.min.js']
      ],
    ]
  ],
  'other' => [
    'keys' => 'EMS@123FikriUtriaMri',
    'username_root_bedah_sentral' => '1471102605960025',
    // 'username_allow_root'=>['1403092401942287'],//sso ROOT bisa akses pasien & RBAC
    // 'username_allow_admin'=>['1403092401942287'],//sso ROOT bisa akses pasien
    // 'username_monitoring_visite_ri'=>['197701132006042009','197904082008012019'],
    'gizi_anak' => [
      'jenis' => 'skrining gizi anak',
      'penilaian' => [
        [
          'id' => 'ga_q1',
          'parameter' => 'Apakah pasien tampak kurus?',
          'kriteria' =>
          [
            ['des' => 'Tidak', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Ya', 'val' => '1', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'ga_q2',
          'parameter' => 'Apakah terdapat penurunan berat 1 bulan terakhir?(Berdasarkan data objektif data berat bila ada, ATAU penilaian subjectif dari orang tua pasien ATAU untuk bayi kurang 1 tahun berat badan tidak naik selama 3 bulan terakhir)',
          'kriteria' =>
          [
            ['des' => 'Tidak', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Ya', 'val' => '1', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'ga_q3',
          'parameter' => 'Apakah terdapat salah satu dari kondisi berikut? *)Diare 25 kali/hari dan atau muntah>3 kali/hari dalam seminggu terakhir; *)Asupan makan berkurang selama 1 minggu terakhir',
          'kriteria' =>
          [
            ['des' => 'Tidak', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Ya', 'val' => '1', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'ga_q4',
          'parameter' => 'Apakah terdapat penyakit atau keadaan yang mengakibatkan pasien berisiko mengalami malnutrisi',
          'kriteria' =>
          [
            ['des' => 'Tidak', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Ya', 'val' => '2', 'pilih' => '0']
          ]
        ]
      ],
      'total_skor' => '',
      'kategori_skor' => '',
      'keterangan_skor' => '0 Rendah; 1-3 Sedang; 4-5 Tinggi'
    ],
    'down_score' => [
      'jenis' => 'down score',
      'penilaian' => [
        [
          'id' => 'ds_q1',
          'parameter' => 'Merintih',
          'kriteria' =>
          [
            ['des' => 'Tidak ada', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Terdengar dengan stetoskop', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Terdengar jelas', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'ds_q2',
          'parameter' => 'Sianosis',
          'kriteria' =>
          [
            ['des' => 'Tidak ada', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Hilang dengan O2', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Tidak hilang dengan O2', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'ds_q3',
          'parameter' => 'Retraksi',
          'kriteria' =>
          [
            ['des' => 'Tidak ada', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Ringan', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Hebat', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'ds_q4',
          'parameter' => 'Udara Masuk',
          'kriteria' =>
          [
            ['des' => 'Baik', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Penurunan ringan', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Tidak ada', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'ds_q5',
          'parameter' => 'Frekuensi Nafas',
          'kriteria' =>
          [
            ['des' => '< 60 x/mnt', 'val' => '0', 'pilih' => '0'],
            ['des' => '60-80 x/mnt', 'val' => '1', 'pilih' => '0'],
            ['des' => '> 80 x/mnt', 'val' => '2', 'pilih' => '0']
          ]
        ]
      ],
      'total_skor' => '',
      'kategori_skor' => '',
      'keterangan_skor' => '< 4 Tak ada gawat nafas ; 4-7 Gawat nafas ; >7 gagal nafas sedang terjadi, perlu pemeriksaan AGD'
    ],
    'dekubitus' => [
      'jenis' => 'resiko dekubitus',
      'penilaian' => [
        [
          'id' => 'rd_q1',
          'parameter' => 'Persepsi Sensorik',
          'kriteria' =>
          [
            ['des' => 'Keterbatasan total', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Sangat terbatas', 'val' => '2', 'pilih' => '0'],
            ['des' => 'Sedikit keterbatasan', 'val' => '3', 'pilih' => '0'],
            ['des' => 'Tidak ada gangguan', 'val' => '4', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'rd_q2',
          'parameter' => 'Kelembaban',
          'kriteria' =>
          [
            ['des' => 'Kelembaban kulit yang konstan', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Kulit yang lembab', 'val' => '2', 'pilih' => '0'],
            ['des' => 'Kulit kadang lembab', 'val' => '3', 'pilih' => '0'],
            ['des' => 'Kulit jarang lembab', 'val' => '4', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'rd_q3',
          'parameter' => 'Aktifikasi',
          'kriteria' =>
          [
            ['des' => 'Tirah baring', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Tidak mampu berjalan', 'val' => '2', 'pilih' => '0'],
            ['des' => 'Berjalan terbatas', 'val' => '3', 'pilih' => '0'],
            ['des' => 'Sering berjalan sendiri', 'val' => '4', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'rd_q4',
          'parameter' => 'Mobilisasi',
          'kriteria' =>
          [
            ['des' => 'Imobilisasi', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Sangat terbatas', 'val' => '2', 'pilih' => '0'],
            ['des' => 'Agak terbatas', 'val' => '3', 'pilih' => '0'],
            ['des' => 'Bebas', 'val' => '4', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'rd_q5',
          'parameter' => 'Nutrisi',
          'kriteria' =>
          [
            ['des' => 'Asupan nutrisi sangat buruk', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Asupan nutrisi kurang', 'val' => '2', 'pilih' => '0'],
            ['des' => 'Asupan nutrisi cukup', 'val' => '3', 'pilih' => '0'],
            ['des' => 'Asupan nutrisi baik', 'val' => '4', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'rd_q6',
          'parameter' => 'Friksi dan gesekan',
          'kriteria' =>
          [
            ['des' => 'Sering terjadi', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Berpotensi', 'val' => '2', 'pilih' => '0'],
            ['des' => 'Tidak memiliki masalah', 'val' => '3', 'pilih' => '0']
          ]
        ]
      ],
      'total_skor' => '',
      'kategori_skor' => '',
      'keterangan_skor' => 'Jika nilai < 16 (resiko tinggi dekubitus) >> Intervensi pencegahan dekubitus'
    ],
    'status_fungsional' => [
      'jenis' => 'status fungsional',
      'penilaian' => [
        [
          'id' => 'sf_q1',
          'parameter' => 'Mengendalikan rangsang defekasi (BAB)',
          'kriteria' =>
          [
            ['des' => 'Tak terkendali / tak teratur (perlu pencahar)', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Kadang-kadang tak terkendali', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q2',
          'parameter' => 'Mengendalikan Rangsang Berkemih (BAK)',
          'kriteria' =>
          [
            ['des' => 'Tak terkendali / pakai kateter', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Kadang-kadang Tak Terkendali(1 x 24 Jam)', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q3',
          'parameter' => 'Membersihkan Diri (Cuci Muka, Sisir Rambut, Sikat Gigi)',
          'kriteria' =>
          [
            ['des' => 'Butuh pertolongan', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '1', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q4',
          'parameter' => 'Penggunaan Jamban, Masuk dan Keluar (Melepaskan, Memakai Celana, Membersihkan, Menyiram)',
          'kriteria' =>
          [
            ['des' => 'Tergantung pertolongan orang lain', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Perlu pertolongan pada beberapa kegiatan, tetapi dapat mengerjakan sendiri kegiatan yang lain', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q5',
          'parameter' => 'Makan',
          'kriteria' =>
          [
            ['des' => 'Tidak mampu', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Perlu ditolong memotong makanan', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q6',
          'parameter' => 'Berubah Sikap Dari Berbaring Ke Duduk',
          'kriteria' =>
          [
            ['des' => 'Tidak mampu', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Perlu banyak bantuan untuk bias duduk (2 orang)', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Bantuan (2 orang)', 'val' => '2', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '3', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q7',
          'parameter' => 'Berpindah / Berjalan',
          'kriteria' =>
          [
            ['des' => 'Tidak mampu', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Bias (pindah) dengan kursi roda', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Berjalan dengan bantuan 1 orang', 'val' => '2', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '3', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q8',
          'parameter' => 'Memakai Baju',
          'kriteria' =>
          [
            ['des' => 'Tergantung orang lain', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Sebagian dibantu (misalnya mengancing baju)', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q9',
          'parameter' => 'Naik Turun Tangga',
          'kriteria' =>
          [
            ['des' => 'Tidak mampu', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Butuh pertolongan', 'val' => '1', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '2', 'pilih' => '0']
          ]
        ],
        [
          'id' => 'sf_q10',
          'parameter' => 'Mandi',
          'kriteria' =>
          [
            ['des' => 'Tergantung orang lain', 'val' => '0', 'pilih' => '0'],
            ['des' => 'Mandiri', 'val' => '1', 'pilih' => '0']
          ]
        ]
      ],
      'total_skor' => '',
      'kategori_skor' => '',
      'keterangan_skor' => '0-4 Ketergantungan total; 5-8 Ketergantungan berat; 9-11 Ketergantungan sedang; 12-19 Ketergantungan ringan; =20 Mandiri; '
    ],
    'nyeri' => [
      'ccpot' => [
        'jenis' => 'Critical Care Pain Observation Tools (CCPOT)',
        'penilaian' => [
          [
            'id' => 'ccpot_q1',
            'parameter' => 'Ekpresi Wajah',
            'kriteria' =>
            [
              ['des' => 'Tidak tampak kontrkasi otot wajah', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Dahi mengerut, penurunan alis mata, kontraksi wajah lain', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Kontraksi dapat diatasi dengan mata memejam cepat', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'ccpot_q2',
            'parameter' => 'Gerakan Tubuh',
            'kriteria' =>
            [
              ['des' => 'Tidak bergerak sama sekali', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Gerakan lambat, berusaha menyentuh daerah nyeri', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Berusaha mencaput selang (tube), berusaha duduk, gerakan tangan dan kaki tidak mengikuti perintah, mencoba melompat', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'ccpot_q3',
            'parameter' => 'Mengikuti Ventilator atau Terintubasi',
            'kriteria' =>
            [
              ['des' => 'Alarm tidak berbunyi ventilasi lancar', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Alarm berbunyi tetapi berhenti sendiri', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Asinkronisasi, alarm sering berbunyi', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'ccpot_q4',
            'parameter' => 'Ketegangan Otot',
            'kriteria' =>
            [
              ['des' => 'Tidak ada tahanan saat di gerakkan', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Ada tahanan saat di gerakkan', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Tahanan yang kuat sampai tidak bisa di gerakkan', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'ccpot_q5',
            'parameter' => 'Vokalisasi (Ekstubasi)',
            'kriteria' =>
            [
              ['des' => 'Bicara Normal', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Mengeluh dan mengerang', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Menangis atau berteriak', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'ccpot_q6',
            'parameter' => 'Penggunaan Analgenik / Sedatif',
            'kriteria' =>
            [
              ['des' => 'Tidak menggunakan sedatif / analgetika', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Menggunakan analgetik / sedatif intermitten', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Menggunakan analgetik / sedatif continue', 'val' => '2', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '-'
      ],
      'bps' => [
        'jenis' => 'Behavioural Pain Scale (BPS)',
        'penilaian' => [
          [
            'id' => 'bps_q1',
            'parameter' => 'Face (Wajah)',
            'kriteria' =>
            [
              ['des' => 'Tenang / Rileks', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Mengerutkan alis', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Kelopak mata tertutup', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Meringis', 'val' => '4', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'bps_q2',
            'parameter' => 'Anggota Badan Sebelah Atas',
            'kriteria' =>
            [
              ['des' => 'Tidak ada pergerakan', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Sebagian ditekuk', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Sepenuhnya ditekuk dengan fleksi jari', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Retraksi permanen', 'val' => '4', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'bps_q3',
            'parameter' => 'Ventilasi',
            'kriteria' =>
            [
              ['des' => 'Pergerakan dapat ditoleransi', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Batuk dengan pergerakan', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Melawan Ventilator', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Tidak dapat mengontrol ventilasi', 'val' => '4', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '0 = Tidak ada nyeri(no pain); 1-3= Nyeri ringan(mild pain); 4-6= Nyeri sedang(moderate pain); >6= Nyeri tak tertahankan(uncontrolled pain)'
      ],
      'nips' => [
        'jenis' => 'Neonatal-Infant Pain Scale (NIPS)',
        'penilaian' => [
          [
            'id' => 'nips_q1',
            'parameter' => 'Ekspresi Wajah',
            'kriteria' =>
            [
              ['des' => 'Wajah Tenang, Ekspresi netral', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Otot wajah tegang, alis berkerut, dagu dan rahang tegang (ekspresi wajah negatif - hidung, mulut dan alis)', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'nips_q2',
            'parameter' => 'Menangis',
            'kriteria' =>
            [
              ['des' => 'Tenang, tidak menangis', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Merengek ringan, kadang-kadang', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Bertindak kencang, menarik, melengking terus-terusan (catatan:menangis lirih mungkin dinilai jika bayi diintubasi yang dibuktikan melalui gerakan mulut dan wajah', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'nips_q3',
            'parameter' => 'Pola Pernapasan',
            'kriteria' =>
            [
              ['des' => 'Pola pernapasan bayi normal', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Tidak teratur, lebih cepat dari biasanya, tersedak, nafas tertahan', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'nips_q4',
            'parameter' => 'Lengan',
            'kriteria' =>
            [
              ['des' => 'Tidak ada kekakuan otot, gerakan tangan acak sekali-sekali', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Tegang, lengan lurus kaku dan ekstensi, ekstensi cepat, fleksi', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'nips_q5',
            'parameter' => 'Kaki',
            'kriteria' =>
            [
              ['des' => 'Tidak ada kekuatan otot, gerakan kaki acak sekali-sekali', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Tegang , kaki lurus, kaku, dan/atau ekstensi, ekstensi cepat, fleksi', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'nips_q6',
            'parameter' => 'Kesadaran',
            'kriteria' =>
            [
              ['des' => 'Tenang, tidur damai atau gerakan kaki acak yang terjaga', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Terjaga, gelisah dan meronta-ronta', 'val' => '1', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '0-2 = Nyeri ringan-tidak nyeri; 3-4 = Nyeri sedang-nyeri ringan; >4 Nyeri hebat'
      ],
      'flacc' => [
        'jenis' => 'Flacc Scale (FLACC)',
        'penilaian' => [
          [
            'id' => 'flacc_q1',
            'parameter' => 'Wajah',
            'kriteria' =>
            [
              ['des' => 'Tidak ada ekspresi yang khusus (Seperti Senyum)', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Kadang meringis atau mengerutkan dahi, menarik', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Sering/terus menerus mengerutkan dahi, rahang mengatup, dagu bergetar', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'flacc_q2',
            'parameter' => 'Kaki',
            'kriteria' =>
            [
              ['des' => 'Posisi normal / rileks', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Tidak tenang, gelisah, tegang', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Menendang / menarik diri', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'flacc_q3',
            'parameter' => 'Aktifitas',
            'kriteria' =>
            [
              ['des' => 'Berbaring tenang, posisi normal, bergerak mudah', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Menggeliat-geliat, bolak-balik, berpindah, tegang', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Posisi tubuh meringkuk, kaku / spasme atau', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'flacc_q4',
            'parameter' => 'Menangis',
            'kriteria' =>
            [
              ['des' => 'Tidak menangis', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Merintih, merengek, kadang mengeluh', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Menangis tersedu-sedu, terisak-isak, menjerit', 'val' => '2', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'flacc_q5',
            'parameter' => 'Dapat Dihibur',
            'kriteria' =>
            [
              ['des' => 'Senang , rileks', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Dapat ditenangkan dengan sentuhan, pelukan atau bicara, dapat dialihkan', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Sulit / tidak dapat ditenangkan dengan pelukan, sentuhan atau distraksi', 'val' => '2', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '0=Rileks dan nyaman; 1-3=Sedikit tidak nyaman; 4-6=Nyeri sedang; 7-10=Nyeri/Tidak nyaman yang parah'
      ],
      'vas' => [
        'jenis' => 'Visual And Scale (VAS)',
        'penilaian' => [
          [
            'id' => 'vas_q1',
            'parameter' => 'Nyeri',
            'kriteria' =>
            [
              ['des' => 'Tidak nyeri', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Nyeri sangat ringan', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Nyeri tidak nyaman', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Nyeri dapat toleransi', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Menyusahkan', 'val' => '4', 'pilih' => '0'],
              ['des' => 'Sangat menyusahkan', 'val' => '5', 'pilih' => '0'],
              ['des' => 'Nyeri hebat', 'val' => '6', 'pilih' => '0'],
              ['des' => 'Sangat hebat', 'val' => '7', 'pilih' => '0'],
              ['des' => 'Sangat menyiksa', 'val' => '8', 'pilih' => '0'],
              ['des' => 'Tidak tertahankan', 'val' => '9', 'pilih' => '0'],
              ['des' => 'Tidak dapat diungkapan', 'val' => '10', 'pilih' => '0']
            ]
          ]
        ],
        'penyebab' => '',
        'kualitas' => '',
        'penyebaran' => '',
        'keparahan' => '',
        'waktu' => '',
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '0=Rileks dan nyaman; 1-3=Sedikit tidak nyaman; 4-6=Nyeri sedang; 7-10=Nyeri/Tidak nyaman yang parah'
      ]
    ],
    'rj' => [
      'sydney_scoring' => [
        'jenis' => 'sydney scoring',
        'penilaian' => [
          [
            'id' => 'rjss_q11',
            'parameter' => 'Resiko Jatuh',
            'subparameter' => 'Apakah pasien datang kerumah sakit karena jatuh',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '6', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q12',
            'parameter' => 'Resiko Jatuh',
            'subparameter' => 'Jika tidak, Apakah pasien mengalami jatuh dalam 2 bulan terakhir',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '6', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q21',
            'parameter' => 'Status Mental',
            'subparameter' => 'Apakah pasien delirium (tidak dapat membuat keputusan, pola pikir tidak terorganisir, gangguan daya ingat)',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '14', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q22',
            'parameter' => 'Status Mental',
            'subparameter' => 'Apakah pasien diserientasi (salah menyebutkan waktu, tempat atau orang)',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '14', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q23',
            'parameter' => 'Status Mental',
            'subparameter' => 'Apakah pasien mengalami agitasi (ketakutan, gelisah dan cemas)',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '14', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q31',
            'parameter' => 'Penglihatan',
            'subparameter' => 'Apakah pasien memakai kacamata',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q32',
            'parameter' => 'Penglihatan',
            'subparameter' => 'Apakah pasien mengeluh adanya penglihatan buram',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q33',
            'parameter' => 'Penglihatan',
            'subparameter' => 'Apakah pasien mempunyai glaukoma, katarak atau degenerasi makula',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q41',
            'parameter' => 'Kebiasaan berkemih',
            'subparameter' => 'Apakah terdapat perubahan perilaku berkemih (frekuensi, urgensiinkontinensia, nokturia)',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q51',
            'parameter' => 'Transfer',
            'subparameter' => 'Transfer dari tempat tidur ke kursi dan kembali ke tempat tidur',
            'kriteria' =>
            [
              ['des' => 'Mandiri (boleh menggunakan alat bantu jalan)', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Memerlukan sedikit bantuan (1 org) / dalam pengawasan', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Memerlukan bantuan yang nyata (2 org)', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Tidak dapat duduk dengan seimbang, perlu bantuan total', 'val' => '3', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjss_q61',
            'parameter' => 'Mobilitas',
            'subparameter' => 'Mobilitas',
            'kriteria' =>
            [
              ['des' => 'Mandiri (boleh menggunakan alat bantu jalan)', 'val' => '0', 'pilih' => '0'],
              ['des' => 'Berjalan dengan bantuan 1 orang (verbal/fisik)', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Memerlukan bantuan yang nyata (2 org)', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Mobilisasi', 'val' => '3', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '0-5 = Resiko Rendah; 6-16 = Resiko Sedang; 17-30 = Resiko Tinggi',
        'langkah_pencegahan' => [
          ['id' => 'rjss_l1', 'item' => 'Pasang pagar tempat tidur', 'pilih' => '0'],
          ['id' => 'rjss_l2', 'item' => 'Memastikan bed dalam keadaan rendah', 'pilih' => '0'],
          ['id' => 'rjss_l3', 'item' => 'Roda dalam keadaan terkunci', 'pilih' => '0'],
          ['id' => 'rjss_l4', 'item' => 'Memastikan lantai tidak licin, ruangan dan toilet terang', 'pilih' => '0'],
          ['id' => 'rjss_l5', 'item' => 'Memasang stiker resiko jatuh', 'pilih' => '0'],
          ['id' => 'rjss_l6', 'item' => 'Memasang segitiga kuning pada bed dan pintu kamar', 'pilih' => '0'],
          ['id' => 'rjss_l7', 'item' => 'Memastikan lingkungan sekitar pasien aman', 'pilih' => '0'],
          ['id' => 'rjss_l8', 'item' => 'Edukasi pasien dan keluarga', 'pilih' => '0'],
          ['id' => 'rjss_l9', 'item' => 'Monitoring/observasi efek puncak obatyang diresepkan yang mempengaruhi tingkat kesadaran & keseimbangan', 'pilih' => '0'],
          ['id' => 'rjss_l10', 'item' => 'Mengawasi pasien saat dilakukan pemeriksaan diagnostik atau terapi', 'pilih' => '0'],
          ['id' => 'rjss_l11', 'item' => 'Informasikan dan mendidik pasien dan/atau anggota keluarga mengenai rencana perawatan untuk mencegah jatuh', 'pilih' => '0'],
          ['id' => 'rjss_l12', 'item' => 'Bekolaborasi dengan pasien atau keluarga untuk memberikan bantuan yang dibutuhkan pasien', 'pilih' => '0'],
          ['id' => 'rjss_l13', 'item' => 'Anjurkan pasien meminta bantuan yang diperlukan', 'pilih' => '0'],
          ['id' => 'rjss_l14', 'item' => 'Menyediakan kursi roda yang terkunci disamping bed', 'pilih' => '0']
        ]
      ],
      'morse' => [
        'jenis' => 'morse',
        'penilaian' => [
          [
            'id' => 'rjms_q1',
            'parameter' => 'Riwayat jatuh',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '25', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjms_q2',
            'parameter' => 'Diagnosis sekunder (lebih dari atau sama dengan 2 diagnosis medis)',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '15', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjms_q3',
            'parameter' => 'Alat bantu',
            'kriteria' =>
            [
              ['des' => 'Berpegangan pada perabot', 'val' => '30', 'pilih' => '0'],
              ['des' => 'Tongkat/alat penopang', 'val' => '15', 'pilih' => '0'],
              ['des' => 'Tidak ada/kursi roda/perawat/tirah baring', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjms_q4',
            'parameter' => 'Terpasang Infus',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '20', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjms_q5',
            'parameter' => 'Gaya Berjalan',
            'kriteria' =>
            [
              ['des' => 'Terganggu', 'val' => '20', 'pilih' => '0'],
              ['des' => 'Lemah', 'val' => '10', 'pilih' => '0'],
              ['des' => 'Normal/tirah baring/imobilisasi', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjms_q6',
            'parameter' => 'Status mental',
            'kriteria' =>
            [
              ['des' => 'Sering lupa akan keterbatasan yang dimiliki', 'val' => '15', 'pilih' => '0'],
              ['des' => 'Sadar akan kemampuan diri sendiri', 'val' => '0', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '0-24 = Resiko Rendah | 25-44 = Resiko Sedang | Lebih dari atau sama 45 = Resiko Tinggi',
        'langkah_pencegahan' => [
          ['id' => 'rjms_l1', 'item' => 'Pasang pagar tempat tidur', 'pilih' => '0'],
          ['id' => 'rjms_l2', 'item' => 'Memastikan bed dalam keadaan rendah', 'pilih' => '0'],
          ['id' => 'rjms_l3', 'item' => 'Roda dalam keadaan terkunci', 'pilih' => '0'],
          ['id' => 'rjms_l4', 'item' => 'Memastikan lantai tidak licin, ruangan dan toilet terang', 'pilih' => '0'],
          ['id' => 'rjms_l5', 'item' => 'Memasang stiker resiko jatuh', 'pilih' => '0'],
          ['id' => 'rjms_l6', 'item' => 'Memasang segitiga kuning pada bed dan pintu kamar', 'pilih' => '0'],
          ['id' => 'rjms_l7', 'item' => 'Memastikan lingkungan sekitar pasien aman', 'pilih' => '0'],
          ['id' => 'rjms_l8', 'item' => 'Edukasi pasien dan keluarga', 'pilih' => '0'],
          ['id' => 'rjms_l9', 'item' => 'Monitoring/observasi efek puncak obat yang diresepkan yang mempengaruhi tingkat kesadaran & keseimbangan', 'pilih' => '0'],
          ['id' => 'rjms_l10', 'item' => 'Mengawasi pasien saat dilakukan pemeriksaan diagnostik atau terapi', 'pilih' => '0'],
          ['id' => 'rjms_l11', 'item' => 'Informasikan dan mendidik pasien dan/atau anggota keluarga mengenai rencana perawatan untuk mencegah jatuh', 'pilih' => '0'],
          ['id' => 'rjms_l12', 'item' => 'Bekolaborasi dengan pasien atau keluarga untuk memberikan bantuan yang dibutuhkan pasien', 'pilih' => '0'],
          ['id' => 'rjms_l13', 'item' => 'Anjurkan pasien meminta bantuan yang diperlukan', 'pilih' => '0'],
          ['id' => 'rjms_l14', 'item' => 'Menyediakan kursi roda yang terkunci disamping bed', 'pilih' => '0']
        ]
      ],
      'humpty_dumpty' => [
        'jenis' => 'humpty dumpty',
        'penilaian' => [
          [
            'id' => 'rjhd_q1',
            'parameter' => 'Umur',
            'kriteria' =>
            [
              ['des' => 'dibawah 3 tahun', 'val' => '4', 'pilih' => '0'],
              ['des' => '3-7 tahun', 'val' => '3', 'pilih' => '0'],
              ['des' => '7-13 tahun', 'val' => '2', 'pilih' => '0'],
              ['des' => '>13 tahun', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjhd_q2',
            'parameter' => 'Jenis kelamin',
            'kriteria' =>
            [
              ['des' => 'Laki-laki', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Perempuan', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjhd_q3',
            'parameter' => 'Diagnosa',
            'kriteria' =>
            [
              ['des' => 'Kelainan neurologi', 'val' => '4', 'pilih' => '0'],
              ['des' => 'Perubahan dalam oksigenasi', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Masalah saluran nafas, dehidrasi, anemia, anoreksia, sinkop/sakit kepala dan lain-lain', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Diagnosis lainya', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjhd_q4',
            'parameter' => 'Gangguan kognitif',
            'kriteria' =>
            [
              ['des' => 'Tidak menyadari keterbatasan dirinya', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Lupa akan adanya keterbatasan', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Orientasi baik terhadap diri sendiri', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjhd_q5',
            'parameter' => 'Faktor lingkungan',
            'kriteria' =>
            [
              ['des' => 'Riwayat jatuh/bayi diletakkan ditempat tidur dewasa', 'val' => '4', 'pilih' => '0'],
              ['des' => 'Pasien menggunakan alat bantu/bayi diletakkan dalam tempat dalam tempat tidur bayi/perabot rumah', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Pasien diletakkan ditempat tidur', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Diluar ruang rawat', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjhd_q6',
            'parameter' => 'Respon terhadap pembedahan/sedasi/anastesi',
            'kriteria' =>
            [
              ['des' => 'Dalam 24 jam', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Dalam 48 jam', 'val' => '2', 'pilih' => '0'],
              ['des' => '> 48 jam atau tidak menjalani pembedahan/sedasi/anastesi', 'val' => '1', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjhd_q7',
            'parameter' => 'Respon terhadap penggunaan obat',
            'kriteria' =>
            [
              ['des' => 'Penggunaan multipel: sedatif,obat hipnosis barbiturat, fenotiazin, antidepresan, pencahar, diuretik, narkose', 'val' => '3', 'pilih' => '0'],
              ['des' => 'Penggunaan salah satu obat : sedatif, obat hipnosis barbiturat, fenotiazin, antidepresan, pencahar, diuretik, narkose', 'val' => '2', 'pilih' => '0'],
              ['des' => 'Penggunaan medikasi lainnya atau tidak ada medikasi', 'val' => '1', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '7-16 = Resiko Rendah | Lebih dari atau sama 17 = Resiko Tinggi | Skor Minimal 7 | Skor Maksimal 23',
        'langkah_pencegahan' => [
          ['id' => 'rjhd_l1', 'item' => 'Resiko Rendah > Pastikan bel mudah terjangkau, roda tempat tidur pada terkunci, posisikan tempat tidur pada posisi terendah dan pagar', 'pilih' => '0'],
          ['id' => 'rjhd_l2', 'item' => 'Resiko Rendah > Pencegahan jatuh akibat kecelakaan', 'pilih' => '0'],
          ['id' => 'rjhd_l3', 'item' => 'Resiko Rendah > Pastikan lingkungan aman', 'pilih' => '0'],
          ['id' => 'rjhd_l4', 'item' => 'Resiko Rendah > edukasi pasien dan keluarga', 'pilih' => '0'],
          ['id' => 'rjhd_l5', 'item' => 'Resiko Tinggi > Lakukan semua pedoman pencegahan pada resiko rendah', 'pilih' => '0'],
          ['id' => 'rjhd_l6', 'item' => 'Resiko Tinggi > Pasangkan stiker kuning resiko jatuh, berikan tanda segitiga kuning resiko jatuh ditempat tidur pasien dan beri tanda segitiga kuning resiko jatuh dipintu kamar pasien', 'pilih' => '0'],
          ['id' => 'rjhd_l7', 'item' => 'Resiko Tinggi > Strategi proteksi dari jatuh > Monitoring', 'pilih' => '0'],
          ['id' => 'rjhd_l8', 'item' => 'Resiko Tinggi > Strategi proteksi dari jatuh > Proteksi jatuh dari tempat tidur/kursi, proteksi dari lingkungan yang berbahaya, proteksi dari cedera', 'pilih' => '0'],
          ['id' => 'rjhd_l9', 'item' => 'Resiko Tinggi > Strategi pencegahan jatuh > Transfer pasien dengan aman', 'pilih' => '0'],
          ['id' => 'rjhd_l10', 'item' => 'Resiko Tinggi > Strategi pencegahan jatuh > Cegah B.A.K yang urgen', 'pilih' => '0'],
          ['id' => 'rjhd_l11', 'item' => 'Resiko Tinggi > Strategi pencegahan jatuh > Evaluasi kemampuan komunikasi', 'pilih' => '0'],
          ['id' => 'rjhd_l12', 'item' => 'Resiko Tinggi > Strategi pencegahan jatuh > latihan/exercise keseimbangan', 'pilih' => '0']
        ]
      ],
      'get_up_and_go' => [
        'jenis' => 'get up and go',
        'penilaian' => [
          [
            'id' => 'rjgu_q1',
            'parameter' => 'Cara berjalan pasien (salah satu atau lebih) : 1.Tidak seimbang/sempoyongan/limbung; 2.Jalan menggunakan alat bantu (kruk,tripot,kursi roda,brangkar, orang lain)',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'rjgu_q2',
            'parameter' => 'Menopang saat akan duduk : tampak memegang pinggiran kursi atau meja / benda lain sebagai penopang saat akan duduk',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '1', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '1 & 2 Tidak Ditemukan = Tidak Berisiko |1 / 2 Ditemukan = Resiko Rendah | 1 & 2 Ditemukan = Resiko Tinggi',
        'langkah_pencegahan' => [
          ['id' => 'rjgu_l1', 'item' => 'Tidak ada Tindakan (Tidak Berisiko)', 'pilih' => '0'],
          ['id' => 'rjgu_l2', 'item' => 'Edukasi (Resiko Rendah/Resiko Tinggi)', 'pilih' => '0'],
          ['id' => 'rjgu_l3', 'item' => 'Pasang Stiker Kuning (Resiko Tinggi)', 'pilih' => '0']
        ]
      ],
      'hd' => [
        'jenis' => 'hemodialisis',
        'penilaian' => [
          [
            'id' => 'hd_q1',
            'parameter' => 'Riwayat jatuh yang baru atau dalam bulan terakhir',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '25', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'hd_q2',
            'parameter' => 'Diagnosis medis sekunder > 1',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '15', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'hd_q3',
            'parameter' => 'Alat bantu',
            'kriteria' =>
            [
              ['des' => 'Furnitur', 'val' => '30', 'pilih' => '0'],
              ['des' => 'Tongkat/alat penopang', 'val' => '15', 'pilih' => '0'],
              ['des' => 'Berest', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'hd_q4',
            'parameter' => 'Memakai Terapi Heparin Lock/iv',
            'kriteria' =>
            [
              ['des' => 'Ya', 'val' => '20', 'pilih' => '0'],
              ['des' => 'Tidak', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'hd_q5',
            'parameter' => 'Cara Berjalan/Berpindah',
            'kriteria' =>
            [
              ['des' => 'Terganggu', 'val' => '30', 'pilih' => '0'],
              ['des' => 'Lemah', 'val' => '15', 'pilih' => '0'],
              ['des' => 'Normal/Berest/imobilisasi', 'val' => '0', 'pilih' => '0']
            ]
          ],
          [
            'id' => 'hd_q6',
            'parameter' => 'Status mental',
            'kriteria' =>
            [
              ['des' => 'Lupa keterbatasan', 'val' => '15', 'pilih' => '0'],
              ['des' => 'Orientasi sesuai kemampuan', 'val' => '0', 'pilih' => '0']
            ]
          ]
        ],
        'total_skor' => '',
        'kategori_skor' => '',
        'keterangan_skor' => '0-24 = Tidak Berisiko | 25-50 = Resiko Rendah | Lebih dari atau sama 51 = Resiko Tinggi',
        'langkah_pencegahan' => []
      ]
    ]
  ]
];
