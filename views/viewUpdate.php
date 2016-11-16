<form enctype="multipart/form-data" action="" method="post">
	<fieldset>
		<div class="col-md-2"></div>
		<legend>Modification d'un étudiant</legend>
		<div class="form-group">
			<input type="text" name="studentName" value="<?= isset($studentName) ? $studentName : ''; ?>" class="form-control" placeholder="Nom"><br />
			<input type="text" name="studentFirstname" value="<?= isset($studentFirstname) ? $studentFirstname : ''; ?>" class="form-control" placeholder="Prénom"><br />
			<input type="email" name="studentEmail" value="<?= isset($studentEmail) ? $studentEmail : ''; ?>" class="form-control" placeholder="E-mail"><br />
			<input type="tel" name="studentAge" value="<?= isset($studentAge) ? $studentAge : ''; ?>" class="form-control" placeholder="Age"><br />
			<label>Ville de résidence :</label>
			<select name="cit_id" class="form-control">
				<option value="">choisissez :</option>
				<?php foreach ($citiesList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
				<?php endforeach; ?>
			</select><br />
			<label>Nationalité :</label>
			<select name="cou_id" class="form-control">
				<option value="" >choisissez :</option>
				<?php foreach ($countriesList as $key=>$value) :?>
				<option value="<?= $key ?>" selected=selected><?= $value ?></option>
				<?php endforeach; ?>
			</select><br />
			<label>Sympathie :</label>
			<select name="stu_friendliness" class="form-control">
				<option value="">choisissez :</option>
				<?php foreach ($sympathieList as $key=>$value) :?>
				<option value="<?= $key ?>" selected=selected><?= $value ?></option>
				<?php endforeach; ?>
			</select>
			</div>
			<input type="hidden" name="MAX_FILE_SIZE" value="200000" />
			<label for="image">Veuillez choisir votre image</label>
			<input type="file" name="image" id="image"/>
			<input type="submit" value="Modifier" class="form-control"><br />
	</fieldset>
</form>