<template>
    <h1>Hello world, {{name}}</h1>

    <h2>Frameworks</h2>
    <ul>
        <li v-for="framework of frameworks" v-text="framework"></li>
    </ul>
</template>

<script>
export default {
    name: "Welcome",
    props: {
        name: String,
        frameworks: Array,
    },
}
</script>

<style scoped>

</style>
