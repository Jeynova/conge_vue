<template>
  <v-app>
    <v-main>
      <dashboard />
    </v-main>
  </v-app>
</template>

<script>
import Dashboard from "./components/UserDashboard.vue";

export default {
  name: "App",
  components: {
    Dashboard,
  },
};
</script>