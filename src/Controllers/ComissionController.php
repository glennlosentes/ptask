<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 27/04/2020
 * Time: 1:34 PM
 */
namespace ptask\Controllers;


class ComissionController
{

    private $transaction_input;
    private $bin_info;
    private $forex;
    private $config;

    private $binRepository;
    private $forexRepository;
    /**
     * constructor.
     * @param $config
     */
    public function __construct($config)
    {
            $this->config = $config;
            //init binRepository
            $this->binRepository = new $config['BIN_LOOKUP']['class'];
            $this->binRepository->init($config['BIN_LOOKUP']);
            //init forex report
            $this->forexRepository  = new $config['FOREX_LOOKUP']['class'];
            $this->forexRepository->init($config['FOREX_LOOKUP']);

    }


    /**
     * trigger process commission.
     * @param file
     */
    public function run($file){

        //process file here
        $result = $this->processFile($file);

        if(!$result){
            die ('Error in input file');
        }
        foreach($this->transaction_input as $item){

            $bin = $this->binRepository->getBinLocations($item['bin']);

            if(!$bin){
                die('Error getting Bin Location');
            }

            $rate = $this->forexRepository->getRates($item['currency']);

            $this->printCommission($item['amount'],$bin, $rate);


        }
    }

    /**
    * public function to process file and convert data to array
    * @return integer
    **/

    public function processFile($file){

        try{

            foreach (explode("\n", file_get_contents($file)) as $row) {
                if(empty($row)) break;
                $this->transaction_input[] = json_decode($row,1);

            }
            return count($this->transaction_input);

        }catch (\Exception $err){
            return false;
        }


    }

    /**
     * caculate rate and prints output
     *
     **/

    private function printCommission($amount, $bin, $rate){

            $ratex = $amount/$rate;

            $com_rate =  in_array($bin,$this->config['EU_COUNTRIES'])
                                        ? $this->config['rate']['EU']
                                        : $this->config['rate']['NON_EU'];

            $conversion       = pow(10, $this->config['decimals']);

            $return = ceil(($ratex * $com_rate) * $conversion) / $conversion;

            print $return;
            print "\n";



    }
    /**
     * return file input
     * returns Array
     */
    public function getFileData(){
        return $this->transaction_input;
    }

}