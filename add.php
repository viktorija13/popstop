<?php

include('config/db_connect.php');
include('models/Song.php');

$title = $artist = $year = $genre = $country = $album = '';

$errors = [
    'title' => '', 'artist' => '', 'year' => '',
    'genre' => '', 'country' => '', 'album' => ''
];

if (isset($_POST['add'])) {

    if (empty($_POST['title'])) {
        $errors['title'] = 'Title is required!';
    } else {
        $title = $_POST['title'];
    }

    if (empty($_POST['artist'])) {
        $errors['artist'] = 'Artist is required!';
    } else {
        $artist = $_POST['artist'];
    }

    if (empty($_POST['year'])) {
        $errors['year'] = 'Year is required!';
    } else {
        $yearStr = $_POST['year'];
        // gledamo da li unos ima 4 cifre
        // i gledamo da li je unesen broj, ako nije unesen broj intval vraća 1
        // intval ~= strtoint
        if (strlen($yearStr) != 4 || intval($yearStr) == 1) {
            $errors['year'] = 'Wrong input for year!';
        } else {
            $year = intval($yearStr);
            // date("Y") trenutna godina
            if ($year < 1860 || $year > date("Y")) {
                $errors['year'] = 'Wrong input for year!';
            }
        }
    }

    if (empty($_POST['genre'])) {
        $errors['genre'] = 'Genre is required!';
    } else {
        $genre = $_POST['genre'];
    }

    include('ajax/countries.php');

    if (empty($_POST['country'])) {
        $errors['country'] = 'Country is required!';
    } else {
        $country = $_POST['country'];
        if (!in_array($country, $country_list)) {
            $errors['country'] = 'No such country exists!';
        }
    }

    if (empty($_POST['album'])) {
        $errors['album'] = 'Album is required!';
    } else {
        $album = $_POST['album'];
    }

    if (!array_filter($errors)) {
        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $country = $_POST['country'];
        $album = $_POST['album'];
        $userid = $_POST['userid'];

        $newSong = new Song(
            null,
            $userid,
            $title,
            $artist,
            $year,
            $genre,
            $country,
            $album,
            null
        );

        $newSong->createSong();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<section class="container">
    <h4 class="center">Post song</h4>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="white form" method="POST">
        <label for="title">Song title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>

        <label for="artist">Artist:</label>
        <input type="text" name="artist" value="<?php echo htmlspecialchars($artist) ?>" onkeyup="suggestArtist(this.value)">
        <div class="red-text"><?php echo $errors['artist']; ?></div>
        <p><span id="artistSuggest"></span></p>

        <label for="year">Year of release:</label>
        <input type="text" name="year" value="<?php echo htmlspecialchars($year) ?>">
        <div class="red-text"><?php echo $errors['year']; ?></div>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($genre) ?>" onkeyup="suggestGenre(this.value)">
        <div class="red-text"><?php echo $errors['genre']; ?></div>
        <p><span id="genreSuggest"></span></p>

        <label for="country">Released in:</label>
        <input type="text" name="country" value="<?php echo htmlspecialchars($country) ?>" onkeyup="showSuggestion(this.value)">
        <div class="red-text"><?php echo $errors['country']; ?></div>
        <p><span id="outputCountry"></span></p>

        <label for="album">Album:</label>
        <input type="text" name="album" value="<?php echo htmlspecialchars($album) ?>">
        <div class="red-text"><?php echo $errors['album']; ?></div>

        <input type="hidden" name="userid" value="<?php echo $loggedId; ?>">

        <div class="center">
            <input type="submit" name="add" value="Post a song" class="btn blue darken-2 z-depth-0">
        </div>
    </form>


</section>

<?php include('templates/footer.php'); ?>

<script>
    // AJAX suggestions for country 
    function showSuggestion(str = "") {
        if (str.length == 0) {
            document.getElementById("outputCountry").innerHTML = ""; // if we did not type anything nothing will be shown inside of span
        } else {
            // AJAX request
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() { // when the request is ready
                if (this.readyState == 4 && this.status == 200) { // checking params for request readiness
                    document.getElementById("outputCountry").innerHTML = this.responseText; // writing suggestions inside of a span
                }
            }
            xmlhttp.open("GET", "ajax/countries.php?qc=" + str, true); // making request for what we typed in to a file that finds the suggestions
            xmlhttp.send(); // sending request
        }
    }
</script>

<script>
    function suggestGenre(str = "") {
        if (str.length == 0) {
            document.getElementById("genreSuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("genreSuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/genre.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

<script>
    function suggestArtist(str = "") {
        if (str.length == 0) {
            document.getElementById("authorSuggest").innerHTML = "";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("artistSuggest").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "ajax/artists.php?query=" + str, true);
            xmlhttp.send();
        }
    }
</script>

</html>