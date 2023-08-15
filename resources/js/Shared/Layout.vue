<template>
    <Head>
        <title>Mobius</title>
        <meta
            type="description"
            content="Information about Mobius"
            head-key="description"
        >
    </Head>

    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="font-bold text-lg">My App</h1>

                <p class="text-sm ml-4"> Welcome back, {{$page.props.auth.user.username}}</p>
            </div>
            <Nav />
        </header>
    </section>

    <section class="p-6 max-w-3xl mx-auto">
<!--        <iframe height="200px" width="100%" frameborder="no" scrolling="no" seamless src="https://player.simplecast.com/b83b0a3a-c934-480e-af5d-3007fccd57b6?dark=false"></iframe>-->
        <slot />

    </section>
</template>

<script>
import Nav from "./Nav.vue";

export default {
    name: "Layout",
    components: {Nav},
    computed : {
        username() {
            return this.$page.props.auth.user.username;
        }
    }

}
</script>

<style scoped>

</style>
