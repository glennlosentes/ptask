<?php
namespace ptask\Repositories\Forex;



use Carbon\Carbon;

class ExchangeRatesApi implements ForexRepositoryInterface
{
    protected $config;
    protected $forex_rates = [];
    protected $lastUpdate = null;

    public function init($config = []){
        $this->config = $config;

    }

    public function loadForex()
    {
        try{
            if(!$this->lastUpdate){
                $this->forex_rates = $this->getForexRate();
                $this->lastUpdate = Carbon::now();

            }else{
                if($this->lastUpdate->diffInHours(Carbon::now()) >= $this->config['refreshTimeInHours'] ){
                    $this->forex_rates = $this->getForexRate();
                    $this->lastUpdate = Carbon::now();
                }

            }

            return count($this->forex_rates);

        }catch (\Exception $err){

            die('Cannot get Forex Rate');
        }


    }
    /**
     * call forex rate via url
     * @return object after processing or parsing
     */
    private function getForexRate(){
        $data = @file_get_contents($this->config['url']);
        if(!$data){
            die('Cannot get Forex Rate');
        }
        return  @json_decode($data,1);

    }

    /**
     * Modify this implementation per connection
     * @param $currency
     * @return float
     *
     */
    public function getRates($currency)
    {
       // echo "getRates: $currency \n";
       if (!$this->forex_rates){
           if(!$this->loadForex()){
               die('Cannot get Forex Rate');
           };
       }
        $rate = 1;
        if(isset($this->forex_rates['rates'][$currency])){
            $rate = $this->forex_rates['rates'][$currency];
        }


        return $rate;
    }


}