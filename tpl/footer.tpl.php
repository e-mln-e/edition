
        
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/jquery.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/waypoints.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/classie.js"></script>
        <script>
			var menuGeneral = document.getElementById( 'menu-general' ),
                menuSommaire = document.getElementById( 'menu-sommaire' ),
				menuAttributs = document.getElementById( 'menu-attributs' ),
				showLeft = document.getElementById( 'showLeft' ),
				showRight = document.getElementById( 'showRight' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;

			showLeft.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuSommaire, 'cbp-spmenu-open' );
				disableOther( 'showLeft' );
			};
			showRight.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuAttributs, 'cbp-spmenu-close' );
				disableOther( 'showRight' );
			};
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuGeneral, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};

			function disableOther( button ) {
				if( button !== 'showLeft' ) {
					classie.toggle( showLeft, 'disabled' );
				}
				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
    </body>
</html>