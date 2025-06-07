<?php
session_start();
$koneksi = mysqli_connect('localhost', 'root', '', 'db_pencernaan');

if (mysqli_connect_error()) {
    echo "Koneksi Database Gagal : " . mysqli_connect_error();
}

if (isset($_GET["act"])) {
    $act = $_GET["act"];
    if ($act == "register") {
        register();
    } else if ($act == "login") {
        login();
    }  else if($act == "ulang"){
        ulang();
    }
}

function ulang(){
    session_unset();
    session_destroy();
    header("Location: test.php");
}

function register()
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $query_user = "INSERT INTO user VALUES ('','1','$nama', '$email', '$alamat', '$tgl_lahir','$password')";
    $exe = mysqli_query($koneksi, $query_user);

    if (!$exe) {
        die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    } else {
        // echo "<script type='text/javascript'> success(); </script>";
        echo "<script>
        alert('Berhasil Registrasi! Silahkan Login');
        document.location.href = 'index.php';
            </script>";
    }
}

function login() {
    global $koneksi;
    $nama = htmlspecialchars($_POST["nama"]);
    $input_pass = htmlspecialchars($_POST['password']);
    
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE nama = '$nama'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $password = $data['password'];
        $role = $data['role'];

        if (password_verify($input_pass, $password)) {
            $_SESSION['role'] = $role;
            if ($role == "1") {
                echo "<script>document.location.href = 'test.php';</script>";
            } elseif ($role == "0") {
                echo "<script>document.location.href = 'indexAdmin.php';</script>";
            }
        } else {
            echo "<script>
                alert('Password salah!');
                document.location.href = 'index.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Username tidak ditemukan!');
            document.location.href = 'index.php';
        </script>";
    }
}


function gejala($id_penyakit){
    global $koneksi;
    $query = "SELECT relasi.id_gejala as id_gejala FROM relasi INNER JOIN gejala ON relasi.id_gejala = gejala.id_gejala INNER JOIN penyakit ON relasi.id_penyakit = penyakit.id_penyakit WHERE relasi.id_penyakit = '$id_penyakit' ";
    $data = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($data);
    
    return $row['id_gejala'];
}


?>