<template>
  <AppLayout title="Panel de información">
    <div class="px-8 py-5">
      <h1 class="text-gray-500 text-2xl font-bold">Mis tareas</h1>
      <div>
        <div class="mt-3 lg:grid grid-cols-4 gap-5 space-y-4 lg:space-y-0">
          <!-- homeworks uploaded this month -->
          <DashboardPanelSmall>
            <template #title>
              <p>Tareas subidas este mes</p>
            </template>
            <template #content>
              <h2 class="text-3xl font-bold">
                {{ homeworks_uploaded_this_month }}
              </h2>
              <small class="text-gray-400">
                Mes pasado: {{ homeworks_uploaded_prev_month }}
              </small>
            </template>
          </DashboardPanelSmall>
          <!-- All homeworks uploaded -->
          <DashboardPanelSmall>
            <template #title>
              <p>Total tareas subidas</p>
            </template>
            <template #content>
              <h2 class="text-3xl font-bold">
                {{ all_homeworks_uploaded }}
              </h2>
              <small class="text-gray-400"
                >Desde {{ $page.props.auth.user.created_at.split("T")[0] }}</small
              >
            </template>
          </DashboardPanelSmall>
        </div>
        <div class="mt-3 lg:grid grid-cols-2 gap-5 space-y-4 lg:space-y-0">
          <!-- homeworks about to expire -->
          <DashboardPanel :items="homework_expired">
            <template #title>
              <p>Tareas vencidas y próximas a vencer</p>
            </template>
            <template #content>
              <div v-for="item in homework_expired" :key="item.id">
                <Link
                  :href="route(routes.homeworks[item.status]) + '?search=' + item.title"
                  class="grid grid-cols-4 gap-x-3 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer px-2 py-1 rounded-md"
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :status="item.status" />
                    {{ item.title }}
                  </span>
                  <span class="text-gray-400 text-right" title="Fecha límite">
                    <i class="fa-solid fa-calendar-day"></i>
                    {{ item.limit_date }}
                  </span>
                </Link>
              </div>
            </template>
          </DashboardPanel>
          <!-- new comments or questions -->
          <DashboardPanel :items="unread_messages">
            <template #title>
              <p>Mensajes sin leer de mis tareas</p>
            </template>
            <template #content>
              <div v-for="item in unread_messages" :key="item.id">
                <Link
                  :href="
                    route(routes.homeworks[item.chat.homework.status]) +
                    '?search=' +
                    item.chat.homework.title
                  "
                  class="grid grid-cols-2 gap-x-3 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer px-2 py-1 rounded-md"
                >
                  <Avatar :user="item.user" :secondary_info="item.created_at.relative" />
                  <span class="mt-2 truncate">{{ item.content }}</span>
                </Link>
              </div>
            </template>
          </DashboardPanel>
          <!-- homeworks recently completed (last 24 hrs) -->
          <DashboardPanel :items="homeworks_recently_completed">
            <template #title>
              <p>Tareas recientemente completadas</p>
            </template>
            <template #content>
              <div v-for="item in homeworks_recently_completed" :key="item.id">
                <Link
                  :href="route(routes.homeworks[item.status]) + '?search=' + item.title"
                  class="grid grid-cols-4 gap-x-3 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer px-2 py-1 rounded-md"
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :status="item.status" />
                    {{ item.title }}
                  </span>
                  <span class="text-gray-400 text-right" title="Completado el">
                    <i class="fa-solid fa-calendar-day"></i>
                    {{ item.approved_collaboration.completed_date }}
                  </span>
                </Link>
              </div>
            </template>
          </DashboardPanel>
          <!-- new collaboration applies -->
          <DashboardPanel :items="apllies_to_collaborate">
            <template #title>
              <p>Nuevos aplicantes para colaborar</p>
            </template>
            <template #content>
              <div v-for="item in apllies_to_collaborate" :key="item.id">
                <Link
                  :href="
                    route(routes.homeworks[item.homework.status]) +
                    '?search=' +
                    item.homework.title
                  "
                  class="grid grid-cols-2 gap-x-3 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer px-2 py-1 rounded-md"
                >
                  <Avatar :user="item.user" :secondary_info="item.created_at.relative" />
                  <span class="mt-2 truncate text-sm">{{ item.homework.title }}</span>
                </Link>
              </div>
            </template>
          </DashboardPanel>
        </div>
      </div>
      <h1 class="text-gray-500 text-2xl font-bold mt-10">Mis Colaboraciones</h1>
      <div>
        <div class="mt-3 lg:grid grid-cols-4 gap-5 space-y-4 lg:space-y-0">
          <!-- profit this month -->
          <DashboardPanelSmall>
            <template #title>
              <p>Ganancias este mes</p>
            </template>
            <template #content>
              <div class="font-bold flex justify-between items-center">
                <span class="text-2xl"> ${{ profit_month }} </span>
                <span class="text-xl" :class="KPIPercentage[0]">
                  <i :class="KPIPercentage[1]"></i>
                  {{ KPIPercentage[2] }}%
                </span>
              </div>
              <small class="text-gray-400"> Mes pasado: ${{ profit_last_month }} </small>
            </template>
          </DashboardPanelSmall>
          <!-- money locked -->
          <DashboardPanelSmall>
            <template #title>
              <p>Dinero por liberar</p>
            </template>
            <template #content>
              <div class="font-bold flex justify-between items-center">
                <span class="text-2xl"> ${{ money_locked }} </span>
              </div>
              <small class="text-gray-400">
                De {{ money_locked_collaborations }} colaboración(es)
              </small>
            </template>
          </DashboardPanelSmall>
          <!-- Total profit -->
          <DashboardPanelSmall>
            <template #title>
              <p>Ganancias totales</p>
            </template>
            <template #content>
              <div class="font-bold flex justify-between items-center">
                <span class="text-2xl"> ${{ total_profit }} </span>
              </div>
              <small class="text-gray-400">
                Desde {{ $page.props.auth.user.created_at.split("T")[0] }}
              </small>
            </template>
          </DashboardPanelSmall>
        </div>
        <div class="mt-3 lg:grid grid-cols-2 gap-5 space-y-4 lg:space-y-0">
          <!-- Collaborations in process -->
          <DashboardPanel :items="collaborations_in_process">
            <template #title>
              <p>Colaboraciones en proceso</p>
            </template>
            <template #content>
              <div v-for="item in collaborations_in_process" :key="item.id">
                <Link
                  :href="
                    route('collaborations.in-process') + '?search=' + item.homework.title
                  "
                  class="grid grid-cols-4 gap-x-3 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer px-2 py-1 rounded-md"
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :status="item.status" />
                    {{ item.homework.title }}
                  </span>
                  <span class="text-gray-400 text-right" title="Fecha promesa">
                    <i class="fa-solid fa-calendar-day"></i>
                    {{ item.promise_date }}</span
                  >
                </Link>
              </div>
            </template>
          </DashboardPanel>
          <!-- collaborations to approve -->
          <DashboardPanel :items="collaborations_to_approve">
            <template #title>
              <p>Colaboraciones esperando aprobación</p>
            </template>
            <template #content>
              <div v-for="item in collaborations_to_approve" :key="item.id">
                <Link
                  :href="
                    route('collaborations.approve-pendent') +
                    '?search=' +
                    item.homework.title
                  "
                  class="grid grid-cols-4 gap-x-3 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer px-2 py-1 rounded-md"
                >
                  <span class="col-span-3 truncate">
                    {{ item.completed_date }}
                    <StatusIcon :status="item.status" />
                    {{ item.homework.title }}
                  </span>
                  <span class="text-gray-400 text-right" title="Fecha aplicación">
                    <i class="fa-solid fa-calendar-day"></i>
                    {{ item.created_at.relative }}</span
                  >
                </Link>
              </div>
            </template>
          </DashboardPanel>
          <!-- unread messages -->
          <DashboardPanel :items="unread_messages_c">
            <template #title>
              <p>Mensajes sin leer de mis colaboraciones</p>
            </template>
            <template #content>
              <div v-for="item in unread_messages_c" :key="item.id">
                <Link
                  :href="
                    route(
                      routes.collaborations[
                        item.chat.homework.approved_collaboration.status
                      ]
                    )
                  "
                  class="grid grid-cols-2 gap-x-3 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer px-2 py-1 rounded-md"
                >
                  <Avatar :user="item.user" :secondary_info="item.created_at.relative" />
                  <span class="mt-2 truncate">{{ item.content }}</span>
                </Link>
              </div>
            </template>
          </DashboardPanel>
          <!-- new collaboration applies -->
          <DashboardPanel :items="collaborations_claims">
            <template #title>
              <p>Reclamos abiertos</p>
            </template>
            <template #content>
              <div v-for="item in collaborations_claims" :key="item.id">
                <Link
                  :href="
                    route('collaborations.claims') + '?search=' + item.homework.title
                  "
                  class="grid grid-cols-4 gap-x-3 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer px-2 py-1 rounded-md"
                >
                  <span class="col-span-3 truncate">
                    <StatusIcon :status="item.status" />
                    {{ item.homework.title }}
                  </span>
                  <span class="text-gray-400 text-right" title="Fecha de creación">
                    <i class="fa-solid fa-calendar-day"></i>
                    {{ item.created_at.relative }}</span
                  >
                </Link>
              </div>
            </template>
          </DashboardPanel>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardPanel from "@/Components/MyComponents/DashboardPanel.vue";
