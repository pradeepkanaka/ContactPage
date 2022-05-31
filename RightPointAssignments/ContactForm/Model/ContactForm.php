<?php
declare(strict_types=1);

namespace RightPointAssignments\ContactForm\Model;

use Magento\Framework\Model\AbstractModel;
use RightPointAssignments\ContactForm\Api\Data\ContactFormInterface;

class ContactForm extends AbstractModel implements ContactFormInterface
{
    protected function _construct()
	{
		$this->_init('RightPointAssignments\ContactForm\Model\ResourceModel\ContactForm');
	}

	/**
     * get first name
     * 
     * @return string
     */
    public function getFirstName()
	{
		return $this->getData(ContactFormInterface::FIRST_NAME);
	}

    /**
     * get last name
     * 
     * @return string|null
     */
    public function getLastName()
	{
		return $this->getData(ContactFormInterface::LAST_NAME);
	}

    /**
     * get email id
     * 
     * @return string
     */
    public function getEmailId()
	{
		return $this->getData(ContactFormInterface::EMAIL_ID);
	}

    /**
     * get phone number
     * 
     * @return int
     */
    public function getPhoneNumber()
	{
		return $this->getData(ContactFormInterface::PHONE_NUMBER);
	}

    /**
     * get newsletter subscription state
     * 
     * @return bool
     */
    public function getNewsletterSubscription()
	{
		return $this->getData(ContactFormInterface::NEWSLETTER_SUBSCRIPTION);
	}

    /**
     * set first name
     * 
     * @return $this
     */
    public function setFirstName($firstName)
	{
		$this->setData(ContactFormInterface::FIRST_NAME, $firstName);
		return $this;
	}

    /**
     * set last name
     * 
     * @return $this
     */
    public function setLastName($lastName)
	{
		$this->setData(ContactFormInterface::LAST_NAME, $lastName);
		return $this;
	}

    /**
     * set email id
     * 
     * @return $this
     */
    public function setEmailId($emailId)
	{
		$this->setData(ContactFormInterface::EMAIL_ID, $emailId);
		return $this;
	}

    /**
     * set phone number
     * 
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
	{
		$this->setData(ContactFormInterface::PHONE_NUMBER, $phoneNumber);
		return $this;
	}

    /**
     * set newsletter subscription state
     * 
     * @return $this
     */
    public function setNewsletterSubscription($newsletterSubscription)
	{
		$this->setData(ContactFormInterface::NEWSLETTER_SUBSCRIPTION, $newsletterSubscription);
		return $this;
	}
}