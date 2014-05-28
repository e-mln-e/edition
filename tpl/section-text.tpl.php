<?php $core->tpl_load('header'); ?>
        <main>
            <nav class="w300p">
                <p id="showLeft"></p>
                <div class="sommaire cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="menu-sommaire">
                <h6>Sommaire</h6>
					<?php $book->summary_display(); ?>
                    <button>Créer une section</button>
                </div>
            </nav>
            <section class="text-edit">
                <div id="test">youpila</div>

                <article class="editable">
                        <?php $book->content(); ?>
                </article>
                <div id="editeurToolbar"></div>
                <article class="pen hinted" data-toggle="pen" placeholder="im a placeholder"><?php $book->content(); ?></article>
            </section>
            <aside class="w400p">
            <p id="showRight"></p>
                <ul class="attributs cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="menu-attributs">
                    <h6>Attributs</h6>
                    <li id="mots-cles">Mots-clés</li><?php $book->tags(); ?>
                    <li>Collaborateurs</li><?php $book->authors(true); ?>
                   <li id="medias">Medias 
                        <form action="/file-upload" class="dropzone" id="dropMedia">
                          <div class="fallback">
                            <input name="file" type="file" multiple />
                          </div>
                        </form> 
                    </li>
                    <li class="media-uploaded"><img src="http://www.picturetopeople.org/images/artistic_mosaic_photo_effect_input.jpg"/>
                    <div class="metadata-medias"><br>Type : image 
                    <br>Text-alternatif* : Ceci est un chat avec un chapeau. 
                    <br>Mise en page :
                    <br>
                    </div>
                    </li>
                </ul>
            </aside>
        </main>
<?php $core->tpl_load('footer'); ?>
