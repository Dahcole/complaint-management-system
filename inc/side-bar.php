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
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>" aria-expanded="false">
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
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>complaints" aria-expanded="false">
                        <i class="fas fa-bullhorn"></i><span class="hide-menu">All Complaints</span>
                    </a>
                </li>

                <li   <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'add-complaint.php'){
                    echo "class='sidebar-item selected'";
                }else{
                    echo "class='sidebar-item'";
                }
                ?>>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>add-complaint" aria-expanded="false">
                        <i class="fas fa-plus"></i><span class="hide-menu">Lodge Complaint</span>
                    </a>
                </li>

                <li  <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'contact.php'){
                    echo "class='sidebar-item selected'";
                }else{
                    echo "class='sidebar-item'";
                }
                ?>>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>contact" aria-expanded="false">
                        <i class="fas fa-phone"></i><span class="hide-menu">Contact</span>
                    </a>
                </li>

                <li  <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'logout.php'){
                    echo "class='sidebar-item selected'";
                }else{
                    echo "class='sidebar-item'";
                }
                ?>>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url?>logout" aria-expanded="false">
                        <i class="fas fa-lock"></i><span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
