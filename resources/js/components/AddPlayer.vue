<template>
    <application>
        <template v-slot:content>
            <v-container class="pa-4" fluid>
                <v-card :loading="loading">
                    <v-card-title>
                        {{ page_title }}
                    </v-card-title>
                    <v-card-text>
                        <v-text-field
                            v-model="player"
                            filled
                            label="Player"
                            :placeholder="''"
                            hint="Enter the player name"
                            persistent-hint
                        />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" width="100%" @click="handleSave">
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-container>
        </template>
    </application>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            loading: false,
            player: "",
            page_title: ""
        };
    },
    mounted() {
        console.log("mounted", this.$router.history.current.params);
        this.player =
            this.$router.history.current.params.item != null
                ? this.$router.history.current.params.item.player_name
                : "";
        if (this.$router.history.current.params.item != null) {
            this.player = this.$router.history.current.params.item.player_name;
            this.page_title = "Update Player";
        } else {
            this.page_title = "Add Player";
        }
    },
    methods: {
        handleSave() {
            if (this.$router.history.current.params.item != null) {
                axios
                    .put(
                        `/api/players/${
                            this.$router.history.current.params.item.id
                        }`,
                        {
                            player: this.player,
                            team_id: this.$router.history.current.params.id
                        }
                    )
                    .then(response => {
                        this.$router.push({ name: "players" });
                        this.$toast.success(response.data);
                    })
                    .catch(e => {
                        console.log(e);
                        this.$toast.error(e);
                    });
            } else {
                axios
                    .post("/api/players", {
                        player: this.player,
                        team_id: this.$router.history.current.params.id
                    })
                    .then(response => {
                        this.$router.push({ name: "players" });
                        this.$toast.success(response.data);
                    })
                    .catch(e => {
                        console.log(e);
                        this.$toast.error(e);
                    });
            }
        }
    }
};
</script>
