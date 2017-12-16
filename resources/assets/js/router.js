import VueRouter from 'vue-router';
import Task from './components/Task.vue';
import Profile from './components/Profile.vue';
import PersonalToken from './components/PersonalToken.vue';


let routes = [
    {
        path: '/',
        component: Task
    },
    {
        path: '/profile',
        component: Profile
    },
    {
        path: '/token',
        component: PersonalToken
    }
];


export default new VueRouter({
    routes
});