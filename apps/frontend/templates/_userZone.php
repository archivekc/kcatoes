        <?php if($sf_user->isAuthenticated()): ?>
          <div id="userZone">
            <span class="left"></span><!-- 
             --><strong><span><?php echo $sf_user->getName(); ?></span></strong><!-- 
             --><span class="right"> </span><!-- 
             --><div class="sub">
              <ul class="menu">
                <li id="connectedUser">
                  <strong>Profil de test&nbsp;:</strong>
                  <ul id="userGroups">
                    <?php foreach($sf_user->getGroups() as $group): ?>
                      <li><?php echo $group->getName(); ?></li> 
                    <?php endforeach; ?>
                  </ul>
                </li>
                <li>
                    <a href="<?php echo url_for('userTest')?>">Paramètres utilisateur</a>
                </li>
                <li id="logoutBtn">
                  <a class="actionButton" href="<?php echo url_for('sf_guard_signout')?>">Déconnexion</a>
                </li>
              </ul>
              <div class="end"></div>
            </div>
          </div>
        <?php endif ?>