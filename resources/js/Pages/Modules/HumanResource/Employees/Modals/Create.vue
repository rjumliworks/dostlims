    
<template>
    <BModal v-model="showModal" style="--vz-modal-width: 1000px;" hide-footer body-class="p-0" header-class="p-0"
        class="v-modal-custom" content-class="border-0" centered hide-header-close>
        <div class="modal-body login-modal p-5">
            <h5 class="text-white fs-18 mb-1 mt-n4">Employee Form</h5>
            <p class="text-white-50 fs-12 mb-4">Please fill out the form carefully to ensure all information is accurate.</p>
            <div class="vstack gap-2 justify-content-center">
               <form class="customform mb-n5">
                    <BRow class="g-3 mb-4"> 
                        <BCol lg="12" class="mt-n2 mb-0">
                            <hr class="text-muted"/>
                        </BCol>
                        <BCol lg="12" class="mt-n1">
                            <InputLabel for="name" value="Fullname" :color="'white'" :message="form.errors.firstname"/>
                              <b-row class="g-3 mt-n3">
                                <b-col lg>
                                    <div class="input-group mb-0">
                                        <input type="text" @input="form.firstname = capitalizeWords(form.firstname)" v-model="form.firstname" placeholder="First name" class="form-control" style="width: 28%; height: 37px;">
                                        <input type="text" @input="form.middlename = capitalizeWords(form.middlename)" v-model="form.middlename" placeholder="Middle name" class="form-control" style="width: 28%; height: 37px;">
                                        <input type="text" @input="form.lastname = capitalizeWords(form.lastname)" v-model="form.lastname" placeholder="Last name" class="form-control" style="width: 28%; height: 37px;">
                                        <select v-model="form.suffix_id" class="form-select" style="width: 16%; height: 37px;">
                                             <option :value="null" selected>Select suffix</option>
                                            <option v-for="(list,index) in dropdowns.suffixes" v-bind:key="index" :value="list.value">{{list.name}}</option>
                                        </select>
                                        <!-- <input type="text" v-model="form.suffix" placeholder="Suffix" class="form-control" style="width: 25%;"> -->
                                    </div>
                                </b-col>
                            </b-row>
                        </BCol>
                        <BCol lg="3" class="mt-0">
                            <InputLabel for="name" value="Birthdate" :color="'white'" :message="form.errors.email"/>
                            <TextInput id="name" v-model="form.birthdate" type="date" class="form-control" placeholder="Please enter birthdate" @input="handleInput('birthdate')" :light="true"/>
                        </BCol>
                        <BCol lg="3" class="mt-0">
                            <InputLabel for="name" value="Username" :color="'white'" :message="form.errors.email"/>
                            <TextInput id="name" v-model="form.username" type="text" class="form-control" placeholder="Please enter username" @input="handleInput('email')" :light="true" readonly/>
                        </BCol>
                        <BCol lg="3" class="mt-0">
                            <InputLabel for="name" value="Email Address" :color="'white'" :message="form.errors.email"/>
                            <TextInput id="name" v-model="form.email" type="email" class="form-control" placeholder="Please enter email" @input="handleInput('email')" :light="true"/>
                        </BCol>
                        <BCol lg="3" class="mt-0">
                            <InputLabel for="name" value="Contact no." :color="'white'" :message="form.errors.mobile"/>
                            <TextInput id="name" v-model="form.mobile" type="text" class="form-control" placeholder="Please enter contact no." @input="handleInput('mobile')" :light="true"/>
                        </BCol>
                        <BCol lg="3" class="mt-0">
                            <InputLabel for="name" value="Sex" :color="'white'" :message="form.errors.sex_id"/>
                            <Multiselect :options="dropdowns.sexes" :searchable="true" label="name" v-model="form.sex_id" placeholder="Select Sex" @input="handleInput('sex_id')"/>
                        </BCol>
                        <BCol lg="3" class="mt-0">
                            <InputLabel for="name" value="Marital Status" :color="'white'" :message="form.errors.marital_id"/>
                            <Multiselect :options="dropdowns.maritals" :searchable="true" label="name" v-model="form.marital_id" placeholder="Select Marital Status" @input="handleInput('marital_id')"/>
                        </BCol>
                        <BCol lg="3" class="mt-0">
                            <InputLabel for="name" value="Religion" :color="'white'" :message="form.errors.religion_id"/>
                            <Multiselect :options="dropdowns.religions" :searchable="true" label="name" v-model="form.religion_id" placeholder="Select Religion" @input="handleInput('religion_id')"/>
                        </BCol>
                        <BCol lg="3" class="mt-0">
                            <InputLabel for="name" value="Blood Type" :color="'white'" :message="form.errors.blood_id"/>
                            <Multiselect :options="dropdowns.bloods" :searchable="true" label="name" v-model="form.blood_id" placeholder="Select Blood Type" @input="handleInput('blood_id')"/>
                        </BCol>
                        
                    </BRow>
               </form>
            </div>
        </div>
        
        <div class="modal-body p-5">
            <form class="customform">
                <BRow class="g-3" style="margin-top: -30px;"> 
                    <BCol lg="12" class="mt-n3 mb-n4"><hr class="text-muted"/></BCol><BCol lg="12" style="margin-top: 13px; margin-bottom: -5px;">
                        <div class="d-flex position-relative">
                            <div class="flex-shrink-0 fs-12" :class="(form.errors.status || form.errors.statusothers) ? 'text-danger' : ''" :style="(form.status == 'Others') ? 'margin-top: 6px' : ''">
                                Employment Status :
                            </div>
                            <div class="flex-grow-1 ms-2"></div>
                            <div class="flex-shrink-0">
                                <div class="d-inline-block" v-for="(list,index) in dropdowns.employment_statuses"  v-bind:key="index">
                                    <div class="custom-control custom-radio mb-3 ms-4">
                                        <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('type_id')" :value="list.value" v-model="form.type_id">
                                        <label class="custom-control-label fs-12 fw-normal" for="customRadio1">{{list.name}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </BCol>
                   <BCol lg="12" class="mt-n3 mb-n4"><hr class="text-muted"/></BCol>
                    <BCol lg="12" class="mt-3">
                        <InputLabel for="name" value="Division" :message="form.errors.division_id"/>
                        <Multiselect :options="dropdowns.divisions" :searchable="true" label="name" v-model="form.division_id" placeholder="Select Division" @input="handleInput('division_id')"/>
                    </BCol>
                    <BCol lg="6" class="mt-1">
                        <InputLabel for="name" value="Station" :message="form.errors.station_id"/>
                        <Multiselect :options="dropdowns.stations" :searchable="true" label="name" v-model="form.station_id" placeholder="Select Category" @input="handleInput('station_id')"/>
                    </BCol>
                    <BCol lg="6" class="mt-1">
                        <InputLabel for="name" value="Unit" :message="form.errors.unit_id"/>
                        <Multiselect :options="units" :searchable="true" label="name" v-model="form.unit_id" placeholder="Select Unit" @input="handleInput('unit_id')"/>
                    </BCol>
                    <BCol lg="6" class="mt-1">
                        <InputLabel for="name" value="Position" :message="form.errors.position_id"/>
                        <Multiselect :options="filteredPositions" :searchable="true" label="name" v-model="form.position_id" placeholder="Select Position" @input="handleInput('position_id')"/>
                    </BCol>
                    <BCol lg="3" class="mt-1">
                        <InputLabel for="name" value="Year Rate"/>
                        <Multiselect :options="uniqueYears" :searchable="true" label="name" v-model="form.year" placeholder="Select Year" @input="handleInput('year')"/>
                    </BCol>
                    <BCol lg="3" class="mt-1">
                        <InputLabel for="name" value="Salary Grade" :message="form.errors.salary_id"/>
                        <Multiselect :options="filteredSalaries" :searchable="true" label="name" v-model="form.salary_id" placeholder="Select Salary" @input="handleInput('salary_id')"/>
                    </BCol>
                    <BCol lg="12" class="mt-0"><hr class="text-muted"/></BCol>
                    <div class="mt-n1 ms-2 form-check">
                        <input type="checkbox" v-model="form.check" class="form-check-input" id="checkTerms">
                        <label class="form-check-label" for="checkTerms">I agree to the <span class="fw-semibold">Terms of Service</span> and Privacy Policy</label>
                    </div>
                </BRow>
             
                <div class="text-end mt-2">
                    <button @click="submit('ok')" class="btn btn-primary btn-md" type="button" :disabled="!form.check">
                        <div class="btn-content">Submit Now</div>
                    </button>
                </div>
            </form>
        </div>
    </BModal>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default { 
    layout: null,
    components: {Multiselect, InputLabel, TextInput },
    props: ['dropdowns'],
    data() {
        return {
            showModal: false,
            form: useForm({
                id: null,
                profile_id: null,
                firstname: null,
                middlename: null,
                lastname: null,
                suffix_id: null,
                username: null,
                mobile: null,
                email: null,
                birthdate: null,
                sex_id: null,
                marital_id: null,
                blood_id: null,
                religion_id: null,
                division_id: null,
                station_id: null,
                position_id: null,
                salary_id: null,
                unit_id: null,
                type_id: null,
                option: 'employee'
            }),
            editable: false,
            units: [],
            filteredPositions: []
        };
    },
    watch: {
        "form.firstname": "generateUsername",
        "form.middlename": "generateUsername",
        "form.lastname": "generateUsername",
        "form.birthdate": "generateUsername",
        "form.division_id"(newVal){
            if(!newVal){
                this.units = [];
                this.form.unit_id = null;
            }
            this.fetchUnits(newVal);
        },
        "form.position_id"(newVal){
            if(!newVal){
                this.form.salary_id = null;
            }else{
                if(this.form.type_id == 15){
                    const selectedPosition = this.dropdowns.positions.find(
                        pos => pos.value === newVal
                    );
                    console.log(selectedPosition);
                    this.form.year = selectedPosition.year;
                    this.form.salary_id = selectedPosition.salary_id;
                }
            }
        },
        "form.type_id"(newVal){
            if(!this.editable){
                this.form.year = null;
                this.form.salary_id = null;
                this.form.position_id = null;
            }
            if (newVal === 15) {
                this.filteredPositions = this.dropdowns.positions 
                .filter(p => p.is_regular === 1)     
                .map(({ value, name }) => ({ value, name }));
            } else {
                this.filteredPositions = this.dropdowns.positions
                .filter(p => p.is_regular === 0)     
                .map(({ value, name }) => ({ value, name }));
            }
        },
    },
    computed: {
        uniqueYears() {
            if (!this.form.type_id) return []; // return empty if no type_id
            const years = this.dropdowns.salaries
                .map(s => s.year);
            return [...new Set(years)].sort((a, b) => b - a);
        },
        filteredSalaries() {
            if (!this.form.type_id || !this.form.year) return [];
            return this.dropdowns.salaries
            .filter(s => {
                const matchesYear = s.year === this.form.year;
                const matchesRegular = this.form.type_id === 15
                    ? s.is_regular == 1   // loose equality in case it's a string
                    : s.is_regular != 1;
                return matchesYear && matchesRegular;
            })
            .sort((a, b) => a.grade - b.grade);
        }
    },
    methods: {
        show(){
            this.form.reset();
            this.editable = false;
            this.showModal = true;
        },
        update(data){
            this.editable = true;
            this.form.id = data.id;
            this.form.profile_id = data.profile.id;
            this.form.firstname = data.profile.firstname;
            this.form.middlename = data.profile.middlename;
            this.form.lastname = data.profile.lastname;
            this.form.suffix = data.profile.suffix;
            this.form.username = data.username;
            this.form.email = data.email;
            this.form.mobile = data.profile.mobile;
            this.form.birthdate = data.profile.birthdate;
            this.form.sex_id = data.profile.sex.id;
            this.form.blood_id = data.profile.blood.id;
            this.form.marital_id = data.profile.marital.id;
            this.form.religion_id = data.profile.religion.id;
            this.form.type_id = data.organization.type_id;
            this.form.division_id = data.organization.division.id;
            this.form.station_id = data.organization.station_id;
            this.form.unit_id = data.organization.unit_id;
            this.form.position_id = data.organization.position_id;
            this.form.year = data.organization.salary.year;
            this.form.salary_id = data.organization.salary_id;
            this.showModal = true;
        },
        submit(){
            if(!this.editable){
                this.form.post('/employees',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('success',true);
                        this.form.clearErrors();
                        this.form.reset();
                        this.hide();
                    },
                });
            }else{
                 this.form.put('/employees/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('update',this.$page.props.flash.data.data);
                        this.form.clearErrors();
                        this.form.reset();
                        this.hide();
                    },
                });
            }
        },
        generateUsername(){
            if (this.editable) return;
            const { firstname, middlename, lastname, birthdate } = this.form;
            if (!firstname || !lastname || !birthdate) {
                this.form.username = null;
                return;
            }
            const f = firstname.charAt(0).toLowerCase();
            const m = middlename ? middlename.charAt(0).toLowerCase() : '';
            const l = lastname.charAt(0).toLowerCase();
            const date = new Date(birthdate);
            if (isNaN(date)) return;
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            this.form.username = `${f}${m}${l}-${month}${day}`;
        },
        fetchUnits(code){
            axios.get('/search',{
                params: {
                    option: 'units',
                    code: code
                }
            })
            .then(response => {
                this.units = response.data;
            })
            .catch(err => console.log(err));
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
            this.showModal = false;
        },
    },
};
</script>