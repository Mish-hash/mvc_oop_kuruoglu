
const postDeleteBtn = document.querySelectorAll('.delete-post');
for (const btn of postDeleteBtn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        const id = e.target.getAttribute('data-id');
        console.log(id)
        axios('/post/delete', {
            method: 'post',
            url: '/post/delete',
            data: `id=${id}`,

        })

            .then(function (response) {
                // console.log(response);
                e.target.parentNode.parentNode.remove()
            })
            .catch(function (error) {
                console.log(error);
            });
    })





}




