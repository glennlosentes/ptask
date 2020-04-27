<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 27/04/2020
 * Time: 4:53 PM
 */

class CommissionControllerTest extends \PHPUnit\Framework\TestCase
{

    public function testHasRunMethod(){
        $com = new ReflectionClass(\ptask\Controllers\ComissionController::class);
        $this->assertTrue($com->hasMethod('run'));
    }







}