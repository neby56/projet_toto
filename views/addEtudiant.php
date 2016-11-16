<form action="" method="post">
	<fieldset>
		<legend>Ajout d'un étudiant</legend>
		<div class="form-group">
			<input type="text" name="studentName" value="" class="form-control" placeholder="Nom"><br />
			<input type="text" name="studentFirstname" value="" class="form-control" placeholder="Prénom"><br />
			<input type="email" name="studentEmail" value="" class="form-control" placeholder="E-mail"><br />
			<input type="tel" name="studentAge" value="" class="form-control" placeholder="Age"><br />
			<label>Ville de résidence :</label>
			<select name="cit_id" class="form-control">
				<option value="0">choisissez :</option>
				<?php foreach ($citiesList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach; ?>
			</select><br />
			<label>Nationalité :</label>
			<select name="cou_id" class="form-control">
				<option value="0">choisissez :</option>
				<?php foreach ($countriesList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach; ?>
			</select><br />
			<label>Sympathie :</label>
			<select name="stu_friendliness" class="form-control">
				<option value="">choisissez :</option>
				<?php foreach ($sympathieList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach; ?>
			</select><br />
			</div>
			<input type="submit" value="Valider" class="form-control"><br />
	</fieldset>
</form>