<?php 
include 'function.php';
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
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700&display=swap"
        rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="custom.css" />
    <title>Sehat Perutku - Sistem Pakar Diagnosa Pencernaan</title>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="img/lambung.jpg" width="50" alt="logo" class="mr-3" />
                <span class="h4 mb-0 font-weight-bold">Sehat Perutku</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link font-weight-600" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-600" href="#alur">Alur Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-600" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item ml-3">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#loginModal">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </button>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="btn btn-primary" href="register.php">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="heroBWA">
        <div class="container">
            <div class="row align-items-center min-vh-100 pt-5">
                <div class="col-lg-6 fade-in-up">
                    <h1 class="display-4 font-weight-bold mb-4">
                        Periksa Kesehatan <span class="text-warning">Pencernaan</span> Anda
                    </h1>
                    <p class="lead mb-4">
                        Sistem pakar berbasis web untuk mendiagnosa gangguan pencernaan dengan teknologi Certainty Factor. 
                        Dapatkan hasil diagnosa akurat hanya dengan menjawab beberapa pertanyaan sederhana.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a class="btn btn-primary btn-lg px-4 py-3" href="register.php">
                            <i class="fas fa-play mr-2"></i>Mulai Diagnosa
                        </a>
                        <button class="btn btn-outline-light btn-lg px-4 py-3" data-toggle="modal" data-target="#loginModal">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </button>
                    </div>
                  
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <img src="img/Home.png" alt="Diagnosa Pencernaan" class="img-fluid" style="max-width: 90%;" />
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section id="alur" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 font-weight-bold text-primary mb-3">Alur Kerja Sistem</h2>
                <p class="lead text-muted">Proses diagnosa yang mudah dan cepat dalam 3 langkah sederhana</p>
            </div>
            
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-header bg-primary text-white text-center">
                            <div class="rounded-circle bg-white text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-sign-in-alt fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-0 font-weight-bold">1. Login</h5>
                        </div>
                        <img src="img/login.jpeg" class="card-img-top" alt="Login" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">
                                Daftar akun baru atau login dengan akun yang sudah ada untuk memulai proses diagnosa kesehatan pencernaan Anda.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-header bg-warning text-white text-center">
                            <div class="rounded-circle bg-white text-warning d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-clipboard-list fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-0 font-weight-bold">2. Test Gejala</h5>
                        </div>
                        <img src="img/tes.png" class="card-img-top" alt="Test" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">
                                Jawab 25 pertanyaan tentang gejala yang Anda alami dengan tingkat keyakinan yang sesuai kondisi Anda.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-header bg-success text-white text-center">
                            <div class="rounded-circle bg-white text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                            <h5 class="card-title mb-0 font-weight-bold">3. Hasil & Solusi</h5>
                        </div>
                        <img src="img/kon.jpeg" class="card-img-top" alt="Hasil" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">
                                Dapatkan hasil diagnosa berupa persentase kemungkinan penyakit beserta saran penanganan yang tepat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-4 font-weight-bold text-primary mb-4">Tentang Sehat Perutku</h2>
                    <p class="lead mb-4">
                        Sistem pakar yang menggunakan metode <strong>Certainty Factor</strong> untuk mendiagnosa 6 jenis gangguan pencernaan berdasarkan 25 gejala yang umum terjadi.
                    </p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle p-2 mr-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Akurat</h6>
                                    <small class="text-muted">Menggunakan metode CF</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle p-2 mr-3">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Cepat</h6>
                                    <small class="text-muted">Hasil dalam hitungan menit</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning rounded-circle p-2 mr-3">
                                    <i class="fas fa-shield-alt text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Aman</h6>
                                    <small class="text-muted">Data terlindungi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-info rounded-circle p-2 mr-3">
                                    <i class="fas fa-mobile-alt text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Responsif</h6>
                                    <small class="text-muted">Dapat diakses di HP</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-primary rounded-lg p-4 text-white">
                        <h4 class="font-weight-bold mb-3">Penyakit yang Dapat Didiagnosa:</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-circle mr-2" style="font-size: 0.5rem;"></i>Maag (Gastritis)</li>
                            <li class="mb-2"><i class="fas fa-circle mr-2" style="font-size: 0.5rem;"></i>GERD</li>
                            <li class="mb-2"><i class="fas fa-circle mr-2" style="font-size: 0.5rem;"></i>Irritable Bowel Syndrome</li>
                            <li class="mb-2"><i class="fas fa-circle mr-2" style="font-size: 0.5rem;"></i>Dispepsia</li>
                            <li class="mb-2"><i class="fas fa-circle mr-2" style="font-size: 0.5rem;"></i>Radang Usus</li>
                            <li class="mb-2"><i class="fas fa-circle mr-2" style="font-size: 0.5rem;"></i>Infeksi Saluran Cerna</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 Sehat Perutku. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <p class="mb-0">Sistem Pakar Diagnosa Pencernaan</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login ke Akun Anda
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form action="function.php?act=login" method="POST">
                        <div class="form-group">
                            <label for="nama" class="font-weight-600">
                                <i class="fas fa-user mr-2 text-primary"></i>Username
                            </label>
                            <input type="text" class="form-control form-control-lg" id="nama" name="nama" 
                                   placeholder="Masukkan username" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight-600">
                                <i class="fas fa-lock mr-2 text-primary"></i>Password
                            </label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" 
                                   placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" name="login_btn" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </button>
                    </form>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <p class="mb-0">Belum punya akun? 
                        <a href="register.php" class="text-primary font-weight-600">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <script>
        // Smooth scrolling for navigation links
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if( target.length ) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 70
                    }, 1000);
                }
            });
            
            // Navbar background on scroll
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
        });
    </script>
</body>
</html>