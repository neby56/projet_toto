<div class="panel panel-primary">
<h3 class="panel-heading">Liste des étudiants</h3>
<form action="" method="post">
<fieldset>
<label>Combien en voulez-vous?</label>
<select name="limite" class="form-control">
	<option value="">Choississez</option>
	<?php for($i=1;$i<10;$i++) :?>
		<option value=""><?=$i ?></option>
	<?php endfor; ?>
	<input type="submit" value="Valider" class="form-control">
</fieldset>
</form>

<div class="panel-body"></div>
<?php if (isset($studentListe) && sizeof($studentListe) > 0) : ?>
	<table class="table">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Ville</th>
			</tr>
		</thead>
		<tbody>
<?php foreach ($studentListe as $currentEtudiant) : ?>
			<tr>
				<td><a href="student.php?id=<?= $currentEtudiant['stu_id']?>"><?= strtoupper($currentEtudiant['stu_lname']) ?></a></td>
				<td><?= $currentEtudiant['stu_fname'] ?></td>
				<td><?= $currentEtudiant['cit_name'] ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<?php if($page>1) : ?>
		<a class="pull-left btn btn-primary" href="<?= $precedent?>">Précédent</a>
	<?php endif ?>

	<?php if($studentListe) : ?>
		<a class="pull-right btn btn-primary" href="<?= $suivant?>">Suivant</a>
	<?php endif ?>
	<br/>
	<br/>

<?php else :?>
	aucun étudiant
<?php endif; ?>
</div>