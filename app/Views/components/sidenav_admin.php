<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="dashboard.html">
          <img src="<?= base_url() ?>/public/assets/img/brand/ps-logo.png" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('/admdashboard') ?>">
                <i class="ni ni-shop text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../widgets.html">
                <i class="ni ni-collection text-orange"></i>
                <span class="nav-link-text">Invoice</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-bag-17 text-green"></i>
                <span class="nav-link-text">Package</span>
              </a>
              <div class="collapse" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="<?= site_url('admpackagefeature') ?>" class="nav-link">
                      Feature
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('admpackageprice') ?>" class="nav-link">Price</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                <i class="ni ni-single-02 text-primary"></i>
                <span class="nav-link-text">Account</span>
              </a>
              <div class="collapse" id="navbar-components">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="<?= site_url('admaccountuserlevel'); ?>" class="nav-link">Level</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('admaccountmember'); ?>" class="nav-link">Member</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('admaccountuser'); ?>" class="nav-link">User</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('admaccountadministrator'); ?>" class="nav-link">Administrator</a>
                  </li>
                  <li class="nav-item">
                    <a href="#navbar-multilevel" class="nav-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-multilevel">Master</a>
                    <div class="collapse show" id="navbar-multilevel" style="">
                      <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                          <a href="<?= site_url('admmasterkomunitas'); ?>" class="nav-link ">Komunitas</a>
                        </li>
                        <li class="nav-item">
                          <a href="<?= site_url('admmasteranggota'); ?>" class="nav-link ">Anggota</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">
                <i class="ni ni-single-copy-04 text-info"></i>
                <span class="nav-link-text">Information</span>
              </a>
              <div class="collapse" id="navbar-forms">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="<?= site_url('adminfotype') ?>" class="nav-link">
                      Type
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('adminfocat') ?>" class="nav-link">
                      Category
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('adminfonews') ?>" class="nav-link">News & Events</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a href="../forms/validation.html" class="nav-link">Events</a>
                  </li> -->
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-tables" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-tables">
                <i class="ni ni-image text-pink"></i>
                <span class="nav-link-text">Media</span>
              </a>
              <div class="collapse" id="navbar-tables">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="<?= site_url('admmediafilter'); ?>" class="nav-link">Filter</a>
                  </li>
                  <li class="nav-item">
                    <a href="../tables/sortable.html" class="nav-link">Images</a>
                  </li>
                  <li class="nav-item">
                    <a href="../tables/datatables.html" class="nav-link">Videos</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-maps" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-maps">
                <i class="ni ni-curved-next text-orange"></i>
                <span class="nav-link-text">Feedback</span>
              </a>
              <div class="collapse" id="navbar-maps">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="<?= site_url('admfeedbackquestion'); ?>" class="nav-link">Question</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('admfeedbacksubscribe'); ?>" class="nav-link">Subscribe</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-another" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-tables">
                <i class="ni ni-settings-gear-65"></i>
                <span class="nav-link-text">Settings</span>
              </a>
              <div class="collapse" id="navbar-another">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="../tables/tables.html" class="nav-link">Banner</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('admsettingbenefit'); ?>" class="nav-link">Benefit</a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('admsettingcustom'); ?>" class="nav-link">Custom</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
        </div>
      </div>
    </div>
  </nav>