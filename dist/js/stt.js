var urlmenu = document.getElementById( 'states1' );
 urlmenu.onchange = function() {
      window.open( 'ads-by-state.php?state=' + this.options[ this.selectedIndex ].value );
 };