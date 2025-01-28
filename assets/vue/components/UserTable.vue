<template>
  <v-container>
    <h1>Gestion des utilisateurs</h1>
    <v-data-table :headers="headers" :items="users" item-value="id" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Utilisateurs</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click="createUser">Créer un utilisateur</v-btn>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-btn small color="primary" @click="editUser(item.id)">Modifier</v-btn>
        <v-btn small color="red" @click="deleteUser(item.id)">Supprimer</v-btn>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  name: "UserTable",
  data() {
    return {
      headers: [
        { text: "ID", value: "id" },
        { text: "Email", value: "email" },
        { text: "Nom", value: "nom" },
        { text: "Prénom", value: "prenom" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      users: [], // Données récupérées depuis l'API
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      fetch("/api/admin/users", {
        headers: { "Content-Type": "application/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          this.users = data;
        })
        .catch((error) => {
          console.error("Erreur lors du chargement des utilisateurs :", error);
        });
    },
    createUser() {
      // Redirection ou logique pour créer un utilisateur
      console.log("Créer un utilisateur");
    },
    editUser(id) {
      // Redirection ou logique pour éditer un utilisateur
      console.log("Modifier l'utilisateur", id);
    },
    deleteUser(id) {
      if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        fetch(`/api/admin/users/${id}`, {
          method: "DELETE",
          headers: { "Content-Type": "application/json" },
        })
          .then(() => {
            this.fetchUsers();
          })
          .catch((error) => {
            console.error("Erreur lors de la suppression :", error);
          });
      }
    },
  },
};
</script>