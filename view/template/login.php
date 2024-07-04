
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nim        = $_POST['mahasiswa_nim'];
        $password   = $_POST['mahasiswa_password'];

        include '../../class/Database.php';
        include '../../class/Auth.php';

        $db     = new Database();
        $conn   = $db->getConnection();
        $auth   = new Auth($conn);

        $result = $auth->login($nim, $password);
        if ($result) {
            header('Location: /pweb/view/dashboard/index.php');
        }
        else {
            header('Location: /pweb/view/template/login.php');
        }
    }

    session_start();
    if (isset($_SESSION['mahasiswa_login']) && $_SESSION['mahasiswa_login'] === true) {
        header('Location: /pweb/view/dashboard/index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body class="vh-100 d-flex align-items-center bg-body-secondary">
    <main class="w-100 m-auto p-3">
        <div class="row">
            <div class="col-md-4 offset-md-4 px-5">
                <div class="card shadow-sm bg-white">
                    <div class="card-body">
                        <h3 class="card-title fw-bolder text-center mb-3">
                            Pemrograman Web
                        </h3>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control mb-3" id="mahasiswa_nim" name="mahasiswa_nim" placeholder="NIM">
                                <div class="invalid-feedback ps-2"></div>
                                <label for="mahasiswa_nim">NIM</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="Password" class="form-control mb-3" id="mahasiswa_password" name="mahasiswa_password" placeholder="Password">
                                <div class="invalid-feedback ps-2"></div>
                                <label for="mahasiswa_password">Password</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                var valid = true;

                var inputs = [
                    {id: '#mahasiswa_nim', pattern: /^\d{10}$/, error: '<b>NIM</b> harus 10 angka.'},
                    {id: '#mahasiswa_password', pattern: /^.{6,}$/, error: '<b>Paassword</b> minimal 6 karakter.'},
                ];

                inputs.forEach(function(input){
                    var byId = $(input.id);
                    byId.removeClass('is-valid is-invalid');
                    byId.next('.invalid-feedback').html('');

                    if (!input.pattern.test(byId.val())) {
                        byId.addClass('is-invalid');
                        byId.next('.invalid-feedback').html(input.error);

                        valid = false;
                    }
                    else {
                        byId.addClass('is-valid');
                    }
                })

                return valid;
            })
        })
    </script>
</body>
</html>