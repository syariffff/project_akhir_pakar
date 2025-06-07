<?php 
include 'function.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
        exit();
    } 
}

if(!isset($_SESSION['jawaban_cf'])){
    $_SESSION['jawaban_cf'] = [];
}

// Proses jawaban dengan CF
if(isset($_POST['submit_jawaban'])) {
    if (!isset($_SESSION['id_gejala'])) {
        $_SESSION['id_gejala'] = 1;
    }

    $id_gejala = $_SESSION['id_gejala'];
    $jawaban_cf = $_SESSION['jawaban_cf'];
    
    // Simpan jawaban CF user
    if(isset($_POST['tingkat_keyakinan'])){
        $jawaban_cf[$id_gejala] = floatval($_POST['tingkat_keyakinan']);
    } else {
        $jawaban_cf[$id_gejala] = 0; // Jika tidak ada jawaban, set 0
    }

    $_SESSION['jawaban_cf'] = $jawaban_cf;
    $_SESSION['id_gejala'] = $id_gejala + 1;

    // Jika sudah selesai semua gejala (25 gejala)
    if($_SESSION['id_gejala'] > 25){
        // Basis pengetahuan CF pakar untuk setiap penyakit dan gejala
        $cf_penyakit = [
            'maag' => [
                1 => 0.8,   // Nyeri perut
                2 => 0.7,   // Mual
                3 => 0.6,   // Muntah
                4 => 0.5,   // Perut kembung
                5 => 0.4,   // Heartburn
            ],
            'gerd' => [
                6 => 0.9,   // Nyeri dada
                7 => 0.8,   // Sulit menelan
                8 => 0.7,   // Batuk kering
                9 => 0.6,   // Regurgitasi
                10 => 0.5,  // Suara serak
            ],
            'iritableBowel' => [
                11 => 0.8,  // Diare
                12 => 0.7,  // Konstipasi
                13 => 0.6,  // Perubahan pola BAB
                14 => 0.5,  // Lendir pada tinja
            ],
            'dispepsia' => [
                15 => 0.7,  // Cepat kenyang
                16 => 0.8,  // Nyeri ulu hati
                17 => 0.6,  // Sendawa berlebihan
            ],
            'radangUsus' => [
                18 => 0.9,  // Darah pada tinja
                19 => 0.8,  // Diare berdarah
                20 => 0.7,  // Demam
            ],
            'infeksiSaluranCerna' => [
                21 => 0.8,  // Diare akut
                22 => 0.9,  // Demam tinggi
                23 => 0.7,  // Muntah hebat
                24 => 0.6,  // Lemas
                25 => 0.5,  // Dehidrasi
            ]
        ];
        
        // Hitung CF untuk setiap penyakit
        $hasil_cf = [];
        
        foreach ($cf_penyakit as $penyakit => $gejala_cf) {
            $cf_gabungan = 0;
            
            foreach ($gejala_cf as $id_gejala_cf => $cf_pakar) {
                if (isset($_SESSION['jawaban_cf'][$id_gejala_cf]) && $_SESSION['jawaban_cf'][$id_gejala_cf] > 0) {
                    $cf_user = $_SESSION['jawaban_cf'][$id_gejala_cf];
                    $cf_gejala = $cf_pakar * $cf_user;
                    
                    // Kombinasi CF menggunakan rumus CF(A,B) = CF(A) + CF(B) * (1 - CF(A))
                    if ($cf_gabungan == 0) {
                        $cf_gabungan = $cf_gejala;
                    } else {
                        $cf_gabungan = $cf_gabungan + $cf_gejala * (1 - $cf_gabungan);
                    }
                }
            }
            
            $hasil_cf[$penyakit] = round($cf_gabungan * 100, 2);
        }
        
        // Simpan hasil ke session
        $_SESSION['maag'] = $hasil_cf['maag'];
        $_SESSION['gerd'] = $hasil_cf['gerd'];
        $_SESSION['iritableBowel'] = $hasil_cf['iritableBowel'];
        $_SESSION['dispepsia'] = $hasil_cf['dispepsia'];
        $_SESSION['radangUsus'] = $hasil_cf['radangUsus'];
        $_SESSION['infeksiSaluranCerna'] = $hasil_cf['infeksiSaluranCerna'];

        header("Location: hasil.php");
        exit();
    }
}

if(!isset($_SESSION['id_gejala'])){
    $id = gejala(1); 
    $_SESSION['id_gejala'] = intval($id);
}
$id_gejala = $_SESSION['id_gejala'];

$data = mysqli_query($koneksi, "SELECT gejala FROM gejala WHERE id_gejala = '$id_gejala'");
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"/>
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
    rel="stylesheet"/>
    <link rel="stylesheet" href="custom.css" />
    <title>Cek Pencernaanmu Yuk!</title>
    <style>
        .card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-check-input {
            display: none;
        }
        .form-check-input:checked + .form-check-label .card {
            border-width: 3px;
            box-shadow: 0 0 15px rgba(0,123,255,0.4);
            transform: translateY(-3px) scale(1.02);
        }
        /* Button press effect - background color change */
        .option-card:active {
            background-color: #e3f2fd !important;
            transform: translateY(1px);
            transition: all 0.1s ease;
        }
        .border-success:active {
            background-color: #e8f5e8 !important;
        }
        .border-info:active {
            background-color: #e1f5fe !important;
        }
        .border-warning:active {
            background-color: #fff8e1 !important;
        }
        .border-primary:active {
            background-color: #e3f2fd !important;
        }
        .border-danger:active {
            background-color: #ffebee !important;
        }
        .progress {
            height: 10px;
        }
        .pressed {
            background-color: #e3f2fd !important;
            transform: translateY(1px);
        }
        .border-success.pressed {
            background-color: #e8f5e8 !important;
        }
        .border-info.pressed {
            background-color: #e1f5fe !important;
        }
        .border-warning.pressed {
            background-color: #fff8e1 !important;
        }
        .border-primary.pressed {
            background-color: #e3f2fd !important;
        }
        .border-danger.pressed {
            background-color: #ffebee !important;
        }
    </style>
