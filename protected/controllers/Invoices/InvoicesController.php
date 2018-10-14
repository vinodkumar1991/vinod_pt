<?php

class InvoicesController extends Controller {

    public function __construct() {
        if (empty(Yii::app()->session['customerID'])) {
            $this->redirect($this->createUrl('mPSVEHICLES_DETAILS/AddVehicle'));
        }
    }

    public function actionInvoice() {
        $arrOrder = $arrExtraRepairsList = array();
        $strOrderNo = Yii::app()->request->getQueryString();
        if (!empty($strOrderNo)) {
            $arrOrder = Orders::model()->orderInfo($strOrderNo);
            $arrExtraRepairsList=Orders::model()->extraRepairsList($strOrderNo,NULL);
        }
        $this->render('/Templates/Invoices/Invoice', array('order_info' => $arrOrder , 'extra_repairs' => $arrExtraRepairsList));
    }

    public function actionHTML2pdf() {
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
        $strOrderNo = Yii::app()->request->getQueryString();
        if (!empty($strOrderNo)) {
            $arrOrder = Orders::model()->orderInfo($strOrderNo);
        }
        # render (full page)
        $mPDF1->WriteHTML($this->renderPartial('/Templates/Invoices/Invoice_Print', array('order_info' => $arrOrder), true));
        # Outputs ready PDF
        $mPDF1->Output();
    }

    public function actionTest(){
        $this->render('/Templates/Invoices/Invoice_Print');
    }

}

?>