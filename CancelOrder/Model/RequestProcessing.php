<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Infobit\CancelOrder\Model;

/**
 * Description of RequestProcessing
 *
 * @author dell
 */
class RequestProcessing {

//put your code here

    public function __construct(
    \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\App\Config\ValueInterface $backendModel, \Magento\Framework\DB\Transaction $transaction, \Magento\Framework\App\Config\ValueFactory $configValueFactory, \Magento\Framework\App\Action\Context $context, \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder, \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Escaper $escaper, array $data = []
    ) {



        parent::__construct($data);
        $this->_storeManager = $storeManager;
        $this->_scopeConfig = $scopeConfig;
        $this->_backendModel = $backendModel;
        $this->_transaction = $transaction;
        $this->_configValueFactory = $configValueFactory;
        $this->_storeId = (int) $this->_storeManager->getStore()->getId();
        $this->_storeCode = $this->_storeManager->getStore()->getCode();

        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->_escaper = $escaper;
    }

    public function sendMail($request,$orderModel) {

        $this->inlineTranslation->suspend();
        try {
            
            $data = $request->getData();
            $data['increament_id'] = $orderModel->getIncreatmentId();
            
            //add other Data of Item Objects
            $items = $orderModel->getItems();
            foreach($items as $item) {
                
                //if(isset())
            }
            
            foreach($orderModel as $order) {
                
                
                
            }
            
            
            $postObject = new \Magento\Framework\DataObject();
            $postObject->setData($data);

            $error = false;


            $sender = [
                'name' => $this->_escaper->escapeHtml($post['name']),
                'email' => $this->_escaper->escapeHtml($post['email']),
            ];

            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->_transportBuilder
                    ->setTemplateIdentifier('send_email_email_template') // this code we have mentioned in the email_templates.xml
                    ->setTemplateOptions(
                            [
                                'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
                                'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                            ]
                    )
                    ->setTemplateVars(['data' => $postObject])
                    ->setFrom($sender)
                    ->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
                    ->getTransport();

            $transport->sendMessage();
            ;
            $this->inlineTranslation->resume();
            $this->messageManager->addSuccess(
                    __('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
            );
            $this->_redirect('*/*/');
            return;
        } catch (\Exception $e) {
            $this->inlineTranslation->resume();
            $this->messageManager->addError(
                    __('We can\'t process your request right now. Sorry, that\'s all we know.' . $e->getMessage())
            );
            $this->_redirect('*/*/');
            return;
        }
    }

}
