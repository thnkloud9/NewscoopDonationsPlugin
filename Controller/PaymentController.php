<?php

namespace Newscoop\DonationsPluginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    /**
     * @Route("/plugin/donations/postfinance")
     */
    public function postfinanceAction(Request $request)
    {
        $defaultData = array('accepturl' => '', 'amount' => '', 
            'currency' => '', 'language' => '', 'orderID' => '', 
            'PSPID' => '');
        $form = $this->createFormBuilder($defaultData)
            ->add('accepturl', 'hidden')
            ->add('amount', 'hidden')
            ->add('currency', 'hidden')
            ->add('language', 'hidden')
            ->add('orderID', 'hidden')
            ->add('PSPID', 'hidden')
            ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $data = $form->getData();
        }

        $shaPass = 'nzzonline123456#$';
        
        $accepturl = $data['accepturl'];
        $amount = $data['amount'];
        $currency = $data['currency'];
        $language = $data['language'];
        $orderId = $data['orderID'];
        $PSPID = $data['PSPID'];
        
        $shaString = "ACCEPTURL=".$accepturl.$shaPass."AMOUNT=".$amount.$shaPass."CURRENCY=".$currency.$shaPass."LANGUAGE=".$language.$shaPass."ORDERID=".$orderId.$shaPass."PSPID=".$PSPID.$shaPass;
        
    	$SHASign = sha1($shaString);
        
        /*	
    	$this->view->amount = $amount;
    	$this->view->accepturl = $accepturl;
    	$this->view->realAmount = round($amount/100, 2);
    	$this->view->language = $language;
    	$this->view->orderID = $orderId;
    	$this->view->PSPID = $PSPID;
    	$this->view->SHASign = $SHASign;
        */

        var_dump($shaString);

        return $this->render('NewscoopDonationsPluginBundle:Default:postfinance.html.smarty');
    }
}
