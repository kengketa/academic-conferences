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
                       placeholder="Prefix" type="text"/>
                <InputError :message="form.errors.prefix" class="mt-2"/>
            </div>

            <!-- First Name Field -->
            <div class="mt-4">
                <InputLabel for="first_name" value="First Name"/>
                <input id="first_name" v-model="form.first_name" autocomplete="first_name"
                       class="input input-bordered w-full"
                       placeholder="First Name" type="text"/>
                <InputError :message="form.errors.first_name" class="mt-2"/>
            </div>

            <!-- Last Name Field -->
            <div class="mt-4">
                <InputLabel for="last_name" value="Last Name"/>
                <input id="last_name" v-model="form.last_name" autocomplete="last_name"
                       class="input input-bordered w-full"
                       placeholder="Last Name" type="text"/>
                <InputError :message="form.errors.last_name" class="mt-2"/>
            </div>

            <!-- Email Field -->
            <div class="mt-4">
                <InputLabel for="email" value="Email"/>
                <input id="email" v-model="form.email" autocomplete="email"
                       class="input input-bordered w-full"
                       placeholder="Email" type="email"/>
                <InputError :message="form.errors.email" class="mt-2"/>
            </div>

            <!-- Telephone Field -->
            <div class="mt-4">
                <InputLabel for="tel" value="Telephone"/>
                <input id="tel" v-model="form.tel" autocomplete="tel"
                       class="input input-bordered w-full"
                       placeholder="Telephone" type="tel"/>
                <InputError :message="form.errors.tel" class="mt-2"/>
            </div>

            <!-- Department Field -->
            <div class="mt-4">
                <InputLabel for="department_id" value="Department"/>
                <select id="department_id" v-model="form.department_id"
                        class="input input-bordered w-full">
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
                <select id="major_id" v-model="form.major_id" class="input input-bordered w-full">
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
                <div class="relative">
                    <input id="password" v-model="form.password" :type="showPassword ? 'text' : 'password'"
                           autocomplete="new-password"
                           class="input input-bordered w-full" placeholder="Password"/>
                    <div class="absolute top-4 right-4 text-gray-500">
                        <button v-if="!showPassword" type="button" @click="showPassword=true">
                            <svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button v-if="showPassword" type="button" @click="showPassword=false">
                            <svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                                <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>

                    </div>
                </div>
                <InputError :message="form.errors.password" class="mt-2"/>
            </div>

            <!-- confirm Password Field -->
            <div class="mt-4">
                <InputLabel for="password-confirmation" value="Confirm Password"/>
                <div class="relative">
                    <input id="password-confirmation" v-model="form.password_confirmation"
                           :type="showConfirmPassword ? 'text' : 'password'"
                           class="input input-bordered w-full" placeholder="Confirm Password"/>
                    <div class="absolute top-4 right-4 text-gray-500">
                        <button v-if="!showConfirmPassword" type="button" @click="showConfirmPassword=true">
                            <svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button v-if="showConfirmPassword" type="button" @click="showConfirmPassword=false">
                            <svg class="size-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                                <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>

                    </div>
                </div>
                <InputError :message="form.errors.password_confirmation" class="mt-2"/>
            </div>
            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms"/>
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
            showPassword: false,
            showConfirmPassword: false,
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
