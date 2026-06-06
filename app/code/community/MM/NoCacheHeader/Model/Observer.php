<?php
class MM_NoCacheHeader_Model_Observer
{
    #[Maho\Config\Observer('controller_front_send_response_before', area: 'frontend')]
    public function addNoCacheHeader(\Maho\Event\Observer $observer): void
    {
        if (!Mage::getStoreConfigFlag('web/nocacheheader/add_nocache_header')) {
            return;
        }

        $response = $observer->getFront()->getResponse();
        $request = Mage::app()->getRequest();

        // Skip AJAX requests
        if ($request->isXmlHttpRequest()) {
            return;
        }

        $response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate', true);
        $response->setHeader('Pragma', 'no-cache', true);
    }
}
