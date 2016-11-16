<div class="panel panel-primary">
<h3 class="panel-heading">Liste des informations des étudiants</h3>
<div class="panel-body">
  <div id="studentContent"></div>
</div>

</div>
<script type="text/javascript">
  var param = 'id='+$('#idEtudiant').val();
  $('#studentContent').load('student.php', param);
</script>