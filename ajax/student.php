<?php if (isset($studentListe) && sizeof($studentListe) > 0) : ?>
  <table class="table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Ville</th>
        <th>Nationalité</th>
        <th>Sympathie</th>
        <th>Age</th>
      </tr>
    </thead>
    <tbody>
<?php foreach ($studentListe as $currentEtudiant) : ?>
      <tr>
        <td><?= $currentEtudiant['stu_lname'] ?></td>
        <td><?= $currentEtudiant['stu_fname'] ?></td>
        <td><?= $currentEtudiant['stu_email'] ?></td>
        <td><?= $currentEtudiant['cit_name'] ?></td>
        <td><?= $currentEtudiant['cou_name'] ?></td>
        <td><?= $currentEtudiant['stu_friendliness'] ?></td>
        <td><?= $currentEtudiant['stu_age'] ?></td>
      </tr>
<?php endforeach; ?>
    </tbody>
  </table>
  <a href="update.php?id=<?=$studentListe[0]['stu_id'];?>" class="btn btn-primary col-lg-1 col-lg-offset-11">Modifier</a>
  <br/>
  <br/>
<?php else :?>
  aucun étudiant
<?php endif; ?>