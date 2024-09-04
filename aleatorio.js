// Los componentes del array
const ponentes = [
  {
    nombre: "Ing. Efrén Sánchez",
    afiliacion: "Red Hat México",
    imagen: "images/personas/efren.jpg",
    descripcion:
      "Efrén Sánchez trabaja para Red Hat México, cursó la licenciatura en Informática en el Instituto Tecnológico Superior de Teziutlán, Puebla. Actualmente se desempeña como Account Manager para el segmento corporativo, desarrollando estrategias enfocadas a proyectos transformacionales en el sector público.",
  },
  {
    nombre: "Dr. Tomás Pérez Becerra",
    afiliacion: "Universidad Tecnológica de la Mixteca",
    imagen: "images/personas/tomasb.jpg",
    descripcion:
      "Tomás Pérez Becerra es licenciado en matemáticas aplicadas, tiene dos maestrías: en ciencias matemáticas y en ciencia de datos aplicada, también es doctor en ciencias matemáticas. Es miembro del Sistema Nacional de Investigadores de México y cuenta con la distinción Prodep-SEP. Cuenta con diversas publicaciones de artículos científicos indexados en revistas internacionales y es responsable de dos proyectos de investigación institucionales. Es coordinador del doctorado en modelación matemática y director del Centro de Modelación Matemática, Vinculación y Consultoría. Algunas de sus líneas de investigación son ecuaciones diferenciales ordinarias, biología matemática, cómputo cuántico y ciencia de datos.",
  },
  {
    nombre: "Ing. Aquino Velasco Osorio",
    afiliacion: "Datyra Inc.",
    imagen: "images/personas/aquino.jpg",
    descripcion:
      "Ingeniero en Computación graduado de la Universidad Tecnológica de la Mixteca, con experiencia en el modelado, implementación y lanzamiento de algoritmos de Inteligencia Artificial. Desarrollador Back-End con habilidades en diseño y desarrollo de sistemas robustos y escalables, así como en proyectos integrales. Se desempeña además en soluciones innovadoras en el ámbito de la tecnología y la inteligencia artificial.",
  },

  {
    nombre: "Ing. Abel Augusto Pacheco Angeles.",
    afiliacion: "WaxacaBytes",
    imagen: "images/personas/abel.png",
    descripcion:
      "Abel Augusto Pacheco Angeles es un Ingeniero Mecatrónico y emprendedor mexicano, graduado de la Universidad Tecnológica de la Mixteca en 2013. Con experiencia en empresas como KadaSoftware y ThunderTix, Abel fundó WaxacaBytes en 2024, una firma de desarrollo de software a medida. Además de su labor empresarial, Abel se destaca por su compromiso con la innovación social. Participa activamente en iniciativas para cerrar la brecha tecnológica en comunidades rurales de Oaxaca, promoviendo el uso de tecnologías de código abierto como herramienta clave para democratizar el acceso digital y mejorar las oportunidades educativas.",
  },
];

/**
 * Mezcla los elementos de un array en su lugar.
 * @param {Array} array - El array que se va a mezclar.
 * @returns {void}
 */
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
}

/**
 * ! Crea el HTML para mostrar la información de un ponente.
 *
 * @param {Object} ponente - El objeto que contiene la información del ponente.
 * @param {number} index - El índice del ponente en la lista.
 * @returns {string} - El HTML generado para mostrar la información del ponente.
 */
function createPonenteHTML(ponente, index) {
  const isEven = index % 2 === 0;
  return `
        <div class="row featurette" id="${ponente.nombre
          .toLowerCase()
          .replace(/\s+/g, "-")}">
            <div class="col-md-12 col-lg-7 ${isEven ? "" : "order-lg-2"}">
                <h4 class="featurette-heading fw-normal lh-1">
                    ${ponente.nombre}
                    <span class="text-body-secondary">${
                      ponente.afiliacion
                    }</span>
                </h4>
                <p class="lead">${ponente.descripcion}</p>
            </div>
            <div class="col-md-12 col-lg-5 ${isEven ? "" : "order-lg-1"}">
                <div class="gray-background">
                    <img src="${
                      ponente.imagen
                    }" width="400px" height="400px" alt="${
    ponente.nombre
  }" class="rounded-image" />
                </div>
            </div>
        </div>
         <hr class="featurette-divider" />
    `;
}

/**
 * Muestra los ponentes en el contenedor.
 */
function displayPonentes() {
  const container = document.querySelector(".container");
  shuffleArray(ponentes);

  // Usa insertAdjacentHTML para agregar el HTML de los ponentes
  ponentes.forEach((ponente, index) => {
    container.insertAdjacentHTML(
      "beforeend",
      createPonenteHTML(ponente, index)
    );
  });
}

document.addEventListener("DOMContentLoaded", displayPonentes);
