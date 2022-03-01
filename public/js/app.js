if("serviceWorker" in navigator){
    navigator.serviceWorker.register("../serviceWorker.js");
}

const filter = document.querySelectorAll('.block-action.filter');

if (filter) {
    filter.forEach((menu) => {
        console.log(menu);
        const buttons = menu.querySelectorAll('.filter-tag');
        // console.log(buttons);
        buttons.forEach((button) => {
            button.addEventListener('click', (e) => {
                buttons.forEach((item) => {
                    item.classList.remove('active');
                });
                e.target.classList.add('active');
                console.log('ok');
                document.querySelectorAll(e.target.dataset.all).forEach((item) => {
                    item.classList.add('d-none');
                });

                document.querySelectorAll(e.target.dataset.target).forEach((item) => {
                    item.classList.remove('d-none');
                })
            })
        })
    })
}
