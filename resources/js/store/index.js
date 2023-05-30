import { createStore } from "vuex";

import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";
import adminAuth from "./auth/admin/index";
import webAuth from "./auth/web/index";

const getCookie = (name) => {
    const cookieValue = document.cookie.match(
        `(^|;)\\s*${name}\\s*=\\s*([^;]+)`
    );
    return cookieValue ? cookieValue.pop() : null;
};

const store = createStore({
    namespaced: true,

    state() {
        return {
            locale: getCookie("locale") || "en",
            // quill editor
            editorOptions: {
                modules: {
                    toolbar: [
                        ["bold", "italic", "underline", "strike"], // toggled buttons
                        ["blockquote", "code-block"],
                        [{ list: "ordered" }, { list: "bullet" }],
                        [{ script: "sub" }, { script: "super" }], // superscript/subscript
                        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                        [{ direction: "rtl" }], // text direction
                        [{ header: [1, 2, 3, 4, 5, 6, false] }],
                        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                        [{ align: [] }],
                    ],
                },
                placeholder: "Enter text...",
            },
        };
    },
    modules: {
        adminAuth,
        webAuth,
    },
    mutations: mutations,
    actions: actions,
    getters: getters,
});

export default store;
