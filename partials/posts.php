<?php 
require('like-script.php');
require('post-script.php');

?>

    <div class="post" post-id="<?=$item->id?>">
        <div class="infos-post">
            <span class="circle-comment">
                <div class="comment-user-photo">
                    <a href="<?=$base?>/perfil.php?id=<?=$item->user->id?>"><img src="<?=$base?>/media/profile/<?=$item->user->photo?>" alt=""></a>
                </div>
            </span>
        
            <a href="<?=$base?>/perfil.php?id=<?=$item->user->id?>">
            <span class="name-user-comment">
                <?=$item->user->name?>
            </span>
        </a>
        <span style="opacity: 0.6">perguntou:</span>
            
             
        </div>
        <div class="body-post">
            <?=$item->body?>
        </div>
        <div class="reactions-post">
            <span class="date-sended">Enviado em: <?=$item->sended_date?></span>
            <?php if($id===$userMe->id): ?>
                <div class="show-input">Responder</div>
            <?php endif; ?>
            <div></div>
        </div>

        <div class="aswners-content">
        <?php if($item->comments): ?>
            <?php foreach($item->comments as $comments): ?>
            <div class="aswner-box">
                <div class="aswner">
                    <span class="circle-comment">
                        <div class="comment-user-photo">
                            <a href="<?=$base?>/perfil.php<?php ($comments->user->id == $userMe->id) ? '':'?id='.$comments->user->id ?>"><img src="<?=$base?>/media/profile/<?=$comments->user->photo?>" class="photo" alt=""></a>
                        </div>
                    </span>
                <div class="body-aswner"><?=$comments->body?></div>
        </div>
            </div>
            
            <?php endforeach; ?>
            <?php endif; ?>
                </div>
        

        <?php if($id===$userMe->id): ?>
        <div class="author-comment-box">
            <div class="loggeduser-photo-comment">
                <span class="circle-comment">
                    <div class="comment-user-photo">
                        <a href="<?=$base?>/profile"><img src="<?=$base?>/media/profile/<?=$userMe->photo?>" alt=""></a>
                    </div>
                </span>
            </div>

                <input type="text" name="owner-profile-form" class="owner-profile-form" id="owner-profile-form" placeholder="Digite sua resposta...">

        </div>
        <?php endif; ?>
        

    </div>

    
  
    
    
    



