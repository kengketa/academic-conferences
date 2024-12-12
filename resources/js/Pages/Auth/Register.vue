<template>
    <Head title="Register"/>

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo/>
        </template>

        <form @submit.prevent="submit">
            <!-- Prefix Field -->
            <div class="mt-4">
                <InputLabel for="prefix" value="Prefix"/>
                <input id="prefix" v-model="form.prefix" autocomplete="prefix"
                       class="input input-bordered w-full"
                       placeholder="Prefix" required type="text"/>
                <InputError :message="form.errors.prefix" class="mt-2"/>
            </div>

            <!-- First Name Field -->
            <div class="mt-4">
                <InputLabel for="first_name" value="First Name"/>
                <input id="first_name" v-model="form.first_name" autocomplete="first_name"
                       class="input input-bordered w-full"
                       placeholder="First Name" required type="text"/>
                <InputError :message="form.errors.first_name" class="mt-2"/>
            </div>

            <!-- Last Name Field -->
            <div class="mt-4">
                <InputLabel for="last_name" value="Last Name"/>
                <input id="last_name" v-model="form.last_name" autocomplete="last_name"
                       class="input input-bordered w-full"
                       placeholder="Last Name" required type="text"/>
                <InputError :message="form.errors.last_name" class="mt-2"/>
            </div>

            <!-- Email Field -->
            <div class="mt-4">
                <InputLabel for="email" value="Email"/>
                <input id="email" v-model="form.email" autocomplete="email"
                       class="input input-bordered w-full"
                       placeholder="Email" required type="email"/>
                <InputError :message="form.errors.email" class="mt-2"/>
            </div>

            <!-- Telephone Field -->
            <div class="mt-4">
                <InputLabel for="tel" value="Telephone"/>
                <input id="tel" v-model="form.tel" autocomplete="tel"
                       class="input input-bordered w-full"
                       placeholder="Telephone" required type="tel"/>
                <InputError :message="form.errors.tel" class="mt-2"/>
            </div>

            <!-- Department Field -->
            <div class="mt-4">
                <InputLabel for="department_id" value="Department"/>
                <select id="department_id" v-model="form.department_id"
                        class="input input-bordered w-full" required>
                    <option disabled selected value="">Select Department</option>
                    <option v-for="department in departments" :key="department.id" :value="department.id">
                        {{ department.name }}
                    </option>
                </select>
                <InputError :message="form.errors.department_id" class="mt-2"/>
            </div>
            <!-- Major Field -->
            <div class="mt-4">
                <InputLabel for="major_id" value="Major"/>
                <select id="major_id" v-model="form.major_id" class="input input-bordered w-full" required>
                    <option disabled selected value="">Select Major</option>
                    <option v-for="major in availableMajors" :key="major.id" :value="major.id">
                        {{ major.name }}
                    </option>
                </select>
                <InputError :message="form.errors.major_id" class="mt-2"/>
            </div>

            <!-- Password Field -->
            <div class="mt-4">
                <InputLabel for="password" value="Password"/>
                <input id="password" v-model="form.password" autocomplete="new-password"
                       class="input input-bordered w-full"
                       placeholder="Password" required type="password"/>
                <InputError :message="form.errors.password" class="mt-2"/>
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required/>
                        <div class="ms-2">
                            I agree to the <a :href="route('terms.show')"
                                              class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                              target="_blank">Terms
                            of Service</a> and <a :href="route('policy.show')"
                                                  class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                  target="_blank">Privacy
                            Policy</a>
                        </div>
                    </div>
                    <InputError :message="form.errors.terms" class="mt-2"/>
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                      class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                </Link>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ms-4">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>

<script>
import {Head, Link} from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';

export default {
    components: {
        AuthenticationCard,
        AuthenticationCardLogo,
        Checkbox,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
        Head, Link
    },
    data() {
        return {
            form: this.$inertia.form({
                prefix: "",
                first_name: "",
                last_name: "",
                email: "",
                tel: "",
                roles: [],
                department_id: "",
                major_id: "",
                password: "",
                password_confirmation: '',
                terms: false,
            }),
            departments: [],  // Replace with actual department data
        };
    },
    async mounted() {
        const res = await axios.get(this.route('api.fetch_all_departments'));
        this.departments = res.data;
    },
    methods: {
        submit() {
            this.form.post(route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        },
    },
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
