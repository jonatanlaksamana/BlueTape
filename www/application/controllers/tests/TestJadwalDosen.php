<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TestJadwalDosen extends CI_Controller {



    public $coverage;

    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->unit->use_strict(TRUE);
        $this->load->database();
        $this->load->model('JadwalDosen_model');
    }


    private function report() {
       
        file_put_contents('../www/application/views/TestDocuments/test_Library.html', $this->unit->report());
        file_put_contents('../www/application/views/TestDocuments/test_Library.php', $this->unit->report());

        // Output result to screen
        $statistics = [
            'Pass' => 0,
            'Fail' => 0
        ];
        $results = $this->unit->result();
        foreach ($results as $result) {


            foreach ($result as $key => $value) {
                echo "$key: $value\n";
            }
            echo "\n";
            if ($result['Result'] == 'Passed') {
                $statistics['Pass']++;
            } else {
                $statistics['Fail']++;
            }
        }
        echo "==========\n";
        foreach ($statistics as $key => $value) {
            echo "$value test(s) $key\n";
        }

        if ($statistics['Fail'] > 0) {
            exit(1);
        }
    }

    /**
     * Run all tests
     */
    public function index() {

        $this->unit->set_test_items(array('test_name', 'test_datatype' , 'res_datatype' , 'result'));
        $this->testGetAllJadwal();
        $this->testGetJadwalByUserName();
        $this->testGetNamaHari();
        $this->testGetNamaBulan();
        $this->testKolomKeHari();
        $this->testHariKeKolom();
        $this->testCekJadwalByJamMulai();
        $this->report();
    }

   



   public function testGetAllJadwal(){
        $testCase = $this->JadwalDosen_model->getAllJadwal();
        $result = $this->getAllJadwal();
        $this->unit->run($testCase,$result,__FUNCTION__);

    }

    public function getAllJadwal(){
        $query = $this->db->query('SELECT jadwal_dosen.*, bluetape_userinfo.name
        FROM jadwal_dosen
        INNER JOIN bluetape_userinfo ON jadwal_dosen.user=bluetape_userinfo.email');
        return $query->result();
   }

    public function testGetJadwalByUserName(){
        $user='jojo';
        $testCase = $this->JadwalDosen_model->getJadwalByUserName($user);
        $result = $this->getJadwalByUserName($user);
        $this->unit->run($testCase,$result,__FUNCTION__);
    }

       public function getJadwalByUserName($user){
            $query = $this->db->get_where('jadwal_dosen', array('user' => $user));
            return $query->result();
       }

    public function testGetNamaHari(){
        $testCase = $this->JadwalDosen_model->getNamaHari();
        $result = $this->getNamaHari();
        $this->unit->run($testCase,$result,__FUNCTION__);
    }

    public function getNamaHari() {
        return JadwalDosen_model::DAY_NAME;
    }

    public function testGetNamaBulan(){
        $testCase = $this->JadwalDosen_model->getNamaBulan();
        $result = $this->getNamaBulan();
        $this->unit->run($testCase,$result,__FUNCTION__);
    }

    public function getNamaBulan() {
        return JadwalDosen_model::MONTH_NAME;
    }

    public function testKolomKeHari(){
        $testCase = $this->JadwalDosen_model->kolomKeHari(1);
        $result = $this->kolomKeHari(1);
        $this->unit->run($testCase,$result,__FUNCTION__);
    }

    public function kolomKeHari($namaHari) {
        return strpos("BCDEF",$namaHari);
    }

    public function testHariKeKolom(){
        $testCase = $this->JadwalDosen_model->hariKeKolom(1);
        $result = $this->hariKeKolom(1);
        $this->unit->run($testCase,$result,__FUNCTION__);
    }

    public function hariKeKolom($col) {
        return substr("BCDEF" , $col, 1);
    }

    public function testCekJadwalByJamMulai(){
        $testCase = $this->JadwalDosen_model->cekJadwalByJamMulai(12,1,'jojo');
        $result = $this->cekJadwalByJamMulai(12,1,'jojo');
        $this->unit->run($testCase,$result,__FUNCTION__);
    }

    public function cekJadwalByJamMulai($jam_mulai,$hari,$user){
        $query = $this->db->get_where('jadwal_dosen', array('jam_mulai' => $jam_mulai, 'hari' =>$hari, 'user' =>$user ));
        return $query->result();
        
   }
}
