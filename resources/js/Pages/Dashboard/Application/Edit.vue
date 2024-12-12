<template>
    <Layout>
        <Form :application="application"/>
    </Layout>
</template>

<script>
import Layout from "@/Pages/Dashboard/Layout/Layout.vue";
import Form from "@/Pages/Dashboard/Application/Form.vue";

export default {
    name: 'EditApplication',
    components: {Layout, Form},
    props: {
        application: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
