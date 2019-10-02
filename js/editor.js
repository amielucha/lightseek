wp.domReady(() => {
  // Remove default button styles.
  wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
  wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
  
  // Add custom button styles.
  wp.blocks.registerBlockStyle("core/button", {
    name: "default",
    label: "Default",
    isDefault: true
  });
  
  wp.blocks.registerBlockStyle("core/button", {
    name: "borderless",
    label: "Borderless"
  });
});
