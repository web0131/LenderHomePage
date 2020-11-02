import Vue from "vue";
import VueRouter from "vue-router";

/**
 * Top level route components.
 */

const Teams = () => import("./components/Teams");
const AddTeam = () => import("./components/AddTeam");
const Players = () => import("./components/Players");
const AddPlayer = () => import("./components/AddPlayer");
const Settings = () => import("./components/Settings");

/**
 * Register router with vue.
 */
Vue.use(VueRouter);

/**
 * Create vue router and register top level routes.
 */

const router = new VueRouter({
    mode: "history",

    routes: [
        {
            path: "/",
            redirect: "teams"
        },
        {
            path: "/teams",
            name: "teams",
            component: Teams
        },
        {
            path: "/teams/add",
            name: "add-team",
            component: AddTeam
        },
        {
            path: "/teams/:id",
            name: "players",
            component: Players
        },
        {
            path: "/teams/:id/add-player",
            name: "add-player",
            component: AddPlayer
        },
        {
            path: "/settings",
            name: "settings",
            component: Settings
        }
    ]
});

export default router;
