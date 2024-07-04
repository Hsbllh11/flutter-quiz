<?php
    session_start();
    if (!isset($_SESSION['mahasiswa_login']) || $_SESSION['mahasiswa_login'] !== true) {
        header('Location: /pweb/view/template/login.php');
    } 

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        include '../../class/Database.php';
        include '../../class/Auth.php';

        $db     = new Database();
        $conn   = $db->getConnection();
        $auth   = new Auth($conn);

        $auth->logout();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Datatables Bootstrap 5 -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css">
</head>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark" style="height: 80px;">
        <div class="container-fluid">
          <a class="navbar-brand" fw-bolder fs-3 href="#">Pemrograman Web</a>
          <div class="collapse navbar-collapse ms-auto " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item me-2 my-1">
                <a class="btn btn-lg btn-light fw-bolder" href="#">Profil</a>
              </li>
              <li class="nav-item me-2 my-1">
                <a class="btn btn-lg btn-light fw-bolder" href="/pweb/view/template/header.php?action=logout">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <main class="d-flex flex-nowrap bg-body-secondary" style="min-height: calc(100vh - 80px);">
            <div class="d-flex flex-column flex-shrink-0 text-white bg-secondary" style="width: 280px;"> 
                <a href="#" class="align-items-center ps-4 py-2 text-decoration-none text-white">
                    <span class="fs-5 d-block fw-bolder">Alya</span>
                    <span class="fs-6">Administrator</span>
                </a>
                <hr class="my-2">
                <ul class="nav nav-pills flex-column mb-auto">
                    <?php
                        $direktori = dirname($_SERVER['REQUEST_URI']);
                        // /pweb/view/dashboard

                        $lastPath = basename($direktori)
                        //dashboard
                    ?>
                    <li>
                        <a href="/pweb/view/dashboard/index.php" class="py-3 ps-4 
                        nav-link fw-bolder text-white rounded-0 <?php echo $lastPath =='dashboard' ? 'bg-dark' : '' ?>">
                            <i class=" me-2 bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/pweb/view/mahasiswa/index.php" class="py-3 ps-4
                         nav-link fw-bolder text-white rounded-0  <?php echo $lastPath =='mahasiswa' ? 'bg-dark' : '' ?>">
                            <i class=" me-2 bi bi-people"></i> Mahasiswa
                        </a>
                    </li>
                    
                </ul>
            </div>

            <div class="container-fluid d-flex flex-column m-0 p-0">
                <div class="content-header p-3">
                    <span class="fs-3 fw-bolder">
                        <?php echo ucfirst($lastPath)?>
                    </span>
                </div>
                <div class="content-body mb-3 pt-4 px-3">