<?php

namespace ptask\Repositories\Binlookup;

interface BinLookUpRepositoryInterface
{

    /**
     * use init to handle initial connection
     * or authentication
     */
    public function init($config = []);

    /**
     * use load bins if you need collection to be saved
     *
     */
    public function loadBins();

    /**
     * getBinLocations to get single binlocation
     *
     */
    public function getBinLocations($bin);
}
