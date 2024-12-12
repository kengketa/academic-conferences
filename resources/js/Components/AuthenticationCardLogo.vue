<script setup>
import {Link} from '@inertiajs/vue3';
</script>

<template>
    <Link :href="'/'">
        <div class="w-20 h-20 overflow-hidden rounded-full">
            <img class="object-cover w-20 h-20" src="/images/logo.jpg">
        </div>
    </Link>
</template>
