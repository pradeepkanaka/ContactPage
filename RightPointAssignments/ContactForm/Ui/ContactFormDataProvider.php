<?php
declare(strict_types=1);

namespace RightPointAssignments\ContactForm\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;
use RightPointAssignments\ContactForm\Model\ResourceModel\ContactForm\Collection;
use RightPointAssignments\ContactForm\Model\ResourceModel\ContactForm\CollectionFactory;

class ContactFormDataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * string $name
     * string $primaryFieldName
     * string $requestFieldName
     * CollectionFactory $collectionFactory
     * array $meta
     * array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $collectionFactory->create();
    }
 
    public function getCollection()
    {
        return $this->collection;
 
    }
 
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        return $this->getCollection()->toArray();
    }
}