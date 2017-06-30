jQuery(document).ready( ($) => {
  // Disable scroll for Google Maps for a moment
  // if the scroll started outside of it
  const $maps = $('iframe[src^="https://www.google.com/maps/"]');

  (function preventMapScroll($maps) {
    if (!$maps.length)
      return;

    let timeout;
    // cache initial pointer-events property
    const pointerState = $maps.css('pointer-events');

    $(document).scroll((event) => {
      //console.log('scrolled', event);

      // remove pointer events
      $maps.css('pointer-events', 'none');

      clearTimeout(timeout);

      timeout = setTimeout(() => {
        // restore pointer events
        $maps.css('pointer-events', pointerState);
      }, 500);
    })
  })($maps);
});
