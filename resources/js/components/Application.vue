<template>
    <v-app>
        <v-navigation-drawer v-model="drawer" app clipped>
            <v-list dense>
                <v-list-item to="/teams">
                    <v-list-item-action>
                        <v-icon>mdi-earth</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Teams</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item to="/settings">
                    <v-list-item-action>
                        <v-icon>mdi-settings</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Settings</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app clipped-left>
            <v-app-bar-nav-icon @click.stop="toggleDrawer" />
            <v-toolbar-title>LenderHomePage</v-toolbar-title>
        </v-app-bar>

        <v-content>
            <slot name="content"></slot>
        </v-content>

        <v-footer app>
            <span>Code Challenge</span>
        </v-footer>
    </v-app>
</template>

<script>
import { mapGetters } from "vuex";
import store from "../store";

export default {
    store,
    data: () => ({
        drawer: null
    }),
    computed: {
        ...mapGetters("settings", ["isDarkMode"])
    },
    created() {
        this.$vuetify.theme.dark = this.isDarkMode;
    },
    watch: {
        isDarkMode() {
            this.$vuetify.theme.dark = this.isDarkMode;
        }
    },
    methods: {
        toggleDrawer() {
            this.drawer = !this.drawer;
        }
    }
};
</script>
