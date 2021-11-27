<?php

class M_Apipeserta extends CI_Model {

    function getPesertaByNIK($NIK){
        $query = $this->db->query("
            SELECT 
                nik as nik,
                nama as nama, 
                email as email,
                jenis_kelamin as jeniskelamin
            FROM table_peserta
            WHERE nik = '".$NIK."'
        ");
        return $query->result();
    }
}

?>