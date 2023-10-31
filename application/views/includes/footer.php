
<script src="<?php echo base_url("node_modules/flowbite/dist/flowbite.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.js") ?>"></script>
<script src="<?php echo base_url("assets/js/datatable.js") ?>"></script>
<script src="<?php echo base_url("assets/js/select2.js") ?>"></script>
<script>
    new DataTable('#example');

    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

</body>
</html>