import DashboardPanelSmall from "@/Components/MyComponents/DashboardPanelSmall.vue";
import StatusIcon from "@/Components/MyComponents/StatusIcon.vue";
import Avatar from "@/Components/MyComponents/Avatar.vue";
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {
      routes: {
        homeworks: [
          "homeworks.no-collaboration",
          "homeworks.on-collaboration",
          "homeworks.on-collaboration",
          "homeworks.completed",
          "homeworks.claims",
        ],
        collaborations: [
          "collaborations.index",
          "collaborations.approve-pendent",
          "collaborations.in-process",
          "collaborations.completed",
          "collaborations.claims",
        ],
      },
    };
  },
  components: {
    AppLayout,
    DashboardPanelSmall,
    DashboardPanel,
    StatusIcon,
    Avatar,
    Link,
  },
  computed: {
    KPIPercentage() {
      let icon;
      let color;

      if (this.profit_month > this.profit_last_month) {
        icon = "fa-solid fa-caret-up";
        color = "text-green-500";
      } else {
        icon = "fa-solid fa-caret-down";
        color = "text-red-500";
      }
      let percentage = (this.profit_month / this.profit_last_month) * 100;
      percentage = Math.round(percentage * 10) / 10;
      return [color, icon, percentage];
    },
  },
  props: {
    homework_expired: Array,
    homeworks_uploaded_this_month: Number,
    homeworks_uploaded_prev_month: Number,
    all_homeworks_uploaded: Number,
    unread_messages: Array,
    homeworks_recently_completed: Array,
    apllies_to_collaborate: Array,
    collaborations_in_process: Array,
    collaborations_to_approve: Array,
    unread_messages_c: Array,
    collaborations_claims: Array,
    profit_month: String,
    profit_last_month: String,
    money_locked_collaborations: Number,
    money_locked: String,
    total_profit: String,
  },
};
</script>
