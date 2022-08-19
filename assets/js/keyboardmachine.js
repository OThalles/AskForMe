'use strict';

function typeWriter(el) {
    const textArray = el.innerHTML.split('');
    el.innerHTML = '';
    textArray.forEach((letter,i) => {
        setTimeout(() => (el.innerHTML += letter), 95 * i);
    })
}
let titulo = document.querySelector('.phrase-keyboard-machine');
typeWriter(titulo)


var isAndroid = navigator.userAgent.toLowerCase().indexOf("mobile");
if(isAndroid) {
    document.write('<meta name="viewport" content="width=device-width,height='+window.innerHeight+', initial-scale=1.0">');
}