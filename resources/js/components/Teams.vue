<template>
    <application>
        <template v-slot:content>
            <v-container class="pa-4" fluid>
                <v-card>
                    <v-card-title>
                        Teams
                        <div class="flex-grow-1" />
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Search"
                            single-line
                            hide-details
                            @input="handleSearch"
                        />
                    </v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="teams"
                        :loading="loading"
                        disable-sort
                    >
                        <template v-slot:body="{ items }">
                            <tbody>
                                <tr v-for="item in items" :key="item.id">
                                    <td>
                                        {{ item.team_name }}
                                    </td>
                                    <td>
                                        {{
                                            new Date(
                                                item.updated_at
                                            ).toLocaleString()
                                        }}
                                    </td>
                                    <td>
                                        <v-btn icon @click="handleDetail(item)">
                                            <v-icon>mdi-eye-outline</v-icon>
                                        </v-btn>
                                        <v-btn icon @click="handleDelete(item)">
                                            <v-icon>mdi-delete</v-icon>
                                        </v-btn>
                                    </td>
                                </tr>
                            </tbody>
                        </template>
                    </v-data-table>
                </v-card>
                <v-btn
                    fab
                    color="primary"
                    bottom
                    right
                    absolute
                    to="/teams/add"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </v-container>
        </template>
    </application>
</template>

<script>
import axios from "axios";
import _ from "lodash";

export default {
    data() {
        return {
            loading: false,
            search: "",
            headers: [
                { text: "Team Name", value: "team_name" },
                { text: "Updated At", value: "updated_at" },
                { text: "Actions" }
            ],
            teams: []
        };
    },
    mounted() {
        this.fetchTeams();
    },
    methods: {
        async fetchTeams() {
            try {
                this.loading = true;
                const teams = await axios.get("/api/teams", {
                    params: { search: this.search }
                });
                this.teams = teams.data;
            } catch (e) {
                console.log(e);
                this.$toast.error(e);
            } finally {
                this.loading = false;
            }
        },

        handleSearch: _.debounce(function() {
            this.fetchTeams();
        }, 500),

        handleDetail(item) {
            this.$router.push({
                name: "players",
                params: { id: item.id, item: item }
            });
        },

        handleDelete(item) {
            axios
                .delete(`/api/teams/${item.id}`)
                .then(response => {
                    this.teams = this.teams.filter(team => {
                        return team.id !== item.id;
                    });
                    this.$toast.success(response.data);
                })
                .catch(e => {
                    console.log(e);
                    this.$toast.error(e);
                });
        }
    }
};
</script>
