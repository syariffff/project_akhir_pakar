<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Registrasi - Sehat Perutku</title>
    
    <style>
        :root {
            --primary-color: #0c8cc1;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --dark-color: #333;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 50px 0;
        }
        
        .register-card {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0a7ba8 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .register-body {
            padding: 40px;
        }
        
        .form-group label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 140, 193, 0.25);
        }
        
        .form-control.is-valid {
            border-color: var(--success-color);
        }
        
        .form-control.is-invalid {
            border-color: var(--danger-color);
        }
        
        .btn-register {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0a7ba8 100%);
            border: none;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
            color: white;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 140, 193, 0.3);
            color: white;
        }
        
        .login-link {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
        }
        
        .input-icon .form-control {
            padding-left: 45px;
        }
        
        .navbar-register {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .progress-indicator {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .progress-bar-register {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--success-color));
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-register fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div style="width: 40px; height: 40px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                    <i class="fas fa-stethoscope text-white"></i>
                </div>
                <span class="h5 mb-0 font-weight-bold">Sehat Perutku</span>
            </a>
            <div class="ml-auto">
                <a href="index.php" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Registration Form -->
    <div class="register-container">
        <div class="container">
            <div class="register-card">
                <div class="register-header">
                    <i class="fas fa-user-plus fa-3x mb-3"></i>
                    <h2 class="mb-0 font-weight-bold">Daftar Akun Baru</h2>
                    <p class="mb-0 opacity-75">Mulai perjalanan kesehatan pencernaan Anda</p>
                </div>
                
                <div class="register-body">
                    <!-- Progress Indicator -->
                    <div class="progress-indicator">
                        <div class="progress-bar-register" id="progressBar"></div>
                    </div>
                    
                    <form id="registrationForm" method="POST" action="function.php?act=register" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">
                                        <i class="fas fa-user text-primary mr-2"></i>Nama Lengkap
                                    </label>
                                    <div class="input-icon">
                                        <i class="fas fa-user"></i>
                                        <input type="text" class="form-control" id="nama" name="nama" 
                                               placeholder="Masukkan nama lengkap Anda" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-check mr-1"></i>Nama valid!
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-times mr-1"></i>Nama tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">
                                        <i class="fas fa-envelope text-primary mr-2"></i>Email
                                    </label>
                                    <div class="input-icon">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               placeholder="contoh@email.com" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-check mr-1"></i>Email valid!
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-times mr-1"></i>Masukkan email yang valid
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">
                                        <i class="fas fa-lock text-primary mr-2"></i>Password
                                    </label>
                                    <div class="input-icon">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" class="form-control" id="password" name="password" 
                                               minlength="8" placeholder="Minimal 8 karakter" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-check mr-1"></i>Password kuat!
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-times mr-1"></i>Password minimal 8 karakter
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>Gunakan kombinasi huruf, angka, dan simbol
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat">
                                        <i class="fas fa-map-marker-alt text-primary mr-2"></i>Alamat
                                    </label>
                                    <div class="input-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="text" class="form-control" id="alamat" name="alamat" 
                                               placeholder="Masukkan alamat lengkap" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-check mr-1"></i>Alamat valid!
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-times mr-1"></i>Alamat tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tgl_lahir">
                                        <i class="fas fa-calendar text-primary mr-2"></i>Tanggal Lahir
                                    </label>
                                    <div class="input-icon">
                                        <i class="fas fa-calendar"></i>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                                        <div class="valid-feedback">
                                            <i class="fas fa-check mr-1"></i>Tanggal lahir valid!
                                        </div>
                                        <div class="invalid-feedback">
                                            <i class="fas fa-times mr-1"></i>Pilih tanggal lahir
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Saya menyetujui <a href="#" class="text-primary">Syarat & Ketentuan</a> 
                                dan <a href="#" class="text-primary">Kebijakan Privasi</a>
                            </label>
                            <div class="invalid-feedback">
                                Anda harus menyetujui syarat dan ketentuan
                            </div>
                        </div>

                        <button type="submit" class="btn btn-register">
                            <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                        </button>
                    </form>
                </div>

                <div class="login-link">
                    <p class="mb-0">
                        Sudah punya akun? 
                        <a href="index.php" class="text-primary font-weight-bold">
                            <i class="fas fa-sign-in-alt mr-1"></i>Masuk di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Form validation and progress bar
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const progressBar = document.getElementById('progressBar');
            const inputs = form.querySelectorAll('input[required], select[required]');
            
            // Update progress bar
            function updateProgress() {
                let filledCount = 0;
                inputs.forEach(input => {
                    if (input.type === 'checkbox') {
                        if (input.checked) filledCount++;
                    } else if (input.value.trim() !== '') {
                        filledCount++;
                    }
                });
                
                const progress = (filledCount / inputs.length) * 100;
                progressBar.style.width = progress + '%';
            }
            
            // Add event listeners to all inputs
            inputs.forEach(input => {
                input.addEventListener('input', updateProgress);
                input.addEventListener('change', updateProgress);
            });
            
            // Bootstrap form validation
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
            
            // Real-time validation
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                });
            });
            
            // Phone number formatting
            const phoneInput = document.getElementById('no_hp');
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 13) {
                    value = value.slice(0, 13);
                }
                e.target.value = value;
            });
            
            // Password strength indicator
            const passwordInput = document.getElementById('password');
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const hasLetter = /[a-zA-Z]/.test(password);
                const hasNumber = /\d/.test(password);
                const hasSymbol = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
                const isLongEnough = password.length >= 8;
                
                if (isLongEnough && hasLetter && hasNumber) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });
    </script>
</body>
</html>