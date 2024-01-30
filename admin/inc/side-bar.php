<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">

                <li   <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'index.php'){
                    echo "class='sidebar-item selected'";
                }else{
                    echo "class='sidebar-item'";
                }
                ?>>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>admin" aria-expanded="false">
                        <i class="fas fa-tachometer-alt"></i><span class="hide-menu">Dashboard</span></a>
                </li>

                <li   <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'complaints.php'
                    || basename($_SERVER['SCRIPT_NAME']) == 'view-complaint.php'){
                    echo "class='sidebar-item selected'";
                }else{
                    echo "class='sidebar-item'";
                }
                ?>>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>admin/complaints" aria-expanded="false">
                        <i class="fas fa-bullhorn"></i><span class="hide-menu">All Complaints</span>
                    </a>
                </li>
                
                       <li  <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'complaint-categories.php'){
                    echo "class='sidebar-item selected'";
                }else{
                    echo "class='sidebar-item'";
                }
                ?>>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>admin/complaint-categories" aria-expanded="false">
                        <i class="fas fa-list"></i><span class="hide-menu">Complaint Categories</span>
                    </a>
                </li>
                
                         <li  <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'complaint-subcategories.php'){
                    echo "class='sidebar-item selected'";
                }else{
                    echo "class='sidebar-item'";
                }
                ?>>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>admin/complaint-subcategories" aria-expanded="false">
                        <i class="fas fa-list-ol"></i><span class="hide-menu">Complaint Subcategories</span>
                    </a>
                </li>


                <li  <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'logout.php'){
                    echo "class='sidebar-item selected'";
                }else{
                    echo "class='sidebar-item'";
                }
                ?>>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>admin/logout" aria-expanded="false">
                        <i class="fas fa-lock"></i><span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>