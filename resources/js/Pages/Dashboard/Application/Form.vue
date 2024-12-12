<template>
    <div>
        <div class="p-6 bg-white rounded-lg shadow-md w-full">
            <h1 class="text-xl font-bold mb-4">แบบฟอร์มเสนอรายชื่อการประชุมวิชาการ</h1>
            <section class="mb-6 space-y-4">
                <h2 class="text-lg font-semibold mb-3">ส่วนที่ 1 ข้อมูลพื้นฐาน</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium" for="conference-name">1) ชื่อการประชุมวิชาการ</label>
                    <div class="w-full">
                        <textarea v-model="form.name" class="textarea textarea-bordered w-full" placeholder="name"
                                  rows="4"></textarea>
                    </div>

                </div>
                <div class="mb-4">
                    <p class="text-sm font-medium">2) เป็นการประชุมวิชาการ</p>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center">
                            <input v-model="form.type" class="radio radio-primary" type="radio"
                                   value="national"/>
                            <span class="ml-2">ระดับชาติ</span>
                        </label>
                        <label class="flex items-center">
                            <input v-model="form.type" class="radio radio-primary" type="radio"
                                   value="international"/>
                            <span class="ml-2">ระดับนานาชาติ</span>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">3) จัดโดยสมาคมวิชาชีพ</label>
                    <div class="">
                        <div v-for="(item, index) in form.organized_by" :key="index" class="">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-1 w-full flex justify-end items-center text-sm">
                                    <p>3.{{ index + 1 }}</p>
                                </div>
                                <div class="col-span-11 relative">
                                    <input v-model="form.organized_by[index]"
                                           class="input input-bordered w-full input-sm mt-1"
                                           placeholder=".." type="text"/>
                                    <div class="absolute  right-2 top-2">
                                        <button class="text-red-500" type="button"
                                                @click="removeOrganizedByField(index)">
                                            <svg class="size-6" fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full justify-end mt-2">
                        <button class="btn btn-primary btn-sm" type="button" @click="addOrganizedByField">
                            <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>


                </div>
                <div class="mb-4 flex gap-2 items-center">
                    <label class="block text-sm font-medium" for="conference-count">
                        4) จำนวนครั้งของการจัดงานประชุมวิชาการที่ผ่านมา
                    </label>
                    <input id="conference-count" v-model="form.number_of_seminar_done"
                           class="input input-bordered w-20 input-sm" type="number"/>
                    <p>ครั้ง</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">5) เอกสารหลักฐาน</label>
                    <div class="">
                        <div v-for="(item, index) in form.references" :key="index" class="">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-1 w-full flex justify-end items-center text-sm">
                                    <p>5.{{ index + 1 }}</p>
                                </div>
                                <div class="col-span-11 relative">
                                    <input v-model="form.references[index]"
                                           class="input input-bordered w-full input-sm mt-1"
                                           placeholder=".." type="text"/>
                                    <div class="absolute  right-2 top-2">
                                        <button class="text-red-500" type="button"
                                                @click="removeReferenceField(index)">
                                            <svg class="size-6" fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full justify-end mt-2">
                        <button class="btn btn-primary btn-sm" type="button" @click="addReferenceField">
                            <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
            <section class="space-y-4">
                <h2 class="text-lg font-semibold mb-3">ส่วนที่ 2 เสนอพิจารณา</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium">1) บทความจากงานประชุมวิชาการดังกล่าวข้างต้น
                        สามารถใช้ขอกำหนดตำแหน่งทางวิชาการสาขาดังต่อไปนี้</label>
                    <div class="">
                        <div v-for="(item, index) in form.relate_majors" :key="index" class="">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-1 w-full flex justify-end items-center text-sm">
                                    <p>1.{{ index + 1 }}</p>
                                </div>
                                <div class="col-span-11 relative">
                                    <input v-model="form.relate_majors[index]"
                                           class="input input-bordered w-full input-sm mt-1"
                                           placeholder=".." type="text"/>
                                    <div class="absolute  right-2 top-2">
                                        <button class="text-red-500" type="button"
                                                @click="removeRelateMajorField(index)">
                                            <svg class="size-6" fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="flex w-full justify-end mt-2">
                        <button class="btn btn-primary btn-sm" type="button" @click="addRelateMajorField">
                            <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">
                        2) บทความจาการประชุมวิชาการดังกล่าวข้างต้น สามารถใช้เป็นผลงานวิชาการของอาจารย์ผู้รับผิดชอบ
                        หลักสูตร, อาจารย์ประจำของหลักสูตร
                    </label>
                    <div class="">
                        <div v-for="(item, index) in form.relate_curriculum" :key="index" class="">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-1 w-full flex justify-end items-center text-sm">
                                    <p>2.{{ index + 1 }}</p>
                                </div>
                                <div class="col-span-11 relative">
                                    <input v-model="form.relate_curriculum[index]"
                                           class="input input-bordered w-full input-sm mt-1"
                                           placeholder=".." type="text"/>
                                    <div class="absolute  right-2 top-2">
                                        <button class="text-red-500" type="button"
                                                @click="removeRelateCurriculumField(index)">
                                            <svg class="size-6" fill="none" stroke="currentColor"
                                                 stroke-width="1.5" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="flex w-full justify-end mt-2">
                        <button class="btn btn-primary btn-sm" type="button" @click="addRelateCurriculumField">
                            <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">
                        3) อื่นๆ
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.other_info" class="textarea textarea-bordered w-full"
                                  placeholder="อื่นๆ"
                                  rows="4"></textarea>
                    </div>
                </div>
            </section>
            <div class="w-full flex justify-end">
                <button class="btn btn-primary mt-6" @click="submitForm">ส่ง</button>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'ApplicationForm',
    props: {
        application: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            form: {
                name: this.application.name,
                type: this.application.type,
                number_of_seminar_done: this.application.number_of_seminar_done,
                organized_by: [],
                references: [],
                relate_majors: [],
                relate_curriculum: [],
                other_info: this.application.other_info,
            },
        };
    },
    mounted() {
        this.form.organized_by = this.application.organized_by;
        this.form.references = this.application.references;
        this.form.relate_majors = this.application.relate_majors;
        this.form.relate_curriculum = this.application.relate_curriculum;
    },
    methods: {
        removeOrganizedByField(index) {
            this.form.organized_by.splice(index, 1);
        },
        addOrganizedByField() {
            this.form.organized_by.push('กรุณากรอก')
        },
        removeReferenceField(index) {
            this.form.references.splice(index, 1);
        },
        addReferenceField() {
            this.form.references.push('กรุณากรอก')
        },
        removeRelateMajorField(index) {
            this.form.relate_majors.splice(index, 1);
        },
        addRelateMajorField() {
            this.form.relate_majors.push('กรุณากรอก')
        },
        removeRelateCurriculumField(index) {
            this.form.relate_curriculum.splice(index, 1);
        },
        addRelateCurriculumField() {
            this.form.relate_curriculum.push('กรุณากรอก')
        }
    }
}
</script>

<style scoped>

</style>
