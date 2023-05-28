<template>
    <div class="transition ease-in-out card flex justify-content-center p-2 border border-red-500">
        <div v-for="(error, index) in errors" :key="index">
            <ul
                class="m-auto"
                v-for="(specficError, specficErrorIndex) in error"
                :key="specficErrorIndex"
            >
                <li>{{ specficError }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        errors: {
            type: Object,
            required: true,
        },
    }, //end of props
};
</script>
