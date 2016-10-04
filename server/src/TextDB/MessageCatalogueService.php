<?php

namespace TextDB;

use \Database\Connection;

/**
 *
 */
class MessageCatalogueService
{

    /**
     * @var Connection $dbConnection;
     */
    private $dbConnection;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getCatalogue(string $catalogueNamespace)
    {
        $catalogue = new Catalogue($catalogueNamespace);

        $rows = $this->dbConnection
            ->table('message')
            ->where('catalogue_name', '=', $catalogue->getCatalogueNamespace())
            ->get();

        foreach ($rows as $dataRow) {

            $message = new Message(
                'identifier'    => $rowArray['identifier'],
                'message'          => $rowArray['text'],
                'catalogueName' => $rowArray['catalogue_name'],
                'locale'        => $rowArray['locale'],
                'isPluralForm' => (bool)$rowArray['is_plural_form']
            ]);

            $catalogue->addMessage($message);

        }

        return $catalogue;

    }

}
