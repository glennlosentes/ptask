<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 27/04/2020
 * Time: 4:53 PM
 */

class ForexExchangRateAPITest extends \PHPUnit\Framework\TestCase
{

    public function testHasInitMethod(){
        $com = new ReflectionClass(\ptask\Repositories\Forex\ExchangeRatesApi::class);
        $this->assertTrue($com->hasMethod('init'));
    }

    public function testHasLoadForexMethod(){
        $com = new ReflectionClass(\ptask\Repositories\Forex\ExchangeRatesApi::class);
        $this->assertTrue($com->hasMethod('loadForex'));
    }

    public function testHasGetRatesMethod(){
        $com = new ReflectionClass(\ptask\Repositories\Forex\ExchangeRatesApi::class);
        $this->assertTrue($com->hasMethod('getRates'));
    }


    public function testServiceOk(){
        $com = new \ptask\Repositories\Forex\ExchangeRatesApi();
        $config = include('./config.php');
        $com->init($config['FOREX_LOOKUP']);
        $rate = $com->getRates('EUR');
        $this->assertGreaterThan('0',$rate);

    }
    public function testNoService(){
        $com = new \ptask\Repositories\Forex\ExchangeRatesApi();
        $config = include('./config.php');
        $config['FOREX_LOOKUP']['url']='http://localhost';
        $com->init($config['FOREX_LOOKUP']);

        $this->expectExceptionMessageRegExp('/Cannot get Forex Rate/', function () use ($com){
            $com->getRates('EU');
        });

    }

}