import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";

const webAuth = {
    namespaced: true,
    
    state() {
        return {
            isLoggedIn: false,
            user: {}
        };
    },
    modules: {},
    mutations: mutations,
    actions: actions,
    getters: getters
};

export default webAuth;
