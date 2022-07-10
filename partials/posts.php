
    <div class="post">
        <div class="infos-post">
            <span class="circle-comment">
                <div class="comment-user-photo">
                    <a href="<?=$base?>/profile"><img src="<?=$base?>/media/profile/default.png" alt=""></a>
                </div>
            </span>
        
        <span class="name-user-comment"><?=$item->user->name?></span>
            
             
        </div>
        <div class="body-post">
            <?=$item->body?>
        </div>
        <div class="reactions-post">
            <span class="date-sended">Enviado em: <?=$item->sended_date?></span>
            <div class="icon-count-like">
            <i class="fa-regular fa-heart"></i><span class="count-likes"> 0 </span>
            </div>
        </div>

    </div>

    
  
    
    
    



