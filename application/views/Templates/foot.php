  <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.0/dist/sweetalert2.js"></script>
	<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
	<!-- <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script> -->
	<script src="<?= base_url('assets/plugins/pace-progress/pace.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/demo.js') ?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/js/ckeditor/ckeditor.js') ?>"></script>

	<script>
		$(function () {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script>

</body>
</html>
