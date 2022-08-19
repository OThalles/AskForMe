<div class="recommended-users-area">
    <div class="container">
        <span style="margin-bottom: 5px; font-family: 'Roboto';">Talvez seja do seu interesse...</span>
    <div class="recommended-users-box">
    <?php foreach($otherUsers as $selectedUser): ?>
    <div class="user-recommended">
                <span class="recommended-circle">
                    <div class="photo-user-recommended">
                            <a href=""><img src="<?=$base?>/media/profile/<?=$selectedUser['photo']?>" alt=""></a>
                    </div>
                </span>
                    <div class="name-user-recommended">
                        <a href="<?=$base?>/perfil.php?id=<?=$selectedUser['id']?>"><?=$selectedUser['name'];?></a>
                    </div>
            </div>

        <?php endforeach;?>
    </div>
    </div>
    </div>
</div>