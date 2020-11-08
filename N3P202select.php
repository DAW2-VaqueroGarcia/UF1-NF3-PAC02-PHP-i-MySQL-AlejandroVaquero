<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));

// select the movie titles and their genre after 1990
$query = 'SELECT
        movie_name, movie_type
    FROM
        movie
    WHERE
        movie_year > 1990
    ORDER BY
        movie_type';
$result = mysqli_query($db,$query) or die(mysqli_error($db));

// show the results
while ($row = mysqli_fetch_assoc($result)) {
	extract($row);
	echo $movie_name . '-' . $movie_type . ' < br/>';
}
?>
