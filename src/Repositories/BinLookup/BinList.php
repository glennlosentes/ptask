<?php
namespace ptask\Repositories\Binlookup;


class BinList implements BinLookUpRepositoryInterface
{
    private $bins = [];
    protected $config;

    public function __construct()
    {

    }
    /**
     * use init if authentication is required
     * @params config
     */

    public function init($config = [])
    {
        $this->config = $config;
    }

    public function loadBins()
    {

    }

    /**
     * specific implementation per partner bin lookup
     * you may change encoding format,or key/index from result
     * @param $bin
     *
     */
    public function getBinLocations($bin)
    {

        /* minimize calling of url if bin already exists */
        if(array_key_exists($bin, $this->bins)) {
            return $this->bins[$bin]['country'];
        }
            $binResults = @file_get_contents($this->config['url'] .$bin);


        if (!$binResults)
            die('Cannot get Bin Location');

        $r = json_decode($binResults);
        $this->bins[$bin]['country'] = $r->country->alpha2;
        return $r->country->alpha2;

    }


}