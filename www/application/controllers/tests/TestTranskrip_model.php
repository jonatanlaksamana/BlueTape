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
        $this->testRequestBy();
        $this->testRequestByID();
        $this->testLimitRequestBy();
        $this->testLimitRequestByID();
        $this->requestTypesForbidden1();
        $this->requestTypesForbidden2();
        $this->requestTypesForbidden3();
    }

    function testRequestBy()
    {
        $this->db->insert('Transkrip', array(
            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'dummytype',
            'requestUsage' => 'tes'
        ));
        $this->db->where('requestByEmail', 'dummyemail');
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();

        $testCase = $this->Transkrip_model->requestsBy('dummyemail', null, null);
        $excpeted_result = $query->result();
        $this->unit->run($testCase, $excpeted_result, __FUNCTION__);
        $this->db->delete('Transkrip', array('requestByEmail' => 'dummyemail'));
    }

    function testRequestByID()
    {
        $this->db->insert('Transkrip', array(

            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'dummytype',
            'requestUsage' => 'tes'
        ));
        $insert_id = $this->db->insert_id();
        $this->db->where('id', $insert_id);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();

        $testCase = $this->Transkrip_model->requestByID($insert_id, null, null);
        $excpeted_result = $query->result()[0];
        $this->unit->run($testCase, $excpeted_result, __FUNCTION__);
        $this->db->delete('Transkrip', array('id' => $insert_id));
    }
    function testLimitRequestBy()
    {
        $this->db->insert('Transkrip', array(
            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'dummytype',
            'requestUsage' => 'tes'
        ));
        $this->db->where('requestByEmail', 'dummyemail');
        $this->db->limit(1, 0);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();

        $testCase = $this->Transkrip_model->requestsBy('dummyemail', 1, 0);
        $excpeted_result = $query->result();
        $this->unit->run($testCase, $excpeted_result, __FUNCTION__);
        $this->db->delete('Transkrip', array('requestByEmail' => 'dummyemail'));
    }
    function testLimitRequestByID()
    {
        $this->db->insert('Transkrip', array(

            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'dummytype',
            'requestUsage' => 'tes'
        ));
        $insert_id = $this->db->insert_id();
        $this->db->where('id', $insert_id);
        $this->db->limit(1, 0);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();

        $testCase = $this->Transkrip_model->requestByID($insert_id, 1, 0);
        $excpeted_result = $query->result()[0];
        $this->unit->run($testCase, $excpeted_result, __FUNCTION__);
        $this->db->delete('Transkrip', array('id' => $insert_id));
    }
    function requestTypesForbidden1()
    {
        $this->db->insert('Transkrip', array(

            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'dummytype',
            'requestUsage' => 'tes'
        ));
        $insert_id = $this->db->insert_id();
        $this->db->where('id', $insert_id);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get(); //syntax query
        $requests = $query->result(); //ubah kedalam array

        $testCase = $this->Transkrip_model->requestTypesForbidden($requests);
        $ex = "Anda tidak bisa meminta cetak karena ada permintaan lain yang belum selesai.";
        $this->unit->run($testCase, $ex, __FUNCTION__);
        $this->db->delete('Transkrip', array('id' => $insert_id));
    }
    function requestTypesForbidden2()
    {
        $this->db->insert('Transkrip', array(

            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'type1',
            'requestUsage' => 'tes', 
            'answer' => 'printed'
        ));
       
    
        $insert_id = $this->db->insert_id();
        $this->db->where('id', $insert_id);
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get(); //syntax query
        $requests = $query->result(); //ubah kedalam array

        $testCase = $this->Transkrip_model->requestTypesForbidden($requests);
         $ex =  ['type1'];
        $this->unit->run($testCase, $ex, __FUNCTION__);
        $this->db->delete('Transkrip', array('id' => $insert_id));
    }
    function requestTypesForbidden3()
    {
        $this->db->insert('Transkrip', array(

            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'type2=1',
            'requestUsage' => 'tes', 
            'answer' => 'printed'
        ));
        $this->db->insert('Transkrip', array(

            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'type2',
            'requestUsage' => 'tes', 
            'answer' => 'printed'
        ));
        $this->db->insert('Transkrip', array(

            'requestByEmail' => 'dummyemail',
            'requestDateTime' => strftime('%Y-%m-%d %H:%M:%S'),
            'requestType' => 'type3',
            'requestUsage' => 'tes', 
            'answer' => 'printed'
        ));
        $this->db->where('requestByEmail', 'dummyemail');
        $this->db->from('Transkrip');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get(); //syntax query
        $requests = $query->result(); //ubah kedalam array
        
        $testCase = $this->Transkrip_model->requestTypesForbidden($requests);
        var_dump($testCase);
        $ex = "Anda tidak bisa meminta cetak karena seluruh jenis transkrip sudah pernah dikabulkan di semester ini (Genap 2018/2019).";
        $this->unit->run($testCase, $ex, __FUNCTION__);
        $this->db->delete('Transkrip', array('requestByEmail' => 'dummyemail'));
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

