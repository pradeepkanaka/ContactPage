<?php

namespace RightPointAssignments\ContactForm\Api\Data;

interface ContactFormInterface
{
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const EMAIL_ID = 'email_id';
    const PHONE_NUMBER = 'phone_number';
    const NEWSLETTER_SUBSCRIPTION = 'newsletter_subscription';

    /**
     * get first name
     * 
     * @return string
     */
    public function getFirstName();

    /**
     * get last name
     * 
     * @return string|null
     */
    public function getLastName();

    /**
     * get email id
     * 
     * @return string
     */
    public function getEmailId();

    /**
     * get phone number
     * 
     * @return int
     */
    public function getPhoneNumber();

    /**
     * get newsletter subscription state
     * 
     * @return bool
     */
    public function getNewsletterSubscription();

    /**
     * set first name
     * 
     * @return $this
     */
    public function setFirstName($firstName);

    /**
     * set last name
     * 
     * @return $this
     */
    public function setLastName($lastName);

    /**
     * set email id
     * 
     * @return $this
     */
    public function setEmailId($emailId);

    /**
     * set phone number
     * 
     * @return $this
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * set newsletter subscription state
     * 
     * @return $this
     */
    public function setNewsletterSubscription($newsletterSubscription);
}