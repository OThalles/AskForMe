let notifications = document.querySelector('#notifications')
let popupNotifications = document.querySelector('.popup-notifications')

function closeNotifications() {
    document.querySelector('.popup-notifications').style.display = 'none';

    document.removeEventListener('click', closeNotifications)
}
notifications.addEventListener('click', ()=>{
    closeNotifications()
    popupNotifications.style.display = 'block';
    setTimeout(()=>{
        document.addEventListener('click', closeNotifications)
    }, 300)
})

