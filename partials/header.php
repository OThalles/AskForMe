<div></div>
<div class="search-user">
    <form action="<?=$base?>/search.php" method="GET">
    <input autocomplete="off" type="text" name="s" id="search" placeholder="Procurar">
      <button class="submit-lente" type="submit">
    <i class="fa fa-search"></i>
  </button>
    </form>
</div>

    <div class="logged-user-area">

        <div class="logged-user-name">
            <a href="<?=$base?>/perfil.php"><?=$userMe->name?></a>
        </div>

        <span class="circle">
            <div class="logged-user-photo">
                    <a href="<?=$base?>/perfil.php"><img src="<?=$base?>/media/profile/<?=$userMe->photo?>" alt=""></a>
            </div>
        </span>
        



    <i class="fa-regular fa-bell" id="notifications">
            
            <div class="popup-notifications">
            <?php if($notifications): ?>
                <?php foreach($notifications as $notification): ?>
                <div class="notification">
                    <span class="circle-notification">
                        <div class="notification-user-photo">
                        <a href="<?=$base?>/perfil.php?id=<?=$notification->user->id?>"><img src="<?=$base?>/media/profile/<?=$notification->user->photo?>" alt=""></a>
                        </div>
                    </span>
                    <div class="division">
                    <a href="<?=$base?>/perfil.php?id=<?=$notification->user->id?>"><span style="margin-bottom: 5px;"><?=$notification->user->name?></span></a>
                        <div><?=$notification->body?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            


            </div>
    </i>
<a href="<?=$base?>/configuracoes.php"><img class="gear-icon" src="<?=$base?>/media/icons/gear.png" alt=""></a>
<a href="<?=$base?>/logout.php"><span class="option-logout-header">Sair</span></a>
</div>
</div>    
     

