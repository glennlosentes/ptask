<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 27/04/2020
 * Time: 4:53 PM
 */

class BinListTest extends \PHPUnit\Framework\TestCase
{

    public function testHasInitMethod(){
        $com = new ReflectionClass(\ptask\Repositories\Binlookup\BinList::class);
        $this->assertTrue($com->hasMethod('init'));
    }

    public function testHasLoadBinsMethod(){
        $com = new ReflectionClass(\ptask\Repositories\Binlookup\BinList::class);
        $this->assertTrue($com->hasMethod('loadBins'));
    }

    public function testHasGetBinLocations(){
        $com = new ReflectionClass(\ptask\Repositories\Binlookup\BinList::class);
        $this->assertTrue($com->hasMethod('getBinLocations'));
    }

    public function testServiceOk(){
        $com = new \ptask\Repositories\Binlookup\BinList();
        $config = include('./config.php');
        $com->init($config['BIN_LOOKUP']);
        $bin = $com->getBinLocations('45717360');
        $this->assertEquals('DK',$bin);

    }
    public function testNoService(){
        $com = new \ptask\Repositories\Binlookup\BinList();
        $config = include('./config.php');
        $config['BIN_LOOKUP']['url']='http://localhost';
        $com->init($config['BIN_LOOKUP']);
        //$bin = );;

        $this->expectExceptionMessageRegExp('/Cannot get Bin Location/', function () use ($com){
            $com->getBinLocations('45717360');
        });

    }


}