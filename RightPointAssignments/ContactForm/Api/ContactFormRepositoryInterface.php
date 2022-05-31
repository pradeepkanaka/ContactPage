<?php

namespace RightPointAssignments\ContactForm\Api;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use RightPointAssignments\ContactForm\Api\Data\ContactFormInterface;

interface ContactFormRepositoryInterface
{
    /**
     * get the contact form details by id
     * 
     * @param int $id
     * 
     * @return ContactFormInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * get the contact form details by email id
     * 
     * @param string $emailId
     * 
     * @return ContactFormInterface
     * @throws NoSuchEntityException
     */
    public function getByEmailId($emailId);

    /**
     * Retrieve contact form details which matches the specified criteria
     * 
     * @param SearchCriteriaInterface $criteria
     * 
     * @return SearchCriteriaInterface
     */
    public function getByList($criteria);

    /**
     * create or update contact form
     * 
     * @param ContactFormInterface $contactFormData
     */
    public function save($contactFormData);

    /**
     * delete contact form
     * 
     * @param ContactFormInterface $contactFormData
     * @throws NoSuchEntityException
     */
    public function delete($contactFormData);

    /**
     * delete contact form by id
     * 
     * @param int $id
     * @throws NoSuchEntityException
     */
    public function deleteById($id);

    /**
     * delete contact form by email id
     * 
     * @param string $emailId
     * @throws NoSuchEntityException
     */
    public function deleteByEmailId($emailId);
}