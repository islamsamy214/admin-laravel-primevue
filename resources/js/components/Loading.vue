<template>
    <div id="loading">
        <ProgressSpinner />
    </div>
</template>

<style scoped>
#loading {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background-color: rgba(0, 0, 0, 0.5); */
    background-color: rgba(255, 255, 255, 0.5);
    z-index: 9999;
    margin: auto;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
