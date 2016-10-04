<?php

namespace TextDB;

/**
 *
 */
class DisplayCatalogueItem
{

    public $catalogueNamespace;

    public $totalMessagesCount = 0;

    public $dateCreated;

    public $dateLastModified;

    public function __construct(string $catalogueNamespace, int $totalMessagesCount, string $dateCreated, string $dateLastModified)
    {
        $this->catalogueNamespace = $catalogueNamespace;
        $this->totalMessagesCount = $totalMessagesCount;
        $this->dateCreated = $dateCreated;
        $this->dateLastModified = $dateLastModified;
    }
}
