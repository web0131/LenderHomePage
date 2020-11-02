<template>
    <application>
        <template v-slot:content>
            <v-container class="pa-4" fluid>
                <v-card>
                    <v-card-title>[{{ team }}] players </v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="players"
                        :loading="loading"
                        disable-sort
                    >
                        <template v-slot:body="{ items }">
                            <tbody>
                                <tr v-for="item in items" :key="item.id">
                                    <td>
                                        {{ item.player_name }}
                                    </td>
                                    <td>
                                        {{
                                            new Date(
                                                item.updated_at
                                            ).toLocaleString()
                                        }}
                                    </td>
                                    <td>
                                        <v-btn icon @click="handleUpdate(item)">
                                            <v-icon>mdi-fingerprint</v-icon>
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
                    @click="addPlayer"
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
                { text: "Player Name", value: "player_name" },
                { text: "Updated At", value: "updated_at" },
                { text: "Actions" }
            ],
            players: [],
            team: null
        };
    },
    mounted() {
        this.fetchPlayers();
    },
    methods: {
        async fetchPlayers() {
            try {
                this.loading = true;
                const result = await axios.get(
                    `/api/teams/${this.$route.params.id}`
                );
                this.players = result.data.players;
                this.team = result.data.team.team_name;
            } catch (e) {
                console.log(e);
                this.$toast.error(e);
            } finally {
                this.loading = false;
            }
        },

        handleDelete(item) {
            axios
                .delete(`/api/players/${item.id}`)
                .then(response => {
                    this.players = this.players.filter(player => {
                        return player.id !== item.id;
                    });
                    this.$toast.success(response.data);
                })
                .catch(e => {
                    console.log(e);
                    this.$toast.error(e);
                });
        },
        handleUpdate(item) {
            this.$router.push({ name: "add-player", params: { item: item } });
        },

        addPlayer() {
            this.$router.push({ name: "add-player" });
        }
    }
};
</script>
