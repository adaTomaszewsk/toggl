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
            cardData = [];
    
            if (inputField.value.trim() !== '') {
                console.log('New card added:', inputField.value);
                 cardData = {
                    title: inputField.value,
                    column_id: event.target.parentNode.id.split('-')[1],
                }
                inputField.value = '';

                inputContainer.style.display = 'none';
            } else {
                alert('Please enter some text.');
            }

            

            console.log(inputField.value);

            fetch("/api/create-card",{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(cardData),
            }).then((response) => {
                if(!response.ok){
                    throw new Error('Failed to create project.');
                }
                return response.json();

            }).then(data => {
                alert(data.message);
                location.reload();
            })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error creating the project.');
                });

        }
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('close-input-btn')) {
            const inputContainer = event.target.closest('.input-container');
            inputContainer.style.display = 'none';
        }
    });
});
