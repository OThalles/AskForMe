let info_menu = document.querySelector('#info-menu');
let generalInfos = document.querySelector('.general-infos')
let credentialsInfos = document.querySelector('.credentials-infos');
let cred_menu = document.querySelector('#cred-menu');

info_menu.addEventListener('click', ()=>{

    //Revertendo alterações no item credenciais e aplicando no informações gerais
    cred_menu.style.backgroundColor = '#fff';
    cred_menu.style.color = '#000';

    info_menu.style.backgroundColor = '#3a86ff';
    info_menu.style.color = '#fff';
    generalInfos.style.display = 'block';
    credentialsInfos.style.display = 'none';
})

cred_menu.addEventListener('click', ()=>{

    info_menu.style.backgroundColor = '#fff';
    info_menu.style.color = '#000';

    cred_menu.style.backgroundColor = '#3a86ff';
    cred_menu.style.color = '#fff';


    generalInfos.style.display = 'none';
    credentialsInfos.style.display = 'block';
})

let change_photo_button = document.querySelector('.change-photo-button');
let input_hidden = document.querySelector('#upload-photo');
change_photo_button.addEventListener('click', function() {
    input_hidden.click();
})


let inputSubmitHidden = document.querySelector('.submitinput');
let button_saveinfos = document.querySelector('#saveinfos');
button_saveinfos.addEventListener('click', function(){
    inputSubmitHidden.click();
})


//Função  que possibilita o usuário ver a imagem antes de salvar
function readURL(input) {
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgpic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }else{
         $('#imgpic').attr('src', '/media/profile/default.png');
    }
}


$("#upload-photo").change(function(){ 
        readURL(this);
    });