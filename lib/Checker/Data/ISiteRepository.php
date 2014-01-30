<?php

namespace Checker\Data;

use Checker\Data\Model\Site;

interface ISiteRepository{

    /**
     * Clear storage
     */
    function clear();

    /**
     * Add new site to the repository
     * @param $site Site to add
     * @return mixed
     */
    function add(Site $site);

    /**
     * Search record by domain name
     * @param $domain domain name to search
     * @throws RecordNotFoundException
     * @return Site site
     */
    function findOneByDomain($domain);

    /**
     * Update record in the repository
     * @param Model\Site $site
     * @return mixed
     */
    function update(Site $site);

    /**
     * Remove record by domain name
     * @param $domain
     * @return mixed
     */
    function delete($domain);

    /**
     * Get statistics
     * @return array
     */
    function getStats();
}