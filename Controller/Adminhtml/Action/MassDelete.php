<?php

namespace VS7\PromoMassactions\Controller\Adminhtml\Action;

class MassDelete extends \Magento\SalesRule\Controller\Adminhtml\Promo\Quote
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $ids = $this->getRequest()->getPost('ids');
        if(!is_array($ids)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = $this->_objectManager->create('\Magento\SalesRule\Model\Rule')
                        ->load($id)
                        ->delete();
                }
                $this->messageManager->addSuccess(__('Total of %1 rule(s) were successfully deleted.', count($ids)));

            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $resultRedirect->setPath('sales_rule/promo_quote/');
    }
}
