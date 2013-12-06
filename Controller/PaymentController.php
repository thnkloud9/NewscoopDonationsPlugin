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
        $shaPass = 'nzzonline123456#$';
        
        $accepturl = $request->get('accepturl');
        $amount = $request->get('amount');
        $currency = $request->get('currency');
        $language = $request->get('language');
        $orderId = $request->get('orderID');
        $PSPID = $request->get('PSPID');
        
        $shaString = "ACCEPTURL=".$accepturl.$shaPass."AMOUNT=".$amount.$shaPass."CURRENCY=".$currency.$shaPass."LANGUAGE=".$language.$shaPass."ORDERID=".$orderId.$shaPass."PSPID=".$PSPID.$shaPass;
        
    	$SHASign = sha1($shaString);
        
        //var_dump($shaString);

        return $this->render('NewscoopDonationsPluginBundle:Default:postfinance.html.smarty', array(
            'amount' => $amount,
            'accepturl' => $accepturl,
            'realAmount' => $round($amount/100, 2),
            'language' => $language,
            'orderId' => $orderId,
            'PPSID' => $PSPID,
            'SHASign' => $SHASign,
        ));
    }
}
