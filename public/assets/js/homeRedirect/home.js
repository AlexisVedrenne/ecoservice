const parrallax = document.querySelector('.parralax');

window.addEventListener('scroll',function(){
    parrallax.style.backgroundPositionY ="-"+this.window.scrollY / 4 + "px"
})