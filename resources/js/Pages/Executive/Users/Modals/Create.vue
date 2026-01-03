<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 600px;" header-class="p-3 bg-light" :title="(!editable) ? 'Create User' : 'Edit User'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                    <div>
                        <h6 class="mb-1">General Information</h6>
                        <p class="text-muted fs-11 mt-n1">Please ensure the user's profile information is accurate and valid. </p>
                    </div>
                    <div>
                        <BRow class="g-3">
                            <BCol lg="12"><hr class="text-muted mt-n1 mb-n4"/></BCol>
                            <BCol lg="12" class="mt-2">
                                <InputLabel for="name" value="Fullname" :message="form.errors.firstname"/>
                                <b-row class="g-3 mt-n3">
                                    <b-col lg>
                                        <div class="input-group mb-0">
                                            <input type="text" @input="form.firstname = capitalizeWords(form.firstname)" v-model="form.firstname" placeholder="First name" class="form-control" style="width: 28%; height: 37px;">
                                            <input type="text" @input="form.middlename = capitalizeWords(form.middlename)" v-model="form.middlename" placeholder="Middle name" class="form-control" style="width: 28%; height: 37px;">
                                            <input type="text" @input="form.lastname = capitalizeWords(form.lastname)" v-model="form.lastname" placeholder="Last name" class="form-control" style="width: 28%; height: 37px;">
                                            <select v-model="form.suffix_id" class="form-select" style="width: 16%; height: 37px;">
                                                <option :value="null" selected>Select</option>
                                                <option v-for="(list,index) in dropdowns.suffixes" v-bind:key="index" :value="list.value">{{list.name}}</option>
                                            </select>
                                            <!-- <input type="text" v-model="form.suffix" placeholder="Suffix" class="form-control" style="width: 25%;"> -->
                                        </div>
                                    </b-col>
                                </b-row>
                            </BCol>
                            <BCol lg="6" class="mt-0">
                                <InputLabel for="email" value="Email" :message="form.errors.email"/>
                                <TextInput id="email" v-model="form.email" type="email" class="form-control" placeholder="Please enter email" @input="handleInput('email')" :light="true"/>
                            </BCol>
                            <BCol lg="6" class="mt-0">
                                <InputLabel for="mobile" value="Mobile" :message="form.errors.mobile"/>
                                <TextInput id="mobile" v-model="form.mobile" type="text" class="form-control" placeholder="Please enter mobile" @input="handleInput('mobile')" :light="true"/>
                            </BCol>
                            <BCol lg="12"><hr class="text-muted mt-0 mb-1"/></BCol>
                            <BCol lg="12">
                                <BRow class="g-3">
                                    <BCol lg="8"  style="margin-top: 13px; margin-bottom: -12px;" class="fs-12" :class="(form.errors.sex_id) ? 'text-danger' : ''">Select sex?</BCol>
                                    <BCol lg="4"  style="margin-top: 13px; margin-bottom: -12px;">
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="custom-control custom-radio mb-3">
                                                    <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('sex_id')" value="7" v-model="form.sex_id">
                                                    <label class="custom-control-label fw-normal fs-12" for="customRadio1">Male</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="custom-control custom-radio mb-3">
                                                    <input type="radio" id="customRadio2" class="custom-control-input me-2" @input="handleInput('sex_id')" value="8" v-model="form.sex_id">
                                                    <label class="custom-control-label fw-normal fs-12" for="customRadio2">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </BCol>
                                    <BCol lg="12"><hr class="text-muted mt-n2"/></BCol>
                                </BRow>
                            </BCol>
                            <BCol lg="12" class="mt-n2">
                                <InputLabel for="facility" value="Facility" :message="form.errors.facility_id"/>
                                <Multiselect @input="handleInput('facility_id')" :options="dropdowns.facilities" label="name" v-model="form.facility_id" placeholder="Select Facility" ref="multiselect3"/>
                            </BCol>
                            <BCol :lg="(has_lab || form.role_id == 9) ? 6 : 12" class="mt-1">
                                <InputLabel for="role" value="Role" :message="form.errors.role_id"/>
                                <Multiselect
                                v-model="form.role" :groups="true"
                                :options="dropdowns.roles"
                                label="name"
                                object
                                @input="handleInput('role_id')"
                                ref="multiselect2"
                                placeholder="Select Role"/>
                            </BCol>
                            <BCol lg="6" v-if="has_lab" class="mt-1">
                                <InputLabel for="laboratory_id" value="Laboratory" :message="form.errors.laboratory_id"/>
                                <Multiselect :options="dropdowns.laboratories" label="name" v-model="form.laboratory_id" placeholder="Select Laboratory" ref="multiselect3"/>
                            </BCol>
                        </BRow>
                    </div>    
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
import { times } from 'lodash';
export default {
    components: {InputLabel, TextInput, Multiselect },
    props: ['dropdowns'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                firstname: null,
                lastname: null,
                middlename: null,
                username: null,
                suffix_id: null,
                email: null,
                mobile: null,
                sex_id: null,
                profile_id: null,
                facility_id: null,
                laboratory_id: null,
                role_id: null,
                role: null,
                option: 'user'
            }),
            has_lab: false,
            showModal: false,
            editable: false
        }
    },
    watch: {
        "form.is_psto"(newVal){
            this.form.province_code = null;
            this.provinces = null;
            this.form.agency = null;
            this.form.agency_id = null;
        },
        "form.role"(newVal){
            if(newVal){
                if(newVal.has_lab){
                    this.has_lab = 1
                }else{
                    this.has_lab = 0
                }
                this.form.role_id = newVal.value;
            }else{
                this.has_lab = 0;
                this.form.role_id = null;
            }
        },
        "form.agency"(newVal){
            if(newVal){
              this.form.agency_id = newVal.value;
              this.region = newVal.region;
              this.fetchProvince(this.region);
              this.fetchFacility(newVal.value);
            }else{
                this.has_lab = 0;
                this.form.agency_id = null;
                this.form.role = null;
                this.form.role_id = null;
                this.form.province_code = null;
                this.form.laboratory_id = null;
                this.provinces = [];
            }
        }
    },
    methods: { 
        show(){
            this.showModal = true;
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
        fetchFacility(code){
            axios.get('/search',{
                params: {
                    option: 'facilities',
                    code: code
                }
            })
            .then(response => {
                this.facilities = response.data;
            })
            .catch(err => console.log(err));
        },
        edit(data){
            console.log(data);
            this.form.id = data.id;
            this.form.email = data.email;
            this.form.firstname = data.firstname;
            this.form.middlename = data.middlename;
            this.form.lastname = data.lastname;
            this.form.username = data.username;
            this.form.mobile = data.mobile;
            this.form.sex = data.sex;
            this.form.profile_id = data.profile_id;
            this.form.laboratory_id = data.assigned_laboratory_id,
            this.form.laboratory_type = data.assigned_type_id,
            this.form.role = {
                value: data.assigned_role_id.id,
                name: data.assigned_role_id.name,
                has_lab: data.assigned_role_id.has_lab
            };
            this.editable = true;
            this.showModal = true;
        },
        submit(){
            if(this.editable){
                this.form.put('/users/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        // this.$emit('update',this.$page.props.flash.data.data);
                        this.form.reset();
                        this.hide();
                    }
                });
            }else{
                this.form.post('/users',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('update',true);
                        this.hide();
                    },
                });
            }
        },
        capitalizeWords(str) {
            return str
            ? str
                .toLowerCase()
                .replace(/\b\w/g, char => char.toUpperCase())
            : '';
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.form.reset();
            this.form.clearErrors();
            this.$refs.multiselect2.clear();
            (this.has_lab) ? this.$refs.multiselect3.clear() : '';
            this.editable = false;
            this.showModal = false;
        }
    }
}
</script>