<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet"  type="text/css" href="estilos.css">
  <title>Hello, world!</title>
</head>

<body>

  <h1>TAREA 5 MONGO</h1><br>
  <h2>PERFIL DE ESTUDIANTES</h2><br>

  <?php

error_reporting(0);
  try{

    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query([]);
    $rows = $manager->executeQuery("asignaturas.asignatura", $query);
    echo "<table >
    <thead>
    <th>nombre alumno</th>
    <th>apellido alumno</th>
    <th>mail</th>
    <th>notas</th>
    </thead>";

    $arrayestudiantes = [];
    foreach($rows as $row){
      foreach ($row->Alumnos as $alm) {

        $arrayestudiantes[$alm->nMatricula]->nombre = $alm->nombre;
        $arrayestudiantes[$alm->nMatricula]->apellido = $alm->apellido;
        $arrayestudiantes[$alm->nMatricula]->mail = $alm->mail;

        $arrayestudiantes[$alm->nMatricula]->asignaturas[$row->codigoAsignatura]->nombreAsignatura = $row->nombreAsignatura;

        foreach ($alm->notasAsignatura as $asg) {
          $arrayestudiantes[$alm->nMatricula]->asignaturas[$row->codigoAsignatura]->notas[$asg->numTarea]->notaTarea = $asg->notaTarea;
          $arrayestudiantes[$alm->nMatricula]->asignaturas[$row->codigoAsignatura]->notas[$asg->numTarea]->numTarea = $asg->numTarea;

        }
      }
    }


    foreach($arrayestudiantes as $arrEstudiante){
      echo "<tr>"."<td>".$arrEstudiante->nombre."</td>"."<td>".$arrEstudiante->apellido."</td>"."<td>".$arrEstudiante->mail."</td>"."<td>";
      echo "<table>
      <thead>
      <th>asignatura</th>
      <th>numeroTarea</th>
      <th>notaTarea</th>
      </thead>";
      foreach ($arrEstudiante->asignaturas as $asignatura) {
        foreach ($asignatura->notas as $nota) {
          echo "<tr>"."<td>".$asignatura->nombreAsignatura."</td>"."<td>".$nota->numTarea."</td>"."<td>".$nota->notaTarea."</td>"."</tr>";
        }
      }
      echo"</table>";
      echo "</td>"."</tr>";
    }
    echo "</table>";
  } catch(MongoDB\Driver\Exception\Exception $e){
    echo "eror".$e;
    die("Error Encountered: ".$e);
  }
  ?>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
