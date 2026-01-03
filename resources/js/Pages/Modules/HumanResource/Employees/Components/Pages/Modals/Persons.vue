<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 800px;" header-class="p-3 bg-light" title="Update User Background" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="mt-2">
                <BCol lg="6">
                    <div class="card bg-light-subtle shadow-none border">
                        <div class="card-header bg-light-subtle">
                            <div class="d-flex" style="margin-bottom: -20px;">
                                <div class="flex-shrink-0 me-3">
                                    <div style="height:2rem;width:2rem;">
                                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                            <i class="bx bx-female text-primary fs-24"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 mt-0">
                                    <h5 class="mb-0 fs-11"><span class="text-body">Mother Details</span></h5>
                                    <p class="text-muted text-truncate-two-lines fs-11">Basic Information of the employee</p>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-white rounded-bottom shadow-none mb-0">
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <BCol lg="12" class="mt-n2">
                                        <InputLabel value="Name" :message="form.errors.school"/>
                                        <TextInput v-model="form.background.parents.mother.name" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                    </BCol>
                                </div>
                                <div class="col-md-12">
                                    <BCol lg="12" class="mt-0">
                                        <InputLabel value="Address" :message="form.errors.school"/>
                                        <TextInput v-model="form.background.parents.mother.address" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                    </BCol>
                                </div>
                            </div>
                        </div>
                    </div>
                </BCol>
                <BCol lg="6">
                    <div class="card bg-light-subtle shadow-none border">
                        <div class="card-header bg-light-subtle">
                            <div class="d-flex" style="margin-bottom: -20px;">
                                <div class="flex-shrink-0 me-3">
                                    <div style="height:2rem;width:2rem;">
                                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                            <i class="bx bx-male text-primary fs-24"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 mt-0">
                                    <h5 class="mb-0 fs-11"><span class="text-body">Father Details</span></h5>
                                    <p class="text-muted text-truncate-two-lines fs-11">Basic Information of the employee</p>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-white rounded-bottom shadow-none mb-0">
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <BCol lg="12" class="mt-n2">
                                        <InputLabel value="Name" :message="form.errors.school"/>
                                        <TextInput v-model="form.background.parents.father.name" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                    </BCol>
                                </div>
                                <div class="col-md-12">
                                    <BCol lg="12" class="mt-0">
                                        <InputLabel value="Address" :message="form.errors.school"/>
                                        <TextInput v-model="form.background.parents.father.address" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                    </BCol>
                                </div>
                            </div>
                        </div>
                    </div>
                </BCol>
                <BCol lg="12" v-if="marital == 'Married'">
                    <div class="card bg-light-subtle shadow-none border">
                        <div class="card-header bg-light-subtle">
                            <div class="d-flex" style="margin-bottom: -20px;">
                                <div class="flex-shrink-0 me-3">
                                    <div style="height:2rem;width:2rem;">
                                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                            <i class="ri-team-fill text-primary fs-24"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 mt-0">
                                    <h5 class="mb-0 fs-11"><span class="text-body">Spouse Details</span></h5>
                                    <p class="text-muted text-truncate-two-lines fs-11">Basic Information of the employee</p>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-white rounded-bottom shadow-none mb-0">
                            <div class="row p-3">
                                <div class="col-md-12">
                                    <BCol lg="12" class="mt-n2">
                                        <InputLabel value="Name" :message="form.errors.school"/>
                                        <TextInput v-model="form.background.spouse.name" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                    </BCol>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <BCol lg="12" class="mt-0">
                                                <InputLabel value="Address" :message="form.errors.school"/>
                                                <TextInput v-model="form.background.spouse.address" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                            </BCol>
                                        </div>
                                        <div class="col-md-12">
                                            <BCol lg="12" class="mt-0">
                                                <InputLabel value="Occupation" :message="form.errors.school"/>
                                                <TextInput v-model="form.background.spouse.occupation" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                            </BCol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <BCol lg="12" class="mt-0">
                                                <InputLabel value="Contact no." :message="form.errors.school"/>
                                                <TextInput v-model="form.background.spouse.contact_no" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                            </BCol>
                                        </div>
                                        <div class="col-md-12">
                                            <BCol lg="12" class="mt-0">
                                                <InputLabel value="Company" :message="form.errors.school"/>
                                                <TextInput v-model="form.background.spouse.company" type="text" class="form-control" placeholder="Please enter school" @input="handleInput('school')" :light="true" />
                                            </BCol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: {InputLabel, TextInput },
    props: ['marital'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                background: {
                    parents: {
                        mother: { 
                            name: null,
                            address: null
                        },
                        father: { 
                            name: null,
                            address: null
                        },
                    },
                    spouse: { 
                        name: null,
                        address: null,
                        contact_no: null,
                        company: null,
                        occupation: null
                    },
                    children: []
                },
                option: 'background'
            }),
            showModal: false
        }
    },
    methods: { 
        show(id,data){
            console.log(data);
            this.form.reset();
            this.form.id = id;
            this.form.background = data;
            this.showModal = true;
        },
        submit(){
            this.form.put('/employees/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.form.reset();
                    this.hide();
                },
            });
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.showModal = false;
        }
    }
}
</script>