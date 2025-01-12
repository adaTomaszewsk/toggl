document.addEventListener('DOMContentLoaded', function () {
    const newCardButtons = document.querySelectorAll('.new-card');

    newCardButtons.forEach(button => {
        button.addEventListener('click', function () {
            const inputContainer = this.previousElementSibling;

            inputContainer.style.display = 'block';
        });
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-card-btn')) {
            const inputContainer = event.target.closest('.input-container');
            const inputField = inputContainer.querySelector('input');

            if (inputField.value.trim() !== '') {
                console.log('New card added:', inputField.value);

                inputField.value = '';

                inputContainer.style.display = 'none';
            } else {
                alert('Please enter some text.');
            }
        }
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('close-input-btn')) {
            const inputContainer = event.target.closest('.input-container');
            inputContainer.style.display = 'none';
        }
    });
});
