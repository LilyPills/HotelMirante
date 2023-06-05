const form = document.querySelector('#hotelForm')
const numeroInput = document.querySelector('#numeroInput')
const tipoInput = document.querySelector('#tipoInput')
const disponivelInput = document.querySelector('#disponivelInput')
const URL = 'http://localhost:8080/hotel.php'

const tableBody = document.querySelector('#hotelTable')

function carregarHotel() {
    fetch(URL, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        mode: 'cors'
    })
        .then(response => response.json())
        .then(hotel => {
            tableBody.innerHTML = ''

            for (let i = 0; i < hotel.length; i++) {
                const tr = document.createElement('tr')
                const hotel = hotel[i]
                tr.innerHTML = `
                  <td>${hotel.id}</td>
                  <td>${hotel.numero}</td>
                  <td>${hotel.tipo}</td>
                  <td>${hotel.disponivel}</td>
                   <td> 
                  <button data-id="${hotel.id}"onclick="atualizarHotel(${hotel.id})">Editar</button>
                  <button onclick="excluirHotel(${hotel.id})">Excluir</button>
                 </td>

                `
                tableBody.appendChild(tr)
            }
        })
}
function adicionarHotel(event) {
    event.preventDefault()
    const numero = numeroInput.value
    const tipo = tipoInput.value
    const disponivel = disponivelInput.value
    fetch(URL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body:
            `numero=${encodeURIComponent(numero)}&tipo=${encodeURIComponent(tipo)}&disponivel=${encodeURIComponent(disponivel)}`
    })
        .then(response => {
            if (response.ok) {
                carregarHotel()
                numeroInput.value = ''
                tipoInput.value = ''
                disponivelInput.value = ''
            } else {
             console.error('Quarto não disponível')
             alert('Quarto não disponível')
          }
        })
}

function atualizarHotel(id) {
    const novoNumero = prompt("Digite o número")
    const novoTipo = prompt("Digite o tipo")
    const novoDisponivel = prompt("Digite se está disponível")


    if (novoNumero && novoTipo && novoDisponivel) {
        fetch(`${URL}?id=${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },

            body: `numero=${encodeURIComponent(novoNumero)}&tipo=${encodeURIComponent(novoTipo)}&disponivel=${encodeURIComponent(novoDisponivel)}}`

        })

            .then(response => {
                if (response.ok) {
                    carregarHotel()
                } else {
                    console.error('Erro ao atualizar')
                    alert('erro ao atualizar')
                }
            })
    }
}

function excluirHotel(id) {
    if (confirm('Deseja excluir esse reserva?')) {
        fetch(`${URL}?id=${id}`, {
            method: 'DELETE'
        })
            .then(response => {
                if (response.ok) {
                    carregarHotel()
                } else {
                    console.error('Erro ao excluir reserva')
                    alert('Erro ao excluir reserva')
                }
            })
    }
}

form.addEventListener('submit', adicionarHotel)

carregarHotel()



































let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}

// erro relacionado ao swiper não estar definido.

var homeSwiper = new Swiper(".home-slider", {
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

var roomSwiper = new Swiper(".room-slider", {
    spaceBetween: 20,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});

var gallerySwiper = new Swiper(".gallery-slider", {
    spaceBetween: 10,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 1500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 4,
        },
    },
});

var reviewSwiper = new Swiper(".review-slider", {
    spaceBetween: 10,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

let accordions = document.querySelectorAll('.faqs .row .content .box');

accordions.forEach(acco =>{
    acco.onclick = () =>{
        accordions.forEach(subAcco => {subAcco.classList.remove('active')});
        acco.classList.add('active');
    }
})


