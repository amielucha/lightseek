jQuery(document).ready( ($) => {
  // Disable scroll for Google Maps for a moment
  // if the scroll started outside of it
  const $maps = $('iframe[src^="https://www.google.com/maps/"]');

  (function preventMapScroll($maps) {
    if (!$maps.length)
      return;

    let timeout;

    $(document).scroll((event) => {
      //console.log('scrolled', event);

      // Add class and remove it once scrolling stops
      $maps.addClass('donotscroll');

      clearTimeout(timeout);

      timeout = setTimeout(() => {
        $maps.removeClass('donotscroll')
      }, 500);
    })
  })($maps);
});
