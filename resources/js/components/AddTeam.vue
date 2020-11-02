<template>
    <application>
        <template v-slot:content>
            <v-container class="pa-4" fluid>
                <v-card :loading="loading">
                    <v-card-title>
                        Add Team
                    </v-card-title>
                    <v-card-text>
                        <v-text-field
                            v-model="team"
                            filled
                            label="Team"
                            :placeholder="''"
                            hint="Enter one team name."
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
            team: ""
        };
    },
    methods: {
        handleSave() {
            axios
                .post("/api/teams", {
                    team: this.team
                })
                .then(response => {
                    this.$router.push({ name: "teams" });
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
