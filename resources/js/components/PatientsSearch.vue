<script setup>
import MainButton from './MainButton.vue';


</script>

<template>
    <form>
        <label for="search">Caută pacient:</label>
        <input type="text" id="search" name="search">
        <MainButton type="button">Caută</MainButton>
    </form>
</template>