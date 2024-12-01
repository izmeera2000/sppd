<?php
require_once('../config.php');

$db = new DBConnection;
$conn = $db->conn;

$id = $id2;

    $qry = $conn->query("SELECT * FROM `transaction_list` where id = '$id'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }

?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="../plugins/fullcalendar/main.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.css">
    <link rel="stylesheet" href="../dist/css/custom.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
     <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<div class="content py-4">
    <div class="card card-outline card-navy shadow rounded-0">
        <div class="card-header">
            <h5 class="card-title">Transaction Details</h5>
        
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label text-muted">Transaction Code</label>
                            <div class="pl-4"><?= isset($code) ? $code : 'N/A' ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    
                </div>
                <fieldset>
                    <legend class="text-muted">Client Information</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">Name</label>
                                <div class="pl-4"><?= isset($client_name) ? $client_name : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">Contact #</label>
                                <div class="pl-4"><?= isset($client_contact) ? $client_contact : 'N/A' ?></div>
                            </div>
                        </div>
                    </div>
       
                </fieldset>
                <div class="clear-fix my-3"></div>
                <fieldset>
                    <div class="row">
                        <div class="col-md-8">
                            <legend class="text-muted">Items</legend>
                            <table class="table table-bordered table-striped">
                                <colgroup>
                                    <col width="30%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-gradient-red text-light">
                                        <th class="py-1 text-center">Size</th>
                                        <th class="py-1 text-center">File name</th>
                                        <th class="py-1 text-center">Price</th>
                                        <th class="py-1 text-center">Qty</th>
                                        <th class="py-1 text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($id)): ?>
                                        <?php
                                        $items = $conn->query("SELECT t.*,p.size, c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id inner join category_list c on p.category_id = c.id where t.transaction_id = '{$id}'");
                                        $i = 1;
                                        while ($row = $items->fetch_assoc()):
                                            ?>
                                            <tr>
                                                <td class=" align-middle px-2 py-1">
                                                    <p class="m-0 item_name"><?= $row['category'] . " - " . $row['size'] ?></p>
                                                </td>
                                                <td class=" align-middle px-2 py-1 text-right price"><a
                                                        href="<?php echo base_url ?>uploads/file/<?= $row['filename'] ?>"
                                                        target="_blank"><?= $row['filename'] ?></a></td>

                                                <td class=" align-middle px-2 py-1 text-right price">
                                                    <?= number_format($row['price'], 2) ?>
                                                </td>
                                                <td class=" align-middle px-2 py-1 text-right">
                                                    <?= number_format($row['quantity']) ?>
                                                </td>
                                                <td class=" align-middle px-2 py-1 text-right total">
                                                    <?= number_format($row['total'], 2) ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gradient-secondary">
                                        <th class="py-1 text-center" colspan='4'><b>Total<b></th>
                                        <th class="px-2 py-1 text-right total_amount">
                                            <?= isset($total_amount) ? number_format($total_amount, 2) : 0 ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <legend class="text-muted">Payment History</legend>
                            <table class="table table-stripped table-bordered">
                                <colgroup>
                                    <col width="30%">
                                    <col width="50%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-gradient-purple">
                                        <th class="py-1 text-center">DateTime</th>
                                        <th class="py-1 text-center">Amount</th>
                                        <th class="py-1 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($id)): ?>
                                        <?php
                                        $history = $conn->query("SELECT * FROM `payment_history` where transaction_id ='{$id}' order by unix_timestamp(date_created) asc");
                                        while ($row = $history->fetch_assoc()):
                                            ?>
                                            <tr>
                                                <td class="px-2 py-1 align-middle">
                                                    <?= date("Y-m-d h:i A", strtotime($row['date_created'])) ?>
                                                </td>
                                                <td class="px-2 py-1 text-right align-middle">
                                                    <?= "RM " . number_format($row['amount'], 2) ?><br>
                                                    <a   href="../uploads/payment/<?= $row['filename']  ?>" ><?= $row['filename']  ?></a>

                                                </td>
                                        
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gradient-secondary">
                                        <th class="px-2 py-1 text-center" colspan="2">Total</th>
                                        <th class="px-2 py-1 text-right">
                                            <?= isset($paid_amount) ? number_format($paid_amount, 2) : "0.00" ?>
                                        </th>
                                    </tr>
                                    <tr class="bg-gradient-secondary">
                                        <th class="px-2 py-1 text-center" colspan="2">Balance</th>
                                        <th class="px-2 py-1 text-right">
                                            <?= isset($balance) ? number_format($balance, 2) : "0.00" ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>