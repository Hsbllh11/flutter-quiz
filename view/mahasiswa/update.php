<?php include '../../class/Database.php'?>
<?php include '../../class/Mahasiswa.php'?>

<?php
    $db          = new Database();
    $conn        = $db->getConnection();
    $mahasiswa   = new Mahasiswa($conn);

    if (!isset($_GET['id'])) {
        header('Location: index.php');
    } else{
        $id = $_GET['id'];
    }

    $detail = $mahasiswa->getDetail($id);
    if (!$detail) {
        header('Location: index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nim    = $_POST['mahasiswa_nim'];
        $nama   = $_POST['mahasiswa_nama'];

        $result = $mahasiswa->update($id, $nim, $nama);
        if ($result) {
            header('Location: index.php');
        } else {
            // error, pesan, validasi
        }
    }
?>

<!-- Header -->
<?php include '../template/header.php'?>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm bg-white">
            <div class="card-body">
                <h5 class="card-title fw-bolder mb-3">
                    Ubah Data Mahasiswa
                </h5>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id=' .$id ?>">
                <div class="mb-3">
                    <label class="form-label" for="mahasiswa_nim">NIM</label>
                    <input class="form-control" type="text" id="mahasiswa_nim" name="mahasiswa_nim"
                     value="<?php echo $detail['mahasiswa_nim']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="mahasiswa_nama">Nama</label>
                    <input class="form-control" type="text" id="mahasiswa_nama" name="mahasiswa_nama" 
                    value="<?php echo $detail['mahasiswa_nama']?>">
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include '../template/footer.php'?>