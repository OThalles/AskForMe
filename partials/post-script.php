<script>
    /**
     * Função para que seja adicionada a resposta do dono do perfil á pergunta feita.
     */
    
    window.addEventListener('load', function() {
    allInputsAswners = document.getElementsByClassName('owner-profile-form');
    Array.prototype.forEach.call(allInputsAswners, function(item) {
        item.addEventListener('keyup', async (e)=>{
            if(e.keyCode == 13) {
                let id_post = item.closest('.post').getAttribute('post-id');
                let content = item.value
                item.value = ''
                

                $.ajax({
                    url:"comment_ajax.php",
                    type: "POST",
                    data: {   
                    'id_post': id_post,
                    'content': content
                    }
                }).done(function(r) {
                    json_response = r
                    if(json_response.error == '') {
                        aswners_box = document.createElement('div');
                        aswners_box.className = 'aswner-box'
                        aswner = document.createElement('div');
                        aswner.className = 'aswner'
                        circle = document.createElement('span'); 
                        circle.className = 'circle-comment'
                        photo = document.createElement('div');
                        photo.className = 'comment-user-photo';
                        link = document.createElement('a');
                        img = document.createElement('img');
                        img.className = 'photo'
                        img.src = json_response.photo
                        body = document.createElement('div');
                        body.className = 'body-aswner'
                        txtbody = document.createTextNode(json_response.body);
                        body.appendChild(txtbody)
                        link.appendChild(img)
                        photo.appendChild(link)
                        circle.appendChild(photo)
                        aswner.appendChild(circle)
                        aswner.appendChild(body)
                        aswners_box.appendChild(aswner)
                        
                        item.closest('.post')
                            .querySelector('.aswners-content')
                            .appendChild(aswners_box)

                    
                    }
                });

                


        
        }
    })
})
function closeFeedWindow() {
    document.querySelectorAll('.post').forEach(item=>{
        document.querySelectorAll('.author-comment-box').forEach(item=>{
            item.style.display = 'none';
            
        });
        
    })
        
        document.removeEventListener('click', closeFeedWindow);
    }

    document.querySelectorAll('.post').forEach(item=>{
        item.querySelectorAll('.show-input');
            item.addEventListener('click', ()=>{
            closeFeedWindow()
            if(item.querySelector('.author-comment-box')) {
                item.querySelector('.author-comment-box').style.display = 'flex';
            }
            setTimeout(()=>{
                document.addEventListener('click', closeFeedWindow);
            }, 300);  
            
        
    })
    })
    })


</script>
