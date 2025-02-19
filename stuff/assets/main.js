window.addEventListener('load', function(event) {
    $("body").toggleClass( "loading-done" );

    $('.lazy').Lazy({
          scrollDirection: 'vertical',
          placeholder: "assets/loader.gif",
          effect: 'fadeIn',
          effectTime: 1000,
          threshold: 0,
          visibleOnly: true,
          onError: function(element) {
              console.log('error loading ' + element.data('src'));
          }
      });
});

// LIGHTBOX

$(document).on('click', '.zoomlightbox-trigger', function () {

  $('body').css( "overflow-y", "hidden" );

  var lightboximage = $(this).attr('data-image-src');
  var imagefilename = lightboximage.slice(lightboximage.lastIndexOf('/') + 1); // get end of the string after the last occurence of /

  $('body').prepend(
    '<div class="zoomlightbox-container">' +
      '<div class="zoomlightbox-image-name">' + imagefilename + ' </div>' +
      '<img src="' + lightboximage + '" class="zoomlightbox-image"/>' +
      '<div class="close-zoomlightbox">Click/tap to close</div>' +
    '</div>'
  );

});

$(document).on('click', '.zoomlightbox-container', function () {
  $(this).remove();
  $('body').css( 'overflow-y', 'auto' );
});
