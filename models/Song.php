<?php

class Song
{
    public $id;
    public $userid;
    public $title;
    public $artist;
    public $year;
    public $genre;
    public $country;
    public $album;
    public $created_at;

    public function __construct(
        $id,
        $userid,
        $title,
        $artist,
        $year,
        $genre,
        $country,
        $album,
        $created_at
    ) {
        $this->id = $id;
        $this->userid = $userid;
        $this->title = $title;
        $this->artist = $artist;
        $this->year = $year;
        $this->genre = $genre;
        $this->country = $country;
        $this->album = $album;
        $this->created_at = $created_at;
    }

    public function createSong()
    {
        $host = 'localhost';
        $user = 'admin';
        $password = 'admin';
        $database = 'popstop';
        $conn = mysqli_connect($host, $user, $password, $database);

        $query = "INSERT INTO song(userid, title, artist, year, genre, country, album)
            VALUES($this->userid, '$this->title', '$this->artist', '$this->year',
                '$this->genre', '$this->country', '$this->album')";

        if (mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
