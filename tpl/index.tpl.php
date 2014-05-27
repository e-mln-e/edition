<?php $core->tpl_load('header'); ?>
        <main>
            <aside class="w300p">
            <p id="showLeft"></p>
                <ul class="sommaire cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="menu-sommaire">
                    <h6>Sommaire</h6>
                    <li>item 1</li>
                    <li>item 1</li>
                    <li>item 1</li>
                </ul>
            </aside>
            <section class="text-edit">
                <p>Lorem Salu bissame ! Wie geht's les samis ? Hans apporte moi une Wurschtsalad avec un picon bitte, s'il te plaît.
  Voss ? Une Carola et du Melfor ? Yo dû, espèce de Knäckes, ch'ai dit un picon !</p> 
                <p>Hopla vous savez que la mamsell Huguette, la miss Miss Dahlias du messti de Bischheim était au Christkindelsmärik en compagnie de Richard Schirmeck (celui qui a un blottkopf), le mari de Chulia Roberstau, qui lui trempait sa Nüdle dans sa Schneck ! Yo dû, Pfourtz ! Ch'espère qu'ils avaient du Kabinetpapier, Gal !</p>
                <p>Yoo ch'ai lu dans les DNA que le Racing a encore perdu contre Oberschaeffolsheim. Verdammi et moi ch'avais donc parié deux knacks et une flammekueche. Ah so ? T'inquiète, ch'ai ramené du schpeck, du chambon, un kuglopf et du schnaps dans mon rucksack. Allez, s'guelt ! Wotch a kofee avec ton bibalaekaess et ta wurscht ? Yeuh non che suis au réchime, je ne mange plus que des Grumbeere light et che fais de la chym avec Chulien. Tiens, un rottznoz sur le comptoir.</p>
                <p>Tu restes pour le lotto-owe ce soir, y'a baeckeoffe ? Yeuh non, merci vielmols mais che dois partir à la Coopé de Truchtersheim acheter des mänele et des rossbolla pour les gamins. Hopla tchao bissame ! Consectetur adipiscing elit</p>
            </section>
            <aside class="w400p">
            <p id="showRight"></p>
                <ul class="attributs cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="menu-attributs">
                    <h6>Attributs</h6>
                    <li id="mots-cles">Mots-clés</li>
                    <li>Collaborateurs</li>
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