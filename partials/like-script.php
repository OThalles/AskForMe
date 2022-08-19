
<script>
    window.addEventListener('load', function() {
    document.querySelectorAll(".fa-regular").forEach(box=>{ 

    box.addEventListener('click', ()=>{

        let post_id = box.closest('.post').getAttribute('post_id'); 
        if(box.classList.contains('fa-solid') === false) {
            
            box.className = 'fa-solid fa-heart'
        } else {
            
            box.className = 'fa-regular fa-heart'
        }
    
        $.ajax({
                url:"likes_ajax.php",
                type: "POST",
                data: {
                'post_id': post_id,
                }
            }).done(function(resposta) {
                console.log(resposta);
            })
                            
        })
    })                        
            

        })
                    

                


</script>