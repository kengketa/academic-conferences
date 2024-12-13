<template>
    <input id="signatureModal" v-model="showModal" class="modal-toggle" type="checkbox"/>
    <div class="modal" role="dialog">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-primary text-center">ลงนาม</h3>
            <div class="w-full rounded-lg h-[400px] mt-2">
                <div class='relative bg-gray-200 rounded-md'>
                    <VueSignaturePad
                        ref='signature'
                        :max-width='adjustedOptions.maxWidth'
                        :min-width='adjustedOptions.minWidth'
                        :options='{
                            penColor: adjustedOptions.penColor,
                            backgroundColor: adjustedOptions.backgroundColor,
                            }'
                        height='400px'
                        width='100%'
                    />
                    <div class='absolute flex flex-col space-y-2 top-3 right-4'>
                        <button
                            class='grid p-2 bg-white rounded-md shadow-md place-items-center'
                            type='button'
                            @click='handleUndo'
                        >
                            <svg
                                height='20'
                                viewBox='0 0 24 24'
                                width='20'
                                xmlns='http://www.w3.org/2000/svg'
                            >
                                <path
                                    d='M10 8H5V3m.291 13.357a8 8 0 1 0 .188-8.991'
                                    fill='none'
                                    stroke='#000'
                                    stroke-linecap='round'
                                    stroke-linejoin='round'
                                    stroke-width='2'
                                />
                            </svg>
                        </button>
                        <button
                            class='grid p-2 bg-white rounded-md shadow-md place-items-center'
                            type='button'
                            @click='handleClearCanvas'
                        >
                            <svg
                                height='20'
                                viewBox='0 0 14 14'
                                width='20'
                                xmlns='http://www.w3.org/2000/svg'
                            >
                                <path
                                    d='M11.5 8.5h-9l-.76 3.8a1 1 0 0 0 .21.83a1 1 0 0 0 .77.37h8.56a1.002 1.002 0 0 0 .77-.37a1.001 1.001 0 0 0 .21-.83zm0-3a1 1 0 0 1 1 1v2h-11v-2a1 1 0 0 1 1-1H4a1 1 0 0 0 1-1v-2a2 2 0 1 1 4 0v2a1 1 0 0 0 1 1zm-3 8V11'
                                    fill='none'
                                    stroke='#000'
                                    stroke-linecap='round'
                                    stroke-linejoin='round'
                                />
                            </svg>
                        </button>
                        <!--                        <button-->
                        <!--                            class='grid p-2 bg-white rounded-md shadow-md place-items-center'-->
                        <!--                            type='button'-->
                        <!--                            @click='handleSaveSignature'-->
                        <!--                        >-->
                        <!--                            <svg-->
                        <!--                                height='20'-->
                        <!--                                viewBox='0 0 24 24'-->
                        <!--                                width='20'-->
                        <!--                                xmlns='http://www.w3.org/2000/svg'-->
                        <!--                            >-->
                        <!--                                <path-->
                        <!--                                    d='M21 7v14H3V3h14zm-2 .85L16.15 5H5v14h14zM12 18q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6zM5 7.85V19V5z'-->
                        <!--                                    fill='#000'-->
                        <!--                                />-->
                        <!--                            </svg>-->
                        <!--                        </button>-->
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-end mt-2">
                <button class="btn btn-primary text-white" @click="handleSubmitSignature">ยืนยัน</button>
            </div>
        </div>
        <label class="modal-backdrop cursor-pointer" @click="handleCloseModal">Close</label>
    </div>
</template>
<script>
import {VueSignaturePad} from '@selemondev/vue3-signature-pad'

export default {
    name: 'SignatureModal',
    components: {VueSignaturePad},
    emits: ['update:modelValue', 'submit'],
    props: {
        modelValue: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            options: {
                penColor: null,
                backgroundColor: null,
                maxWidth: null,
                minWidth: null,
            },
            signature: null
        }
    },
    mounted() {
        this.signature = this.$refs.signature
        this.options.penColor = 'rgb(4, 19, 222)';
        this.options.backgroundColor = 'rgb(255, 255, 255)';
        this.options.minWidth = 2;
        this.options.maxWidth = 5;

    },
    methods: {
        handleSubmitSignature() {
            if (this.signature.isCanvasEmpty()) {
                return;
            }
            this.$emit('submit', this.signature.saveSignature());
            this.$emit('update:modelValue', false);
            this.signature.clearCanvas();
        },
        handleCloseModal() {

            this.$emit('update:modelValue', false);
            this.signature.clearCanvas();
        },
        handleUndo() {
            if (this.signature?.undo) {
                this.signature.undo()
            }
        },
        handleClearCanvas() {
            if (this.signature?.clearCanvas) {
                this.signature.clearCanvas()
            }
        },
        handleSaveSignature() {
            if (this.signature.isCanvasEmpty()) {
                return;
            }
            console.log(this.signature.saveSignature());
            // fixme emit this.signature.saveSignature()
        },
        changePenColor(color) {
            this.options.penColor = color
        }
    },
    computed: {
        showModal() {
            return this.modelValue;
        },
        adjustedOptions() {
            return this.options;
        }
    },
    watch: {
        modelValue(newValue, oldValue) {
            console.log('-----------------');
            console.log(this.modelValue);
            console.log('-----------------');
        }
    }
}
</script>
