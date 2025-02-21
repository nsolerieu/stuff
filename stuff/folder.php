<?php

$folder_name = filter_var($_GET['name'], FILTER_DEFAULT);
$folder_path = __DIR__.'/stuff/'.$folder_name;

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
      <span>@slrncl</span>
      <span class="path-separator">/</span>
      <a href="index.php">stuff</a> 
      <span class="path-separator">/</span> 
      <span><?php echo $folder_name; ?></span>
    </div>
  </div>
</header>

<main>
  <div class="container">
    <div class="file-containter">

    <?php 

      if ( is_dir($folder_path) ) {

        function is_dir_empty($dir) {
          if (!is_readable($dir)) return NULL;
          return (count(scandir($dir)) == 2);
        }

        if (is_dir_empty($folder_path)) {

          echo '<div class="row"><div class="message">Empty</div></div>';

        } else {

          $items = scandir($folder_path, SCANDIR_SORT_NONE);
        
          foreach ($items as $item) {

            if ($item !== '.' && $item !== '..') {

              $totalItems++;

              $path = 'stuff/'.$folder_name.'/'.$item;

              if (is_file($path)) {

                  $ext = pathinfo($path, PATHINFO_EXTENSION);

                  // image (4 types supported only)
                  if ( $ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'webp' || $ext == 'svg' ) {
                    echo '

                      <div class="item">
                        <figure class="item__image-file zoomlightbox-trigger" data-image-src="'.$path.'">
                          <img data-src="'.$path.'" alt="'.$item.'" class="lazy" >
                        </figure>
                      </div>

                    ';
                  }

                  // txt or md file
                  elseif ( $ext == 'txt' || $ext == 'md' ) {
                    echo '

                      <div class="item">
                        <a href=text-file.php?name='.$folder_name.'/'.$item.'>
                          <div class="item__other-file">'.$item.'</div>
                        </a>
                      </div>

                    ';
                  }

                  // other/unsupported file
                  else {
                    echo '

                      <div class="item">
                        <a href='.$path.'>
                          <div class="item__other-file">'.$item.'</div>
                        </a>
                      </div>

                    ';
                  }

              } else {

                echo '<div class="row"><div class="message">Weird</div></div>';

              }
            }
          }
        }

      } else {
        echo'<div class="row"><div class="message">Not found</div></div>';
      }

    ?>

    </div>
  </div>
</main>

<footer>
  <div class="container">
    <div class="row">
      <?php echo $totalItems . " items - updated: " . date("F d Y H:i:s", filemtime($folder_path)); ?> 
    </div>
  </div>
</footer>

<script src="assets/jquery.js"></script>
<script src="assets/jquery.lazy.min.js"></script>
<script src="assets/main.js" ></script>

</body>
</html>
