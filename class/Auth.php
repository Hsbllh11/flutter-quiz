<?php
    class Auth
    {
        private $db;

        public function __construct($conn)
        {
           $this->db = $conn; 
        }

        public function login($nim, $password)
        {
            $query  = "SELECT * FROM mahasiswa WHERE mahasiswa_nim = ? AND mahasiswa_password = ?";
            $exec   = $this->db->prepare($query);

            $exec->bind_param('ss', $nim, sha1($password));
            $exec->execute();

            $result  = $exec->get_result();
            if ($result->num_rows == 1) {
                $akun = $result->fetch_assoc();

                session_start();
                $_SESSION['mahasiswa_nim']      = $akun['mahasiswa_nim'];
                $_SESSION['mahasiswa_nama']     = $akun['mahasiswa_nama'];
                $_SESSION['mahasiswa_login']    = true;

                return true;
            }
            else {
                return false;
            }
        
        }

        public function logout()
        {
            session_start();
            session_unset();
            session_destroy();

            header('Locatioon: /pweb/view/template/login.php');
        }
    }

?>