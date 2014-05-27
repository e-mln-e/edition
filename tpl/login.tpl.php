<?php $core->tpl_load('header'); ?>
<h1>Bienvenue sur Hypublish</h1>
<h4>Outil d'écriture et de publication numérique</h4>
<p>Cet outil est en version bêta</p>
<?php if ($user->is_error('password')) : ?>
	<p>Erreur de mot de passe</p>
<?php elseif ($user->is_error('login')) : ?>
	<p>Erreur de login</p>
<?php endif; ?>
<form method="post" action="<?php $core->tpl_get_link_to('login'); ?>">Veuillez vous identifier
<br><label for="login"><strong>Adresse mail</strong></label>
    <input type="text" name="login" id="login"/>
<br>    
    <label for="pass"><strong>Mot de passe</strong></label>
    <input type="password" name="pass" id="pass"/>
<button type="submit" name="connexion">Se connecter</button>
</form>
<p><a href="mailto:emeline.brule@ensad.fr">Demander un accès</a></p>
<?php $core->tpl_load('footer'); ?>