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
      <span class="name">@slrncl</span>
      <span class="path">/</span>
    </div>
  </div>
</header>

<main>
  <div class="container">
    <div class="file-containter">

    <?php
      $directory = 'stuff/';
      $items = scandir($directory, SCANDIR_SORT_ASCENDING);

      $folders = [];
      $files = [];
      $totalItems = 0;

      foreach ($items as $item) {
        if ($item !== '.' && $item !== '..') {
          $totalItems++;
          $path = $directory . '' . $item;
          if (is_dir($path)) {
            $folders[] = $item;
          } elseif (is_file($path)) {
            $files[] = $item;
          }
        }
      }

      /* Unsure about sorting alphabetically
      natcasesort($folders);
      natcasesort($files);
      */

      $items = array_merge($folders, $files);

      foreach ($items as $item) {
        $path = $directory . '' . $item;

        if (is_file($path)) {
          $ext = pathinfo($path, PATHINFO_EXTENSION);

          if (in_array($ext, ['jpg', 'png', 'gif', 'webp', 'svg'])) {
            echo '
              <div class="item">
                <figure class="item__image-file zoomlightbox-trigger" data-image-src="' . $path . '">
                  <img data-src="' . $path . '" alt="' . $item . '" class="lazy" >
                </figure>
              </div>';
          } elseif (in_array($ext, ['txt', 'md'])) {
            echo '
              <div class="item">
                <a href=text-file.php?name=' . $item . '>
                  <div class="item__other-file">' . $item . '</div>
                </a>
              </div>';
          } else {
            echo '
              <div class="item">
                <a href=' . $path . '>
                  <div class="item__other-file">' . $item . '</div>
                </a>
              </div>';
          }
        } elseif (is_dir($path)) {
          echo '
            <div class="item">
              <a href=folder.php?name=' . $item . '>
                <div class="item__folder">/' . $item . '</div>
              </a>
            </div>';
        }
      }
    ?>

    </div>
  </div>
</main>

<footer>
  <div class="container">
    <div class="row">
      <?php echo $totalItems . " items - updated: " . date("F d Y H:i:s", filemtime($directory)); ?> 
    </div>
  </div>
</footer>

<script src="assets/jquery.js"></script>
<script src="assets/jquery.lazy.min.js"></script>
<script src="assets/main.js" ></script>

</body>
</html>
