<h1>Welcome to <?php echo $_settings->info('name') ?> - Admin Panel</h1>
<hr class="border-purple">
<style>
    #website-cover{
        width:100%;
        height:30em;
        object-fit:cover;
        object-position:center center;
    }
</style>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-purple elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Total Categories</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `category_list` WHERE delete_flag= 0 AND `status` = 1 ")->num_rows;
                ?>
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
                <?php 

                $id =  $_settings->info('user_id');
                    echo $conn->query("SELECT * FROM `transaction_list` WHERE (`status` = 0)   AND (user_id = '$id') ")->num_rows;
                ?>
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
                <?php 
                    echo $conn->query("SELECT * FROM `transaction_list` WHERE (`status` = 1)   AND (user_id = '$id')  ")->num_rows;
                ?>
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
                <?php 
                    echo $conn->query("SELECT * FROM `transaction_list` WHERE (`status` = 2)   AND (user_id = '$id')  ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
 
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <img src="<?= validate_image($_settings->info('cover')) ?>" alt="Website Cover" class="img-fluid border w-100" id="website-cover">
    </div>
</div>
