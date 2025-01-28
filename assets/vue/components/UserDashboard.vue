<template>
  <v-container>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>
            Bienvenue, {{ userName }}
          </v-card-title>
          <v-card-text>
            Voici un aperçu de vos congés.
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>
            Congés posés
          </v-card-title>
          <v-card-text>
            <!-- Graphique ou liste à intégrer ici -->
          </v-card-text>
        </v-card>
      </v-col>
      <v-col>
        <v-card>
          <v-card-title>
            Solde de congés
          </v-card-title>
          <v-card-text>
            {{ soldeConge }} heures restantes
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "Dashboard",
  data() {
    return {
      userName: "",
      soldeConge: 0,
    };
  },
  mounted() {
    fetch("/api/user/dashboard", {
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        this.userName = data.userName;
        this.soldeConge = data.soldeConge;
      })
      .catch((error) => {
        console.error("Erreur lors du chargement des données :", error);
      });
  },
};
</script>

<style scoped>
/* Styles spécifiques au tableau de bord */
</style>