</head>
<body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="img/lambung.jpg" width="60" alt="logo" class="mr-2" />
            <span class="h5 mb-0">Sehat Perutku</span>
            </a>
            <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="btn px-2 py-2 btn-success ml-2" href="function.php?act=ulang" role="button">Cek Ulang</a>
                    </li>
                    <li>
                        <a class="btn px-2 py-2 btn-primary ml-2" href="logout.php" role="button">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="test mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 align-self-center">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Pertanyaan Diagnosa</h3>
                            <small>Pertanyaan <?= $id_gejala ?> dari 25</small>
                        </div>
                        <div class="card-body">
                            <?php if(isset($row['gejala'])) { ?>
                            <form action="" method="post">
                                <h4 class="mb-4">
                                    Seberapa yakin Anda mengalami gejala: <br>
                                    <strong class="text-primary"><?= $row['gejala']; ?></strong> ?
                                </h4>
                                
                                <div class="form-group mb-4">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input class="form-check-input" type="radio" name="tingkat_keyakinan" value="0" id="tidak_yakin" checked>
                                            <label class="form-check-label w-100" for="tidak_yakin">
                                                <div class="card border-success option-card">
                                                    <div class="card-body text-center">
                                                        <div class="h5 text-success">Tidak Yakin</div>
                                                        <small class="text-muted">0% - Tidak mengalami</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input class="form-check-input" type="radio" name="tingkat_keyakinan" value="0.25" id="kurang_yakin">
                                            <label class="form-check-label w-100" for="kurang_yakin">
                                                <div class="card border-info option-card">
                                                    <div class="card-body text-center">
                                                        <div class="h5 text-info">Kurang Yakin</div>
                                                        <small class="text-muted">25% - Mungkin mengalami</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input class="form-check-input" type="radio" name="tingkat_keyakinan" value="0.5" id="cukup_yakin">
                                            <label class="form-check-label w-100" for="cukup_yakin">
                                                <div class="card border-warning option-card">
                                                    <div class="card-body text-center">
                                                        <div class="h5 text-warning">Cukup Yakin</div>
                                                        <small class="text-muted">50% - Kemungkinan besar</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input class="form-check-input" type="radio" name="tingkat_keyakinan" value="0.75" id="yakin">
                                            <label class="form-check-label w-100" for="yakin">
                                                <div class="card border-primary option-card">
                                                    <div class="card-body text-center">
                                                        <div class="h5 text-primary">Yakin</div>
                                                        <small class="text-muted">75% - Hampir pasti</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <input class="form-check-input" type="radio" name="tingkat_keyakinan" value="1.0" id="sangat_yakin">
                                            <label class="form-check-label w-100" for="sangat_yakin">
                                                <div class="card border-danger option-card">
                                                    <div class="card-body text-center">
                                                        <div class="h5 text-danger">Sangat Yakin</div>
                                                        <small class="text-muted">100% - Pasti mengalami</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" name="submit_jawaban" class="btn btn-primary btn-lg px-5">
                                        <?= ($id_gejala == 25) ? 'Selesai & Lihat Hasil' : 'Lanjut ke Pertanyaan Berikutnya' ?>
                                    </button>
                                </div>
                            </form>
                            <?php } else { ?>
                            <div class="alert alert-warning">
                                <p>Data gejala tidak ditemukan. Silakan hubungi administrator.</p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Progress Diagnosa</span>
                                <span><?= round(($id_gejala-1)/25 * 100) ?>%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" 
                                     style="width: <?= round(($id_gejala-1)/25 * 100) ?>%" 
                                     aria-valuenow="<?= round(($id_gejala-1)/25 * 100) ?>" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <img width="100%" src="img/tes.png" alt="tes" class="img-fluid mb-4" />
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Petunjuk Penggunaan</h5>
                            <p class="card-text">
                                Jawab setiap pertanyaan dengan tingkat keyakinan Anda:
                            </p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Tidak Yakin</span>
                                    <span class="badge badge-success">0%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Kurang Yakin</span>
                                    <span class="badge badge-info">25%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Cukup Yakin</span>
                                    <span class="badge badge-warning">50%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Yakin</span>
                                    <span class="badge badge-primary">75%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Sangat Yakin</span>
                                    <span class="badge badge-danger">100%</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Enhanced interactivity untuk pilihan
            $('input[type="radio"]').change(function() {
                // Reset semua card
                $('.option-card').removeClass('border-primary').removeClass('selected');
                // Highlight card yang dipilih
                $(this).siblings('label').find('.card').addClass('selected');
            });
            
            // Add click effect for better user feedback
            $('.option-card').on('mousedown', function() {
                $(this).addClass('pressed');
            });
            
            $('.option-card').on('mouseup mouseleave', function() {
                $(this).removeClass('pressed');
            });
            
            // Trigger radio button when card is clicked
            $('.option-card').click(function(e) {
                e.preventDefault();
                const radioId = $(this).closest('label').attr('for');
                $('#' + radioId).prop('checked', true).trigger('change');
            });
        });
    </script>
</body>
</html>