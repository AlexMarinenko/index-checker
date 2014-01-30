<?php

namespace Checker\Data;

use Checker\Data\Model\Site;
use PDO;

class SQLSiteRepository implements ISiteRepository
{

    /**
     * @var PDO
     */
    private $dbh;

    /**
     * @var PDOStatement
     */
    private $addStmt;

    /**
     * @var PDOStatement
     */
    private $statsStmt;

    /**
     * @var PDOStatement
     */
    private $findOneByDomainStmt;

    /**
     * @var PDOStatement
     */
    private $updateStmt;

    /**
     * @var PDOStatement
     */
    private $deleteStmt;

    public function __construct($dbh, $append = false){
        $this->dbh = $dbh;
        $this->initStatements();
        if (!$append){
            $this->clear();
        }
    }

    /**
     * Initialize statememts for future use
     */
    private function initStatements()
    {
        $this->addStmt = $this->dbh->prepare("INSERT INTO site (domain, indexed) VALUES (:domain, :indexed)");
        $this->statsStmt = $this->dbh->prepare("select COUNT(*) as total, SUM(case when indexed>0 then 1 else 0 end) as notindexed from site");
        $this->findOneByDomainStmt = $this->dbh->prepare("SELECT domain, indexed FROM site WHERE domain = :domain");
        $this->updateStmt = $this->dbh->prepare("UPDATE site SET indexed = :indexed WHERE domain = :domain");
        $this->deleteStmt = $this->dbh->prepare("DELETE FROM site WHERE domain = :domain");

        $this->initTable();
    }

    /**
     * Initialize table in the Database
     */
    private function initTable()
    {
        $createQuery = "CREATE TABLE IF NOT EXISTS site (
                    domain varchar(32) PRIMARY KEY,
                    indexed INTEGER
                    )";
        $this->dbh->exec($createQuery);
    }

    function clear(){
        $this->dbh->query("DELETE FROM site");
    }

    function add(Site $site)
    {
        $this->addStmt->bindValue(':domain', $site->domain, PDO::PARAM_STR);
        $this->addStmt->bindValue(':indexed', $site->indexed, PDO::PARAM_INT);
        $this->addStmt->execute();
    }


    function findOneByDomain($domain)
    {
        $this->findOneByDomainStmt->bindValue(':domain', $domain, PDO::PARAM_STR);
        $this->findOneByDomainStmt->execute();
        $result = $this->findOneByDomainStmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false){
            throw new RecordNotFoundException("Site not found for domain: ".$domain);
        }
        return new Site($result['domain'], $result['indexed']);
    }

    function update(Site $site)
    {
        $this->updateStmt->bindValue(':domain', $site->domain, PDO::PARAM_STR);
        $this->updateStmt->bindValue(':indexed', $site->indexed, PDO::PARAM_INT);
        $this->updateStmt->execute();
    }

    function delete($domain)
    {
        $this->deleteStmt->bindValue(':domain', $domain, PDO::PARAM_STR);
        $this->deleteStmt->execute();
    }

    function getStats()
    {
        $this->statsStmt->execute();
        $result = array();
        $row = $this->statsStmt->fetch(PDO::FETCH_ASSOC);
        $notindexed = (int)$row['notindexed'];
        $result[] = array('Not indexed', $notindexed);
        $result[] = array('Indexed', $row['total']-$row['notindexed']);
        return $result;
    }


}