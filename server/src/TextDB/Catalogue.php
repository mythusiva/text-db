<?php

class Catalogue
{

    /**
     * @param string $catalogueNamespace
     */
    private $catalogueNamespace;

    /**
     * @param Message[] $listOfMessages
     */
    private $listOfMessages = [];

    public function __construct(string $catalogueNamespace)
    {
        $this->catalogueNamespace = $catalogueNamespace;
    }

    public function getCatalogueNamespace()
    {
        return $this->catalogueNamespace;
    }

    /**
     * @param Message[] $listOfMessages
     */
    public function addMessages(array $listOfMessages)
    {
        # If the message that is being provided, is not from the same catalogue then ignore it!
        /** @var Message $message */
        foreach ($listOfMessages as $message) {
            $this->addMessage($message);
        }
    }

    public function addMessage(Message $message) {
        if ($this->catalogueNamespace != $message->getCatalogueNamespace()) {
            continue;
        }
        array_push($this->listOfMessages, $message);
    }
}
