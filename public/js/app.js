// if("serviceWorker" in navigator){
//     navigator.serviceWorker.register("../serviceWorker.js");
// }

const filter = document.querySelectorAll('.filter-buttons');

if (filter) {
    filter.forEach((menu) => {
        const buttons = menu.querySelectorAll('.filter-tag');
        buttons.forEach((button) => {
            button.addEventListener('click', (e) => {
                buttons.forEach((item) => {
                    item.classList.remove('tag-active');
                });
                e.target.classList.add('tag-active');
                console.log(document.querySelectorAll(e.target.dataset.all));
                document.querySelectorAll(e.target.dataset.all).forEach((item) => {
                    console.log('test')
                    item.classList.add('d-none');
                });

                document.querySelectorAll(e.target.dataset.target).forEach((item) => {
                    item.classList.remove('d-none');
                })
            })
        })
    })
}
