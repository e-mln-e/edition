
        
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/jquery.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/waypoints.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/waypoints-sticky.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/dropzone.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/classie.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/markdown.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/pen.js"></script>
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
			};
			showRight.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuAttributs, 'cbp-spmenu-close' );
			};
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuGeneral, 'cbp-spmenu-open' );
                classie.toggle( showLeft, 'cbp-spmenu-push-toright' );
                classie.toggle( menuSommaire, 'cbp-spmenu-push-toright' );
			};
            
            
            $('.sommaire').waypoint(function() {
                classie.toggle( showLeft, 'active' );
				classie.toggle( menuSommaire, 'cbp-spmenu-open' );
            }, {
                  offset: function() {
                    var hauteur = -$(".sommaire").height();
                    return hauteur + 116;
                  }
                });
            
            
// Dropage des fichiers 
            Dropzone.options.dropMedia = {
              paramName: "file", // The name that will be used to transfer the file
              maxFilesize: 2, // MB
              uploadMultiple: true,
              previewsContainer: 'li.media-uploaded',
              dictDefaultMessage: 'Choisir un fichier',
              accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                  done("Naha, you don't.");
                }
                else { done(); }
              }
            };


//editeur markdown

          // config
          var options = {
            editor: document.querySelector('[data-toggle="pen"]'),
            debug: true
          };

          // create editor
          var pen = new Pen(options);

        </script>
    </body> 
</html>