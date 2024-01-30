<footer class="footer text-center">
    &copy; <?php echo date('Y'); ?> | Yabatech Complaint Management System  | Designed and Developed by <a href="javascript:void();">Nnoluka Franklyn C., Ose Emmanuel and Blessing Ungwugian</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo $base_url; ?>assets/libs/jquery/dist/jquery.min.js"></script>




<!--Menu sidebar -->
<script src="<?php echo $base_url; ?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo $base_url; ?>dist/js/custom.min.js"></script>

<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo $base_url; ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/libs/select2/dist/js/select2.min.js"></script>

<!--This page JavaScript -->
<!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    //script for the header search
    $(document).ready(function(){
        $("#search").keyup(function () {
            $('#search-data').css('display', 'block');
            var search = $(this).val();
            //send data to the PHP script using Ajax
            $.ajax({
                url:"<?php echo $conn->base_url()?>/process-search.php",
                method: "POST",
                data: {query: search},
                success: function (response) {
                    //populate the result div with the fetched data
                    $("#search-data").html(response);
                    if(search.length === 0){
                        $("#search-data").html('');
                    }
                }

            })
        })

    });
</script>
