
<?php include '../../class/Database.php'?>
<?php include '../../class/Mahasiswa.php'?>

<?php
    $db          = new Database();
    $conn        = $db->getConnection();
    $mahasiswa   = new Mahasiswa($conn);

    $data_mahasiswa = $mahasiswa->getAll();

    if (isset($_GET['id'])) {
        $id     = $_GET['id'];
        $result = $mahasiswa->delete($id);

        if ($result) {
            header('Location: index.php');
        } else {
            //pesan error / gagal hapus
        }
    }
?>




<!-- Header -->
<?php include '../template/header.php'; ?>

<div class="card shadow-sm bg-white mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title fw-bolder mb-3">Data Mahasiswa</h5>
            </div>
            <div class="col-md-6 text-end">
                <a href="create.php" class="btn btn-primary mb-3">Tambah</a>
            </div>
        </div> 

        <table id="datatables" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-primary text-center">No.</th>
                    <th class="text-primary">NIM</th>
                    <th class="text-primary">Nama</th>
                    <th class="text-primary">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_mahasiswa as $key => $value): ?>
                    <tr>
                        <td class ="text-center">
                            <?php echo $key+1 ?>
                        </td>
                        <td>
                            <?php echo $value['mahasiswa_nim'] ?>
                        </td>
                        <td>
                            <?php echo $value['mahasiswa_nama'] ?>
                        </td>
                        <td>
                            <a href="update.php?id=<?php echo $value['mahasiswa_id'] ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="?id=<?php echo $value['mahasiswa_id'] ?>" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                        </td>
                    </tr>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Footer -->
<?php include '../template/footer.php'; ?>