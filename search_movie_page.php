<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="clapperboard.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Movie Archive</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a style="margin-left: 1rem;" class="navbar-brand" href="index.php">Movie Archive</a>
        <form style="margin-right: 1rem;" method="post" class="d-flex" action="search_movie_page.php">
            <input class="form-control me-2" name="search" type="search" placeholder="Search">
            <input class="btn btn-outline-light" name="send" type="submit" value="Send"></input>
        </form>
    </nav>
    <?php

    $error = "Lütfen aramak istediğiniz filmin adını yazınız.";
    $search_value = $_POST['search'];
    if (!empty($search_value)) {
        $api_url = 'https://api.themoviedb.org/3/search/movie?api_key=4760a9c0855d055cbda02ccb2ab9d2a6&language=en-US&query=' . $search_value . '&page=1&include_adult=false';
        $image_base_url = 'https://image.tmdb.org/t/p/w500';
        $data = json_decode(file_get_contents($api_url));
        $movies = $data->results;

        foreach ($movies as $movie) { ?>
            <div class="container">
                <div id="profile" style="margin-top: 1rem;">
                    <div class="card card-body mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="movie_detail.php?value_id=<?php echo $movie->id ?>">
                                    <img class="img-fluid mb-2" alt="<?php echo $movie->title ?>" src="<?php echo $image_base_url . $movie->poster_path ?>">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <li class="list-group">
                                    <div id="fullName"><strong><?php echo $movie->title ?></strong></div>
                                <li class="list-group-item borderzero">
                                    <span> <strong>IMDB : </strong> <?php echo $movie->vote_average ?></span>
                                </li>
                                <li class="list-group-item borderzero">
                                    <span> <strong>Vision Date : </strong> <?php echo $movie->release_date ?></span>
                                </li>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<script>alert('" . $error . "');</script>";
        header("Refresh:0; url=index.php");
    }
    ?>
    <footer class="bg-dark text-center text-white">
        <div class="container p-4 pb-0">
            <section class="mb-4">
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-google"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-github"></i></a>
            </section>
        </div>
        <div class="text-center p-3" style="background-color: #212529;">
            © 2020 Copyright:
            <a class="text-white" href="searchmovie.test">searchmovie.test</a>
        </div>
    </footer>
</body>

</html>