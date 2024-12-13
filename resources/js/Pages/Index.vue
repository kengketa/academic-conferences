<template>
    <Layout>
        <div></div>
    </Layout>
</template>

<script>
import Layout from "@/Pages/Layout/Layout.vue";
import TeachingMaterialCard from "@/Pages/Components/TeachingMaterialCard.vue";
import axios from 'axios';
import {Link} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Layout, Link},
    props: {},
    data() {
        return {};
    },
    mounted() {
    },
    methods: {},
    watch: {},
    computed: {}
};
</script>

<style scoped>
</style>
