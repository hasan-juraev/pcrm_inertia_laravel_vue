<template>
    <Head>
        <title>Users</title>
        <meta
            type="description"
            content="Home page Mobius"
            head-key="description"
        >
    </Head>

    <div class="flex justify-between ml-6">
        <div class="flex items-center">
            <h1 class="text-3xl">Users</h1>
            <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-3">Users Create </Link>
        </div>
        <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg">
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">Name</th>
                            <th scope="col" class="px-6 py-4">Edit</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users.data"
                            :key="user.id"
                            class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4">{{user.name}}</td>
                            <td v-if="user.can.edit" class="whitespace-nowrap px-6 py-4">
                                <Link :href="'/users/' + user.id + '/edit'" class="text-indigo-600 hover:text-indigo-900">
                                    Edit
                                </Link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <Pagination :links="users.links" class="mt-6" />

    <div style="margin-top: 800px;">
        <Link href="/users" class="text-blue-700" preserve-scroll> Current time: {{time}}</Link>
    </div>
</template>

<script setup>
import Pagination from "../../Shared/Pagination.vue";
import {ref, watch} from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

let props = defineProps( {
    users: Object,
    filters: Object,
    can: Object,
    time: String,
});

let search = ref(props.filters.search);

watch(search, debounce( function (value) {
    console.log('triggered');
    Inertia.get('/users', {search: value},{ preserveState: true, replace: true});
    }, 500));
</script>
