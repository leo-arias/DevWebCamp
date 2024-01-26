(function() {
    const tagsInput = document.querySelector('#tags_input');

    if(tagsInput) {
        // Div donde se mostrarán los tags
        const tagsDiv = document.querySelector('#tags'); 
        const tagsInputHidden = document.querySelector('[name="tags"]'); 

        // Arreglo de tags
        let tags = [];

        // Recuperar los tags del input hidden
        if(tagsInputHidden.value !== '') {
            tags = tagsInputHidden.value.split(',');
            mostrarTags();
        }

        // Escuchar los cambios en el input
        tagsInput.addEventListener('keypress', guardarTag);

        // Función para guardar el tag
        function guardarTag(e) {
            // Si se presiona la ,
            if(e.keyCode === 44) {
                // Evitar espacios vacíos
                if(e.target.value.trim() === '' || e.target.value < 1) return;

                // Evitar que se agregue la ,
                e.preventDefault();

                // Agregar el tag al arreglo
                tags = [...tags, tagsInput.value.trim()]; 

                // Limpiar el input
                tagsInput.value = '';

                // Mostrar los tags
                mostrarTags();
            }
        }

        // Función para mostrar los tags
        function mostrarTags() {
            // Limpiar el div
            tagsDiv.textContent = ''; 

            // Recorrer el arreglo de tags
            tags.forEach(tag => {
                // Crear el elemento li
                const etiqueta = document.createElement('LI');

                // Agregar la clase
                etiqueta.classList.add('tag');

                // Agregar el texto
                etiqueta.textContent = tag;

                // Eliminar el tag al hacer doble click
                etiqueta.onclick = elimistarTag;

                // Agregar el elemento al div
                tagsDiv.appendChild(etiqueta);
            })

            // Actualizar el input hidden
            actualizarInputHidden();
        }

        // Función para eliminar un tag
        function elimistarTag(e) {
            // Eliminar el tag del DOM
            e.target.remove();

            // Eliminar el tag del arreglo
            tags = tags.filter(tag => tag !== e.target.textContent);

            // Mostrar los tags
            actualizarInputHidden();
        }

        // Función para actualizar los inputs hidden
        function actualizarInputHidden() {
            // Convertir el arreglo de tags a un string
            tagsInputHidden.value = tags.toString();
        }

    }
})()