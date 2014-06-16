
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
            
            $('#editable').waypoint(function() {
              notify('Basic example callback triggered.');
            });
            
            $('.sommaire.cbp-spmenu-open').waypoint(function() {
                classie.toggle( showLeft, 'active' );
				classie.toggle( menuSommaire, 'cbp-spmenu-open' );
            }, {
                  offset: function() {
                    var hauteur = -$(".sommaire").height();
                    return hauteur + 116;
                  }
                });
            
            
// Dropage des fichiers 
            //Dropzone.options.dropMedia = {
              //paramName: "file", // The name that will be used to transfer the file
              //maxFilesize: 2, // MB
              //uploadMultiple: true,
              //previewsContainer: 'li.media-uploaded',
              //dictDefaultMessage: 'Choisir un fichier',
              //accept: function(file, done) {
                //if (file.name == "justinbieber.jpg") {
                  //done("Naha, you don't.");
                //}
                //else { done(); }
              //}
            //};

//editeur live
Aloha.bind( 'aloha-editable-activated', function(){
                var htmlString = $(".editable").html();
	              $.ajax({
	              	  type: "POST",
		              url: "admin-ajax.php?action=content",
					  data: { content: htmlString, section: <?php echo $book->get_chapter_info('id'); ?> },
					  dataType: "html",
				  }) .done(function(html) {
					 $("#result").html(html); 
                     });
                
              setInterval(function () {
                  var htmlString = $(".editable").html();
	              $.ajax({
	              	  type: "POST",
		              url: "admin-ajax.php?action=content",
					  data: { content: htmlString, section: <?php echo $book->get_chapter_info('id'); ?> },
					  dataType: "html",
				  }) .done(function(html) {
					 $("#result").html(html); 
				  });
              }, 30000);

});
        </script>
        <script>
        
        Aloha.ready( function(){
            $(".editable").mouseup(function(e){ 
                if (typeof window.getSelection != "undefined" && window.getSelection().toString().length ) {                    
                    $('#tab-ui-container-1, #tab-ui-container-3, #tab-ui-container-4').css({ "position": "absolute", "top": e.clientY, "left": e.clientX });
                    $('#tab-ui-container-1').show();
                } else {
                    $('#tab-ui-container-3, #tab-ui-container-4').css({ "position": "absolute", "top": e.pageY, "left": e.pageX });
                    $('#tab-ui-container-1').hide();
                }
                
            });
            $(".editable").keyup(function(e){  
                if (typeof window.getSelection != "undefined" && window.getSelection().toString().length ) {
                    $('#tab-ui-container-1, #tab-ui-container-3, #tab-ui-container-4').css({ "position": "absolute", "top": e.pageY, "left": e.pageX });
                    $('#tab-ui-container-1').show();
                } else {
                    $('#tab-ui-container-3, #tab-ui-container-4').css({ "position": "absolute", "top": e.pageY, "left": e.pageX });
                    $('#tab-ui-container-1').hide();
                }
                
            });
            if ( $("#tab-ui-container-3").is(":visible") ) {
                $('#tab-ui-container-1').hide();
            } else {  
            }

            $('.editable').aloha().ready(function(){
                $('#tab-ui-container-2').show();
                $('#tab-ui-container-1').hide();
            });
        });
        Aloha.bind('aloha-editable-activated', function (event, alohaEvent) {
                    $('#tab-ui-container-1').css({ "top" : "-1000px", "position" : "absolute" });
                });
            
        </script>
    </body> 
</html>