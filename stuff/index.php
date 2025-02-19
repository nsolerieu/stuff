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
      <span class="stuff">stuff</span>
    </div>
  </div>
</header>

<main>
  <div class="container">
    <div class="file-containter">

    <?php
      
      $directory = 'stuff/';
      $items = scandir($directory, SCANDIR_SORT_NONE);  
        
      foreach ($items as $item) {

        if ($item !== '.' && $item !== '..') {

          $path = $directory.''.$item;

          // File

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

            // other file
            else {
              echo '

                <div class="item">
                  <a href='.$path.'>
                    <div class="item__other-file">'.$item.'</div>
                  </a>
                </div>

              ';
            }

          // Folder 

          } elseif (is_dir($path)) {

            echo '

                <div class="item">
                  <a href=folder.php?name='.$item.'>
                    <div class="item__folder">/'.$item.'</div>
                  </a>
                </div>

                ';

          }
        }
      }

    ?>

    </div>
  </div>
</main>

</body>

<script src="assets/jquery.js"></script>
<script src="assets/jquery.lazy.min.js"></script>
<script src="assets/main.js" ></script>

</body>
</html>
