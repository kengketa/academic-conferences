<template>
    <Layout>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">คำนำหน้า</span>
                        </div>
                        <input v-model="form.prefix" class="input input-bordered w-full"
                               placeholder="คำนำหน้า"
                               type="text"/>
                    </label>
                    <div v-if="$page.props.errors.prefix" class="text-red-500 text-sm">
                        {{ $page.props.errors.prefix }}
                    </div>
                </div>
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">ชื่อจริง</span>
                        </div>
                        <input v-model="form.first_name" class="input input-bordered w-full"
                               placeholder="ชื่อจริง"
                               type="text"/>
                    </label>
                    <div v-if="$page.props.errors.first_name" class="text-red-500 text-sm">
                        {{ $page.props.errors.first_name }}
                    </div>
                </div>
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">นามสกุล</span>
                        </div>
                        <input v-model="form.last_name" class="input input-bordered w-full"
                               placeholder="นามสกุล"
                               type="text"/>
                    </label>
                    <div v-if="$page.props.errors.last_name" class="text-red-500 text-sm">
                        {{ $page.props.errors.last_name }}
                    </div>
                </div>
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">อีเมล</span>
                        </div>
                        <input v-model="form.email" class="input input-bordered w-full"
                               placeholder="อีเมล"
                               type="email"/>
                    </label>
                    <div v-if="$page.props.errors.email" class="text-red-500 text-sm">
                        {{ $page.props.errors.email }}
                    </div>
                </div>

                <!-- Telephone -->
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">เบอร์โทรศัพท์</span>
                        </div>
                        <input v-model="form.tel" class="input input-bordered w-full"
                               placeholder="เบอร์โทรศัพท์"
                               type="tel"/>
                    </label>
                    <div v-if="$page.props.errors.tel" class="text-red-500 text-sm">
                        {{ $page.props.errors.tel }}
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">รหัสผ่าน</span>
                        </div>
                        <input v-model="form.password" class="input input-bordered w-full"
                               placeholder="รหัสผ่าน"
                               type="password"/>
                    </label>
                    <div v-if="$page.props.errors.password" class="text-red-500 text-sm">
                        {{ $page.props.errors.password }}
                    </div>
                </div>
                <!-- Department -->
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">คณะ</span>
                        </div>
                        <select v-model="form.department_id" class="select select-bordered w-full">
                            <option value="">เลือกคณะ</option>
                            <option v-for="(department,index) in departments" :key="index" :value="department.id">
                                {{ department.name }}
                            </option>
                        </select>
                    </label>
                    <div v-if="$page.props.errors.department" class="text-red-500 text-sm">
                        {{ $page.props.errors.department }}
                    </div>
                </div>

                <!-- Major -->
                <div :class="availableMajors.length === 0 ?'hidden':'block'">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">สาขา</span>
                        </div>
                        <select v-model="form.major_id" class="select select-bordered w-full">
                            <option value="">เลือกสาขา</option>
                            <option v-for="(major,index) in availableMajors" :key="index"
                                    :value="major.id">
                                {{ major.name }}
                            </option>
                        </select>
                    </label>
                    <div v-if="$page.props.errors.major" class="text-red-500 text-sm">
                        {{ $page.props.errors.major }}
                    </div>
                </div>
                <!-- Roles (Multi-Select) -->
                <div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">สิทธ์</span>
                        </div>
                        <multiselect v-model="form.roles" :max-height="150"
                                     :multiple="true"
                                     :options="roles" :taggable="true"
                                     label="name" placeholder="Search or add a tag"
                                     tag-placeholder="Add this as new tag" track-by="id"
                                     @tag="addTag"></multiselect>
                    </label>
                    <div v-if="$page.props.errors.roles" class="text-red-500 text-sm">
                        {{ $page.props.errors.roles }}
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-end mt-4">
                <button :disabled="submitting" class="btn btn-primary uppercase" type="submit">Submit</button>
            </div>
        </form>
    </Layout>

</template>
<script>
import Layout from "@/Pages/Dashboard/Layout/Layout.vue";
import {Inertia} from "@inertiajs/inertia";
import {Link, router} from "@inertiajs/vue3";
import {useForm} from '@inertiajs/inertia-vue3';
import AnnouncementForm from "@/Pages/Dashboard/Announcement/AnnouncementForm.vue";
import Multiselect from 'vue-multiselect'

export default {
    name: "UserEdit",
    components: {Layout, Link, Multiselect},
    props: {
        user: {
            type: Object,
            required: true
        },
        roles: {
            type: Array,
            required: true
        },
        departments: {
            type: Array,
            required: true
        },
        errors: Object,
    },
    data() {
        return {
            submitting: false,
            form: {
                _method: 'patch',
                user_id: this.user.id,
                prefix: this.user.prefix ?? "",
                first_name: this.user.first_name ?? "",
                last_name: this.user.last_name ?? "",
                email: this.user.email,
                tel: this.user.tel,
                roles: this.user.roles,
                department_id: this.user.department_id ?? "",
                major_id: this.user.major_id ?? "",
                password: null
            },
        };
    },
    mounted() {
    },

    methods: {
        addTag(newTag) {

        },
        submit() {
            this.submitting = true;
            const url = this.route('dashboard.users.update', this.user.id);
            router.post(url, this.form, {
                onError: () => {
                    this.submitting = false;

                }
            });
        },
    },
    watch: {},
    computed: {
        availableMajors() {
            if (this.form.department_id === null || this.form.department_id === "") {
                return [];
            }
            const foundDepartment = this.departments.find(dep => dep.id === this.form.department_id);
            return foundDepartment.majors;
        }
    }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
