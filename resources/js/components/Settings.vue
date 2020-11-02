<template>
    <application>
        <template v-slot:content>
            <v-container class="pa-4" fluid>
                <v-card>
                    <v-card-title>
                        Settings
                    </v-card-title>
                    <v-card-text>
                        <v-select
                            :items="items"
                            filled
                            label="Dark Mode"
                            hint="Darkens the application's user interface."
                            persistent-hint
                            @change="handleChange"
                        />
                    </v-card-text>
                </v-card>
            </v-container>
        </template>
    </application>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import store from "../store";

export default {
    store,
    data: () => ({
        items: [
            { text: "Enabled", value: true },
            { text: "Disabled", value: false }
        ]
    }),
    computed: {
        ...mapGetters("settings", ["isDarkMode"])
    },
    methods: {
        ...mapMutations("settings", ["setDarkMode"]),
        handleChange(value) {
            this.setDarkMode(value);
        }
    }
};
</script>
