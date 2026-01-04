<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 700px;" header-class="p-3 bg-light" title="Edit Customer" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        
            <BRow v-if="selected">
                <BCol lg="12" class="mt-n1">
                    <TextInput id="address" :value="selected.customer" type="text" class="form-control" :light="true" readonly/>
                    <hr class="text-muted mt-3 mb-4"/>
                    <div class="mt-3">
                    <form class="customform">
                        <BRow>
                            <BCol lg="12">
                                <BRow class="g-3">
                                    <BCol lg="12" v-if="form.has_branches" class="mt-1 mb-n1">
                                        <InputLabel for="name" value="Branch" :message="errors.name"/>
                                        <TextInput id="name" v-model="form.name" type="text" class="form-control" placeholder="Please enter name" @input="handleInput('name')" :light="true"/>
                                    </BCol>
                                    <BCol lg="6" class="mt-1 mb-n1">
                                        <InputLabel for="email" value="Email" :message="errors.email"/>
                                        <TextInput id="email" v-model="form.email" type="email" class="form-control" placeholder="Please enter email" @input="handleInput('email')" :light="true"/>
                                    </BCol>
                                    <BCol lg="6" class="mt-1 mb-n1">
                                        <InputLabel for="contact_no" value="Contact" :message="errors.contact_no"/>
                                        <TextInput id="contact_no" v-model="form.contact_no" type="text" class="form-control" placeholder="Please enter contact" @input="handleInput('contact_no')" :light="true"/>
                                    </BCol>
                                    <BCol :lg="(form.classification_id == 9) ? 3 : 6" class="mt-1 mb-1">
                                        <InputLabel for="classification_id" value="Classification" :message="errors.classification_id"/>
                                        <Multiselect :options="dropdowns.classes" v-model="form.classification_id" label="name" placeholder="Select Classification" @input="handleInput('classification_id')" :light="true"/>
                                    </BCol>
                                    <BCol lg="3" v-if="form.classification_id == 9" class="mt-1 mb-1">
                                        <InputLabel for="type_id" value="Type" :message="errors.type_id"/>
                                        <Multiselect :options="dropdowns.individuals" v-model="form.type_id" label="name" placeholder="Select Type" @input="handleInput('type_id')" :light="true"/>
                                    </BCol>
                                    <BCol :lg="(form.sex_id == 71) ? '3' : '6'" class="mt-1 mb-1">
                                        <InputLabel for="sex_id" value="Sex" :message="errors.sex_id"/>
                                        <Multiselect :options="dropdowns.sexs" v-model="form.sex_id" label="name" placeholder="Select Sex" @input="handleInput('sex_id')" :light="true"/>
                                    </BCol>
                                    <BCol lg="3" v-if="form.sex_id == 71" class="mt-1 mb-1">
                                        <InputLabel for="led_id" value="Type" :message="errors.led_id"/>
                                        <Multiselect :options="dropdowns.females" v-model="form.led_id" label="name" placeholder="Select type" @input="handleInput('led_id')" :light="true"/>
                                    </BCol>
                                    <BCol lg="12" class="mt-1 mb-1">
                                        <InputLabel for="industry_id" value="Industry Type" :message="errors.industry_id"/>
                                        <Multiselect :options="industries" :searchable="true" object v-model="industry" label="name" placeholder="Select Industry" @input="handleInput('industry_id')" :light="true"/>
                                    </BCol>
                                    <BCol lg="12" class="mt-1 mb-1" v-if="subs.length > 0">
                                        <InputLabel for="industry_id" value="Industry Subtype" :message="form.errors.industry_id"/>
                                        <Multiselect :options="subs" :searchable="true" label="name" v-model="form.industry_id" placeholder="Select Industry" @input="handleInput('industry_id')" />
                                    </BCol>
                                    <BCol lg="12"><hr class="text-muted mt-1 mb-2"/></BCol>
                                    <BCol lg="6" class="mt-1">
                                        <InputLabel for="region" value="Region" :message="errors.region_code"/>
                                        <Multiselect :options="dropdowns.regions" label="name" v-model="form.region_code" :message="errors.region_code" placeholder="Select Region" @input="handleInput('region_code')"/>
                                    </BCol>
                                    <BCol lg="6" class="mt-1">
                                        <InputLabel for="province" value="Province" :message="errors.province_code"/>
                                        <Multiselect :options="provinces" label="name" :searchable="true" v-model="form.province_code" placeholder="Select Province" @input="handleInput('province_code')"/>
                                    </BCol>
                                    <BCol lg="6" class="mt-1">
                                        <InputLabel for="municipality" value="Municipality" :message="errors.municipality_code"/>
                                        <Multiselect :options="municipalities" label="name" :searchable="true" v-model="form.municipality_code" placeholder="Select Municipality" @input="handleInput('municipality_code')"/>
                                    </BCol>
                                    <BCol lg="6" class="mt-1">
                                        <InputLabel for="barangay" value="Barangay" :message="errors.barangay_code"/>
                                        <Multiselect :options="barangays" label="name" :searchable="true" v-model="form.barangay_code" placeholder="Select Barangay" @input="handleInput('barangay_code')"/>
                                    </BCol>
                                    <BCol lg="12" class="mt-1">
                                        <InputLabel for="address" value="Address" :message="errors.address"/>
                                        <TextInput id="address" v-model="form.address" type="text" class="form-control" placeholder="Please enter address" @input="handleInput('address')" :light="true"/>
                                    </BCol>
                                </BRow>
                            </BCol>
                        </Brow>
                    </form>
                    </div>    
                </BCol>
            </BRow>
          <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import _ from 'lodash';
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: { InputLabel, TextInput, Multiselect },
    props: ['dropdowns','region'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                email: null,
                contact_no: null,
                classification_id: null,
                type_id: null,
                sex_id: null,
                led_id: null,
                industry_id: null,
                address: null,
                region_code: this.region,
                province_code: null,
                municipality_code: null,
                barangay_code: null,
                option: 'customer',
            }),
            errors: [],
            provinces: [],
            municipalities: [],
            barangays: [],
            industry: null,
            showModal: false,
            editable: false,
            selected: null,
            industry_type: null,
            subs: []
        }
    },
    watch: {
        'form.region_code'(){
            (this.form.region_code) ? this.fetchProvince(this.form.region_code) : '';
        },
        'form.province_code'(){
            (this.form.province_code) ? this.fetchMunicipality(this.form.province_code) : '';
        },
        'form.municipality_code'(){
            (this.form.municipality_code) ? this.fetchBarangay(this.form.municipality_code) : '';
        },
        'industry'(){
            if(this.industry){
                if(this.industry.is_alone == 1){
                    this.form.industry_id = this.industry.value;
                    this.subs = [];
                }else{
                    this.subs = this.dropdowns.industries.filter(industry => industry.industry_id == this.industry.value);
                }
            }else{
                this.subs = [];
            }
        }
    },
    computed: {
        industries() {
            return this.dropdowns.industries.filter(industry => industry.is_main == 1);
        },
    },
    methods: { 
        show(data){
            this.selected = data;
            this.form.id = data.id;
            this.form.email = data.email;
            this.form.contact_no = data.contact_no;
            this.form.classification_id = data.classification.id;
            this.form.type_id = (data.type) ? data.type.id : null,
            this.form.sex_id = (data.sex) ? data.sex.id : null,
            this.form.led_id = (data.female) ? data.female.id : null,
            this.form.province_code = data.address.province.code;
            this.form.municipality_code = data.address.municipality.code;
            this.form.barangay_code = data.address.barangay.code;
            this.form.address = data.address.address;
            this.fetchProvince(data.address.region.code);
    
            
            if(this.selected.industry.is_alone == 1){
                this.industry_type = this.industries.find(item => item.value === this.selected.industry.id);
                this.industry = this.industry_type;
                this.subs = [];         
            }else{
                this.industry_type = this.industries.find(item => item.value === this.selected.industry.industry_id);
                this.industry = this.industry_type;
                this.form.industry_id = this.selected.industry.id;
            }
            this.showModal = true;
        },
        submit(){
            this.form.put('/customers/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.$emit('update',true);
                    this.hide();
                }
            });
        },
        fetchProvince(code){
            axios.get('/search',{
                params: {
                    option: 'provinces',
                    code: code
                }
            })
            .then(response => {
                this.provinces = response.data;
            })
            .catch(err => console.log(err));
        },
        fetchMunicipality(code){
            axios.get('/search',{
                params: {
                    option: 'municipalities',
                    code: code
                }
            })
            .then(response => {
                this.municipalities = response.data;
            })
            .catch(err => console.log(err));
        },
        fetchBarangay(code){
            axios.get('/search',{
                params: {
                    option: 'barangays',
                    code: code
                }
            })
            .then(response => {
                this.barangays = response.data;
            })
            .catch(err => console.log(err));
        },
        handleInput(field) {
            this.errors[field] = false;
        },
        hide(){
            this.form.reset();
            this.form.clearErrors();
            this.editable = false;
            this.showModal = false;
        }
    }
}
</script>