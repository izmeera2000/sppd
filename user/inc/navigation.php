</style>
<!-- Main Sidebar Container -->
<?php
    $base_page = "user";

if ($_settings->userdata('type') == 1):
    $base_page = "admin";
endif; 
?>

<aside class="main-sidebar sidebar-dark-maroon elevation-4 sidebar-no-expand bg-gradient-red">
  <!-- Brand Logo -->
  <a href="<?php echo base_url . $base_page ?>" class="brand-link bg-transparent text-sm border-0 shadow-sm">
    <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo"
      class="brand-image elevation-3 bg-white"
      style="width: 1.8rem;height: 1.8rem;max-height: unset;object-fit:scale-down;object-position:center center">
    <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
  </a>
  <!-- Sidebar -->
  <div
    class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
    <div class="os-resize-observer-host observed">
      <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
    </div>
    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
      <div class="os-resize-observer"></div>
    </div>
    <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
          <!-- Sidebar user panel (optional) -->
          <div class="clearfix"></div>
          <!-- Sidebar Menu -->
          <nav class="mt-4">
            <ul
              class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child"
              data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item dropdown">
                <a href="./" class="nav-link nav-home">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url . $base_page ?>/?page=prices" class="nav-link nav-prices">
                  <i class="nav-icon fas fa-tags"></i>
                  <p>
                    Price List
                  </p>
                </a>
              </li>
              <li class="nav-header">Transactions</li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url . $base_page ?>/?page=transactions/manage_transaction"
                  class="nav-link nav-transactions_manage_transaction">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>
                    New Transaction
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url . $base_page ?>/?page=transactions" class="nav-link nav-transactions">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>
                    Transaction Records
                  </p>
                </a>
              </li>
              <?php if ($_settings->userdata('type') == 1): ?>

                <li class="nav-header">Reports</li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url . $base_page ?>/?page=reports/daily_transaction"
                    class="nav-link nav-reports_daily_transaction">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Daily Transactions
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url . $base_page ?>/?page=reports/date_wise_transaction"
                    class="nav-link nav-reports_date_wise_transaction">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Date-wise Transactions
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url . $base_page ?>/?page=reports/date_wise_payment"
                    class="nav-link nav-reports_date_wise_payment">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                      Date-wise Payments
                    </p>
                  </a>
                </li>

                <li class="nav-header">Maintenance</li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url . $base_page ?>/?page=categories" class="nav-link nav-categories">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                      Category List
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url . $base_page ?>/?page=user/list" class="nav-link nav-user_list">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>
                      User List
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a href="<?php echo base_url . $base_page ?>/?page=system_info" class="nav-link nav-system_info">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>
                      Settings
                    </p>
                  </a>
                </li>
              <?php endif; ?>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar-corner"></div>
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  var page;
  $(document).ready(function () {
    page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    page = page.replace(/\//gi, '_');

    if ($('.nav-link.nav-' + page).length > 0) {
      $('.nav-link.nav-' + page).addClass('active')
      if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
      }
      if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
        $('.nav-link.nav-' + page).parent().addClass('menu-open')
      }

    }

    $('#receive-nav').click(function () {
      $('#uni_modal').on('shown.bs.modal', function () {
        $('#find-transaction [name="tracking_code"]').focus();
      })
      uni_modal("Enter Tracking Number", "transaction/find_transaction.php");
    })
  })
</script>