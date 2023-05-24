export default {
    setLocale(state, payload) {
        state.locale = payload.locale;
        if (
            !document.cookie.match(/locale/) ||
            decodeURIComponent(document.cookie).match(/locale=([^;]*)/)[1] !==
                payload.locale
        ) {
            const now = new Date();
            now.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000);
            document.cookie = `locale=${
                payload.locale
            };expires=${now.toUTCString()};path=/`;
        }
    }, //end of setting locale
};
