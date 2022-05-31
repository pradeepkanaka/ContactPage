<?php 

declare(strict_types=1);

namespace RightPointAssignments\ContactForm\Controller\ContactForm;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\UrlFactory;
use RightPointAssignments\ContactForm\Api\ContactFormRepositoryInterface;
use RightPointAssignments\ContactForm\Api\Data\ContactFormInterface;

class Save extends Action
{
    /**
     * @var UrlInterface
     */
    private $urlModel;

    /**
     * @var ContactFormRepositoryInterface
     */
    private $contactFormRepositoryInterface;

    /**
     * 
     * @param Context $context
     * @param UrlFactory $urlFactory
     * @param ContactFormRepositoryInterface $contactFormRepositoryInterface
     * @param ContactFormInterface $contactFormInterface
     */
    public function __construct(
        Context $context,
        UrlFactory $urlFactory,
        ContactFormRepositoryInterface $contactFormRepositoryInterface,
        ContactFormInterface $contactFormInterface
    ) {
        $this->urlModel = $urlFactory->create();
        $this->contactFormRepositoryInterface = $contactFormRepositoryInterface;
        $this->contactFormInterface = $contactFormInterface;

        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $contactFormData = $this->getRequest()->getParams();
            if (isset($contactFormData['newsletter_subscription'])) {
                $contactFormData['newsletter_subscription'] = 1;
            }
            $contactFormObj = $this->contactFormInterface->setData($contactFormData);
            $this->contactFormRepositoryInterface->save($contactFormObj);
            $this->messageManager->addSuccessMessage("Contact information saved.");
        } catch (\Exception $ex) {
            $this->messageManager->addErrorMessage($ex->getMessage());
        }
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $url = $this->urlModel->getUrl('*/*/index', ['_secure' => true]);
        $resultRedirect->setUrl($url);
        return $resultRedirect;
    }
}