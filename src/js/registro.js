import Swal from "sweetalert2";

(function() {
    let eventos = [];

    const resumen = document.querySelector('#tu-registro-resumen');

    if(resumen) {
        const eventosBoton = document.querySelectorAll('.evento__agregar');
        eventosBoton.forEach(boton => boton.addEventListener('click', seleccionarEvento));

        const formularioRegistro = document.querySelector('#registro');
        formularioRegistro.addEventListener('submit', submitFormulario);

        mostrarEventos();

        function seleccionarEvento(e) {
            if(eventos.length < 5) {
                // Deshabilitar el evento
                e.target.disabled = true;
        
                eventos = [...eventos, {
                    id: e.target.dataset.id,
                    titulo: e.target.parentElement.querySelector('.evento__nombre').textContent.trim()
                }];

                // Mostrar el evento en el carrito
                mostrarEventos();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Máximo 5 eventos',
                    text: 'No puedes agregar más de 5 eventos a tu registro',
                    confirmButtonText: 'Entendido',
                    timer: 5000,
                    timerProgressBar: true,
                })
            }

        }

        function mostrarEventos() {
            // Limpiar el HTML
            limpiarEventos();

            if(eventos.length > 0) {
                eventos.forEach(evento => {
                    const eventoDOM = document.createElement('DIV');
                    eventoDOM.classList.add('tu-registro__evento');

                    const titulo = document.createElement('H3');
                    titulo.classList.add('tu-registro__nombre');
                    titulo.textContent = evento.titulo;

                    const botonEliminar = document.createElement('BUTTON');
                    botonEliminar.classList.add('tu-registro__eliminar');
                    botonEliminar.textContent = 'Eliminar';
                    botonEliminar.innerHTML = `<i class="fas fa-trash"></i>`;
                    botonEliminar.onclick = function() {
                        eliminarEvento(evento.id);
                    }

                    // Renderizar el HTML
                    eventoDOM.appendChild(titulo);
                    eventoDOM.appendChild(botonEliminar);
                    resumen.appendChild(eventoDOM);
                });
            } else {
                const noRegistro = document.createElement('P');
                noRegistro.textContent = 'No tenes eventos seleccionados, agrega hasta 5 del lado izquierdo';
                noRegistro.classList.add('tu-registro__texto');

                resumen.appendChild(noRegistro);
            }
        }

        function eliminarEvento(id) {
            // Actualizar el arreglo de eventos
            eventos = eventos.filter(evento => evento.id !== id);

            // Mostrar el HTML
            mostrarEventos();

            // Habilitar el boton
            const boton = document.querySelector(`[data-id="${id}"]`);
            boton.disabled = false;
        }

        function limpiarEventos() {
            while(resumen.firstChild) {
                resumen.removeChild(resumen.firstChild);
            }
        }

        async function submitFormulario(e) {
            e.preventDefault();

            // Obtener el regalo
            const regaloId = document.querySelector('#regalo').value;
            const eventosId = eventos.map(evento => evento.id);
            
            if(eventosId.length === 0 || regaloId === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debes seleccionar al menos un evento y un regalo',
                    confirmButtonText: 'Entendido',
                    timer: 5000,
                    timerProgressBar: true,
                })
                return;
            }

            // Objeto de formdata
            const datos = new FormData();
            datos.append('eventos', eventosId);
            datos.append('regalo_id', regaloId);

            const url = '/finalizar-registro/conferencias';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            if(resultado.resultado) {
                Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    text: 'Tus conferencias se almacenaron y tu registro se realizó correctamente, te esperamos en DevWebCamp',
                    confirmButtonText: 'Entendido',
                    timer: 5000,
                    timerProgressBar: true,
                }).then(() => {
                    window.location.href = `/boleto?id=${resultado.token}`
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al registrar tus conferencias, intenta nuevamente',
                    confirmButtonText: 'Entendido',
                    timer: 5000,
                    timerProgressBar: true,
                }).then(() => {
                    window.location.reload();
                });
            }
        }
    }
})();