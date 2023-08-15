<template>
    <nav>
        <ul class="flex space-x-6">
            <li>
                <NavLink href="/users" :active="$page.component === 'Index'">
                    Users
                </NavLink>
            </li>

            <li>
                <NavLink href="/about" :active="$page.component === 'About'">
                    About
                </NavLink>
            </li>

            <li>
                <NavLink href="/settings" :active="$page.component === 'Settings'">
                    Settings
                </NavLink>
            </li>

            <li>
                <NavLink href="/logout" method="post">
                    Logout
                </NavLink>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import NavLink from "./NavLink.vue";

</script>

<style scoped>

</style>
