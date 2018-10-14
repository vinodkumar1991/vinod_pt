<!--Tab Menus :: END-->
<div class="card-body">
    <!--Tab Menus :: START-->
    <ul class="nav nav-tabs" role="tablist">
        <li>
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/Create'; ?>">Create Agent</a>
        </li>
        <li class="active">
            <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/AgentsReport'; ?>">Agent Report</a>
        </li>
    </ul>

    <!--Tab Menus :: END-->  

    <div class="col-md-12">
        <div class="table-responsive">
            <table class="datatable table table-striped" cellspacing="0" width="100%" id="example">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Agency Name</th>
                        <th>Owner</th>
                        <th>Code</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Username</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($agents_report)) {
                        $i = 0;
                        foreach ($agents_report as $arrAgent) {
                            $i++;
                            ?>
                            <tr data-toggle="modal">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($arrAgent['agency_name']) ? $arrAgent['agency_name'] : NULL;
                                    ?>
                                </td>       
                                <td>
                                    <?php
                                    echo isset($arrAgent['agent_owner']) ? $arrAgent['agent_owner'] : NULL;
                                    ?>
                                </td>       

                                <td>
                                    <?php
                                    echo isset($arrAgent['agent_code']) ? $arrAgent['agent_code'] : NULL;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($arrAgent['agent_email']) ? $arrAgent['agent_email'] : NULL;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($arrAgent['agent_phone']) ? $arrAgent['agent_phone'] : NULL;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($arrAgent['agent_user_name']) ? $arrAgent['agent_user_name'] : NULL;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($arrAgent['agent_address']) ? $arrAgent['agent_address'] : NULL;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($arrAgent['city_name']) ? $arrAgent['city_name'] : NULL;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo isset($arrAgent['area_name']) ? $arrAgent['area_name'] : NULL;
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    $status = 'Active';
                                    if (0 == $arrAgent['agent_status']) {
                                        $status = 'Inactive';
                                    }
                                    echo $status;
                                    ?>
                                </td>
                                <td align="center">
                                    <a href="<?php echo Yii::app()->params['webURL'] . 'SelfDrive/Agent/EditAgentsReport/id/' . $arrAgent['agent_id']; ?>" class="clickbtn edit-u"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        unset($agents_report);
                        unset($i);
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>    