<template>
<v-container>
  <v-card v-if="isLoading">
    <v-card-title>Chargement...</v-card-title>
  </v-card>
  <v-card v-else>
    <v-card-title>Bienvenue, {{ userName }}</v-card-title>
    <v-card-text>Votre solde de congés : {{ soldeConge }} heures</v-card-text>
  </v-card>
</v-container>
</template>

<script>
export default {
  data() {
  return {
    userName: "",
    soldeConge: 0,
    isLoading: true,
  };
},
    mounted() {
    fetch("/api/user/dashboard")
        .then((response) => {
        if (!response.ok) {
            throw new Error("Erreur lors du chargement des données");
        }
        return response.json();
        })
        .then((data) => {
        this.userName = data.userName;
        this.soldeConge = data.soldeConge;
        })
        .catch((error) => {
        console.error("Erreur :", error);
        this.userName = "Erreur";
        this.soldeConge = 0;
        })
        .finally(() => {
        this.isLoading = false;
        });
    },
};
</script>