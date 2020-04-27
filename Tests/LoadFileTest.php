<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 27/04/2020
 * Time: 4:53 PM
 */

class LoadFileTest extends \PHPUnit\Framework\TestCase
{
    public function testNoFile(){
        $output = `php ./index.php`;
        $this->assertEquals(    'No input file',                $output );

    }
    public function testWithFile(){

            $config = include('./config.php');
            $com = new \ptask\Controllers\ComissionController($config);

            $result = $com->processFile('./input.txt');

            $this->assertGreaterThan(0,$result);


    }
    public function testInvalidDataContent(){

        $config = include('./config.php');
        $com = new \ptask\Controllers\ComissionController($config);

        $result = $com->processFile('./Tests/invalidfile.txt');

        $data = $com->getFileData();


        foreach ($data as $k => $v){
            $this->assertArrayNotHasKey('bin', $v, 'Data with BIN');
            $this->assertArrayNotHasKey('amount', $v, 'Data with AMOUNT');
            $this->assertArrayNotHasKey('currency', $v, 'Data with CURRENCY');
        }

    }

    public function testValidDataContent(){

        $config = include('./config.php');
        $com = new \ptask\Controllers\ComissionController($config);

        $result = $com->processFile('./input.txt');

        $data = $com->getFileData();


        foreach ($data as $k => $v){
            $this->assertArrayHasKey('bin', $v, 'Data with BIN');
            $this->assertArrayHasKey('amount', $v, 'Data with AMOUNT');
            $this->assertArrayHasKey('currency', $v, 'Data with CURRENCY');
        }

    }




}