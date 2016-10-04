<?php

namespace TextDB;

class Message
{
    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $catalogueNamespace;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var boolean
     */
    private $isPluralForm = false;

    /**
     * @param string $identifier
     * @param string $message
     * @param string $catalogueNamespace
     * @param string $locale
     * @param bool $isPluralForm
     */
    public function __construct(string $identifier, string $message, string $catalogueNamespace, string $locale, bool $isPluralForm)
    {
        $this->identifier = $identifier;
        $this->message = $message;
        $this->catalogueNamespace = $catalogueNamespace;
        $this->locale = $locale;
        $this->isPluralForm = $isPluralForm;
    }

    public function getCatalogueNamespace()
    {
        return $this->catalogueNamespace;
    }
}
