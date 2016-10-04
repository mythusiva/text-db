<?php

namespace TextDB;

use Database\Connection;

/**
 *
 */
class AdminService
{

    /**
     * @var Connection $dbConnection;
     */
    private $dbConnection;

    public function __construct(Connection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getCatalogueList()
    {
        $rows = $this->dbConnection
            ->fetchAll('SELECT c.*, coalesce(count(m.catalogue_name),0) as num_texts
                FROM catalogue c
                LEFT JOIN message m ON c.name = m.catalogue_name
                GROUP BY c.name
                ORDER BY c.date_created DESC');

        $calalogueList = [];
        foreach ($rows as $rowArray) {
            $catalogueListItemEntity = new DisplayCatalogueItem(
                $rowArray['name'],
                $rowArray['num_texts'],
                $rowArray['date_created'],
                $rowArray['date_created']
            );
            $catalogueList[] = $catalogueListItemEntity;
        }

        return $catalogueList;
    }

}
