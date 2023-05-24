export default {
    login(state, payload) {
        state.isLoggedIn = true;
        state.user = payload;
    }, //end of logging in

    logout(state) {
        state.isLoggedIn = false;
        state.user = {};
    } //end of logging out
};
