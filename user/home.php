 

<h1>Selamat Datang Ke  <?php echo $_settings->info('name') ?> - User Panel</h1>
<hr class="border-purple">
<style>
    #website-cover {
        width: 100%;
        height: 30em;
        object-fit: cover;
        object-position: center center;
    }
</style>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-purple elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Categories</span>
                <span class="info-box-number text-right">


                    <?php if ($_settings->userdata('type') == 1):

                        echo $conn->query("SELECT * FROM `category_list` where delete_flag= 0 and `status` = 1 ")->num_rows;

                    endif;
                    if ($_settings->userdata('type') == 2):
                        echo $conn->query("SELECT * FROM `category_list` where delete_flag= 0 and `status` = 1 ")->num_rows;

                    endif; ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-folder"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pending Transactions</span>
                <span class="info-box-number text-right">


                    <?php if ($_settings->userdata('type') == 1):

                        echo $conn->query("SELECT * FROM `transaction_list` where `status` = 0 ")->num_rows;

                    endif;
                    if ($_settings->userdata('type') == 2):

                        $user_id = $_settings->userdata('user_id');
                        echo $conn->query("SELECT * FROM `transaction_list` where `status` = 0 AND user_id = '$user_id' ")->num_rows;

                    endif; ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-folder"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">On-Progress Transactions</span>
                <span class="info-box-number text-right">


                    <?php if ($_settings->userdata('type') == 1):

                        echo $conn->query("SELECT * FROM `transaction_list` where `status` = 1 ")->num_rows;

                    endif;
                    if ($_settings->userdata('type') == 2):

                        $user_id = $_settings->userdata('user_id');
                        echo $conn->query("SELECT * FROM `transaction_list` where `status` = 1 AND user_id = '$user_id' ")->num_rows;


                    endif; ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-teal elevation-1"><i class="fas fa-folder"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Finished Transactions</span>
                <span class="info-box-number text-right">


                    <?php if ($_settings->userdata('type') == 1):

                        echo $conn->query("SELECT * FROM `transaction_list` where `status` = 2 ")->num_rows;

                    endif;
                    if ($_settings->userdata('type') == 2):

                        $user_id = $_settings->userdata('user_id');
                        echo $conn->query("SELECT * FROM `transaction_list` where `status` = 2 AND user_id = '$user_id'  ")->num_rows;


                    endif; ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <?php if ($_settings->userdata('type') == 1): ?>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="info-box bg-gradient-light shadow">
                <span class="info-box-icon bg-gradient-maroon elevation-1"><i class="fas fa-coins"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Todays Payments</span>
                    <span class="info-box-number text-right">
                        <?php
                        $payments = $conn->query("SELECT SUM(amount) FROM `payment_history` where date(date_created) = '" . (date("Y-m-d")) . "'")->fetch_array()[0];
                        $payments = $payments > 0 ? $payments : 0;
                        echo number_format($payments, 2);
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    <?php endif; ?>

</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <img src="<?= validate_image($_settings->info('cover')) ?>" alt="Website Cover" class="img-fluid border w-100"
            id="website-cover">
    </div>
</div>