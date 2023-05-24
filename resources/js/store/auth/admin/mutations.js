export default {
    login(state, payload) {
        state.isLoggedIn = true;
        state.user = payload.user;
    }, //end of logging in

    logout(state) {
        state.isLoggedIn = false;
        state.user = {};
    }, //end of logging out
};
