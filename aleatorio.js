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
    {
        nombre: "Mtra. Nataly Coss Sansón",
        afiliacion: "Binario Consultores",
        imagen: "images/personas/coss.jpeg",
        descripcion:
          "Nataly Coss Sansón es Ingeniera en Comunicaciones y Electrónica por la Escuela Superior de Ingeniería Mecánica y Eléctrica del Instituto Politécnico Nacional, realizó estudios de especialización en materia de Informática y Telecomunicaciones en materia forense en el Instituto Nacional de Ciencias Penales y el posgrado en Administración de Alta Dirección, donde obtuvo el grado de Maestra por la Universidad del Valle de México. Actualmente se desempeña como Encargada de la Especialidad de Telecomunicaciones y Electrónica en la Unidad de Ingenierías Forenses, en el Centro Federal Pericial Forense de la Agencia de Investigación Criminal de la Fiscalía General de la República. Cuenta con más de 30 cursos, seminarios, entrenamientos y certificaciones especiales en materia de Telecomunicaciones e Informática forense dentro del país y en el extranjero, así como del Sistema de Justicia Penal; Cadena de Custodia; Derechos Humanos, entre otros. Tiene más de trece años de experiencia operativa en materia de Telecomunicaciones y electrónica.",
    },
    {
        nombre: "Mtro. Víctor René Silva Xilotl. ",
        afiliacion: "Binario Consultores",
        imagen: "images/personas/victorS.jpeg",
        descripcion:
          "Víctor René Silva Xilotl es Ingeniero en Sistemas Computacionales por el Instituto Tecnológico Superior de Atlixco, en el estado de Puebla, Maestría en Sistemas Computacionales y Maestría en Tecnología Educativa, ambas por la Universidad Popular Autónoma del Estado de Puebla, así como una maestría en curso de Seguridad de la Información, por el Instituto Suizo, en el estado de Puebla. Actualmente se desempeña como Perito de la Especialidad de Informática en la Unidad de Ingenierías Forenses, en el Centro Federal Pericial Forense de la Agencia de Investigación Criminal de la Fiscalía General de la República, realizando funciones de emitir dictámenes e informes en el área de informática forense, en ocasiones también ha sido encargado de la especialidad de informática; Asimismo es cofundador de Binario Consultores, empresa dedicada al análisis de forense y auditoria de sistemas. Dentro de su campo laboral ha sido Jefe de Redes y Soporte Tecnológico del Ayuntamiento de Atlixco, así como también, ha sido Jefe de División de la Carrera de Ingeniería de Sistemas Computacionales y Jefe del Centro de Cómputo del Instituto Tecnológico Superior de Tepexi. Cuenta con más de 30 cursos, seminarios, entrenamientos y certificaciones especiales en materia el área de Tecnologías de la Información, así como del Sistema de Justicia Penal; Cadena de Custodia; Derechos Humanos, entre otros.",
    },    
    {
        nombre: "Dra. María Auxilio Medina Nieto  ",
        afiliacion: "Universidad Politécnica de Puebla.",
        imagen: "images/personas/mnieto.jpg",
        descripcion:
          "María Auxilio Medina Nieto es profesora-investigadora del Departamento de Posgrado en la Universidad Politécnica de Puebla. Recibió su grado de maestría y doctorado por la Universidad de las Américas Puebla y de Licenciada en Computación por la Benemérita Universidad Autónoma de Puebla. La Dra. Medina pertenece al SNII nivel 1, es integrante de la red temática para el desarrollo e incorporación de Tecnología Educativa, de la Red de Inteligencia Computacional Aplicada y de la Academia Mexicana de Computación. Sus áreas de interés incluyen ontologías, web semántica, repositorios de datos abiertos enlazados y de recursos educativos.",
    },    
    {
        nombre: "Ing. Israel Bazán  ",
        afiliacion: "HSBC Centro de Cómputo Toluca  Área de GPS (Global Payments Sistemas).",
        imagen: "images/personas/ibazan.jpg",
        descripcion:
          "Software Engineer, egresado de la carrera Ingeniería en Computación de la Universidad Tecnológica de la Mixteca y certificado como SAFe® 6 DevOps Practitioner. Actualmente es Desarrollador FullStack en GSC que es una una red global de centros de servicio para HSBC, desempeñándose como miembro de equipos ágiles que desarrollan y dan soporte a productos financieros del área de Wholesale Global Payment Systems de HSBC. Ha trabajado como Developer, Team Lead, SysAdmin y Consultor para empresas en México y Estados Unidos.",
    },
    {
        nombre: "Dr. Raúl Cruz Barbosa",
        afiliacion: "Universidad Tecnológica de la Mixteca",
        imagen: "images/personas/raulc.jpg",
        descripcion:
          "El Dr. Raúl Cruz Barbosa realizó estudios de licenciatura y maestría en Ciencias de la Computación en la Facultad de Ciencias de la Computación de la Benemérita Universidad Autónoma de Puebla, México. También, obtuvo su doctorado en Inteligencia Artificial en la Universidad Politécnica de Cataluña, España, y un postdoctorado en la Universidad Autónoma de Barcelona. Él es profesor-investigador en la Universidad Tecnológica de la Mixteca, donde ha fungido como Director del Instituto de Computación y coordinador de la maestría en Tecnologías de Cómputo Aplicado. El Dr. Cruz Barbosa forma parte del Sistema Nacional de Investigadoras e Investigadores con nivel 1 desde 2016 y cuenta con el desempeño de Perfil Deseable del Programa para el Desarrollo Profesional Docente (SEP-PRODEP). Actualmente, es miembro del cuerpo académico de Reconocimiento de Patrones (grado en consolidación) y sus intereses de investigación están relacionados con la inteligencia artificial explicable, aprendizaje computacional a gran escala, aprendizaje profundo, procesamiento y análisis de imágenes médicas, ciencia de datos y reconocimiento de patrones, así como su aplicación en la detección y diagnóstico asistido por computadora, ingeniería de software, bioinformática y educación.",
    },
    {
        nombre: "M.C. Gerardo Cruz González.  ",
        afiliacion: "Universidad Tecnológica de la Mixteca",
        imagen: "images/personas/gerardoc.png",
        descripcion:
          "Gerardo Cruz González obtuvo el grado de licenciado en computación en la Escuela de Ciencias Físico-Matemáticas de la Universidad Autónoma de Puebla. Posteriormente se graduó como maestro en ciencias en la Universidad de las Américas Puebla y como maestro en Medios Interactivos en la Universidad Tecnológica de la Mixteca (UTM). Laboralmente se ha desempeñado como profesor en la Facultad de Ciencias de la Computación de la Benemérita Universidad Autónoma de Puebla y en la UTM, donde también ha desempeñado cargos administrativos.",
    },    
    {
        nombre: "Ing. Emmanuel Espinoza ",
        afiliacion: "Broxel",
        imagen: "images/personas/emmanuelesp.png",
        descripcion:
          "Emmanuel Espinoza es Ingeniero en mecatrónica por la Universidad Tecnológica de la Mixteca. Tiene más de 3 años de experiencia en el desarrollo y despliegue en producción de algoritmos de Procesamiento de Datos, Procesamiento Generativo del Lenguaje Natural, Minería de Datos así como Modelado y Análisis Predictivo. Ha laborado en Ingeniería. de Datos del Grupo Ziga S.A. de C.V., Cientifico de Datos en Localadventures Stuntshare, Inc., Desarrollador Sr. en  Aprendizaje Automático en Datyra Inc. Actualmente es Arquitecto de IA en Broxel.",
    },    
    {
        nombre: "M.E.C. José Antonio García Hernández",
        afiliacion: "3Pillar Global",
        imagen: "images/personas/josea.png",
        descripcion:
          "Ingeniero de Software Senior con más de 10 años de experiencia en el diseño, desarrollo e implementación de soluciones de software complejas. He liderado y gestionado proyectos de desarrollo de software, desde la concepción hasta la entrega. Experto en diversos lenguajes de programación y tecnologías, incluyendo Python, Java, JavaScript, PostgreSQL, MySQL, servicios AWS, frameworks como FastAPI, Flask. Historial de éxito en la entrega de proyectos impactantes que han aumentado la eficiencia y la funcionalidad para clientes en diversas industrias.",
    },    
    {
        nombre: "Ing. Lizet Nuñez Martínez",
        afiliacion: "Ingenia Agency",
        imagen: "images/personas/lizetn.png",
        descripcion:
          "Lizet Núñez Martínez estudió la ingeniería en Computación en Universidad Tecnológica de la Mixteca, actualmente es Backend Head en Ingenia Agency. Cuenta con 16 años de experiencia en desarrollo de aplicaciones web para grandes corporativos. Realiza Implementación de soluciones Open Source y es experta en Search Engine Optimization y marketing digital, así como  en diversos lenguajes de programación y tecnologías, incluyendo  PHP, Python, C#.",
    },    
    {
        nombre: "Dr. Manuel Hernández Gutiérrez ",
        afiliacion: "Universidad Tecnológica de la Mixteca.",
        imagen: "images/personas/manuelh.png",
        descripcion:
          "El Dr. Hernández obtuvo su doctorado en el IIMAS, UNAM, y tiene amplia experiencia en la aplicación de Erlang a diversos problemas distribuidos, con aplicaciones al diseño de ambientes de aprendizaje a distancia, cómputo distribuido y robótica, con publicaciones arbitradas en cada ocasión. El Dr. Hernández siempre ha considerado que la programación declarativa, de la cual la programación funcional es parte, permite la creación de programas correctos, legibles, bien documentados, escalables y adecuados para trabajo en grupo, y que Erlang facilita la creación de este tipo de programas.",
    },    
    {
        nombre: "M.C. Graciela Castro González ",
        afiliacion: "Universidad Tecnológica de la Mixteca.",
        imagen: "images/personas/gracielac.png",
        descripcion:
          "Graciela Castro González es Licenciada en Computación y Maestra en Ciencias, con orientación a computación matemática, por la Benemérita Universidad Autónoma de Puebla (BUAP).  Es profesor de la UTM desde 2000, ha impartido diversos cursos de matemáticas durante este tiempo. Su interés de investigación es el estudio de los métodos numéricos, ya sea en problemas de investigación o en el desarrollo de éstos. Particularmente el estudio de las ecuaciones diferenciales ordinarias donde ha abordado: un problema de control en el caso de un microsatélite y un problema de ecuaciones unimodales.",
    },    
    {
        nombre: "Dr. Virgilio Vázquez Hipólito ",
        afiliacion: "Universidad Tecnológica de la Mixteca.",
        imagen: "images/personas/virgiliov.png",
        descripcion:
          "Virgilio Vázquez Hipólito es Doctor en Ciencias con Orientación en Matemáticas Aplicadas por el Centro de Investigación en Matemáticas, A. C.  y desde 2016 es Profesor-Investigador adscrito al Instituto de Física y Matemáticas de la Universidad Tecnológica de la Mixteca. Realiza investigación en el área de la Matemática Aplicada. Desde 2017 pertenece al Sistema Nacional de Investigadores y a partir de 2020 en el nivel I. Fungió como coordinador de la Maestría en Modelación Matemática durante el periodo 2018- 2022 y desde el año 2016 es integrante del núcleo académico básico de la Maestría y Doctorado en Modelación Matemática.",
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
