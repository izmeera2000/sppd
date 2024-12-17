<?php
require_once('../../config.php');
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `payment_history` where id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    } else {
        echo "<center><small class='text-muted'>Unkown Payment ID.</small</center>";
        exit;
    }
}
if (isset($_GET['transaction_id'])) {
    $qry = $conn->query("SELECT `paid_amount`,`balance` FROM `transaction_list` where id = '{$_GET['transaction_id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    } else {
        echo "<center><small class='text-muted'>Unkown Transaction ID.</small</center>";
        exit;
    }
} else {
    echo "<center><small class='text-muted'>Transaction ID is required.</small</center>";
    exit;
}
?>
<style>
    img#cimg {
        height: 17vh;
        width: 25vw;
        object-fit: scale-down;
    }
</style>
<div class="container-fluid">
    <form action="" id="payment-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <input type="hidden" name="transaction_id"
            value="<?php echo isset($_GET['transaction_id']) ? $_GET['transaction_id'] : '' ?>">
 
            <div class="form-group">
                <label for="amount" class="control-label">Amount</label>
                <input type="number" id="amount" name="amount" value="<?= isset($amount) ? $amount : '' ?>"
                    max="<?= isset($balance) ? $balance + (isset($amount) ? $amount : 1) : '' ?>"
                    class="form-control form-control-border form-control-sm text-right" required>
            </div>
 
        <div class="row justify-content-center">

            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <!-- <label class="btn btn-lg btn-primary active">
                    <input type="radio" name="method" id="cash" autocomplete="off" checked value="CASH">
                    Cash -->
                <!-- </label> -->
                <!-- <label class="btn btn-lg btn-primary"> -->
                <input type="hidden" name="method" id="qr" autocomplete="off" value="QR"> QR
                <!-- </label> -->
            </div>
        </div>

        <div class="row justify-content-center">
            <img class="qr-code" src="<?php echo base_url . 'uploads/qr.jpg'; ?>">
        </div>
        <div class="row justify-content-center">

            <input type="file" name="filename_payment" id="filename_payment">
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        // function toggleQrCode() {
        //     if ($('#qr').is(':checked')) {
        //         $('.qr-code').removeClass('d-none');
        //     } else {
        //         $('.qr-code').addClass('d-none');
        //     }
        // }

        // Initial check
        // toggleQrCode();

        // Add event listeners to the radio buttons
        // $('#cash').change(toggleQrCode);
        // $('#qr').change(toggleQrCode);
    });
    $(function () {
        $('#uni_modal').on('shown.bs.modal', function () {
            $('#amount').focus();
        })
        $('#uni_modal #payment-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            if (_this[0].checkValidity() == false) {
                _this[0].reportValidity();
                return false;
            }
            $('.pop-msg').remove()
            var el = $('<div>')
            el.addClass("pop-msg alert")
            el.hide()
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_payment",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (resp.status == 'success') {
                        location.reload();
                    } else if (!!resp.msg) {
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    } else {
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({ scrollTop: 0 }, 'fast')
                    end_loader();
                }
            })
        })
    })
</script>