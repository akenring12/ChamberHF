document.querySelector('.nav-list').addEventListener('click', function (event) {
    if (event.target.tagName === 'A') {
        document.getElementById('check').checked = false;
    }
});
