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
  <h2>ASIGNATURAS</h2><br>



   <?php
  try{

    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query([]);
    $rows = $manager->executeQuery("asignaturas.asignatura", $query);
    echo "<table >
    <thead>
    <th>codigo asignatura</th>
    <th>nombre asignatura</th>
    <th>Username</th>
    </thead>";

    foreach($rows as $row){
      echo "<tr>"."<td>".$row->codigoAsignatura."</td>"."<td>".$row->nombreAsignatura."</td>"."<td>";
      echo "<table>
      <thead>
      <th>CodAlumno</th>
      <th>nombreAlumno</th>
      <th>apellido</th>
      <th>Mail</th>
      </thead>";
      foreach ($row->Alumnos as $alm) {
        echo "<tr>"."<td>".$alm->nMatricula."</td>"."<td><a href=estudiante.php?alumno=".$alm->nMatricula.">".$alm->nombre."</a></td>"."<td>".$alm->apellido."</td>"."<td>".$alm->mail."</td>".
        "</tr>";
        foreach ($alm->notasAsignatura as $asg) {
          echo "<tr>"."<td>"."nota".$asg->numTarea."</td>"."<td>".$asg->notaTarea."</td>". "</tr>";
        }
      }
      echo"</table>";
      echo "</td>"."</tr>";
    }
    echo"</table>";
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
