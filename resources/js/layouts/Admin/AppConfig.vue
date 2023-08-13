<script setup>
import RadioButton from "primevue/radiobutton";
import Button from "primevue/button";
import InputSwitch from "primevue/inputswitch";
import Sidebar from "primevue/sidebar";

import { ref } from "vue";
import { useLayout } from "./composables/layout";

defineProps({
    simple: {
        type: Boolean,
        default: false,
    },
});
const scales = ref([12, 13, 14, 15, 16]);
const visible = ref(false);

const { changeThemeSettings, setScale, layoutConfig } = useLayout();

const onConfigButtonClick = () => {
    visible.value = !visible.value;
};
const onChangeTheme = (theme, mode) => {
    const elementId = "theme-css";
    const linkElement = document.getElementById(elementId);
    const cloneLinkElement = linkElement.cloneNode(true);
    const newThemeUrl = linkElement
        .getAttribute("href")
        .replace(layoutConfig.theme.value, theme);
    cloneLinkElement.setAttribute("id", elementId + "-clone");
    cloneLinkElement.setAttribute("href", newThemeUrl);
    cloneLinkElement.addEventListener("load", () => {
        linkElement.remove();
        cloneLinkElement.setAttribute("id", elementId);
        changeThemeSettings(theme, mode === "dark");
    });
    linkElement.parentNode.insertBefore(
        cloneLinkElement,
        linkElement.nextSibling
    );
};
const decrementScale = () => {
    setScale(layoutConfig.scale.value - 1);
    applyScale();
};
const incrementScale = () => {
    setScale(layoutConfig.scale.value + 1);
    applyScale();
};
const applyScale = () => {
    document.documentElement.style.fontSize = layoutConfig.scale.value + "px";
};

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

if (cookie.theme) {
    const mode = cookie.islamsamy214_temp_darkTheme ? "dark" : "light";
    onChangeTheme(cookie.islamsamy214_temp_theme, mode);
}
</script>

