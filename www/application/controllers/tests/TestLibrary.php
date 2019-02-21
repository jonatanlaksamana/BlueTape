<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class TestLibrary extends CI_Controller {


    public $coverage;

    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->unit->use_strict(TRUE);
        // $this->coverage = new SebastianBergmann\CodeCoverage\CodeCoverage;
        // $this->coverage->filter()->addDirectoryToWhitelist('application/libraries');
        // $this->coverage->start('UnitTests');
        $this->load->library('BlueTape');
        
    }


    private function report() {
<<<<<<< HEAD
        // $this->coverage->stop();
        // $writer = new  \SebastianBergmann\CodeCoverage\Report\Html\Facade;
        // $writer->process($this->coverage, '../www/application/views/TestDocuments/code-coverage');
=======
        $str = '
<table border="0"  cellpadding="4" cellspacing="1">
{rows}
        <tr>
                <td>{item}</td>
                <td>{result}</td>
        </tr>
 {/rows}
        <br>
 

</table>';
        $this->unit->set_template($str);
        $this->coverage->stop();
        $writer = new  \SebastianBergmann\CodeCoverage\Report\Html\Facade;
        $writer->process($this->coverage, '../www/application/views/TestDocuments/code-coverage');
>>>>>>> 0d42f24cb94cdc436e242f5a7066f9f2375ffab1
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

//        $this->unit->set_test_items(array('test_name', 'test_datatype' , 'res_datatype' , 'result'));
        $this->testBlueTapeLibraryGetNPM();
        $this->testBlueTapeLibraryGetNPM_2017();
        $this->testBlueTapeLibraryGetNPM_Null();
        $this->testGetSemester_genap();
        $this->testGetSemesterSimple_genap();
        $this->testGetSemesterSimple_ganjil();
        $this->testSmesterCodeToStringGanjil();
        $this->testSmesterCodeToStringGenap();
        $this->testSmesterCodeToStringPadat();
        $this->testGetSemester_ganjil();

<<<<<<< HEAD
       $this->testGetName();
=======
        $this->testGetName();
//        $this->testGetEmail();
>>>>>>> 0d42f24cb94cdc436e242f5a7066f9f2375ffab1

        $this->testGetSemester_pendek();
        $this->testGetEmailBawah();
        $this->testGetEmailAtas();
        $this->testSmesterCodeToStringFalse();

        $this->report();
    }

    public function testBlueTapeLibraryGetNPM() {
        $this->unit->run(
            $this->bluetape->getNPM('7316081@student.unpar.ac.id'),
            '2016730081',
            __FUNCTION__,
            'Ensure e-mail to NPM conversion works, for angkatan <  2017'
        );
    }

    public function testBlueTapeLibraryGetNPM_2017() {
        $this->unit->run(
            $this->bluetape->getNPM('2017730013@student.unpar.ac.id'),
            '2017730013',
            __FUNCTION__,
            'Ensure e-mail to NPM conversion works, for angkatan >= 2017'
        );
    }

    public function testBlueTapeLibraryGetNPM_Null() {
        $this->unit->run(
            $this->bluetape->getNPM('fikrizzaki@gmail.com'),
            NULL,
            __FUNCTION__,
            'Ensure e-mail to NPM conversion works, for dosen, etc'
        );
    }


    function testGetSemester_genap(){
        $this->unit->run(
            $this->bluetape->yearMonthToSemesterCode("2016",1),"162", __FUNCTION__ , "Untuk mengecek semester genap"

        );
    }

    function testGetSemester_ganjil(){
        $this->unit->run(
            $this->bluetape->yearMonthToSemesterCode("2016",9),"161", __FUNCTION__ , "Untuk mengecek semester ganjil"

        );
    }

    function testGetSemester_pendek(){
        $this->unit->run(
            $this->bluetape->yearMonthToSemesterCode("2016",6),"164", __FUNCTION__ , "Untuk mengecek semester pendek"

        );
    }


    function testGetSemesterSimple_genap(){
        $this->unit->run(
            $this->bluetape->yearMonthToSemesterCodeSimplified("2016",1),"162", __FUNCTION__ , "Untuk mengkonversi tahun dan bulan sekarang menjadi code smester sederhana (genap)"

        );
    }

    function testGetSemesterSimple_ganjil(){
        $this->unit->run(
            $this->bluetape->yearMonthToSemesterCodeSimplified("2016",8),"161", __FUNCTION__ , "Untuk mengkonversi tahun dan bulan sekarang menjadi code smester sederhana (ganjil)"

        );
    }
//still bugged

    function testGetName(){
        $this->unit->run(
            $this->bluetape->getName("7316057@student.unpar.ac.id"),"CHRISSANDI SUTRISNO", __FUNCTION__ , "Untuk mendapatkan nama mahasiswa dari email"

        );
    }

    function  testSmesterCodeToStringGanjil(){
        $this->unit->run(
            $this->bluetape->semesterCodeToString("141"),"Ganjil 2014/2015" , __FUNCTION__ , "mengubah smester Ganjil code menjadi string"
        );

    }
    function  testSmesterCodeToStringGenap(){
        $this->unit->run(
            $this->bluetape->semesterCodeToString("152"),"Genap 2014/2015" , __FUNCTION__ , "mengubah smester Genap code menjadi string"
        );

    }

    function  testSmesterCodeToStringPadat(){
        $this->unit->run(
            $this->bluetape->semesterCodeToString("164"),"Padat 2015/2016" , __FUNCTION__ , "mengubah smester Padat code menjadi string"
        );

    }
    function  testSmesterCodeToStringFalse(){
        $this->unit->run(
            $this->bluetape->semesterCodeToString("169"),FALSE, __FUNCTION__ , "mengubah smester Padat code menjadi string"
        );

    }
    function  testDateTimeToHumanFormat(){
        $this->unit->run(
            $this->bluetape->dbDateTimeToReadableDate("2008-11-11 13:23:44"),"Selasa, 11 November 2008 ",__FUNCTION__,"mengubah format datetime pada database menjadi sesuatu yang bisa di baca manusia"
        );
    }

    //EMAIL MHS SEBELUM 2017
    function  testGetEmailBawah(){
        $this->unit->run(
            $this->bluetape->getEmail("2016730025"),"7316025@student.unpar.ac.id",__FUNCTION__ , "mendapatkan email dari npm mhs angkatan sebelum 2017"
        );
    }

    //EMAIL MHS 2017 KEATAS
    function  testGetEmailAtas(){
        $this->unit->run(
            $this->bluetape->getEmail("2018730048"),"2018730048@student.unpar.ac.id",__FUNCTION__ , "mendapatkan email dari npm mhs angkatan 2017 keatas"
        );
    }

    
    





}
