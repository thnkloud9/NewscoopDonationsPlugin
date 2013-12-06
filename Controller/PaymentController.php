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

        if (!$reguest->get('accepturl') || 
            !$request->get('amount') || 
            !$request->get('currency') || 
            !$request->get('language') || 
            !$request->get('orderID') || 
            !$request->get('PSPID')) {
			die('Forbidden');        	
        }
        
        $shaPass = 'nzzonline123456#$';
        
        $accepturl = $request->get['accepturl'];
        $amount = $request->get['amount'];
        $currency = $request->get['currency'];
        $language = $request->get['language'];
        $orderId = $request->get['orderID'];
        $PSPID = $request->get['PSPID'];
        
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

        //var_dump($SHASign);

        return $this->render('NewscoopDonationsPluginBundle:Default:postfinance.html.smarty');
    }
}