<template>
    <button
        class="layout-config-button p-link pl-2"
        type="button"
        @click="onConfigButtonClick()"
    >
        <i class="pi pi-cog"></i>
    </button>

    <Sidebar
        v-model:visible="visible"
        position="right"
        :transitionOptions="'.3s cubic-bezier(0, 0, 0.2, 1)'"
        class="layout-config-sidebar w-20rem"
    >
        <h5>Scale</h5>
        <div class="flex align-items-center">
            <Button
                icon="pi pi-minus"
                type="button"
                @click="decrementScale()"
                class="p-button-text p-button-rounded w-2rem h-2rem mr-2"
                :disabled="layoutConfig.scale.value === scales[0]"
            ></Button>
            <div class="flex gap-2 align-items-center">
                <i
                    class="pi pi-circle-fill text-300"
                    v-for="s in scales"
                    :key="s"
                    :class="{
                        'text-primary-500': s === layoutConfig.scale.value,
                    }"
                ></i>
            </div>
            <Button
                icon="pi pi-plus"
                type="button"
                pButton
                @click="incrementScale()"
                class="p-button-text p-button-rounded w-2rem h-2rem ml-2"
                :disabled="
                    layoutConfig.scale.value === scales[scales.length - 1]
                "
            ></Button>
        </div>

        <template v-if="!simple">
            <h5>Menu Type</h5>
            <div class="flex">
                <div class="field-radiobutton flex-1">
                    <RadioButton
                        name="menuMode"
                        value="static"
                        v-model="layoutConfig.menuMode.value"
                        inputId="mode1"
                    ></RadioButton>
                    <label for="mode1">Static</label>
                </div>

                <div class="field-radiobutton flex-1">
                    <RadioButton
                        name="menuMode"
                        value="overlay"
                        v-model="layoutConfig.menuMode.value"
                        inputId="mode2"
                    ></RadioButton>
                    <label for="mode2">Overlay</label>
                </div>
            </div>
        </template>

        <template v-if="!simple">
            <h5>Input Style</h5>
            <div class="flex">
                <div class="field-radiobutton flex-1">
                    <RadioButton
                        name="inputStyle"
                        value="outlined"
                        v-model="layoutConfig.inputStyle.value"
                        inputId="outlined_input"
                    ></RadioButton>
                    <label for="outlined_input">Outlined</label>
                </div>
                <div class="field-radiobutton flex-1">
                    <RadioButton
                        name="inputStyle"
                        value="filled"
                        v-model="layoutConfig.inputStyle.value"
                        inputId="filled_input"
                    ></RadioButton>
                    <label for="filled_input">Filled</label>
                </div>
            </div>

            <h5>Ripple Effect</h5>
            <InputSwitch v-model="layoutConfig.ripple.value"></InputSwitch>
        </template>

        <h5>Bootstrap</h5>
        <div class="grid">
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('bootstrap4-light-blue', 'light')"
                >
                    <!-- style with tailwindcss -->
                    <Icon
                        icon="fa-brands:bootstrap"
                        class="text-blue-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('bootstrap4-light-purple', 'light')"
                >
                    <Icon
                        icon="fa-brands:bootstrap"
                        class="text-purple-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('bootstrap4-dark-blue', 'dark')"
                >
                    <Icon
                        icon="fa-brands:bootstrap"
                        class="text-blue-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('bootstrap4-dark-purple', 'dark')"
                >
                    <Icon
                        icon="fa-brands:bootstrap"
                        class="text-purple-900"
                        width="42"
                    />
                </button>
            </div>
        </div>

        <h5>Material Design</h5>
        <div class="grid">
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('md-light-indigo', 'light')"
                >
                    <Icon
                        icon="mdi:material-design"
                        class="text-blue-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('md-light-deeppurple', 'light')"
                >
                    <Icon
                        icon="mdi:material-design"
                        class="text-purple-600"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('md-dark-indigo', 'dark')"
                >
                    <Icon
                        icon="mdi:material-design"
                        class="text-blue-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('md-dark-deeppurple', 'dark')"
                >
                    <Icon
                        icon="mdi:material-design"
                        class="text-purple-900"
                        width="42"
                    />
                </button>
            </div>
        </div>

        <h5>Material Design Compact</h5>
        <div class="grid">
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('mdc-light-indigo', 'light')"
                >
                    <Icon
                        icon="simple-icons:materialdesign"
                        class="text-indigo-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('mdc-light-deeppurple', 'light')"
                >
                    <Icon
                        icon="simple-icons:materialdesign"
                        class="text-purple-600"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('mdc-dark-indigo', 'dark')"
                >
                    <Icon
                        icon="simple-icons:materialdesign"
                        class="text-indigo-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('mdc-dark-deeppurple', 'dark')"
                >
                    <Icon
                        icon="simple-icons:materialdesign"
                        class="text-purple-900"
                        width="42"
                    />
                </button>
            </div>
        </div>

        <h5>Tailwind</h5>
        <div class="grid">
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('tailwind-light', 'light')"
                >
                    <Icon
                        icon="devicon:tailwindcss"
                        class="text-blue-400"
                        width="40"
                    />
                </button>
            </div>
        </div>

        <h5>Fluent UI</h5>
        <div class="grid">
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('fluent-light', 'light')"
                >
                    <Icon
                        icon="simple-icons:microsoft"
                        class="text-blue-400"
                        width="36"
                    />
                </button>
            </div>
        </div>

        <h5>PrimeOne Design - 2022</h5>
        <div class="grid">
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('lara-light-indigo', 'light')"
                >
                    <Icon
                        icon="prime:prime"
                        class="text-indigo-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('lara-light-blue', 'light')"
                >
                    <Icon icon="prime:prime" class="text-blue-400" width="42" />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('lara-light-purple', 'light')"
                >
                    <Icon
                        icon="prime:prime"
                        class="text-purple-600"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('lara-light-teal', 'light')"
                >
                    <Icon icon="prime:prime" class="text-teal-400" width="42" />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('lara-dark-indigo', 'dark')"
                >
                    <Icon
                        icon="simple-icons:laravel"
                        class="text-indigo-900"
                        width="36"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('lara-dark-blue', 'dark')"
                >
                    <Icon
                        icon="simple-icons:laravel"
                        class="text-blue-900"
                        width="36"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('lara-dark-purple', 'dark')"
                >
                    <Icon
                        icon="simple-icons:laravel"
                        class="text-purple-900"
                        width="36"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('lara-dark-teal', 'dark')"
                >
                    <Icon
                        icon="simple-icons:laravel"
                        class="text-teal-900"
                        width="36"
                    />
                </button>
            </div>
        </div>

        <h5>PrimeOne Design - 2021</h5>
        <div class="grid">
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('saga-blue', 'light')"
                >
                    <Icon
                        icon="simple-icons:reduxsaga"
                        class="text-blue-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('saga-green', 'light')"
                >
                    <Icon
                        icon="simple-icons:reduxsaga"
                        class="text-green-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('saga-orange', 'light')"
                >
                    <Icon
                        icon="simple-icons:reduxsaga"
                        class="text-orange-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('saga-purple', 'light')"
                >
                    <Icon
                        icon="simple-icons:reduxsaga"
                        class="text-purple-400"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('vela-blue', 'dark')"
                >
                    <Icon
                        icon="icon-park-outline:level"
                        class="text-blue-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('vela-green', 'dark')"
                >
                    <Icon
                        icon="icon-park-outline:level"
                        class="text-green-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('vela-orange', 'dark')"
                >
                    <Icon
                        icon="icon-park-outline:level"
                        class="text-orange-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('vela-purple', 'dark')"
                >
                    <Icon
                        icon="icon-park-outline:level"
                        class="text-purple-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('arya-blue', 'dark')"
                >
                    <Icon
                        icon="cryptocurrency:ary"
                        class="text-blue-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('arya-green', 'dark')"
                >
                    <Icon
                        icon="cryptocurrency:ary"
                        class="text-green-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('arya-orange', 'dark')"
                >
                    <Icon
                        icon="cryptocurrency:ary"
                        class="text-orange-900"
                        width="42"
                    />
                </button>
            </div>
            <div class="col-3">
                <button
                    class="p-link w-2rem h-2rem"
                    @click="onChangeTheme('arya-purple', 'dark')"
                >
                    <Icon
                        icon="cryptocurrency:ary"
                        class="text-purple-900"
                        width="42"
                    />
                </button>
            </div>
        </div>
    </Sidebar>
</template>

<style lang="scss" scoped></style>
