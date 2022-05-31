<?php
declare(strict_types=1);

namespace RightPointAssignments\ContactForm\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ContactForm extends AbstractDb
{
    protected function _construct()
	{
		$this->_init('rp_contact_form', 'entity_id');
	}
}