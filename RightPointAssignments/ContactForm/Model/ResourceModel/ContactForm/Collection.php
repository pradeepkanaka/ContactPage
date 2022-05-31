<?php
declare(strict_types=1);

namespace RightPointAssignments\ContactForm\Model\ResourceModel\ContactForm;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
	{
		$this->_init('RightPointAssignments\ContactForm\Model\ContactForm', 'RightPointAssignments\ContactForm\Model\ResourceModel\ContactForm');
	}
}