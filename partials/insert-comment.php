<form action="<?=$base?>/insert-comment_action.php?id=<?=$user->id?>" method="POST">
    <input type="hidden" name="body" id="hidden-input">
    <textarea placeholder="Escreva aqui..." id="sendpost" cols="30" rows="10"></textarea>


</form>


<script>
inputhidden =  document.querySelector('#hidden-input');
textarea = document.querySelector('#sendpost')
textarea.addEventListener('keyup', function(e){
    if(e.keyCode === 13) {
        inputhidden.value = textarea.value

        textarea.value = "";
        this.form.submit();
    }
})
</script>