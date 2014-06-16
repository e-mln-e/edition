<?php $core->tpl_load('header'); ?>
    <main class="300p menu-inactif">
        <section>
            <h1>Bienvenue sur Hypublish</h1>
            <h4>Outil d'écriture et de publication numérique</h4>
            <p>Cet outil est en version bêta</p>
            <?php if ($user->is_error('pass')) : ?>
                <p>Erreur de mot de passe</p>
            <?php elseif ($user->is_error('login')) : ?>
                <p>Erreur de login</p>
            <?php endif; ?>
            <form method="post" action="<?php $core->tpl_get_link_to('login'); ?>">Veuillez vous identifier
            <br><label for="login"><b>Adresse mail</b></label>
                <input type="text" name="login" id="login"/>
            <br>    
                <label for="pass"><b>Mot de passe</b></label>
                <input type="password" name="pass" id="pass"/>
            <button type="submit" name="connexion">Se connecter</button>
            </form>
            <p><a href="mailto:emeline.brule@ensad.fr">Demander un accès</a></p>
            <p>J'ai perdu mon mot de passe</p>
        </section>
    </main>
<?php $core->tpl_load('footer'); ?>