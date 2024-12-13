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
                                   value="local"/>
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
                <div class="mb-4">
                    <label class="block text-sm font-medium">
                        เอกสารแนบ
                    </label>
                    <div class="w-full flex gap-2 mt-2">
                        <div v-if="form.documents.length > 0" class="flex gap-2">
                            <div v-for="(doc,index) in form.documents" :key="index"
                                 class="w-40 h-40 border flex flex-col pb-2 relative">
                                <div class="h-24 flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="text-xs text-center leading-4 mt-2">
                                    <p>{{ doc.name }}</p>
                                </div>
                                <button class="absolute top-1 right-1 text-red-500" type="button"
                                        @click="handleRemoveDocument(index)">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <button class="w-40 h-40 border border-dashed flex flex-col pb-2 justify-center items-center"
                                type="button" @click="$refs.documentInputRef.click()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <input ref="documentInputRef" accept=".pdf,.ppt,.pptx,.doc,.docx,.xls,.xlsx"
                               class="hidden" type="file" @change="handleSubjectDocument">
                    </div>
                </div>
            </section>
            <div class="w-full grid grid-cols-12">
                <div class="col-span-8"></div>
                <div class="col-span-4 flex flex-col items-center justify-center">
                    <SignatureModal v-model="showProposerSignaturePad" @submit="handleSubmitProposerSignature"/>
                    <img :src="form.proposer_signature" class="w-36 h-36">
                    <button class="btn btn-primary btn-sm ml-4" type="button" @click="showProposerSignaturePad=true">
                        ลงชื่อ
                    </button>
                    <p>ลงชื่อ ..................................</p>
                    <p>
                        ผู้เสนอ {{ application.proposer ? application.proposer.full_name : $page.props.user.full_name }}
                    </p>
                    <p>วันที่ {{ application.created_at }}</p>
                </div>
            </div>
            <hr class="border-2 my-4">
            <section class="space-y-4 ">
                <h2 class="text-lg font-semibold mb-3">ส่วนที่ 3 การพิจารณา</h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium">
                        3.1) ความเห็นคณบดี
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.dean_comment" class="textarea textarea-bordered w-full"
                                  placeholder="ความเห็นคณบดี"
                                  rows="6">
                        </textarea>
                    </div>
                </div>
                <div class="grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center justify-center">
                        <button class="btn btn-primary btn-sm ml-4" type="button">ลงชื่อ</button>
                        <p>ลงชื่อ ..................................</p>
                        <p>{{ application.dean ? application.dean.full_name : '...' }}</p>
                        <p>คณะบดี{{ application.department.name }}</p>
                        <p>วันที่ {{ application.dean_commented_at }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">
                        3.2) ความเห็นคณะกรรมการติดตามภาระงานวิจัยและงานวิชาการอื่นของคณาจารย์
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.chairman_comment" class="textarea textarea-bordered w-full"
                                  placeholder="ความเห็นคณะกรรมการ"
                                  rows="6">
                        </textarea>
                    </div>
                </div>
                <div class="grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center">
                        <button class="btn btn-primary btn-sm ml-4" type="button">ลงชื่อ</button>
                        <p>ลงชื่อ ..................................</p>
                        <p>ผู้ช่วยศาสตราจารย์ ดร. กมลวรรณ วรรณธนัง</p>
                        <p>ประธานคณะกรรมการติดตามภาระงานวิจัยและงานวิชาการอื่นของคณาจารย์</p>
                        <p>วันที่ {{ application.chairman_commented_at ?? '....................' }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">
                        3.3) ความเห็นอธิการบดี
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.president_comment" class="textarea textarea-bordered w-full"
                                  placeholder="ความเห็นอธิการบดี"
                                  rows="6">
                        </textarea>
                    </div>
                </div>
                <div class="grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center justify-center">
                        <button class="btn btn-primary btn-sm ml-4" type="button">ลงชื่อ</button>
                        <p>ลงชื่อ ..................................</p>
                        <p>รองศาสตราจารย์ ดร.ชูสิทธิ์ ประดับเพ็ชร์</p>
                        <p>อธิการบดี</p>
                        <p>วันที่ {{ application.president_commented_at ?? '....................' }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">
                        3.4) มติที่ประชุมคณะกรรมการพิจารณาตำแหน่งทางวิชาการ (กพว.)
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.secretary_comment" class="textarea textarea-bordered w-full"
                                  placeholder="มติที่ประชุม"
                                  rows="6">
                        </textarea>
                    </div>
                </div>
                <div class="grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center justify-center">
                        <button class="btn btn-primary btn-sm ml-4" type="button">ลงชื่อ</button>
                        <p>ลงชื่อ ..................................</p>
                        <p>ผู้ช่วยศาสตราจารย์ ดร. กมลวรรณ วรรณธนัง</p>
                        <p>เลขานุการคณะกรรมการพิจารณาตำแหน่งทางวิชาการ</p>
                        <p>วันที่ {{ application.secretary_commented_at ?? '....................' }}</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import SignatureModal from "@/Pages/Components/SignatureModal.vue";
import {router} from '@inertiajs/vue3'

export default {
    name: 'ApplicationForm',
    components: {SignatureModal},
    props: {
        application: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            showProposerSignaturePad: false,
            form: {
                _method: 'PATCH',
                name: this.application.name,
                type: this.application.type,
                number_of_seminar_done: this.application.number_of_seminar_done,
                organized_by: [],
                references: [],
                relate_majors: [],
                relate_curriculum: [],
                other_info: this.application.other_info,
                documents: [],
                to_delete_documents: [],
                proposer_signature: this.application.proposer_signature,
                dean_comment: "",
                dean_signature: "",
                chairman_comment: "",
                chairman_signature: "",
                president_comment: "",
                president_signature: "",
                secretary_comment: "",
                secretary_signature: "",
                current_status: this.application.status,
                next_status: null
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
        handleSubmitProposerSignature(image) {
            this.form.proposer_signature = image;
            this.form.next_status = 2;
            const url = this.route('dashboard.applications.update', this.application.id);
            router.post(url, this.form, {
                onSuccess: async () => {
                    const result = await this.$swal.fire({
                        title: "สำเร็จ",
                        text: "คุณได้เสนอชื่อการประชุมวิชาการเรียบร้อยแล้ว",
                        icon: "success",
                        confirmButtonText: "ตกลง"
                    });
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                }
            });
        },
        handleRemoveDocument(index) {
            if (this.form.documents[index].id !== undefined) {
                this.form.to_delete_documents.push(this.form.documents[index]);
            }
            this.form.documents.splice(index, 1);
        },
        handleSubjectDocument(event) {
            const file = event.target.files[0];
            this.form.documents.push(file);
        },
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
