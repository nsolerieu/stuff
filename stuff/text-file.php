<?php

$content = '';

$file_name = filter_var($_GET['name'], FILTER_DEFAULT);
$file_path = __DIR__.'/stuff/'.$file_name;

?>

<!DOCTYPE html>

<html lang="en" >

<head>

  <title>Stuff</title>

  <meta charset="utf-8">
  <meta name="description" content="An improvised instagram replacement" />
  <meta name="robots" content="index, follow, all" />

  <meta name="viewport" content="initial-scale=1, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />

  <link rel="stylesheet" href="assets/style.css" >

</head>

<!-- BODY -->
<body id="body" class="">

<header>
  <div class="container">
    <div class="row">
      <span onclick="history.back()" style="cursor: pointer;">Back</span>
      <span class="path-separator">/</span>
      <span class="stuff">File: <?php echo $file_name; ?></span>
    </div>
  </div>
</header>

<main style="padding: 6vh 0;">
  <div class="container">
    <div class="row">
			<?php 
				if ( file_exists($file_path) ) {

					echo $file = nl2br(file_get_contents($file_path, FILE_USE_INCLUDE_PATH));

				} else {
					echo '<h2>Not Found</h2>';
				}
			?>
    </div>
  </div>
</main>

</body>
</html>