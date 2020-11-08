<?php

//connect to MySQL
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db , 'moviesite') or die(mysqli_error($db));

$query = ' INSERT INTO movie 
			(movie_id, movie_name, movie_type, movie_year, movie_leadactor,
        movie_director)
			VALUES 
			(4, "Halloween", 1, 2017, 1, 2),
			(5, "FPLlefia",1, 2017, 5, 6),
			(6, "Portatil Film", 1, 2017, 1, 2)'; 

mysqli_query($db,$query) or die(mysqli_error($db));

echo 'Peliculas añadidas'; 


?> 




