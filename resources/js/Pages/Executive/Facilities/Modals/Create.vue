<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 550px;" header-class="p-3 bg-light" :title="(editable) ? 'Update Facility' : 'Add Facility'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                    <BRow class="g-3">
                        <BCol lg="9" class="mt-3">
                            <InputLabel value="Name"/>
                            <TextInput v-model="form.name" type="text" class="form-control" placeholder="Please name" @input="handleInput('name')" :light="true" />
                        </BCol>
                        <BCol lg="3" class="mt-3">
                            <InputLabel value="Short"/>
                            <TextInput v-model="form.short" type="text" class="form-control" placeholder="Please name" @input="handleInput('name')" :light="true" />
                        </BCol>
                        <BCol lg="12">
                            <BRow class="g-3 mt-n3">
                                <BCol lg="12"><hr class="text-muted mb-n3 mt-n1"/></BCol>
                                <BCol lg="8" style="margin-top: 13px; margin-bottom: -12px;" class="fs-12" :class="(form.errors.is_psto) ? 'text-danger' : ''">Is facility a PSTO?</BCol>
                                <BCol lg="4" style="margin-top: 13px; margin-bottom: -12px;">
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_psto')" :value="true" v-model="form.is_psto">
                                                <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="customRadio2" class="custom-control-input me-2" @input="handleInput('is_psto')" :value="false" v-model="form.is_psto">
                                                <label class="custom-control-label fw-normal fs-12" for="customRadio2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </BCol>
                                <BCol lg="12"><hr class="text-muted mt-n2"/></BCol>
                            </BRow>
                        </BCol>
                        <BCol lg="12" v-if="form.is_psto === false">
                            <BRow class="g-3" style="margin-top: -32px;">
                                <BCol lg="8" style="margin-top: 13px; margin-bottom: -12px;" class="fs-12" :class="(form.errors.is_separated) ? 'text-danger' : ''">Is facility separated from regional office?</BCol>
                                <BCol lg="4" style="margin-top: 13px; margin-bottom: -12px;">
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_separated')" :value="true" v-model="form.is_separated">
                                                <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="customRadio2" class="custom-control-input me-2" @input="handleInput('is_separated')" :value="false" v-model="form.is_separated">
                                                <label class="custom-control-label fw-normal fs-12" for="customRadio2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </BCol>
                                <BCol lg="12"><hr class="text-muted mt-n2"/></BCol>
                            </BRow>
                        </BCol>
                        <BCol lg="6" class="mt-0">
                            <InputLabel value="Region"/>
                            <Multiselect :options="regions" v-model="form.region_code" label="name" :searchable="true" placeholder="Select Region" />
                        </BCol>
                        <BCol lg="6" class="mt-0">
                            <InputLabel value="Province"/>
                            <Multiselect :options="provinces" v-model="form.province_code" label="name" :searchable="true" placeholder="Select Province" />
                        </BCol>
                        <BCol lg="6" class="mt-1">
                            <InputLabel value="Municipality" :message="form.errors.municipality_code"/>
                            <Multiselect :options="municipalities" v-model="form.municipality_code" label="name" :searchable="true" placeholder="Select Municipality" />
                        </BCol>
                        <BCol lg="6" class="mt-1">
                            <InputLabel value="Barangay" :message="form.errors.barangay_code"/>
                            <Multiselect :options="barangays" v-model="form.barangay_code" label="name" :searchable="true" placeholder="Select Barangay" />
                        </BCol>
                        <BCol lg="12" class="mt-1">
                            <InputLabel value="Street, Landmark, Block, Lot, Unit"/>
                            <TextInput v-model="form.address" type="text" class="form-control" placeholder="Please enter st.,road" @input="handleInput('address')" :light="true" />
                        </BCol>
                    </BRow>  
                </BCol>
                <BCol lg="12">
                    <div class="mt-2">
                        <Map @set="handleCoordinates" ref="map" class="leaflet-map"/>
                    </div>
                </BCol>
            </BRow>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing || !isFormValid" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import Map from './Map.vue';
import Multiselect from "@vueform/multiselect";
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: {InputLabel, TextInput, Multiselect, Map },
    props: ['regions'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                name: null,
                short: null,
                is_psto: null,
                is_regional: null,
                is_separated: null,
                address: null,
                region_code: null,
                province_code: null,
                municipality_code: null,
                longitude: null,
                latitude: null,
                barangay_code: null,
                option: 'facility'
            }),
            coordinates: {},
            provinces: [],
            municipalities: [],
            barangays: [],
            index: null,
            showModal: false,
            editable: false,
            selected: null,
        }
    },
    watch: {
        "form.is_psto"(newVal){
            if(newVal){
                this.form.is_regional = false;
            }else{
                this.form.is_regional = true;
            }
        },
        "form.region_code"(newVal){
            if(!newVal){
                this.form.province_code = null;
                this.form.municipality_code = null;
                this.form.barangay_code = null;
            }
            this.fetchProvince(newVal);
        },
        "form.province_code"(newVal){
            if(!newVal){
                this.form.municipality_code = null;
                this.form.barangay_code = null;
            }
            this.fetchMunicipality(newVal);
        },
        "form.municipality_code"(newVal){
            if(!newVal){
                this.form.barangay_code = null;
            }
            this.fetchBarangay(newVal);
        }
    },
    computed: {
        isFormValid() {
            return this.form.address && this.form.region_code && this.form.province_code && this.form.municipality_code && this.form.barangay_code;
        }
    },
    methods: { 
        handleCoordinates(coords) {
            this.coordinates = coords;
            this.form.longitude = this.coordinates.lng;
            this.form.latitude = this.coordinates.lat;
        },
        show(region){
            this.$refs.map.view();
            this.form.region_code = region;
            this.fetchProvince(region);
            this.showModal = true;
        },  
        submit(){
            this.form.post('/facilities',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.names = [];
                    this.$emit('message',true);
                    this.hide();
                },
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
        emptyMap(){
            this.$refs.map.empty();
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