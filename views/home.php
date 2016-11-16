<div class="jumbotron">
	  <h1>Hey! Salut mon amie !!!</h1>
	  <p>Tu aimes Webforce3 ?</p>
	  <p><a class="btn btn-primary btn-lg" href="https://www.youtube.com/watch?v=6TAjuotaLHw" target="_blank" role="button">Click ici</a></p>
</div>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Esch-Belval</div>
  <div class="panel-body">
  </div>
  <!-- Table -->
  <?php if(isset($trainingList) && sizeof($trainingList) > 0) : ?>
  <table class="table">
  <thead>
  	<tr>
  		<th>Id de Session</th>
  		<th>Date de début</th>
  		<th>Date de fin</th>
      <th>Nb</th>
  	</tr>
  </thead>
  <tbody>
    <?php foreach ($trainingList as $currentTraing) : ?>
      <tr>
        <td><a href='list.php?id=<?= $currentTraing['tra_id']?>'><?= $currentTraing['tra_id'] ?></a></td>
        <td><a href='list.php?id=<?= $currentTraing['tra_id']; $currentTraing['tra_id']?> '><?= $currentTraing['tra_start_date'] ?></a></td>
        <td><a href='list.php?id=<?<?= $currentTraing['tra_id']; $currentTraing['tra_id']?> '><?= $currentTraing['tra_end_date'] ?></a></td>
        <td><?= $currentTraing['nb'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  </table>
<?php else :?>
  aucune session
<?php endif; ?>
</div>