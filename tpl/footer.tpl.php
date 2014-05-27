
        
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/jquery.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/jquery-ui.js"></script>
        <!--<script src="<?php $core->tpl_go_to_assets('js'); ?>/waypoints.js"></script>
        <script src="<?php $core->tpl_go_to_assets('js'); ?>/waypoints-sticky.js"></script>-->
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
        <script>
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
        </script>
        <script type="text/javascript">

          // config
          var options = {
            editor: document.querySelector('[data-toggle="pen"]'),
            debug: true
          };

          // create editor
          var pen = new Pen(options);


          // toggle editor mode
          document.querySelector('#mode').addEventListener('click', function() {
            var text = this.textContent;

            if(this.classList.contains('disabled')) {
              this.classList.remove('disabled');
              pen.rebuild();
            } else {
              this.classList.add('disabled');
              pen.destroy();
            }
          });

          // toggle editor mode
          document.querySelector('#hinted').addEventListener('click', function() {
            var pen = document.querySelector('.pen')

            if(pen.classList.contains('hinted')) {
              pen.classList.remove('hinted');
              this.classList.add('disabled');
            } else {
              pen.classList.add('hinted');
              this.classList.remove('disabled');
            }
          });
        </script>
       <!-- <script>

            $('.sommaire').waypoint(function() {
                if( $("ul.sommaire").hasClass("cbp-spmenu-open") ){
                    $("#menu-sommaire").toggleClass("cbp-spmenu-open");
                    disableOther( 'showLeft' );
                } else {
                }
            }, {
              offset: function() {
                  var hauteur = return -$(this).height();
                  return hauteur-58;
              }
            });
        </script>-->
    </body>
</html>