<template>
    <div class="relative bg-gray-200">
        <input id="loadingModal" v-model="loadingModal" class="modal-toggle" type="checkbox"/>
        <div class="modal" role="dialog">
            <div class="modal-box">
                <h3 class="text-lg font-bold">กำลังทำงาน</h3>
                <p class="py-4 text-center">ระบบกำลัง load ไฟล์แนบทั้งหมด กรุณารอสักครู่</p>
                <div class="w-full flex justify-center">
                    <span class="loading loading-infinity loading-lg"></span>
                </div>
            </div>
        </div>
        <div ref="printComponentRef">
            <div ref="printArea" class="print-container relative shadow-md">
                <div class="form-container text-sm leading-5">
                    <h2 class="text-center font-bold text-lg">แบบฟอร์มเสนอรายชื่อการประชุมวิชาการ</h2>
                    <section class="mt-4">
                        <h3 class="font-semibold text-lg">ส่วนที่ 1 ข้อมูลพื้นฐาน</h3>
                        <p>1) ชื่องานประชุมวิชาการ</p>
                        <p>{{ application.name }}</p>
                        <p>2) เป็นการประชุมวิชาการ</p>
                        <p>{{ application.type === 'local' ? 'ระดับชาติ' : 'ระดับนานาชาติ' }}</p>
                        <p>
                            3) จัดโดยสมาคมวิชาชีพ (แบบหลักฐานข้อมูลพื้นฐานสมาคมวิชาชีพ เช่น คณะกรรมการสมาคม
                            นายกสมาคม ประวัติการก่อตั้งสมาคม และเว็บไซต์สมาคม เป็นต้น)
                        </p>
                        <ul class="pl-8">
                            <li v-for="(item,index) in application.organized_by">
                                3.{{ index + 1 }} {{ item }}
                            </li>
                        </ul>
                        <p>
                            4) จำนวนครั้งของการจัดงานประชุมวิชาการที่ผ่านมา {{ application.number_of_seminar_done }}
                            ครั้ง
                        </p>
                        <p>5) เอกสารหลักฐาน แหล่งสืบค้นข้อมูลของงานประชุมวิชาการ</p>
                        <ul class="pl-8">
                            <li v-for="(item,index) in application.references">
                                5.{{ index + 1 }} {{ item }}
                            </li>
                        </ul>
                    </section>
                    <section class="mt-4">
                        <h3 class="font-semibold text-lg">ส่วนที่ 2 เสนอพิจารณา</h3>
                        <p>
                            1) บทความจากงานประชุมวิชาการดังกล่าวข้างต้น
                            สามารถใช้ข้อกำหนดตำแหน่งทางวิชาการสาขาดังต่อไปนี้
                        </p>
                        <ul class="pl-8">
                            <li v-for="(item,index) in application.relate_majors">
                                1.{{ index + 1 }} {{ item }}
                            </li>
                        </ul>
                        <p>2) บทความจากการประชุมวิชาการดังกล่าวข้างต้น
                            สามารถใช้เป็นผลลัพธ์ทางวิชาการของอาจารย์ผู้รับผิดชอบหลักสูตร, อาจารย์ประจำของหลักสูตร</p>
                        <ul class="pl-8">
                            <li v-for="(item,index) in application.relate_curriculum">
                                2.{{ index + 1 }} {{ item }}
                            </li>
                        </ul>
                        <p class="mt-4">3) อื่น ๆ</p>
                        <p>{{ application.other_info }}</p>
                        <div class="w-full grid grid-cols-12">
                            <div class="col-span-3"></div>
                            <div class="col-span-9 flex flex-col items-center justify-center">
                                <img :src="application.proposer_signature" class="w-10 h-10">
                                <p>ลงชื่อ ..................................</p>
                                <p>ผู้เสนอ {{ application.proposer.full_name }}</p>
                                <p>วันที่ {{ application.created_at }}</p>
                            </div>
                        </div>
                    </section>
                    <section class="mt-4 print-page">
                        <h3 class="font-semibold text-xl">ส่วนที่ 3 การพิจารณา</h3>
                        <div class="break-inside-avoid">
                            <p>3.1 ความเห็นคณะบดี</p>
                            <p>{{ application.dean_comment }}</p>
                            <div class="w-full grid grid-cols-12">
                                <div class="col-span-3"></div>
                                <div class="col-span-9 flex flex-col items-center justify-center">
                                    <img :src="application.dean_signature" class="w-10 h-10">
                                    <p>ลงชื่อ ..................................</p>
                                    <p>{{ application.dean.full_name }}</p>
                                    <p>{{ application.dean.full_name }}</p>
                                    <p class="whitespace-nowrap">คณะบดี{{ application.department.name }}</p>
                                    <p>วันที่ {{ application.dean_commented_at }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="break-inside-avoid">
                            <p class="mt-4">3.2
                                ความเห็นคณะกรรมการติดตามการประเมินผลงานวิจัยและงานวิชาการอื่นของคณาจารย์</p>
                            <p>{{ application.chairman_comment }}</p>
                            <div class="w-full grid grid-cols-12">
                                <div class="col-span-3"></div>
                                <div class="col-span-9 flex flex-col items-center justify-center">
                                    <img :src="application.chairman_signature" class="w-10 h-10">
                                    <p>ลงชื่อ ..................................</p>
                                    <p class="whitespace-nowrap">(ผู้ช่วยศาสตราจารย์ ดร. กมลวรรณ วรรณธนัง)</p>
                                    <p class="whitespace-nowrap">
                                        ประธานคณะกรรมการติดตามการประเมินผลงานวิจัยและงานวิชาการอื่นของคณาจารย์</p>
                                    <p>วันที่ {{ application.chairman_commented_at }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="break-inside-avoid">
                            <p class="mt-4">3.3 ความเห็นอธิการบดี</p>
                            <p>{{ application.president_comment }}</p>
                            <div class="w-full grid grid-cols-12">
                                <div class="col-span-3"></div>
                                <div class="col-span-9 flex flex-col items-center justify-center">
                                    <img :src="application.president_signature" class="w-10 h-10">
                                    <p>ลงชื่อ ..................................</p>
                                    <p class="whitespace-nowrap">(รองศาสตราจารย์ ดร.ชูสิทธิ์ ประดับเพ็ชร์)</p>
                                    <p class="whitespace-nowrap">อธิการบดี</p>
                                    <p>วันที่ {{ application.president_commented_at }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="break-inside-avoid">
                            <p class="mt-4">3.4 มติที่ประชุมคณะกรรมการพิจารณาตำแหน่งทางวิชาการ (กพว.)</p>
                            <p>{{ application.secretary_comment }}</p>
                            <div class="w-full grid grid-cols-12">
                                <div class="col-span-3"></div>
                                <div class="col-span-9 flex flex-col items-center justify-center">
                                    <img :src="application.secretary_signature" class="w-10 h-10">
                                    <p>ลงชื่อ ..................................</p>
                                    <p class="whitespace-nowrap">(ผู้ช่วยศาสตราจารย์ ดร. กมลวรรณ วรรณธนัง)</p>
                                    <p class="whitespace-nowrap">เลขานุการคณะกรรมการพิจารณาตำแหน่งทางวิชาการ</p>
                                    <p>วันที่ {{ application.secretary_commented_at }}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="w-full print-page">
                    <div v-for="(doc,index) in  application.documents.data ">
                        <VuePdfEmbed :source="doc.url" annotation-layer text-layer @rendered="handlePdfRender"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import {nextTick} from "vue";
import {useVueToPrint} from "vue-to-print";
import SignatureModal from "@/Pages/Components/SignatureModal.vue";
import VuePdfEmbed from 'vue-pdf-embed'

// optional styles
import 'vue-pdf-embed/dist/styles/annotationLayer.css'
import 'vue-pdf-embed/dist/styles/textLayer.css'

export default {
    name: "PrintApplication",
    components: {
        SignatureModal,
        Link,
        VuePdfEmbed
    },
    props: {
        application: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            loadingModal: true,
            debounce: null,
            pdfCounter: 0
        }
    },
    mounted() {

    },
    methods: {
        handlePdfRender() {
            this.pdfCounter++;
            if (this.pdfCounter === this.application.documents.data.length) {
                this.loadingModal = false;
                this.handlePrint();
            }
        },
        handlePrint() {
            const {handlePrint} = useVueToPrint({
                content: () => this.$refs.printComponentRef,
                documentTitle: this.application.id + '-' + this.application.name,
                removeAfterPrint: true
            });
            handlePrint();
        }
    },
    computed: {}
}
</script>

<style scoped>
/* General styling for A4 print */
.print-container {
    width: 21cm; /* A4 width */
    height: auto;
    margin: auto;
    padding: 1cm;
    background-color: white;
    font-family: Arial, sans-serif;
    font-size: 14px;
}

/* Print-specific styles */
@media print {
    @page {
        size: A4;
        margin: 1cm;
    }

    .print-page {
        page-break-before: always; /* Ensure a proper break */
        margin-top: 0.5cm; /* Add space on new pages */
    }

    .no-print {
        display: none; /* Ensure no-print elements are hidden */
    }

    /* Container styles */
    .print-container {
        page-break-after: auto; /* Add page break after each A4 page */
    }

    /* Body reset for print */
    body {
        margin: 0 !important;
        padding: 0 !important;
        background-color: white !important;
    }
}
</style>
