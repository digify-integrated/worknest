<?php
    require('session.php');
    require('config/config.php');
    require('classes/api.php');

    $api = new Api;
    $page_title = 'Import Other Income';

    $page_access = $api->check_role_permissions($username, 272);
	$import_other_income = $api->check_role_permissions($username, 273);

	$check_user_account_status = $api->check_user_account_status($username);

    if($check_user_account_status == 0){
        if($page_access == 0){
            header('location: 404-page.php');
        }
    }
    else{
        header('location: logout.php?logout');
    }

    require('views/_application_settings.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <?php require('views/_head.php'); ?>
        <link rel="stylesheet" href="assets/libs/sweetalert2/sweetalert2.min.css">
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <?php require('views/_required_css.php'); ?>
    </head>

    <body data-sidebar="dark">
        <?php require('views/_preloader.php'); ?> 

        <div id="layout-wrapper">
            <?php 
                require('views/_top_bar.php');
                require('views/_menu.php'); 
            ?>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"><?php echo $page_title; ?></h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administrator</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Import</a></li>
                                            <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1 align-self-center">
                                                        <h4 class="card-title">Import Other Income</h4>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <?php
                                                            if($import_other_income > 0){
                                                                echo '<button type="button" class="btn btn-primary waves-effect btn-label waves-light" id="import-other-income"><i class="bx bx-import label-icon"></i> Import</button>';
                                                            }
                                                        ?>

                                                        <button type="button" class="btn btn-success waves-effect btn-label waves-light d-none multiple" id="submit-import-other-income"><i class="bx bx-import label-icon"></i> Import</button>

                                                        <button type="button" class="btn btn-danger waves-effect btn-label waves-light d-none multiple" id="clear-import-other-income"><i class="bx bx-trash label-icon"></i> Clear</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <table id="import-other-income-datatable" class="table table-bordered align-middle mb-0 table-hover table-striped dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th class="all">Other Income ID</th>
                                                            <th class="all">Employee ID</th>
                                                            <th class="all">Other Income Type</th>
                                                            <th class="all">Payroll ID</th>
                                                            <th class="all">Payroll Date</th>
                                                            <th class="all">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-grow-1 align-self-center">
                                                        <h4 class="card-title">Instructions</h4>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <a href="./import_template/import_other_income.csv" class="btn btn-success waves-effect waves-light" target="_blank">Download Template File</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <h5 class="font-size-15">Follow the instructions carefully before importing the file.</h5>
                                                <p class="mb-2">The columns of the file should be in the following order.</p>
                                            </div>
                                        </div>       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Column Number</th>
                                                                <th>Column Name</th>
                                                                <th>Type</th>
                                                                <th>Max Length</th>
                                                                <th>Required</th>
                                                                <th>Instruction</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Other Income ID</td>
                                                                <td>Text</td>
                                                                <td>50</td>
                                                                <td><span class="badge bg-info">No</span></td>
                                                                <td>Leave blank if you wish to insert. If you want to update get the database ID of the other income.</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>Employee ID</td>
                                                                <td>Text</td>
                                                                <td>100</td>
                                                                <td><span class="badge bg-warning">Yes</span></td>
                                                                <td>--</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>Other Income Type</td>
                                                                <td>Text</td>
                                                                <td>50</td>
                                                                <td><span class="badge bg-warning">Yes</span></td>
                                                                <td>Get the database ID of the type of other income.</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">4</th>
                                                                <td>Payroll ID</td>
                                                                <td>Text</td>
                                                                <td>100</td>
                                                                <td><span class="badge bg-info">No</span></td>
                                                                <td>Get the database ID of the payroll that the other income is connected.</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">5</th>
                                                                <td>Payroll Date</td>
                                                                <td>Date</td>
                                                                <td>--</td>
                                                                <td><span class="badge bg-warning">Yes</span></td>
                                                                <td>--</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">6</th>
                                                                <td>Amount</td>
                                                                <td>Number</td>
                                                                <td>--</td>
                                                                <td><span class="badge bg-warning">Yes</span></td>
                                                                <td>--</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php require('views/_footer.php'); ?>
               
            </div>
        </div>

        <?php require('views/_script.php'); ?>
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="assets/libs/jquery-validation/js/jquery.validate.min.js"></script>
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/system.js?v=<?php echo rand(); ?>"></script>
        <script src="assets/js/pages/import-other-income.js?v=<?php echo rand(); ?>"></script>
    </body>
</html>