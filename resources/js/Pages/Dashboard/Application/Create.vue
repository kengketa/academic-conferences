<template>
    <Layout>
        <Form/>
    </Layout>
</template>

<script>
import Layout from "@/Pages/Dashboard/Layout/Layout.vue";
import Form from "@/Pages/Dashboard/Application/Form.vue";

export default {
    name: 'CreateApplication',
    components: {Layout, Form},
    props: {}
}
</script>

<style scoped>

</style>
