export default {
    login(state, payload) {
        state.isLoggedIn = true;
        state.user = payload.user;
    }, //end of logging in

    logout(state) {
        localStorage.removeItem("adminToken");
        state.isLoggedIn = false;
        state.user = {};
    }, //end of logging out
};
