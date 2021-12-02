<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Halaman <?= $data['judul'] ?></title>
<link rel="stylesheet" href="<?= BASEURL ?>/css/bootstrap.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
  <a class="navbar-brand" href="<?= BASEURL ?>">PHP MVC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?= BASEURL ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= BASEURL ?>/mahasiswa">Mahasiswa</a>
      </li>
      </div>
  </div>
</nav>