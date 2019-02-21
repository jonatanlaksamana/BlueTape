<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TestTranskrip_model extends CI_Controller {



    public $coverage;

    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->unit->use_strict(TRUE);
        $this->load->database();
        $this->load->model('Transkrip_model');
        $this->load->model('JadwalDosen_model' , 'jadwaldosen');
    }


    private function report() {
    
        file_put_contents('../www/application/views/TestDocuments/TestTranskrip .html', $this->unit->report());
        // file_put_contents('../www/application/views/TestDocuments/test_Library.php', $this->unit->report());

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
        $this->testRequestBy();
        $this->report();
    }


    function testRequestBy(){
        $testCase = $this->Transkrip_model->requestsBy('7316059@student.unpar.ac.id' , 1 , 1);
        $excpeted_result = $this->resultTest('7316057@student.unpar.ac.id' , 1 , 1);
        var_dump($testCase);
        var_dump($excpeted_result);
        $this->unit->run($testCase , $excpeted_result , __FUNCTION__  );
    }

   function resultTest($email , $start , $rows){
    if ($email !== NULL) {
        $this->db->where('requestByEmail', $email);
    }
    if ($start !== NULL && $rows !== NULL) {
        $this->db->limit($rows, $start);
    }
    $this->db->from('Transkrip');
    $this->db->order_by('requestDateTime', 'DESC');
    $query = $this->db->get();
    return $query->result();
    }
}