import HomePage from "./../pages/home/HomePage.vue";

const web = [
    ////////////////////////////////// web routes ////////////////////////////

    // // auth routes
    // {
    //     name: "register",
    //     path: "register",
    //     component: RegisterPage
    // },
    // {
    //     name: "login",
    //     path: "login",
    //     component: LoginPage
    // },
    {
        name: "home",
        path: "home",
        component: HomePage,
        children: web
    }
];

export default web;
