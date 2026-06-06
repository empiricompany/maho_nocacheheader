<?php
class MM_NoCacheHeader_Model_Observer
{
    #[Maho\Config\Observer('controller_front_send_response_before')]
    public function addNoCacheHeader(\Maho\Event\Observer $observer): void
    {
        if (!Mage::getStoreConfigFlag('web/nocacheheader/add_nocache_header')) {
            return;
        }

        $response = $observer->getFront()->getResponse();
        $request = Mage::app()->getRequest();

        // Frontend + non-AJAX only
        if ($request->isXmlHttpRequest() || Mage::app()->getStore()->isAdmin()) {
            return;
        }

        $response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate', true);
        $response->setHeader('Pragma', 'no-cache', true);
    }
}
