<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>

<template>
  <Head title="Bienvenido" />
  <div class="text-gray-800 antialiased">
    <!-- <nav
      class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3"
    >
      <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
        <div
          class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
        >
          <img src="@/resources/images/logo_claro.png" class="w-1/3" alt="LOGO" />
          <button
            class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
            type="button"
            onclick="toggleNavbar('example-collapse-navbar')"
          >
            <i class="text-white fas fa-bars"></i>
          </button>
        </div>
        <div
          class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden"
          id="example-collapse-navbar"
        >
          <ul class="flex flex-col lg:flex-row list-none mr-auto">
            <li class="flex items-center"></li>
          </ul>
          <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
            <li class="flex items-center">
              <a
                class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                href="#"
                ><i
                  class="lg:text-gray-300 text-gray-500 fab fa-facebook text-lg leading-lg hover:text-gray-500"
                ></i
                ><span class="lg:hidden inline-block ml-2">facebook</span></a
              >
            </li>
            <li class="flex items-center">
              <a
                class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                href="#"
                ><i
                  class="lg:text-gray-300 text-gray-500 fab fa-twitter text-lg leading-lg hover:text-gray-500"
                ></i
                ><span class="lg:hidden inline-block ml-2">Tweet</span></a
              >
            </li>
            <li class="flex items-center">
              <a
                class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                href="#"
                ><i
                  class="lg:text-gray-300 text-gray-500 fa-brands fa-youtube text-lg leading-lg hover:text-gray-500"
                ></i
                ><span class="lg:hidden inline-block ml-2">Youtube</span></a
              >
              <a
                class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                href="#"
                ><i
                  class="lg:text-gray-300 text-gray-500 fa-brands fa-instagram text-lg leading-lg hover:text-gray-500"
                ></i
                ><span class="lg:hidden inline-block ml-2">Instagram</span></a
              >
            </li>
            <li class="flex items-center"></li>
          </ul>
        </div>
      </div>
    </nav> -->
    <main>
      <div
        class="relative pt-16 pb-32 flex content-center items-center justify-center"
        style="min-height: 75vh"
      >
        <div class="absolute top-0 w-full h-full bg-center bg-cover">
          <span
            id="blackOverlay"
            class="w-full h-full absolute opacity-75 bg-black"
          ></span>
        </div>
        <div class="container relative mx-auto">
          <div class="items-center flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
              <div class="pr-12">
                <h1 class="text-white font-semibold text-5xl">
                  ¡Forma parte de nuestro grupo estudiantil!
                </h1>
                <p class="mt-4 text-lg text-gray-300">
                  Colabora con la comunidad. <br />
                  Aprovecha el tiempo libre y tus conocimientos para apoyar a los demás generando ganancias
                </p>
                <br /><br />
                <div>
                  <Link
                    :href="route('login')"
                    class="text-xl text-cyan-600 font-extrabold mr-2 hover:text-cyan-400"
                  >
                    Ingresar
                    
                  </Link>
                </div>
                <br/>
                <div>
                  <Link
                    :href="route('register')"
                    class="text-xl text-cyan-600 font-extrabold mr-2 hover:text-cyan-400"
                  >
                    Crear una cuenta
                    
                  </Link>
                </div>
                  <br/>
                <div>
                  <a
                    href="https://drive.google.com/file/d/1r6xtokFpXKqG0K7gKk-XGUIbaAyscyxk/view?usp=share_link"
                    target="_blank"
                    class="text-xl text-cyan-600 font-extrabold mr-2 hover:text-cyan-400"
                  >
                    Manual de uso
                    
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
          style="height: 70px"
        >
          <svg
            class="absolute bottom-0 overflow-hidden"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            version="1.1"
            viewBox="0 0 2560 100"
            x="0"
            y="0"
          >
            <polygon
              class="text-gray-500 fill-current"
              points="2560 0 2560 100 0 100"
            ></polygon>
          </svg>
        </div>
      </div>
      <section class="pb-20 bg-gray-400 -mt-24">
        <div class="container mx-auto px-4">
          <div class="flex flex-wrap">
            <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto hover:shadow-xl hover:shadow-gray-600/100">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400"
                  >
                    <i class="fas fa-award"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Garantía de Cumplimiento</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Te garantizamos la entrega en tiempo y forma de tus actividades de lo
                    contrario se realizará una revisión para evaluar una devolución
                    parcial o total de tu dinero.
                  </p>
                </div>
              </div>
            </div>
            <div class="w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto hover:shadow-xl hover:shadow-gray-600/100">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-green-400"
                  >
                    <i class="fa-solid fa-dollar-sign"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Genera ganancias</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Colabora con la comunidad siendo partner y obten ganancias por tu
                    ayuda!
                  </p>
                </div>
              </div>
            </div>
            <div class="pt-6 w-full md:w-4/12 px-4 text-center">
              <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg"
              >
                <div class="px-4 py-5 flex-auto hover:shadow-xl hover:shadow-gray-600/100">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-blue-400"
                  >
                    <i class="fa-solid fa-shield-halved"></i>
                  </div>
                  <h6 class="text-xl font-semibold">Seguridad</h6>
                  <p class="mt-2 mb-4 text-gray-600">
                    Tu información estará siempre bien protegida y no se tolerará ninguna
                    falta de respeto hacia los integrantes de la comunidad.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap items-center mt-32">
            <div class="w-full md:w-5/12 px-4 mr-auto ml-auto">
              <div
                class="text-gray-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-gray-100 hover:scale-110"
              >
                <i class="fas fa-user-friends text-xl"></i>
              </div>
              <h3 class="text-3xl mb-2 font-semibold leading-normal">
                Sé parte de nuestro colectivo de estudiantes
              </h3>
              <p class="text-lg font-light leading-relaxed mt-2 mb-4 text-gray-700">
                Somos una red integrada por estudiantes de diferentes escuelas de
                todo México que tiene como fin la colaboración de unos con otros mientras
                generas ganacias por tu ayuda y aportes
              </p>
              <p class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-700">
                Sólo tienes que registrarte totalmente gratis e ingresar para comenzar a
                pedir ayuda o colaborar con la comunidad
              </p>
              <Link
                :href="route('register')"
                class="font-bold text-teal-700 mt-8 text-2xl py-2 px-3 rouded hover:text-teal-500 underline"
                >¡REGISTRATE!
              </Link>
            </div>
            <div class="w-full md:w-4/12 px-4 mr-auto ml-auto">
              <div
                class="relative flex flex-col min-w-0 break-word w-full mb-6 shadow-lg rounded-lg bg-cyan-600"
              >
                <img
                  alt="..."
                  src="@/../../public/images/students2.png"
                  class="w-full align-middle rounded-t-lg"
                />
                <blockquote class="relative p-8 mb-4">
                  <svg
                    preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 583 95"
                    class="absolute left-0 w-full block"
                    style="height: 95px; top: -94px"
                  >
                    <polygon
                      points="-30,95 583,95 583,65"
                      class="text-emerald-500 fill-current"
                    ></polygon>
                  </svg>
                  <h4 class="text-xl font-bold text-white">
                    ¡Colabora y obten beneficios!
                  </h4>
                  <p class="text-md font-light mt-2 text-white">
                    Sube de nivel colaborando con la comunidad obten multiples beneficios
                    y aumenta tus ganancias.
                  </p>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="relative py-20">
        <div
          class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
          style="height: 80px"
        >
          <svg
            class="absolute bottom-0 overflow-hidden"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            version="1.1"
            viewBox="0 0 2560 100"
            x="0"
            y="0"
          >
            <polygon
              class="text-white fill-current"
              points="2560 0 2560 100 0 100"
            ></polygon>
          </svg>
        </div>
        <div class="container mx-auto px-4">
          <div class="items-center flex flex-wrap">
            <div class="w-full md:w-4/12 ml-auto mr-auto px-4">
              <img
                alt="..."
                class="max-w-full rounded-lg shadow-lg"
                src="@/../../public/images/homeStudent.jpg"
              />
            </div>
            <div class="w-full md:w-5/12 ml-auto mr-auto px-4">
              <div class="md:pr-12">
                <div
                  class="text-sky-600 p-3 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-sky-300 hover:scale-110"
                >
                  <i class="fa-solid fa-house"></i>
                </div>
                <h3 class="text-3xl font-semibold">Genera rendimientos desde casa</h3>
                <p class="mt-4 text-lg leading-relaxed text-gray-600">
                  Genera rendimientos desde la comodidad de tu casa dedicando el tiempo que
                  tengas disponible ayudando a la comunidad con sus actividades
                  académicas. <br />
                  ¿Cómo funciona?
                </p>
                <ul class="list-none mt-6">
                  <li class="py-2">
                    <div class="flex items-center">
                      <div>
                        <span
                          class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-700 bg-red-300 mr-3"
                          ><i class="fa-solid fa-user"></i>
                        </span>
                      </div>
                      <div>
                        <h4 class="text-gray-600">Registrate</h4>
                      </div>
                    </div>
                  </li>
                  <li class="py-2">
                    <div class="flex items-center">
                      <div>
                        <span
                          class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-700 bg-red-300 mr-3"
                          ><i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                      </div>
                      <div>
                        <h4 class="text-gray-600">
                          Busca y aplica a una tarea con la que puedas colaborar
                        </h4>
                      </div>
                    </div>
                  </li>
                  <li class="py-2">
                    <div class="flex items-center">
                      <div>
                        <span
                          class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-700 bg-red-300 mr-3"
                          ><i class="fa-solid fa-hand-holding-dollar"></i>
                        </span>
                      </div>
                      <div>
                        <h4 class="text-gray-600">Espera la apobación de tu solicitud y genera ingresos</h4>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="pb-20 relative block bg-gray-900">
        <div
          class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
          style="height: 80px"
        >
          <svg
            class="absolute bottom-0 overflow-hidden"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            version="1.1"
            viewBox="0 0 2560 100"
            x="0"
            y="0"
          >
            <polygon
              class="text-gray-900 fill-current"
              points="2560 0 2560 100 0 100"
            ></polygon>
          </svg>
        </div>
        <div class="container mx-auto px-4 lg:pt-24 lg:pb-64">
          <div class="text-center">
            <div class="w-full px-4">
              <h2 class="text-4xl font-semibold text-white">
                ¿Qué te ofrece YouPartner?
              </h2>
              <div class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                En Youpartner Puedes conocer gente del sector estudiantil de todo México e
                interactuar con ellos. Puedes brindar ayuda con tus conocimientos de
                cualquier materia y/o pedir apoyo a la comunidad con cualquier actividad
                que tengas.
                <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                  Además puedes generar ingresos con tus colaboraciones desde tu casa!
                  Regístrate totalmente gratis. Sé parte de nuestra sociedad y comienza a
                  colaborar
                </p>
              </div>
            </div>
            <!----------------------------------------------------------------------->
            <div
              class="flex flex-wrap mt-10 justify-center border-2 p-3 border-white rounded-md bg-gray-700"
            >
              <div class="w-full lg:w-3/12 px-4 text-center">
                <i class="fa-solid fa-pencil text-white text-2xl"></i>
                <h6 class="text-xl mt-5 font-semibold text-white">Tareas</h6>
              </div>
              <div class="w-full lg:w-3/12 px-4 text-center">
                <i class="fa-regular fa-file-lines text-white text-2xl"></i>
                <h6 class="text-xl mt-5 font-semibold text-white">Exámenes</h6>
              </div>
              <div class="w-full lg:w-3/12 px-4 text-center">
                <i class="fa-solid fa-magnifying-glass text-white text-2xl"></i>
                <h6 class="text-xl mt-5 font-semibold text-white">Tesis</h6>
              </div>
              <div class="w-full lg:w-3/12 px-4 text-center">
                <i class="fa-regular fa-file-powerpoint text-white text-2xl"></i>
                <h6 class="text-xl mt-5 font-semibold text-white">Presentaciones</h6>
              </div>
              <div class="w-full lg:w-3/12 px-4 text-center">
                <i class="fa-solid fa-circle-info text-white text-2xl"></i>
                <h6 class="text-xl mt-5 font-semibold text-white">Asesorías</h6>
              </div>
            </div>
          </div>
          <!-- ------------------------------------------------------------------------>
          <div class="flex flex-wrap mt-20 justify-center">
            <div class="w-full lg:w-6/12 px-4 text-center">
              <Link :href="route('login')" class="text-xl mt-5 font-semibold text-white">
                <div
                  class="hover:scale-110 hover:cursor-pointer text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
                >
                  <i class="fa-solid fa-right-to-bracket"></i>
                </div>
                Ingresa y Colabora
              </Link>
            </div>
            <div class="w-full lg:w-6/12 px-4 text-center">
              <Link
                :href="route('register')"
                class="text-xl mt-5 font-semibold text-white"
              >
                <div
                  class="hover:scale-110 hover:cursor-pointer text-gray-900 p-3 w-12 h-12 shadow-lg rounded-full bg-white inline-flex items-center justify-center"
                >
                  <i class="fa-solid fa-user-plus"></i>
                </div>
                Registrate Ahora
              </Link>
            </div>
          </div>
        </div>
      </section>
      <section class="relative block py-24 lg:pt-0 bg-gray-900">
        <div class="container mx-auto px-4">
          <div class="flex flex-wrap justify-center lg:-mt-64 -mt-48">
            <div class="w-full lg:w-6/12 px-4">
              <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300"
              ></div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <footer class="relative bg-gray-300 pt-8 pb-6">
      <div
        class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
        style="height: 80px"
      >
        <svg
          class="absolute bottom-0 overflow-hidden"
          xmlns="http://www.w3.org/2000/svg"
          preserveAspectRatio="none"
          version="1.1"
          viewBox="0 0 2560 100"
          x="0"
          y="0"
        >
          <polygon
            class="text-gray-300 fill-current"
            points="2560 0 2560 100 0 100"
          ></polygon>
        </svg>
      </div>
      <div class="container mx-auto px-4">
        <div class="flex justify-center flex-wrap">
          <!-- <div class="w-full lg:w-6/12 px-4">
            <h4 class="text-3xl font-semibold">Encuentranos en...</h4>
            <h5 class="text-lg mt-0 mb-2 text-gray-700">
              Encuentranos en todas platoformas...
            </h5>
            <div class="mt-6">
              <button
                class="hover:bg-gray-300 bg-white text-blue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
                type="button"
              >
                <i class="flex fab fa-twitter"></i></button
              ><button
                class="hover:bg-gray-300 bg-white text-blue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
                type="button"
              >
                <i class="flex fab fa-facebook-square"></i>
              </button>
              <button
                class="hover:bg-gray-300 bg-white text-red-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
                type="button"
              >
                <i class="flex fa-brands fa-youtube"></i>
              </button>
              <button
                class="hover:bg-gray-300 text-lg bg-white font-semibold shadow-lg h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-3"
                type="button"
              >
                <i class="flex fa-brands fa-instagram"></i>
              </button>
            </div>
          </div> -->
          <div class="w-full lg:w-6/12 px-4">
            <div class="flex flex-wrap items-top mb-6">
              <div class="w-full lg:w-4/12 px-4 ml-auto">
                <span class="block uppercase text-gray-600 text-sm font-semibold mb-2"
                  >Links de utilidad</span
                >
                <ul class="list-unstyled">
                  <li>
                    <a
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm hover:underline"
                      href="#"
                      >Acerca de nosotros</a
                    >
                  </li>
                </ul>
              </div>
              <div class="w-full lg:w-4/12 px-4">
                <span class="block uppercase text-gray-600 text-sm font-semibold mb-2"
                  >Otros recursos</span
                >
                <ul class="list-unstyled">
                  <li>
                    <Link
                      :href="route('terms-of-service')"
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm hover:underline"
                    >
                      Términos de servicio
                    </Link>
                  </li>
                  <li>
                    <Link
                      :href="route('privacy-policy')"
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm hover:underline"
                    >
                      Politicas de Privacidad
                    </Link>
                  </li>
                  <li>
                    <!-- <Link
                      :href="route('contact')"
                      class="text-gray-700 hover:text-gray-900 font-semibold block pb-2 text-sm hover:underline"
                    >
                      Contáctanos
                    </Link> -->
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <hr class="my-6 border-gray-400" />
        <div class="flex flex-wrap items-center md:justify-between justify-center">
          <div class="w-full md:w-4/12 px-4 mx-auto text-center">
            <div class="text-sm text-gray-600 font-semibold py-1">
              Copyright © 2022 YouPartner
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
