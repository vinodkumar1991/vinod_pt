<?php

class InvoiceController extends Controller {

   
    public function actionInvoice() {
        $arrOrder = array();
        $strOrderNo = $_GET['OrdNo'];//Yii::app()->request->getQueryString();
        if (!empty($strOrderNo)) {
            $arrOrder = Orders::getBookingOrdersList($intOrder=NULL,$strOrderNo);
        }
        $this->render('/Templates/Invoices/Invoice', array('order_info' => $arrOrder,'OrderNo'=>$strOrderNo));
    }

    public function actionHTML2pdf() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        $strOrderNo = $_GET['OrdNo'];//Yii::app()->request->getQueryString();
        if (!empty($strOrderNo)) {
            $arrOrder = Orders::getBookingOrdersList($intOrder=NULL,$strOrderNo);
        }
        # render (full page)
        $mPDF1->WriteHTML($this->renderPartial('/Templates/Invoices/Invoice_Print', array('order_info' => $arrOrder), true));
        # Outputs ready PDF
        $mPDF1->Output();
    }

}

?>