<?php
$db = mysqli_connect('localhost', 'root', 'root') or die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));
$noRegistros = 4; //Registros por página
$pagina = 1; //Por defecto pagina = 1
$buskr = "";

if($_GET['pagina']){
    $pagina = $_GET['pagina']; //Si hay pagina, lo asigna
    $buskr=$_GET['searchs']; //Palabra a buscar
}

//Utilizo el comando LIMIT para seleccionar un rango de registros
$sSQL = "SELECT m.movie_name, mov.movietype_label, p.people_fullname FROM movie as m, movietype as mov, people as p where m.movie_type = mov.movietype_id and p.people_id = m.movie_director   and movie_name LIKE '%$buskr%' LIMIT ".($pagina-1)*$noRegistros.",$noRegistros";
$result = mysqli_query($db,$sSQL) or die(mysqli_error($db));


//Exploracion de registros
echo '<table border = "1"> <tr> <th>Obra</th> <th>Genero</th> <th>Autor</th> </tr>';
while ($row = mysqli_fetch_assoc($result)) {
	extract($row);
	echo '<tr>';
	echo '<td>' .$movie_name . '</td><td>' . $movietype_label . '</td><td>' . $people_fullname . '</td>';
	echo '<tr>';
}
echo '</table>';

//Imprimiendo paginacion
$sSQL = "SELECT count(*) FROM movie as m, movietype as mov, people as p where m.movie_type = mov.movietype_id and p.people_id = m.movie_director and movie_name LIKE '%$buskr%'"; 
//Cuento el total de registros
$result = mysqli_query($db,$sSQL);
$row = mysqli_fetch_array($result);
$totalRegistros = $row["count(*)"]; //Almaceno el total en una variable
$noPaginas = $totalRegistros/$noRegistros; //Determino la cantidad de paginas

?>
<table>
    <tr>
        <td colspan="2"> <?php echo "<strong>Total registros: </strong>" .$totalRegistros; ?></td>
    </tr>
    <tr>
        <td colspan="2"> <?php echo "<strong>Pagina: </strong>".$pagina; ?></td>
    </tr>

    
    <tr bgcolor="f3f4f1">
        <td colspan="4"><strong>Pagina:
        
<?php

for($i=1; $i<$noPaginas+1; $i++) { //Imprimo las paginas
	if($i == $pagina)
		echo "<font color=red> $i </font>"; //A la pagina actual no le pongo link
	else
		echo "<a href=\"?pagina=" .$i. " &searchs= " .$buskr. " \" style=color:#000;> " .$i. " </a>";
}

?>
	   </strong></td>
    </tr>
</table>
