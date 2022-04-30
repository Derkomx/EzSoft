const cards = document.getElementById('cards')
    //const items = document.getElementById('items')
    //const footer = document.getElementById('footer')
const templateCard = document.getElementById('template-card').content
    //const templateFooter = document.getElementById('template-footer').content
    //const templateCarrito = document.getElementById('template-carrito').content
const fragment = document.createDocumentFragment()
let carrito = {}

// Eventos
// El evento DOMContentLoaded es disparado cuando el documento HTML ha sido completamente cargado y parseado
document.addEventListener('DOMContentLoaded', e => {
    fetchData()
});
//cards.addEventListener('click', e => {
//    addCarrito(e)
//});
//items.addEventListener('click', e => {
//    btnAumentarDisminuir(e)
//})

async function myAjax(param) {
    let result
    try {

        result = await $.ajax({
            type: 'POST',
            url: 'Inyector.php',
            //data: {Archivo: 'productos.php', Tipo: 'carga'},
            data: { Archivo: 'ajax.php', Tipo: 'carga2' },
            dataType: 'html',
        })

        return JSON.parse(result)
    } catch (error) {
        console.error(error)
    }
}

// Traer productos
const fetchData = async() => {
    const data = await myAjax()
    pintarCards(data)
};

// Pintar productos
const pintarCards = data => {
    data.forEach(item => {
        templateCard.querySelector('h5').textContent = item.nomprod
        templateCard.querySelector('p').textContent = ('$' + item.prevent)
            //templateCard.querySelector('button').dataset.id = item.id_prod
        let archi = item.fileprod;
        if (archi === null) {
            templateCard.querySelector('img').setAttribute('src', 'productos/Preview/nulo.jpg');
        } else {
            templateCard.querySelector('img').setAttribute('src', 'productos/Preview/' + item.id_user + '/' + item.fileprod + '.jpeg');
        }
        const clone = templateCard.cloneNode(true)
        fragment.appendChild(clone)
    })
    cards.appendChild(fragment)
}