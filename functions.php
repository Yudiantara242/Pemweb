<?php
$conn = mysqli_connect("localhost", "root", "", "toko_online");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;

    $id = htmlspecialchars($data["id_pegawai"]);
    $nama = htmlspecialchars($data["nama_pegawai"]);
    $alamat = htmlspecialchars($data["alamat_pegawai"]);
    $notelp = htmlspecialchars($data["notelp_pegawai"]);
    $jabatan = htmlspecialchars($data["jabatan"]);

    $gambar = upload();
    if(!$gambar){
        return false;
    }
    $query = "INSERT INTO pegawai VALUES ('$id', '$nama', '$alamat', '$notelp', '$jabatan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
function upload(){
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if( $error === 4){
        echo "
    <script>
        alert('pilih gambar terlebih dahulu');
    </script>
    ";
    return false;
    }
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if(!in_array($ekstensigambar, $ekstensigambarvalid)){
        echo "
        <script>
            alert('Yang anda upload bukan gambar');
        </script>
        ";
        return false;
    }
if($ukuranfile > 1000000){
    echo "
    <script>
        alert('Ukuran gambar maksimal 1MB');
    </script>
    ";
    return false;
}
$namafilebaru = uniqid();
$namafilebaru .= '.';
$namafilebaru .= $ekstensigambar;

move_uploaded_file($tmpName, 'img/' . $namafile);
return $namafile;

}


function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM pegawai WHERE id_pegawai = '$id'");
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id = htmlspecialchars($data["id_pegawai"]);
    $nama = htmlspecialchars($data["nama_pegawai"]);
    $alamat = htmlspecialchars($data["alamat_pegawai"]);
    $notelp = htmlspecialchars($data["notelp_pegawai"]);
    $jabatan = htmlspecialchars($data["jabatan"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);

    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarlama;
    }else{
    $gambar = upload();
    }
    $query = "UPDATE pegawai SET nama_pegawai = '$nama', alamat_pegawai = '$alamat', notelp_pegawai = '$notelp', jabatan = '$jabatan' WHERE id_pegawai = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
function cari($keyword){
    $query = "SELECT * FROM pegawai WHERE nama_pegawai LIKE '%$keyword%' OR id_pegawai LIKE '%$keyword%' OR jabatan LIKE '%$keyword%'";
    return query($query);
}
function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

   $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "
        <script>
            alert('Username tidak dapat digunakan');
        </script>
        "; 
        return false;
    }

    if($password !== $password2){
        echo "
        <script>
            alert('Password tidak sesuai');
        </script>
        ";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");
    return mysqli_affected_rows($conn);

}


?>