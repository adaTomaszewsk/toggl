document.addEventListener('DOMContentLoaded', function () {
    let columnCount = 1; // Zakładamy, że pierwsza kolumna już istnieje
    const modalElement = document.getElementById('newProjectModal');
    const addColumnBtn = document.getElementById('addColumnBtn');
    const columnsContainer = document.getElementById('columnsContainer');
    const firstColumn = document.getElementById('column-1'); // Pierwsza kolumna

    if (modalElement) {
        // Resetujemy modal przy otwieraniu
        modalElement.addEventListener('shown.bs.modal', function () {
            columnCount = 1; // Resetujemy licznik kolumn do początkowego stanu

            // Usuwamy wszystkie dodatkowe kolumny (pozostawiamy tylko pierwszą i przycisk "Add Column")
            Array.from(columnsContainer.children).forEach(child => {
                if (child !== firstColumn && child !== addColumnBtn) {
                    child.remove();
                }
            });

            // Czyszczenie pól tekstowych w pierwszej kolumnie
            firstColumn.querySelector('input').value = '';

            // Czyszczenie pól ogólnych w modalu
            const inputs = modalElement.querySelectorAll('input, textarea:not(#columnName-1)');
            inputs.forEach(input => {
                input.value = '';
            });
        });
    }

    // Obsługa przycisku dodawania nowych kolumn
    addColumnBtn.addEventListener('click', function () {
        columnCount++;
        const newColumnDiv = document.createElement('div');
        newColumnDiv.className = 'mb-2 d-flex align-items-center';
        newColumnDiv.id = `column-${columnCount}`;

        newColumnDiv.innerHTML = `
            <input type="text" class="form-control me-2" id="columnName-${columnCount}" placeholder="e.g. Doing" />
            <button type="button" class="btn btn-danger btn-sm remove-column-btn" data-column-id="column-${columnCount}">
                X
            </button>
        `;

        columnsContainer.insertBefore(newColumnDiv, addColumnBtn); // Wstawiamy kolumnę nad przyciskiem

        // Obsługa przycisku usuwania dodanej kolumny
        newColumnDiv.querySelector('.remove-column-btn').addEventListener('click', function () {
            const columnId = this.getAttribute('data-column-id');
            const columnElement = document.getElementById(columnId);
            if (columnElement) {
                columnElement.remove();
            }
        });
    });
});
