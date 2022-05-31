<?php

declare(strict_types=1);

namespace RightPointAssignments\ContactForm\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use RightPointAssignments\ContactForm\Model\ResourceModel\ContactForm\Collection;

class ContactForm implements ArgumentInterface
{
    /**
     * @var Collection
     */
    private $contactFormCollection;

    /**
     * @param Collection $contactFormCollection
     */
    public function __construct(
        Collection $contactFormCollection
    ) {
        $this->contactFormCollection = $contactFormCollection;
    }

    /**
     * returns the contact form data
     * 
     * @param Collection
     */
    public function getFormData()
    {
        return $this->contactFormCollection;
    }   
}