
<form class="form-post" action="<?=$base?>/insert-comment_action.php?id=<?=$user->id?>" method="POST">
    <input type="hidden" name="body" id="hidden-input">
    <textarea placeholder="Escreva aqui..." id="sendpost" cols="30" rows="10"></textarea>
    <span id="countcharacters">0/500 characteres</span>



</form>


<script>
inputhidden =  document.querySelector('#hidden-input');
textarea = document.querySelector('#sendpost')
textarea.addEventListener('keyup', function(e){
    if(e.keyCode === 13) {
        count = textarea.value.replace(/\s/g,'') //Para remover os espaços da contagem
        if(count.length > 1) {
            inputhidden.value = textarea.value
            textarea.value = "";
            this.form.submit();
        }

    }
})

textarea.addEventListener('keydown', function(){
    let removespaces = textarea.value.replace(/\s/g,'')
    let countCharacters = document.getElementById('countcharacters')
    let modifyNumber = countCharacters.innerHTML = removespaces.length+'/500 caracteres';
    if(removespaces.length > 500) {
        countCharacters.style.color = 'red';
    }
})



</script>