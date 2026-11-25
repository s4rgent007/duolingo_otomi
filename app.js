 fetch("obtener_datos.php")
    .then(response => response.json())
    .then(data => {


        console.log(data);


        if (!data.success) {
            alert(data.mensaje);
            return;
        }


        const progreso = data.datos;


        document.getElementById("contenedor").innerHTML = `
            <div class="card">


                <h2>${progreso.nombre}</h2>


                <p><strong>Email:</strong> ${progreso.email}</p>
                <p><strong>País:</strong> ${progreso.pais}</p>
                <p><strong>Nivel:</strong> ${progreso.nivel}</p>


                <hr>


                <h3>Progreso</h3>


                <p><strong>Porcentaje:</strong> ${progreso.porcentaje}%</p>
                <p><strong>Experiencia:</strong> ${progreso.experiencia}</p>
                <p><strong>Racha:</strong> ${progreso.racha}</p>
                <p><strong>Curso:</strong> ${progreso.id_curso}</p>
                <p><strong>Fecha:</strong> ${progreso.fecha_registro}</p>


            </div>
        `;
    })
    .catch(error => console.error(error));
