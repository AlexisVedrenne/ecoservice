var priceFilter = false
var catFil = false
catFiltre= document.getElementById('filtreCat')

document.getElementById('filterPrice').addEventListener('change',function(){

    addPrice(this.value)
})

function addPrice(value){
    var cards = document.querySelectorAll('card')
    var price = document.getElementById('price')
    price.innerText='Entre 0 et '+value+'€'
    if(price.innerText == 'Aucun filtre'){
        priceFilter = false
        cards.forEach(val => {
            val.removeAttribute('hidden')
        })
    }
    else if(catFil){
        priceFilter = true
        cards.forEach(card => {
            let p = parseInt(card.querySelector('price').innerText)
            let c = card.querySelector('cat').innerText
            if(catFiltre.innerText==c&&(p >= 0 && p <= value)){
                card.removeAttribute('hidden')
            }
            else{
                card.setAttribute('hidden','true')
            }
            
        })
    }
    else{
        priceFilter = true
        cards.forEach(card => {
            let p = parseInt(card.querySelector('price').innerText)
            if(p >= 0 && p <= value){
                card.removeAttribute('hidden')
            }
            else{
                card.setAttribute('hidden','true')
            }
            
        })
    }
}

function addCat(value){
    catFiltre.innerText=value
    var cards = document.querySelectorAll('card')
    if(catFiltre.innerText=='Toute Catégorie'){
        catFil = false
        cards.forEach(card => {
            card.removeAttribute('hidden')
        })
    }
    else if(priceFilter){
        catFil = true
        let price = document.getElementById('filterPrice').value
        cards.forEach(card=>{
            let c = card.querySelector('cat').innerText
            let p = parseInt(card.querySelector('price').innerText)
            if(catFiltre.innerText==c && (p >= 0 && p <= price)){
                card.removeAttribute('hidden')
            }
            else{
                card.setAttribute('hidden','true')
            }
        })
    }
    else{
        catFil=true
        cards.forEach(card=>{
            let c = card.querySelector('cat').innerText
            if(catFiltre.innerText==c){
                card.removeAttribute('hidden')
            }
            else{
                card.setAttribute('hidden','true')
            }
        })
    }
}

document.getElementById('btnResetFiltre').addEventListener('click',function(){
    document.getElementById('price').innerText='Aucun filtre'
    addCat('Toute Catégorie')
    document.getElementById('filterPrice').value=500
})