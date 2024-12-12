<template>
    <Layout>
        <div>
            <div class="flex justify-between px-4">
                <p class="text-lg font-bold">เปลี่ยนรายละเอียดสถาบัน</p>
                <Link :href="route('index')" class="flex items-center gap-2">
                    <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <p>กลับ</p>
                </Link>
            </div>

            <div class="bg-white p-8 rounded-md shadow-lg mt-2">
                <form autocomplete="off" class="grid grid-cols-2 gap-4 mt-2" @submit.prevent="submit">
                    <div>
                        <InputLabel for="institution" value="Institution"/>
                        <input id="institution" v-model="form.institution" autocomplete="institution"
                               autofocus class="input input-bordered w-full"
                               placeholder="ชื่อหน่วยงาน"
                               required type="text"/>
                        <InputError :message="form.errors.institution" class="mt-2"/>
                    </div>
                    <div>
                        <InputLabel for="name" value="Name"/>
                        <input id="name" v-model="form.name" autocomplete="name"
                               autofocus class="input input-bordered w-full"
                               placeholder="ใส่ชื่อผู้ติดต่อ"
                               required type="text"/>
                        <InputError :message="form.errors.name" class="mt-2"/>
                    </div>

                    <div>
                        <InputLabel for="email" value="Email"/>
                        <input id="email" v-model="form.email" autocomplete="email"
                               class="input input-bordered w-full"
                               placeholder="Type here"
                               required type="email"/>
                        <InputError :message="form.errors.email" class="mt-2"/>
                    </div>
                    <div>
                        <InputLabel for="tel" value="Tel"/>
                        <input id="tel" v-model="form.tel" autocomplete="tel"
                               autofocus class="input input-bordered w-full"
                               placeholder="เบอร์โทรศัพท์"
                               required type="text"/>
                        <InputError :message="form.errors.tel" class="mt-2"/>
                    </div>

                    <div>
                        <InputLabel for="pwd" value="Password"/>
                        <input v-model="form.password"
                               autocomplete="off"
                               class="input input-bordered w-full"
                               placeholder="ปล่อยว่าง ถ้าไม่ต้องการเปลี่ยน"
                               type="text"/>
                        <InputError :message="form.errors.password" class="mt-2"/>
                    </div>
                    <div>
                        <InputLabel for="pwd_confirmation" value="Confirm Password"/>
                        <input v-model="form.password_confirmation"
                               autocomplete="off"
                               class="input input-bordered w-full"
                               placeholder="ปล่อยว่าง ถ้าไม่ต้องการเปลี่ยน"
                               type="text"/>
                        <InputError :message="form.errors.password_confirmation" class="mt-2"/>
                    </div>
                    <div class="flex w-full justify-end col-span-2">
                        <button class="btn btn-primary">SUBMIT</button>
                    </div>
                </form>
            </div>

        </div>
    </Layout>
</template>

<script>
import Layout from "@/Pages/Layout/Layout.vue";
import TeachingMaterialCard from "@/Pages/Components/TeachingMaterialCard.vue";
import axios from 'axios';
import {Link, useForm} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

export default {
    name: "Index",
    components: {InputError, PrimaryButton, Checkbox, InputLabel, Layout, Link},
    props: {},
    data() {
        return {
            form: useForm({
                name: this.$page.props.user.name,
                email: this.$page.props.user.email,
                tel: this.$page.props.user.tel,
                institution: this.$page.props.user.institution,
                password: '',
                password_confirmation: '',
            })
        };
    },
    mounted() {
    },
    methods: {
        async submit() {
            const res = await this.form.post(this.route('update_institution_profile'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.$swal({
                        position: 'center',
                        icon: 'success',
                        title: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        router.visit(this.route('index'));
                    })
                },
            });

        }
    },
    watch: {},
    computed: {}
};
</script>

<style scoped>
</style>
