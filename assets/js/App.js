// if("serviceWorker" in navigator){
//     navigator.serviceWorker.register("../serviceWorker.js");
// }

if(location.pathname === '/'){
    const filter = document.querySelectorAll('.filter-buttons');
    const inputSearch = document.getElementById('searchBox');
    const cardRessource = document.querySelectorAll('.card-res');

    if (filter) {
        filter.forEach((menu) => {
            const buttons = menu.querySelectorAll('.filter-tag');
            buttons.forEach((button) => {
                button.addEventListener('click', (e) => {
                    buttons.forEach((item) => {
                        item.classList.remove('tag-active');
                    });
                    e.target.classList.add('tag-active');
                    document.querySelectorAll(e.target.dataset.all).forEach((item) => {
                        item.classList.add('d-none');
                        item.classList.remove('card-affiche');

                    });

                    document.querySelectorAll(e.target.dataset.target).forEach((item) => {
                        item.classList.remove('d-none');
                        item.classList.add('card-affiche');

                    })
                })
            })
        })
    }

    inputSearch.addEventListener('keyup', (e) => {
        let value = e.target.value.toLowerCase();
        cardRessource.forEach((card) => {
            if(card.classList.contains('card-affiche')){
                const title = card.getElementsByClassName('ressource-title').item(0).innerHTML.toLowerCase();
                const content = card.getElementsByClassName('ressource-content').item(0).innerHTML.toLowerCase();
                if (!title.includes(value) && !content.includes(value)) {
                    card.classList.add('d-none');
                } else {
                    card.classList.remove('d-none');

                }

            }
        })
    })
}
