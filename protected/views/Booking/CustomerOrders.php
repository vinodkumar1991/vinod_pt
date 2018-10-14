<section class="orders-main page-section breadcrumbs">
    <div class="container">
        <div class="col-md-12 text-right">
            <div class="page-header">
                <h1>List of Orders</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active">List of Orders</li>
            </ul>
        </div>
    </div>
</section>
<section class="page-section with-sidebar sub-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--Book A Service :: START-->
                <?php
                if (!empty($customer_orders)) {
                    foreach ($customer_orders as $arrEleCustomerOrder) {
                        ?>
                        <div class="orders-list-bg">
                            <div class="col-md-8">
                                <table class="table borderless">
                                    <tr>
                                        <td width="50%">Order / Booking Id</td>
                                        <td width="50%">
                                            <strong>
                                                <?php
                                                echo isset($arrEleCustomerOrder['order_number']) ? $arrEleCustomerOrder['order_number'] : NULL;
                                                ?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vehicle Type</td>
                                        <td>
                                            <?php
                                            echo isset($arrEleCustomerOrder['vehicle_name']) ? $arrEleCustomerOrder['vehicle_name'] : NULL;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Type of Service</td>
                                        <td>
                                            <?php
                                            echo isset($arrEleCustomerOrder['service_name']) ? $arrEleCustomerOrder['service_name'] : NULL;
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Package </td>
                                        <td>
                                            <?php
                                            echo isset($arrEleCustomerOrder['plan_name']) ? $arrEleCustomerOrder['plan_name'] : NULL;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Booking Date / Time</td>
                                        <td>
                                            <?php
                                            $strPickupDate = isset($arrEleCustomerOrder['pickup_date']) ? $arrEleCustomerOrder['pickup_date'] : NULL;
                                            $strPickupTime = isset($arrEleCustomerOrder['pickup_time']) ? $arrEleCustomerOrder['pickup_time'] : NULL;
                                            echo $strPickupDate . ' ' . $strPickupTime;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Type</td>
                                        <td>
                                            <?php
                                            echo isset($arrEleCustomerOrder['payment_mode']) ? $arrEleCustomerOrder['payment_mode'] : NULL;
                                            ?>
                                        </td>
                                    </tr>						
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>
                                            <?php
                                            $doubleAmount = isset($arrEleCustomerOrder['final_amount']) ? $arrEleCustomerOrder['final_amount'] : NULL;
                                            echo 'Rs. ' . number_format($doubleAmount, 2);
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="order-btn">
                                    <a href="" class="btn btn-theme btn-theme-dark">
                                        <i class="fa fa-file-text" aria-hidden="true"></i> Track Vehicle</a><br>
                                    <a href="<?php echo Yii::app()->params['webURL'] . 'Invoices/Invoices/Invoice?' . $arrEleCustomerOrder['order_number']; ?>" class="btn btn-theme btn-theme-dark" target="__blank">
                                        <i class="fa fa-file-text" aria-hidden="true"></i> View Invoice</a><br>
                                    <!--                                    <a href="" class="btn btn-theme btn-theme-dark cancel">
                                                                            <i class="fa fa-ban" aria-hidden="true"></i> Cancel Order</a>-->
                                </div>
<!--                                <div class="col-md-12 text-right">
                                    <div class="suc-txt"><i class="fa fa-check" aria-hidden="true"></i> Success</div><br>
                                    <div class="prog-txt"><i class="fa fa-refresh" aria-hidden="true"></i> In Progress</div>
                                </div>-->
                            </div>
                        </div>
                        <?php
                    }
                    unset($customer_orders);
                }
                ?>
                <!--Book A Service :: END-->
            </div>
        </div>
    </div>
</section>