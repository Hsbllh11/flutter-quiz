<?php

    class Mahasiswa {
        private $db;

        public function __construct($conn) {
            $this->db = $conn;
        }

        public function getAll() {
            $query = "SELECT * FROM mahasiswa";
            $result = $this->db->query($query);

            $mahasiswa = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $mahasiswa[] = $row;
                }
            }

            return $mahasiswa;
        }

        public function create($nim, $nama) {
            $query  = "INSERT INTO mahasiswa (mahasiswa_nim, mahasiswa_nama) VALUES (?,?)";
            $exec   = $this->db->prepare($query);

            $exec->bind_param('ss', $nim, $nama);
            return $exec->execute();
        }

        public function getDetail($id) {
            $query = "SELECT * FROM mahasiswa WHERE mahasiswa_id = ?";
            $exec   = $this->db->prepare($query);
            $exec->bind_param('i', $id);
            $exec->execute();

            $result = $exec->get_result();
            return $result->fetch_assoc();

        }

        public function update($id, $nim, $nama) {
            $query  = "UPDATE mahasiswa SET mahasiswa_nim = ?, mahasiswa_nama = ? 
                    WHERE mahasiswa_id = ?";
            $exec   = $this->db->prepare($query);

            $exec->bind_param('ssi', $nim,$nama, $id);
            return $exec->execute();
        }

        public function delete($id) {
            $query  = "DELETE FROM mahasiswa WHERE mahasiswa_id = ?";
            $exec   = $this->db->prepare($query);

            $exec->bind_param('i', $id);
            return $exec->execute();
        }
    }
?>