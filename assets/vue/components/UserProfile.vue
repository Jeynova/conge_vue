<template>
  <v-container>
    <v-card>
      <v-card-title>Mon profil</v-card-title>
      <v-card-text>
        <p><strong>Email :</strong> {{ user.email }}</p>
        <p><strong>Nom :</strong> {{ user.nom }}</p>
        <p><strong>Prénom :</strong> {{ user.prenom }}</p>
        <p><strong>Solde de congés :</strong> {{ user.soldeConge }} heures</p>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  name: "UserProfile",
  data() {
    return {
      user: {}, // Données utilisateur récupérées via l'API
    };
  },
  mounted() {
    this.fetchProfile();
  },
  methods: {
    fetchProfile() {
      fetch("/api/user/dashboard", {
        headers: { "Content-Type": "application/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          this.user = data;
        })
        .catch((error) => {
          console.error("Erreur lors du chargement des données :", error);
        });
    },
  },
};
</script>
