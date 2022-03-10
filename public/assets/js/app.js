footer=document.getElementById('footer')
footer.style.display='none';
document.addEventListener('scroll',function(){
    if(window.scrollY > 700 || window.scrollY > 500){
        footer.style.display='block';
    }
    else{
        footer.style.display='none';
    }
})