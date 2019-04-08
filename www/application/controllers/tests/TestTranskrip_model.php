<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class TestTranskrip_model extends CI_Controller
{


    public $coverage;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->database();
        $this->load->model('Transkrip_model');
        $this->load->library('BlueTape');
    }

    /**
     * Run all tests
     */
    public function index()
    {

        $this->testAll();

        $this->report();
    }

    public function testAll()
    {
        // $this->testRequestBy();
        // $this->testRequestByID();
        // $this->testLimitRequestBy();
        // $this->testLimitRequestByID();
        $this->requestTypesForbidden1();
        // $this->requestTypesForbidden2();
        // $this->requestTypesForbidden3();
    }

    function testRequestBy()
    {
        $this->db->where('requestByEmail', 'dummyemail');
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();

        $testCase = $this->Transkrip_model->requestsBy('dummyemail', null, null);
        $excpeted_result = $query->result();
        $this->unit->run($testCase, $excpeted_result, __FUNCTION__);
    }

    function testRequestByID()
    {
        $insert_id = 0;
        $this->db->where('id', $insert_id);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();

        $testCase = $this->Transkrip_model->requestByID($insert_id, null, null);
        $excpeted_result = $query->result()[0];
        $this->unit->run($testCase, $excpeted_result, __FUNCTION__);
    }
    function testLimitRequestBy()
    {
        $this->db->where('requestByEmail', 'dummyemail');
        $this->db->limit(1, 0);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();

        $testCase = $this->Transkrip_model->requestsBy('dummyemail', 1, 0);
        $excpeted_result = $query->result();
        $this->unit->run($testCase, $excpeted_result, __FUNCTION__);
    }
    function testLimitRequestByID()
    {
        $insert_id = 0;
        $this->db->where('id', $insert_id);
        $this->db->limit(1, 0);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();

        $testCase = $this->Transkrip_model->requestByID($insert_id, 1, 0);
        $excpeted_result = $query->result()[0];
        $this->unit->run($testCase, $excpeted_result, __FUNCTION__);
    }
    function requestTypesForbidden1()
    {
        $insert_id = 0;
        $this->db->where('id', $insert_id);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get(); //syntax query
        $requests = $query->result(); //ubah kedalam array

        $testCase = $this->Transkrip_model->requestTypesForbidden($requests);
        $ex = "Anda tidak bisa meminta cetak karena ada permintaan lain yang belum selesai.";
        var_dump($testCase);
        // $this->unit->run($testCase, $ex, __FUNCTION__);
    }
    function requestTypesForbidden2()
    {
        $insert_id = 0;
        $this->db->where('id', $insert_id);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get(); //syntax query
        $requests = $query->result(); //ubah kedalam array

        $testCase = $this->Transkrip_model->requestTypesForbidden($requests);
         $ex =  ['type1'];
        $this->unit->run($testCase, $ex, __FUNCTION__);
    }
    function requestTypesForbidden3()
    {
        
        $this->db->where('requestByEmail', 'dummyemail');
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get(); //syntax query
        $requests = $query->result(); //ubah kedalam array
        
        $testCase = $this->Transkrip_model->requestTypesForbidden($requests);
        
        $ex = "Anda tidak bisa meminta cetak karena seluruh jenis transkrip sudah pernah dikabulkan di semester ini (Genap 2018/2019).";
        $this->unit->run($testCase, $ex, __FUNCTION__);
       
    }
    private function report()
    {

        file_put_contents('../TestDocuments/TestPlan/TestTranskripModel.html', $this->unit->report());

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
    
    

}

