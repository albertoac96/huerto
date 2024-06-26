@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')
<header>
        <h1>ACERCA DE</h1>
        <p class="frase">El Huerto-Ibero forma parte de la sociedad InIAT. Visita el sitio del <a role="link" href="https://iniat.ibero.mx/" target="_blank">InIAT</a> aquí</p>
        <nav aria-label="Main Navigation" role="navigation">
            <h2>Barra de navegación principal</h2>
            <p>icono</p>
           
        </nav>
    </header>
    <section class="infoHuerto">
        <div class="espaciosH">
            <h2> ESPACIOS EN EL HUERTO</h2>
                <article role="article" class="comunitario article">
                    <figure>
                        <img src="images/icon/icono_espacio_comunitario.png" class="iconos" alt="Icono de dos manos colaborando con diferentes herramientas.">
                    </figure>
                    <h3> Espacio comunitario </h3>
                    <p>Ocho camas de cultivo estandarizadas y distribuidas espacialmente para siembra, cuidado y cosecha de distintas paletas vegetales.</p>
                </article>
                <article role="article" class="tecnicas article">
                    <figure>
                        <img src="images/icon/icono_tecnicas_cultivo.png" class="iconos" alt="Icono de una cama de cultivo.">
                    </figure>
                    <h3>Espacio para diversas técnicas de cultivo</h3>
                    <p>Como la siembra directa, en contenedor y la hidroponía; Es un espacio para la siembra con semillas endémicas de México.</p>
                </article>
                <article role="article" class="ecotecnias article">
                    <figure>
                        <img src="images/icon/icono_ecotecnias.png" class="iconos" alt="Icono de un rastrillo y engranajes.">
                    </figure>
                    <h3>Espacio para el diseño de diversas ecotecnias</h3>
                    <p>Para innovaciones en lombricomposta, captación de agua de lluvia, letrinas secas y otras.</p>
                </article>
                <article role="article" class="banco article">
                    <figure>
                        <img src="images/icon/icono_banco_semillas.png" class="iconos" alt="Icono de un saco de semillas.">
                    </figure>
                    <h3>Banco de semillas</h3>
                    <p>A lo largo de cada temporada de cosecha, el huerto propiciará la recuperación de semillas con la intención de almacenarlas en un banco dentro de la universidad.</p>
                </article>
        </div>
        <div class="tecnologiaH">
            <h2>TECNOLOGÍA EN EL HUERTO</h2>
            <article role="article" class="plan">
                <figure>
                    <img src="images/icon/icono_plan_integral.png" class="iconos" alt="Icono de un sujetapapel con enganajes.">
                </figure>
                <h3>Plan integral de tecnología</h3>
                <p   line-height: 0 >Con dispositivos electrónicos y de comunicación para el monitoreo remoto de variables como temperatura, humedad, etc. y su resguardo en bases de datos para su análisis en línea o posterior.</p>
            </article>
            <article role="article" class="automatizacion">
                <figure>
                    <img src="images/icon/icono_automatizacion.png" class="iconos" alt="Icono de un sistema de riego automatizado.">
                </figure>
                <h3>Distintos grados de automatización</h3>
                <p>Las camas están dotadas de riego automatizado y sensores básicos en un primer nivel de automatización. Cualquier cama puede convertirse en un invernadero con los instrumentos para controlar el clima interior, en un segundo nivel de automatización.</p>
            </article>
            <article role="article" class="internet">
                <figure>
                    <img src="images/icon/icono_laboratorio_internet.png" class="iconos" alt="Icono de un guante manipulando una tableta táctil.">
                </figure>
                <h3>Laboratorio de Internet de las cosas</h3>
                <p>Con todos los dispositivos de monitoreo y control ligados a una estación de mando con comunicación inalámbrica.</p>
            </article>
            <article role="article" class="datos">
                <figure>
                    <img src="images/icon/icono_laboratorio_analisis.png" class="iconos" alt="Icono de una lupa sobre un documento.">
                </figure>
                <h3>Laboratorio de análisis de datos</h3>
                <p>Con el resguardo de información en línea e histórica que permita encontrar causalidades de mejora de procesos de producción con métodos de ciencia de datos.</p>
            </article>
            <article role="article" class="usuario">
                <figure>
                    <img src="images/icon/icono_visualizacion_informacion.png" class="iconos" alt="Icono de un usuario usando gafas de realidad virtual.">
                </figure>
                <h3>Visualización de información al usuario</h3>
                <p>A través del catálogo de plantas, artículos de divulgación e interacción in situ con el huerto a través de realidad aumentada.</p>
            </article>
        </div>
        <div class="ofreceH">
            <h2>LO QUE OFRECE EL HUERTO</h2>
            <article role="article" class="agroecologia">
                <figure>
                    <img src="images/icon/icono_docencia_capacitacion.png" class="iconos" alt="Icono de una horticultora y un investigador.">
                </figure>
                <h3>Docencia y capacitación en agroecología y ecotecnias</h3>
                <p>Con fines didácticos pero también de investigación sobre las mejores prácticas y asimilación de contenidos para la adopción de técnicas de agricultura sustentable.</p>
            </article>
            <article role="article" class="innovaciones">
                <figure>
                    <img src="images/icon/icono_innovaciones.png" class="iconos" alt="Icono de una bombilla con engranajes.">
                </figure>
                <h3>Innovaciones tecnológicas</h3>
                <p>Probando tecnología de internet de las cosas para monitoreo y control automatizados, diseño industrial de soluciones ecotecnológicas, entre muchos otros.</p>
            </article>
            <article role="article" class="medida">
                <figure>
                    <img src="images/icon/icono_diseno_huertos.png" class="iconos" alt="Icono de la construcción de una cama de cultivo.">
                </figure>
                <h3>Diseño de huertos a la medida</h3>
                <p>Para necesidades específicas de nutrición y bienestar de la salud y su impacto económico.</p>
            </article>
            <article role="article" class="valoracion">
                <figure>
                    <img src="images/icon/icono_valoracion_nutrimental.png" class="iconos" alt="Icono de una lupa sobre una planta.">
                </figure>
                <h3>Valoración nutrimental de las plantas</h3>
                <p>Con diseño inter y transdisciplinar de experimentos para probar distintas combinaciones de semillas, asociación de cultivos, sustratos y fertilizantes orgánicos, y su impacto en el incremento del valor nutrimental de las plantas.</p>
            </article>
            <article role="article" class="ancestrales">
                <figure>
                    <img src="images/icon/icono_comprobacion_cientifica.png" class="iconos" alt="Icono de un matraz que contiene una planta.">
                </figure>
                <h3>Comprobación científica de saberes tradicionales ancestrales</h3>
                <p>Con el apoyo de la tecnología es posible valorar técnicas de cultivo de forma científica, no tan solo observacional y empírica, sino con datos obtenidos de todo el proceso de cultivo.</p>
            </article>
            <article role="article" class="evaluacion">
                <figure>
                    <img src="images/icon/icono_evaluacion.png" class="iconos" alt="Icono de una mano sosteniendo un lápiz.">
                </figure>
                <h3>Evaluación de la automatización</h3>
                <p>Al comparar camas de cultivo iguales pero con y sin automatización en un mismo experimento, se valora el real impacto de la automatización en las plantas.</p>
            </article>
        </div>
    </section>
    @endsection