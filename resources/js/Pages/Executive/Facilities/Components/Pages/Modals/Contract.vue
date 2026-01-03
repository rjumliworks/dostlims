<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 1000px;" header-class="p-3 bg-light" :title="(editable) ? 'Update Contract' : 'Add Contract'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="6" class="mb-3 mt-2">
                    <InputLabel for="name" value="Start Date" :message="form.errors.start_at"/>
                    <TextInput id="name" v-model="form.start_at" type="date" class="form-control" placeholder="Please enter contact no." @input="handleInput('contact_no')" :light="true"/>
                </BCol>
                <BCol lg="6" class="mb-3 mt-2">
                    <InputLabel for="name" value="End Date" :message="form.errors.end_at"/>
                    <TextInput id="name" v-model="form.end_at" type="date" class="form-control" placeholder="Please enter contact no." @input="handleInput('contact_no')" :light="true"/>
                </BCol>
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
                    <InputLabel for="name" value="Year Rate" :message="form.errors.salary_id"/>
                    <Multiselect :options="uniqueYears" :searchable="true" label="name" v-model="form.year" placeholder="Select Year" @input="handleInput('year')"/>
                </BCol>
                <BCol lg="3" class="mt-1">
                    <InputLabel for="name" value="Salary Grade" :message="form.errors.salary_id"/>
                    <Multiselect :options="filteredSalaries" :searchable="true" label="name" v-model="form.salary_id" placeholder="Select Salary" @input="handleInput('salary_id')"/>
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
    props: ['dropdowns'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                division_id: null,
                station_id: null,
                position_id: null,
                salary_id: null,
                unit_id: null,
                type_id: null,
                option: 'contract'
            }),
            types: [
               {
                   'value': 1,
                   'name': 'Yes'
               },
               {
                   'value': 0,
                   'name': 'No'
               }
           ],
            units: [],
            filteredPositions: [],
            showModal: false,
            editable: false
        }
    },
    watch: {
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
            if (newVal === 15) {
                this.filteredPositions = this.dropdowns.positions 
                .filter(p => p.is_regular === 1)     
                .map(({ value, name }) => ({ value, name }));
            } else {
                this.filteredPositions = this.dropdowns.positions
                .filter(p => p.is_regular === 0)     
                .map(({ value, name }) => ({ value, name }));
            }
            this.form.year = null;
            this.form.salary_id = null;
            this.form.position_id = null;
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