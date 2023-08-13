import { toRefs, reactive, computed } from "vue";

// cache the theme and darkTheme in cookies for 1 year
const themeCookie = {
    set: (theme, darkTheme) => {
        document.cookie = `islamsamy214_temp_theme=${theme};max-age=31536000;path=/`;
        document.cookie = `islamsamy214_temp_darkTheme=${darkTheme};max-age=31536000;path=/`;
    },
    get: () => {
        // return the value of the theme and darkTheme cookie
        const cookie = document.cookie
            .split(";")
            .map((cookie) => cookie.split("="))
            .reduce(
                (accumulator, [key, value]) => ({
                    ...accumulator,
                    [key.trim()]: decodeURIComponent(value),
                }),
                {}
            );
        return {
            theme: cookie.islamsamy214_temp_theme || "lara-light-indigo",
            darkTheme: cookie.islamsamy214_temp_darkTheme === "true",
        };
    },
};

const layoutConfig = reactive({
    ripple: false,
    darkTheme: false,
    inputStyle: "outlined",
    menuMode: "static",
    theme: "lara-light-indigo",
    scale: 14,
    activeMenuItem: null,
});

const layoutState = reactive({
    staticMenuDesktopInactive: false,
    overlayMenuActive: false,
    profileSidebarVisible: false,
    configSidebarVisible: false,
    staticMenuMobileActive: false,
    menuHoverActive: false,
});

export function useLayout() {
    const changeThemeSettings = (theme, darkTheme) => {
        layoutConfig.darkTheme = darkTheme;
        layoutConfig.theme = theme;
        if (
            themeCookie.get().theme !== theme ||
            themeCookie.get().darkTheme !== darkTheme
        ) {
            themeCookie.set(theme, darkTheme);
        }
    };

    const setScale = (scale) => {
        layoutConfig.scale = scale;
    };

    const setActiveMenuItem = (item) => {
        layoutConfig.activeMenuItem = item.value || item;
    };

    const onMenuToggle = () => {
        if (layoutConfig.menuMode === "overlay") {
            layoutState.overlayMenuActive = !layoutState.overlayMenuActive;
        }

        if (window.innerWidth > 991) {
            layoutState.staticMenuDesktopInactive =
                !layoutState.staticMenuDesktopInactive;
        } else {
            layoutState.staticMenuMobileActive =
                !layoutState.staticMenuMobileActive;
        }
    };

    const isSidebarActive = computed(
        () =>
            layoutState.overlayMenuActive || layoutState.staticMenuMobileActive
    );

    const isDarkTheme = computed(() => layoutConfig.darkTheme);

    return {
        layoutConfig: toRefs(layoutConfig),
        layoutState: toRefs(layoutState),
        changeThemeSettings,
        setScale,
        onMenuToggle,
        isSidebarActive,
        isDarkTheme,
        setActiveMenuItem,
    };
}
