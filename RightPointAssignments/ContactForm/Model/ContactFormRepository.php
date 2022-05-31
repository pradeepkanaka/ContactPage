<?php

declare(strict_types=1);

namespace RightPointAssignments\ContactForm\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use RightPointAssignments\ContactForm\Api\Data\ContactFormInterface;
use RightPointAssignments\ContactForm\Api\ContactFormRepositoryInterface;
use RightPointAssignments\ContactForm\Model\ContactFormFactory;
use RightPointAssignments\ContactForm\Model\ResourceModel\ContactForm as ContactFormResourceModel;
use RightPointAssignments\ContactForm\Model\ResourceModel\ContactForm\CollectionFactory;

class ContactFormRepository implements  ContactFormRepositoryInterface
{
    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var ContactFormFactory
     */
    private $contactFormFactory;

    /**
     * @var ContactFormResourceModel
     */
    private $contactFormResourceModel;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param ContactFormFactory $contactFormFactory
     * @param ContactFormResourceModel $contactFormResourceModel
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        SearchResultsInterfaceFactory $searchResultsFactory,
        ContactFormFactory $contactFormFactory,
        ContactFormResourceModel $contactFormResourceModel,
        CollectionFactory $collectionFactory
    ){
        $this->searchResultsFactory = $searchResultsFactory;
        $this->contactFormFactory = $contactFormFactory;
        $this->contactFormResourceModel = $contactFormResourceModel;
        $this->collectionFactory = $collectionFactory;
    }
    /**
     * get the contact form details by id
     * 
     * @param int $id
     * 
     * @return ContactFormInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $contactFormObject = $this->contactFormFactory->create();
        $contactFormObjectData = $this->contactFormResourceModel->load($contactFormObject, $id);
        if (!$contactFormObjectData->getId()) {
            throw new NoSuchEntityException(__('Details not exist for the id ' . $id));
        }
        return $contactFormObjectData;
    }

    /**
     * get the contact form details by email id
     * 
     * @param string $emailId
     * 
     * @return ContactFormInterface
     * @throws NoSuchEntityException
     */
    public function getByEmailId($emailId)
    {
        $contactFormObject = $this->contactFormFactory->create();
        $contactFormObjectData = $this->contactFormResourceModel->load($contactFormObject, $emailId);
        if (!$contactFormObjectData->getId()) {
            throw new NoSuchEntityException(__('Details not exist for the email id ' . $emailId));
        }
        return $contactFormObjectData;
    }

    /**
     * Retrieve contact form details which matches the specified criteria
     * 
     * @param SearchCriteriaInterface $criteria
     * 
     * @return SearchCriteriaInterface
     */
    public function getByList($criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $objects = [];
        foreach ($collection as $objectModel) {
            $objects[] = $objectModel;
        }
        $searchResults->setItems($objects);

        return $searchResults;
    }

    /**
     * create or update contact form
     * 
     * @param ContactFormInterface $contactFormData
     */
    public function save($contactFormData)
    {
        try {
            $this->contactFormResourceModel->save($contactFormData);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        return $this;
    }

    /**
     * delete contact form
     * 
     * @param ContactFormInterface $contactFormData
     * @throws NoSuchEntityException
     */
    public function delete($contactFormData)
    {
        try {
            $this->contactFormResourceModel->delete($contactFormData);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        return $this;
    }

    /**
     * delete contact form by id
     * 
     * @param int $id
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * delete contact form by email id
     * 
     * @param string $emailId
     * @throws NoSuchEntityException
     */
    public function deleteByEmailId($emailId)
    {
        return $this->delete($this->getByEmailId($emailId));
    }
}