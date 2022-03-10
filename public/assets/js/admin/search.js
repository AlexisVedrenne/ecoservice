document.getElementById('dtl').addEventListener('change',function(){
    var ops= document.querySelectorAll('tr');
    if(this.value==''){
        ops.forEach(val=>{
            val.removeAttribute('hidden')
        })
    }
    else{
        ops.forEach(val=>{
            if(val.id != 'none')
            {
                id=val.id.toLowerCase();
                search=this.value.toLowerCase();
                if(id.includes(search)){
                    val.removeAttribute('hidden')
                }
                else{
                    val.setAttribute('hidden',true);
                }
            }
        })
    }
})
