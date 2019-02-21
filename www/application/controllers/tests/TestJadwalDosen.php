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
        
        $str = '
<table border="0"  cellpadding="4" cellspacing="1">
{rows}
        <tr>
                <td></td>
                <td></td>
        </tr>
<br>
 

</table>';
        $this->unit->set_template($str);
       
        file_put_contents('../www/application/views/TestDocuments/testjadwaldosen.html', $this->unit->report());
        //file_put_contents('../www/application/views/TestDocuments/test_Library.php', $this->unit->report());

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
        //$this->testRequestBy();
        $this->testAddJadwal();
        $this->testUpdateJadwal();
        $this->report();
    }

   



    public function testRequestBy(){

        $this->db->where('requestByEmail', 'fikrizzaki');
        $this->db->from('jadwal_dosen');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();
        $ex=  $query->result();
        $testCase = $this->JadwalDosen_model->requestBy('fikrizzaki' , null , null );
        $this->unit->run($testCase,$ex,__FUNCTION__);
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
        $testCase = $this->JadwalDosen_model->kolomKeHari("B");
        $result = 0;
        $this->unit->run($testCase,$result,__FUNCTION__);
    }

    public function kolomKeHari($namaHari) {
        return strpos("BCDEF",$namaHari);
    }

    public function testHariKeKolom(){
        $testCase = $this->JadwalDosen_model->hariKeKolom(1);
        $result = "C";
        $this->unit->run($testCase,$result,__FUNCTION__);
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

   public function testAddJadwal(){
        $user = 'jaki';
        $hari = 1;
        $jam_mulai =1;
        $durasi = 1;
        $jenis ='responsi';
        $label = 'entahlah';
        $lastUpdate=date('Y-m-d H:i:s');
        
        $data = array(
            'user'=> $user,
            'hari'=>$hari,
            'jam_mulai'=>$jam_mulai,
            'durasi'=>$durasi,
            'jenis_jadwal'=>$jenis,
            'label_jadwal'=>$label,
            'lastupdate'=>$lastUpdate
        );
        $this->JadwalDosen_model->addJadwal($data);

        $testCase = $this->db->affected_rows();
        $ex = 1 ;

        $this->unit->run($testCase,$ex,__FUNCTION__);
        $this->db->delete('jadwal_dosen',array('user'=>'jaki'));
    }

    public function testUpdateJadwal(){
        $user = 'jaki';
        $hari = 1;
        $jam_mulai =1;
        $durasi = 1;
        $jenis ='responsi';
        $label = 'entahlah';
        $lastUpdate=date('Y-m-d H:i:s');

        $data = array(
            'user'=> $user,
            'hari'=>$hari,
            'jam_mulai'=>$jam_mulai,
            'durasi'=>$durasi,
            'jenis_jadwal'=>$jenis,
            'label_jadwal'=>$label,
            'lastupdate'=>$lastUpdate
        );

        $this->JadwalDosen_model->addJadwal($data);
        $insert_id = $this->db->insert_id();
        $newData = array(
            'user'=>'testcase',
        );
        $this->JadwalDosen_model->updateJadwal($insert_id,$newData);
        $this->db->where('id', $insert_id);
        $this->db->from('jadwal_dosen');
        $query = $this->db->get();
        $row =  $query->row();
        $testCase = $row->user;
        $ex = 'testcase' ;
        $this->unit->run($testCase,$ex,__FUNCTION__);
         $this->db->delete('jadwal_dosen',array('id'=>$insert_id));
    }
}
