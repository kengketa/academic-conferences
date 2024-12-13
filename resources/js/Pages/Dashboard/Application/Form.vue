<template>
    <div>
        <div class="p-6 bg-white rounded-lg shadow-md w-full">

            <!-- section 1-2-->
            <div class="w-full">
                <h1 class="text-xl font-bold mb-4">แบบฟอร์มเสนอรายชื่อการประชุมวิชาการ</h1>
                <section class="mb-6 space-y-4">
                    <h2 class="text-lg font-semibold mb-3">ส่วนที่ 1 ข้อมูลพื้นฐาน</h2>
                    <div class="mb-4">
                        <label class="block text-sm font-medium" for="conference-name">1) ชื่อการประชุมวิชาการ</label>
                        <div class="w-full">
                        <textarea v-model="form.name" :disabled="form.current_status >=3"
                                  class="textarea textarea-bordered w-full" placeholder="name"
                                  rows="4"></textarea>
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium">2) เป็นการประชุมวิชาการ</p>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center">
                                <input v-model="form.type" :disabled="form.current_status >=3"
                                       class="radio radio-primary" type="radio"
                                       value="local"/>
                                <span class="ml-2">ระดับชาติ</span>
                            </label>
                            <label class="flex items-center">
                                <input v-model="form.type" :disabled="form.current_status >=3"
                                       class="radio radio-primary" type="radio"
                                       value="international"/>
                                <span class="ml-2">ระดับนานาชาติ</span>
                            </label>
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.type }}</p>
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
                                        <input v-model="form.organized_by[index]" :disabled="form.current_status >=3"
                                               class="input input-bordered w-full input-sm mt-1"
                                               placeholder=".." type="text"/>
                                        <div v-if="form.current_status <=2" class="absolute  right-2 top-2">
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
                        <div v-if="form.current_status <=2" class="flex w-full justify-end mt-2">
                            <button class="btn btn-primary btn-sm" type="button" @click="addOrganizedByField">
                                <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.organized_by }}</p>
                    </div>
                    <div class="mb-4 ">
                        <div class="flex gap-2 items-center">
                            <label class="block text-sm font-medium" for="conference-count">
                                4) จำนวนครั้งของการจัดงานประชุมวิชาการที่ผ่านมา
                            </label>
                            <input id="conference-count" v-model="form.number_of_seminar_done"
                                   :disabled="form.current_status >=3"
                                   class="input input-bordered w-20 input-sm" type="number"/>
                            <p>ครั้ง</p>
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.number_of_seminar_done }}</p>
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
                                        <input v-model="form.references[index]" :disabled="form.current_status >=3"
                                               class="input input-bordered w-full input-sm mt-1"
                                               placeholder=".." type="text"/>
                                        <div v-if="form.current_status <=2" class="absolute right-2 top-2">
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
                        <div v-if="form.current_status <=2" class="flex w-full justify-end mt-2">
                            <button class="btn btn-primary btn-sm" type="button" @click="addReferenceField">
                                <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.references }}</p>
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
                                        <input v-model="form.relate_majors[index]" :disabled="form.current_status >=3"
                                               class="input input-bordered w-full input-sm mt-1"
                                               placeholder=".." type="text"/>
                                        <div v-if="form.current_status <=2" class="absolute  right-2 top-2">
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
                        <div v-if="form.current_status <=2" class="flex w-full justify-end mt-2">
                            <button class="btn btn-primary btn-sm" type="button" @click="addRelateMajorField">
                                <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.relate_majors }}</p>
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
                                               :disabled="form.current_status >=3"
                                               class="input input-bordered w-full input-sm mt-1"
                                               placeholder=".." type="text"/>
                                        <div v-if="form.current_status <=2" class="absolute  right-2 top-2">
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
                        <div v-if="form.current_status <=2" class="flex w-full justify-end mt-2">
                            <button class="btn btn-primary btn-sm" type="button" @click="addRelateCurriculumField">
                                <svg class="size-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.relate_curriculum }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">
                            3) อื่นๆ
                        </label>
                        <div class="w-full">
                        <textarea v-model="form.other_info" :disabled="form.current_status >=3"
                                  class="textarea textarea-bordered w-full"
                                  placeholder="อื่นๆ"
                                  rows="4"></textarea>
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.other_info }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">
                            เอกสารแนบ
                        </label>
                        <div class="w-full flex gap-2 mt-2">
                            <div v-if="form.documents.length > 0" class="flex gap-2">
                                <div v-for="(doc,index) in form.documents" :key="index"
                                     class="w-40 h-40 border flex flex-col pb-2 relative">
                                    <a :href="doc.url" class="h-24 flex items-center justify-center" target="_blank">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <div class="text-xs text-center leading-4 mt-2">
                                        <p>{{ doc.name }}</p>
                                    </div>
                                    <button v-if="form.current_status <=2" class="absolute top-1 right-1 text-red-500"
                                            type="button"
                                            @click="handleRemoveDocument(index)">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                                  stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button
                                v-if="form.current_status <=2"
                                class="w-40 h-40 border border-dashed flex flex-col pb-2 justify-center items-center"
                                type="button" @click="$refs.documentInputRef.click()">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <input ref="documentInputRef" accept=".pdf,.ppt,.pptx,.doc,.docx,.xls,.xlsx"
                                   class="hidden" type="file" @change="handleSubjectDocument">
                        </div>
                        <p class="text-red-500 text-sm">{{ $page.props.errors.documents }}</p>
                    </div>
                </section>
                <div class="w-full grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center justify-center">
                        <SignatureModal v-model="showProposerSignaturePad" @submit="handleSubmitProposerSignature"/>
                        <img v-if="form.proposer_signature !== null" :src="form.proposer_signature" class="w-36 h-36">
                        <button
                            v-if="application.id === undefined || (form.current_status <=2 && $page.props.user.id === application.proposed_by) "
                            class="btn btn-primary btn-sm ml-4" type="button"
                            @click="showProposerSignaturePad=true">
                            ลงชื่อ
                        </button>
                        <p>ลงชื่อ ..................................</p>
                        <p>
                            ผู้เสนอ
                            {{ application.proposer ? application.proposer.full_name : $page.props.user.full_name }}
                        </p>
                        <p>วันที่ {{ application.created_at }}</p>
                    </div>
                </div>
            </div>
            <!--  end section 1-2-->
            <hr v-if="application.id !== undefined" class="border-2 my-4">
            <section class="space-y-4 ">
                <h2 v-if="application.id !== undefined" class="text-lg font-semibold mb-3">ส่วนที่ 3 การพิจารณา</h2>
                <div v-if="application.status >=2" class="mb-4">
                    <label class="block text-sm font-medium">
                        3.1) ความเห็นคณบดี
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.dean_comment" :disabled="form.current_status >3 || !isDean"
                                  class="textarea textarea-bordered w-full"
                                  placeholder="ความเห็นคณบดี"
                                  rows="6">
                        </textarea>
                    </div>
                    <p class="text-red-500 text-sm">{{ $page.props.errors.dean_comment }}</p>
                </div>
                <div v-if="application.status >=2" class="grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center justify-center">
                        <SignatureModal v-model="showDeanSignaturePad" @submit="handleSubmitDeanSignature"/>
                        <img v-if="form.dean_signature" :src="form.dean_signature" class="w-36 h-36">
                        <button v-if="form.current_status <=3 && isDean" class="btn btn-primary btn-sm ml-4"
                                type="button"
                                @click="showDeanSignaturePad=true">
                            ลงชื่อ
                        </button>
                        <p>ลงชื่อ ..................................</p>
                        <p>{{ application.dean ? application.dean.full_name : $page.props.user.full_name }}</p>
                        <p>คณะบดี{{ application.department.name }}</p>
                        <p>วันที่ {{ application.dean_commented_at }}</p>
                    </div>
                </div>
                <div v-if="application.status >=3" class="mb-4">
                    <label class="block text-sm font-medium">
                        3.2) ความเห็นคณะกรรมการติดตามภาระงานวิจัยและงานวิชาการอื่นของคณาจารย์
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.chairman_comment" :disabled="form.current_status >4 || !isChairman"
                                  class="textarea textarea-bordered w-full"
                                  placeholder="ความเห็นคณะกรรมการ"
                                  rows="6">
                        </textarea>
                    </div>
                    <p class="text-red-500 text-sm">{{ $page.props.errors.chairman_comment }}</p>
                </div>
                <div v-if="application.status >=3" class="grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center">
                        <SignatureModal v-model="showChairmanSignaturePad" @submit="handleSubmitChairmanSignature"/>
                        <img v-if="form.chairman_signature" :src="form.chairman_signature" class="w-36 h-36">
                        <button v-if="form.current_status <=4 && isChairman" class="btn btn-primary btn-sm ml-4"
                                type="button"
                                @click="showChairmanSignaturePad=true">
                            ลงชื่อ
                        </button>
                        <p>ลงชื่อ ..................................</p>
                        <p>ผู้ช่วยศาสตราจารย์ ดร. กมลวรรณ วรรณธนัง</p>
                        <p>ประธานคณะกรรมการติดตามภาระงานวิจัยและงานวิชาการอื่นของคณาจารย์</p>
                        <p>วันที่ {{ application.chairman_commented_at ?? '....................' }}</p>
                    </div>
                </div>
                <div v-if="application.status >=4" class="mb-4">
                    <label class="block text-sm font-medium">
                        3.3) ความเห็นอธิการบดี
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.president_comment" :disabled="form.current_status >5 || !isPresident"
                                  class="textarea textarea-bordered w-full"
                                  placeholder="ความเห็นอธิการบดี"
                                  rows="6">
                        </textarea>
                    </div>
                    <p class="text-red-500 text-sm">{{ $page.props.errors.president_comment }}</p>
                </div>
                <div v-if="application.status >=4" class="grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center justify-center">
                        <SignatureModal v-model="showPresidentSignaturePad" @submit="handleSubmitPresidentSignature"/>
                        <img v-if="form.president_signature" :src="form.president_signature" class="w-36 h-36">
                        <button v-if="form.current_status <=5 && isPresident" class="btn btn-primary btn-sm ml-4"
                                type="button"
                                @click="showPresidentSignaturePad=true">
                            ลงชื่อ
                        </button>
                        <p>ลงชื่อ ..................................</p>
                        <p>รองศาสตราจารย์ ดร.ชูสิทธิ์ ประดับเพ็ชร์</p>
                        <p>อธิการบดี</p>
                        <p>วันที่ {{ application.president_commented_at ?? '....................' }}</p>
                    </div>
                </div>
                <div v-if="application.status >=5" class="mb-4">
                    <label class="block text-sm font-medium">
                        3.4) มติที่ประชุมคณะกรรมการพิจารณาตำแหน่งทางวิชาการ (กพว.)
                    </label>
                    <div class="w-full">
                        <textarea v-model="form.secretary_comment" :disabled="!isSecretary"
                                  class="textarea textarea-bordered w-full"
                                  placeholder="มติที่ประชุม"
                                  rows="6">
                        </textarea>
                    </div>
                    <p class="text-red-500 text-sm">{{ $page.props.errors.secretary_comment }}</p>
                </div>
                <div v-if="application.status >=5" class="grid grid-cols-12">
                    <div class="col-span-8"></div>
                    <div class="col-span-4 flex flex-col items-center justify-center">
                        <SignatureModal v-model="showSecretarySignaturePad" @submit="handleSubmitSecretarySignature"/>
                        <img v-if="form.secretary_signature" :src="form.secretary_signature" class="w-36 h-36">
                        <button v-if="form.current_status <=6 && isSecretary" class="btn btn-primary btn-sm ml-4"
                                type="button"
                                @click="showSecretarySignaturePad=true">
                            ลงชื่อ
                        </button>
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
            showDeanSignaturePad: false,
            showChairmanSignaturePad: false,
            showPresidentSignaturePad: false,
            showSecretarySignaturePad: false,
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
                proposer_signature: this.application.proposer_signature ?? null,
                dean_comment: this.application.dean_comment ?? null,
                dean_signature: this.application.dean_signature ?? null,
                chairman_comment: this.application.chairman_comment ?? null,
                chairman_signature: this.application.chairman_signature ?? null,
                president_comment: this.application.president_comment ?? null,
                president_signature: this.application.president_signature ?? null,
                secretary_comment: this.application.secretary_comment ?? null,
                secretary_signature: this.application.secretary_signature ?? null,
                current_status: this.application.status === undefined ? 1 : this.application.status,
                next_status: null
            },
        };
    },
    mounted() {
        if (this.application.id !== undefined) {
            this.form.organized_by = this.application.organized_by;
            this.form.references = this.application.references;
            this.form.relate_majors = this.application.relate_majors;
            this.form.relate_curriculum = this.application.relate_curriculum;
            this.application.documents.data.forEach(doc => {
                this.form.documents.push(doc);
            })
        }
    },
    methods: {
        submit() {
            let url = null;
            let successMessage = "คุณได้เสนอชื่อการประชุมวิชาการเรียบร้อยแล้ว";
            if (this.application.id !== undefined) {
                url = this.route('dashboard.applications.update', this.application.id);
            }
            if (this.application.id === undefined) {
                this.form._method = 'POST';
                this.form.next_status = 2;
                url = this.route('dashboard.applications.store');
            }
            if (this.form.next_status === 2) {
                successMessage = "คุณได้เสนอชื่อการประชุมวิชาการเรียบร้อยแล้ว";
            }
            if (this.form.next_status === 3) {
                successMessage = "อธิการได้ลงความเห็นเรียบร้อยแล้ว";
            }
            if (this.form.next_status === 4) {
                successMessage = "ประธานคณะกรรมการได้ลงความเห็นเรียบน้อยแล้ว";
            }
            if (this.form.next_status === 5) {
                successMessage = "อธิการได้ลงความเห็นเรียบน้อยแล้ว";
            }
            if (this.form.next_status === 6) {
                successMessage = "เลขานุการคณะกรรมการได้ลงความเห็นเรียบน้อยแล้ว";
            }
            router.post(url, this.form, {
                onSuccess: async () => {
                    const result = await this.$swal.fire({
                        title: "สำเร็จ",
                        text: successMessage,
                        icon: "success",
                        confirmButtonText: "ตกลง"
                    });
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                },
                onError: () => {
                    if (this.application.id === undefined) {
                        this.form.proposer_signature = null;
                    }
                    if (this.form.next_status === 2) {
                        this.form.proposer_signature = null;
                    }
                    if (this.form.next_status === 3) {
                        this.form.dean_signature = null;
                    }
                    if (this.form.next_status === 4) {
                        this.form.chairman_signature = null;
                    }
                    if (this.form.next_status === 5) {
                        this.form.president_signature = null;
                    }
                    if (this.form.next_status === 6) {
                        this.form.secretary_signature = null;
                    }
                }
            });
        },
        handleSubmitProposerSignature(image) {
            this.form.proposer_signature = image;
            this.form.next_status = 2;
            this.submit();
        },
        handleSubmitDeanSignature(image) {
            this.form.dean_signature = image;
            this.form.next_status = 3;
            this.submit();
        },
        handleSubmitChairmanSignature(image) {
            this.form.chairman_signature = image;
            this.form.next_status = 4;
            this.submit();
        },
        handleSubmitPresidentSignature(image) {
            this.form.president_signature = image;
            this.form.next_status = 5;
            this.submit();
        },
        handleSubmitSecretarySignature(image) {
            this.form.secretary_signature = image;
            this.form.next_status = 6;
            this.submit();
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
    },
    computed: {
        isProposer() {
            if (this.isAdmin) return true;
            return this.$page.props.user.roles.some(role => role.name === 'proposer');
        },
        isDean() {
            if (this.isAdmin) return true;
            return this.$page.props.user.roles.some(role => role.name === 'dean');
        },
        isChairman() {
            if (this.isAdmin) return true;
            return this.$page.props.user.roles.some(role => role.name === 'chairman');
        },
        isPresident() {
            if (this.isAdmin) return true;
            return this.$page.props.user.roles.some(role => role.name === 'president');
        },
        isSecretary() {
            if (this.isAdmin) return true;
            return this.$page.props.user.roles.some(role => role.name === 'secretary');
        },
        isAdmin() {
            if (this.$page.props.user.roles.some(role => role.name === 'admin')) {
                return true;
            }
        }
    }
}
</script>

<style scoped>

</style>
