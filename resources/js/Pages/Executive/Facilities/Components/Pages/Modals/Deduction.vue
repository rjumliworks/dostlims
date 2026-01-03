<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" :title="(editable) ? 'Update Deduction' : 'Add Deduction'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                    <BRow class="g-3 mt-2">
                        <BCol lg="12" class="mt-0 mb-2">
                            <InputLabel value="Deduction" :message="form.errors.deduction"/>
                            <Multiselect :options="filteredDeductions" object :searchable="true" label="name" v-model="form.deduction" placeholder="Select Deduction" @input="handleInput('deduction')"/>
                        </BCol>
                        <BCol lg="12" class="mt-n1">
                            <InputLabel value="Amount" :message="form.errors.amount"/>
                            <Amount @amount="amount" ref="testing" :readonly="false" @input="handleInput('amount')"/>
                        </BCol>
                        <BCol lg="12"><hr class="text-muted mt-n1 mb-n4"/></BCol>
                        <BCol lg="12" style="margin-top: 13px; margin-bottom: -10px;">
                            <div class="d-flex position-relative">
                                <div class="flex-shrink-0 fs-12" :class="(form.errors.is_active) ? 'text-danger' : ''">
                                    Mark as active deduction? 
                                </div>
                                <div class="flex-grow-1 ms-2"></div>
                                <div class="flex-shrink-0">
                                    <div class="d-inline-block" v-for="(list,index) in types"  v-bind:key="index">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('type_id')" :value="list.value" v-model="form.is_active">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">{{list.name}}</label>
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
import Amount from '@/Shared/Components/Forms/Amount.vue';
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: {InputLabel, TextInput, Multiselect, Amount },
    props: ['deductions','type'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                amount: null,
                is_active: null,
                deduction: null,
                deduction_id: null,
                user_id: null,
                option: 'deduction'
            }),
            types: [ {'value': 1,'name': 'Yes'},{'value': 0,'name': 'No'}],
            showModal: false,
            editable: false
        }
    },
    watch: {
        "form.deduction"(newVal){
            if(newVal){
                this.form.deduction_id = this.form.deduction.value;
            }else{
                this.form.deduction_id = null;
            }
        },
    },
    computed: {
        filteredDeductions() {
            if (this.type === 'Regular') {
            return this.deductions.filter(d => d.is_regular === 1);
            } else {
            return this.deductions.filter(d => d.is_regular === 0);
            }
        }
    },
    methods: { 
        amount(val){
            this.form.amount = val;
        },
        show(id){
            this.form.reset();
            this.form.user_id = id;
            this.showModal = true;
        },
        edit(data){
            this.form.id = data.id;
            this.form.grade = data.grade;
            this.form.upper_limit = data.upper_limit;
            this.form.lower_limit = data.lower_limit;
            this.form.is_failed = (data.is_failed) ? true : false;
            this.form.is_incomplete = (data.is_incomplete) ? true : false;
            this.form.campus_id = data.campus_id;
            this.editable = true;
            this.showModal = true;
        },
        submit(){
            if(this.editable){
                this.form.put('/employees/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('success',true);
                        this.form.reset();
                        this.hide();
                    },
                });
            }else{
                this.form.post('/employees',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$refs.testing.empty();
                        this.$emit('success',this.$page.props.flash.data);
                        this.form.reset();
                        this.hide();
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