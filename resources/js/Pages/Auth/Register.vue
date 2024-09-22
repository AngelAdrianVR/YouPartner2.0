<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const regions = [
  "Ciudad de México",
  "Aguascalientes",
  "Baja California",
  "Baja California Sur",
  "Campeche",
  "Coahuila de Zaragoza",
  "Colima",
  "Chiapas",
  "Chihuahua",
  "Durango",
  "Guanajuato",
  "Guerrero",
  "Hidalgo",
  "Jalisco",
  "México",
  "Michoacán de Ocampo",
  "Morelos",
  "Nayarit",
  "Nuevo León",
  "Oaxaca",
  "Puebla",
  "Querétaro",
  "Quintana Roo",
  "San Luis Potosí",
  "Sinaloa",
  "Sonora",
  "Tabasco",
  "Tamaulipas",
  "Tlaxcala",
  "Veracruz de Ignacio de la Llave",
  "Yucatán",
  "Zacatecas",
];

const grades = [
  "Aeroespacial",
  "Administración y negocios",
  "Ambiental",
  "Artes y humanidades",
  "Automotríz",
  "Electromecánica",
  "Sistemas",
  "Industrial",
  "Agroindustrial",
  "Aeronáutica",
  "Alimentos",
  "Arquitectura",
  "Biomédica",
  "Biónica",
  "Bioquímica",
  "Civil",
  "Ciencias sociales",
  "Ciencias de la salud",
  "Ciencias naturales, matemáticas y/o estadística",
  "Computación",
  "Comercial",
  "Derecho",
  "Eléctrica y/o Electrónica",
  "Educación",
  "Física",
  "Farmacéutica",
  "Geofísica",
  "Geológica",
  "Informática",
  "Materiales",
  "Manufactura",
  "Mecatrónica",
  "Mecánica",
  "Negocios",
  "Programador web",
  "Programador apps móviles",
  "Química",
  "Robótica",
  "Recursos Humanos",
  "Transporte",
  "Telecomunicaciones",
  "Textil",
  "Tecnologías de la información y la comunicación",
  "Software",
  "Servicios",
  "Otro",
];

const form = useForm({
    name: "",
    birthdate: "",
    email: "",
    state: "",
    academic_grade: "",
    school_name: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Registro" />

    <AuthenticationCard>
        <template #logo>
            <!-- <AuthenticationCardLogo /> -->
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-1">
                <InputLabel for="birthdate" value="Fecha de Nacimiento" is_required />
                <TextInput
                    id="birthdate"
                    v-model="form.birthdate"
                    type="date"
                    class="mt-1 block w-full"
                    required
                />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-1">
                <InputLabel for="state" value="Estado" is_required />
                <select
                    name="state"
                    v-model="form.state"
                    required
                    class=
                        "h-[2.5rem]
                        mt-1
                        block
                        w-full
                        border-gray-300
                        focus:border-indigo-300
                        focus:ring
                        focus:ring-indigo-200
                        focus:ring-opacity-50
                        rounded-md
                        shadow-sm
                        placeholder:text-gray-400 placeholder:text-sm
                        input"
                >
                <option value="" disabled>-- Selecciona --</option>
                <option v-for="(region, index) in regions" :key="index">
                    {{ region }}
                </option>
                </select>
            </div>

            <div class="mt-1">
                <InputLabel for="academic_grade" value="Área de Especialidad" is_required />
                <select
                name="academic_grade"
                v-model="form.academic_grade"
                required
                class="
                    h-[2.5rem]
                    mt-1
                    block
                    w-full
                    border-gray-300
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-indigo-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                    placeholder:text-gray-400 placeholder:text-sm
                    input"
                >
                <option value="" disabled>-- Selecciona --</option>
                <option v-for="(grade, index) in grades" :key="index">
                    {{ grade }}
                </option>
                </select>
            </div>

            <div class="mt-1">
                <InputLabel for="school_name" value="Nombre de Escuela" />
                <input
                name="school_name"
                type="text"
                placeholder="¿En qué escuela estás o de cual egresaste?"
                v-model="form.school_name"
                class="
                    h-[2.5rem]
                    mt-1
                    block
                    w-full
                    border-gray-300
                    focus:border-indigo-300
                    focus:ring
                    focus:ring-indigo-200
                    focus:ring-opacity-50
                    rounded-md
                    shadow-sm
                    placeholder:text-gray-400 placeholder:text-sm
                    input"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div
                class="mt-4"
            >
                <InputLabel for="terms">
                <div class="flex items-center">
                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" />

                    <div class="ml-1">
                    Estoy de acuerdo con los
                    <a
                        target="_blank"
                        :href="route('terms-of-service')"
                        class="underline text-sm text-gray-600 hover:text-gray-300"
                        >Terminos de servicio</a
                    >
                    y
                    <a
                        target="_blank"
                        :href="route('privacy-policy')"
                        class="underline text-sm text-gray-600 hover:text-gray-300"
                        >Politicas de privacidad</a
                    >
                    </div>
                </div>
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    ¿Ya tienes una cuenta?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Registrar
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
