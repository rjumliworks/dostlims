<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" :title="(editable) ? 'Update Unit' : 'Add Unit'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                    <BRow class="g-3 mt-n1">
                        <BCol lg="12" class="mt-1">
                            <InputLabel value="Name" :message="form.errors.name"/>
                            <TextInput v-model="form.name" type="text" class="form-control" placeholder="Please enter name" @input="handleInput('name')" :light="true" />
                        </BCol>
                        
                        <BCol lg="12" class="mt-n1">
                            <InputLabel value="Subtype" :message="form.errors.subtype"/>
                            <TextInput v-model="form.subtype" type="text" class="form-control" placeholder="Please enter subtype" @input="handleInput('subtype')" :light="true" />
                        </BCol>
                        <BCol lg="12"><hr class="text-muted mt-n1 mb-n4"/></BCol>
                        <BCol lg="12" style="margin-top: 8px; margin-bottom: -10px;">
                            <div class="d-flex position-relative">
                                <div class="flex-shrink-0 fs-12" :class="(form.errors.is_regular) ? 'text-danger' : ''">
                                    Is for regular only? :
                                </div>
                                <div class="flex-grow-1 ms-2"></div>
                                <div class="flex-shrink-0">
                                    <div class="d-inline-block">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_regular')" :value="true" v-model="form.is_regular">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_regular')" :value="false" v-model="form.is_regular">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </BCol>
                        <BCol lg="12"><hr class="text-muted mt-n2 mb-n4"/></BCol>
                        <BCol lg="12" style="margin-top: 6px; margin-bottom: -10px;">
                            <div class="d-flex position-relative">
                                <div class="flex-shrink-0 fs-12" :class="(form.errors.is_contribution) ? 'text-danger' : ''">
                                    Is for contribution? :
                                </div>
                                <div class="flex-grow-1 ms-2"></div>
                                <div class="flex-shrink-0">
                                    <div class="d-inline-block">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_contribution')" :value="true" v-model="form.is_contribution">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_contribution')" :value="false" v-model="form.is_contribution">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </BCol>
                        <BCol lg="12"><hr class="text-muted mt-n2 mb-n4"/></BCol>
                        <BCol lg="12" style="margin-top: 6px; margin-bottom: -10px;">
                            <div class="d-flex position-relative">
                                <div class="flex-shrink-0 fs-12" :class="(form.errors.is_loan) ? 'text-danger' : ''">
                                    Is for loan? :
                                </div>
                                <div class="flex-grow-1 ms-2"></div>
                                <div class="flex-shrink-0">
                                    <div class="d-inline-block">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_loan')" :value="true" v-model="form.is_loan">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_loan')" :value="false" v-model="form.is_loan">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </BCol>
                        <BCol lg="12"><hr class="text-muted mt-n2 mb-n4"/></BCol>
                        <BCol lg="12" style="margin-top: 6px; margin-bottom: -10px;">
                            <div class="d-flex position-relative">
                                <div class="flex-shrink-0 fs-12" :class="(form.errors.is_enrollable) ? 'text-danger' : ''">
                                    Is for enrollable? :
                                </div>
                                <div class="flex-grow-1 ms-2"></div>
                                <div class="flex-shrink-0">
                                    <div class="d-inline-block">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_enrollable')" :value="true" v-model="form.is_enrollable">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_enrollable')" :value="false" v-model="form.is_enrollable">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </BCol>
                        <BCol lg="12"><hr class="text-muted mt-n2 mb-n4"/></BCol>
                    </BRow>
                </BCol>
            </BRow>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: {InputLabel, TextInput, Multiselect },
    props: ['divisions'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                name: null,
                subtype: null,
                is_regular: null,
                is_contribution: null,
                is_loan: null,
                is_enrollable: null,
                option: 'deduction'
            }),
            showModal: false,
            editable: false
        }
    },
    methods: { 
        show(){
            this.form.reset();
            this.editable = false;
            this.showModal = true;
        },
        edit(data){
            this.form.id = data.id;
            this.form.name = data.name;
            this.form.subtype = data.subtype;
            this.form.is_regular = (data.is_regular) ? true : false;
            this.form.is_contribution = (data.is_contribution) ? true : false;
            this.form.is_loan = (data.is_loan) ? true : false;
            this.form.is_enrollable = (data.is_enrollable) ? true : false;
            this.editable = true;
            this.showModal = true;
        },
        submit(){
            if(this.editable){
                this.form.put('/references/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.form.reset();
                        this.hide();
                    },
                });
            }else{
                this.form.post('/references',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.form.reset();
                        this.hide();
                        this.$emit('success',true);
                    },
                });
            }
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.editable = false;
            this.showModal = false;
        }
    }
}
</script>