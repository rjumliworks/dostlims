<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" :title="(editable) ? 'Update Credential' : 'Add Credential'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                    <BRow class="g-3 mt-n1">
                        <BCol lg="12"><hr class="text-muted mt-n1 mb-n3"/></BCol>
                        <BCol lg="12" style="margin-top: 13px; margin-bottom: -5px;">
                            <div class="d-flex position-relative">
                                <div class="flex-shrink-0 fs-12" :class="(form.errors.type_id) ? 'text-danger' : ''">
                                    Please select your credential type :
                                </div>
                                <div class="flex-grow-1 ms-2"></div>
                                <div class="flex-shrink-0">
                                    <div class="d-inline-block" v-for="(list,index) in types"  v-bind:key="index">
                                        <div class="custom-control custom-radio mb-3 ms-4">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('type_id')" :value="list.value" v-model="form.type_id">
                                            <label class="custom-control-label fs-12 fw-normal" for="customRadio1">{{list.name}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </BCol>
                        <BCol lg="12"><hr class="text-muted mt-n2 mb-n4"/></BCol>
                        <BCol lg="12" class="mt-1">
                            <InputLabel value="Credential" :message="form.errors.name_id"/>
                            <Multiselect :options="options" :searchable="true" label="name" v-model="form.name_id" placeholder="Select" @input="handleInput('name_id')"/>
                        </BCol>
                        <BCol lg="12" class="mt-1">
                            <InputLabel value="Issued Date" :message="form.errors.issued_at"/>
                            <TextInput v-model="form.issued_at" type="date" class="form-control" @input="handleInput('issued_at')" :light="true" />
                        </BCol>
                       
                        
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
    props: ['eligibilities','licenses','types'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                name_id: null,
                type_id: null,
                user_id: null,
                issued_at: null,
                option: 'credential'
            }),
            options: [],
            showModal: false,
            editable: false
        }
    },
    watch: {
        'form.type_id'(newVal) {
            this.options = newVal === 106 ? this.eligibilities : this.licenses;
            this.form.name_id = null;
            this.form.issued_at = null;
        }
    },
    methods: { 
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
                this.form.put('/management/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.form.reset();
                        this.hide();
                    },
                });
            }else{
                this.form.post('/employees',{
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