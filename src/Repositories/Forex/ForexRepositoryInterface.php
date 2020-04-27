<?php
namespace ptask\Repositories\Forex;

interface ForexRepositoryInterface
{

    /**
     * use init to handle initial connection
     * or authentication
     */
    public function init($config = []);

    /**
     * use load forex if you need collection to be saved
     *
     */
    public function loadForex();

    /**
     * Modify this implementation per
     * @param $currency
     *
     *
     */
    public function getRates($currency);
}