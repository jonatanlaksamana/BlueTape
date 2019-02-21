<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class TestModel extends CI_Controller {


    public $coverage;

    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->unit->use_strict(TRUE);
        $this->coverage = new SebastianBergmann\CodeCoverage\CodeCoverage;
        $this->coverage->filter()->addDirectoryToWhitelist('application/libraries');
        $this->coverage->start('UnitTests');
        $this->load->model('PerubahanKuliah_model');
        $this->load->database();
    }


    private function report() {
        $str = '
<table border="0" style="color: blue" cellpadding="4" cellspacing="1">
{rows}
        <tr>
                <td>{item}</td>
                <td>{result}</td>
        </tr>
{/rows}
</table>';
        $this->unit->set_template($str);
        $this->coverage->stop();
        $writer = new  \SebastianBergmann\CodeCoverage\Report\Html\Facade;
        $writer->process($this->coverage, '../www/application/views/TestDocuments/code-coverage');
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

        $this->testRequest();
        $this->report();
    }

    public function testRequest(){
        $testCase = $this->PerubahanKuliah_model->requestsBy('7316081@student.unpar.ac.id' , 1 ,1 );
        $ex = $this->testGetAll('7316081@student.unpar.ac.id' , 1 , 1);
        var_dump($testCase);
        var_dump($ex);
        $this->unit->run($testCase,$ex ,"aaa");

    }


    function  testGetAll($email , $start , $rows){
        if ($email !== NULL) {
            $this->db->where('requestByEmail', $email);
        }
        if ($start !== NULL && $rows !== NULL) {
            $this->db->limit($rows, $start);
        }
        $this->db->from('PerubahanKuliah');
        $this->db->order_by('requestDateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }








}
