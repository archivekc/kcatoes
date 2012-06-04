  <div class="block" id="connexionBlock">
    <h1>Connexion</h1>
    <form method="post" action="<?php echo url_for('sf_guard_signin')?>">
      <div>
        <div class="fields">
          <?php if ($form->hasGlobalErrors()):?>
          <div>
            <?php $form->renderGlobalErrors() ?>
          </div>
          <?php endif ?>
          <div>
            <?php echo $form['username']->renderError()?>
            <label for="signin_username">Nom</label>&nbsp;:
            <?php echo $form['username']->render()?>
          </div>
          <div>
            <?php echo $form['password']->renderError()?>
            <label for="signin_password">Mot de passe</label>&nbsp;:
            <?php echo $form['password']->render()?>
          </div>
          <div class="submit">
            <?php echo $form->renderHiddenFields()?>
            <input type="submit" value="Se connecter"/>
          </div>
        </div>
      </div>
    </form>
  </div>