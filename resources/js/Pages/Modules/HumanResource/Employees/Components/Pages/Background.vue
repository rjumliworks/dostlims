<template>
    <div style="height: calc(100vh - 429px); overflow-y: auto; overflow-x: hidden;">
        <div class="row g-3" v-if="information">
            <div class="col-md-3">
                <div class="text-center mt-3">
                    <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                        <img :src="$page.props.user.data.avatar" class="rounded-circle img-thumbnail user-profile-image material-shadow" style="height: 10rem; width: 10rem;">
                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                            <input id="profile-img-file-input" type="file" class="profile-img-file-input" @change="previewImage"/>
                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                <span class="avatar-title rounded-circle bg-light text-body">
                                <i class="ri-camera-fill"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 mt-4">
                <div class="row g-3">
                    <!-- <div class="col-md-12">
                        <hr class="text-muted"/>
                            <p class="mt-0 mb-0 text-primary fs-12 fw-semibold">Other Information</p>
                        <hr class="text-muted mb-0"/>
                    </div> -->
                    <div class="col-md-4 col-6" style="cursor: pointer;" @click="openBackground()">
                        <div class="d-flex border border-dashed rounded p-3">
                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i class="bx bx-female"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="mb-0 fs-12">Mother :</p>
                                <h6 v-if="backgrounds.parents.mother.name" class="text-truncate fs-12 mb-0"> {{backgrounds.parents.mother.name}} </h6>
                                <h6 v-else class="text-truncat text-muted fs-12 mb-0"> Not set </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6" style="cursor: pointer;" @click="openBackground()">
                        <div class="d-flex border border-dashed rounded p-3">
                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i class="bx bx-male"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="mb-0 fs-12">Father :</p>
                                <h6 v-if="backgrounds.parents.father.name" class="text-truncate fs-12 mb-0"> {{backgrounds.parents.father.name}} </h6>
                                <h6 v-else class="text-truncat text-muted fs-12 mb-0"> Not set </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6" style="cursor: pointer;" @click="openBackground()">
                        <div class="d-flex border border-dashed rounded p-3">
                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i class="ri-user-2-fill"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="mb-0 fs-12">Spouse :</p>
                                <h6 v-if="backgrounds.spouse.name" class="text-truncate fs-12 mb-0"> {{backgrounds.spouse.name}} </h6>
                                <h6 v-else class="text-truncat text-muted fs-12 mb-0"> Not set </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <hr class="text-muted mt-0 mb-0"/>
                     </div>
                    <div class="col-md-4 col-6" v-for="(list, index) in accounts" v-bind:key="index" style="cursor: pointer;" @click="openAccount()">
                        <div class="d-flex border border-dashed rounded p-3">
                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i :class="icons[index]"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="mb-0 fs-12">{{list.name}} :</p>
                                <h6 v-if="list.number" class="text-truncate fs-12 mb-0"> {{list.number}} </h6>
                                <h6 v-else class="text-truncat text-muted fs-12 mb-0"> Not set </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <hr class="text-muted mt-0 mb-0"/>
                     </div>
                     <!-- <div class="col-md-12 mt-0">
                        <hr class="text-muted"/>
                            <p class="mt-0 mb-0 text-primary fs-12 fw-semibold">Other Information</p>
                        <hr class="text-muted mb-0"/>
                    </div> -->
                    
                    <div class="col-md-12">
                        <div class="d-flex border border-dashed rounded p-3">
                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                <div class="avatar-title bg-light rounded-circle fs-16 text-danger"><i class="ri-error-warning-fill"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="mb-0 fs-12">Incase of Emergency :</p>
                                <h6 v-if="contacts.emergency_contact.name" class="text-truncate fs-12 mb-0">Aurora Village 4th st., Guiwan, Zamboanga City, Region IX</h6>
                                <h6 v-else class="text-truncate fw-normal text-muted fs-12 mb-0">Please update it to ensure we can reach you in case of an emergency</h6>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="d-flex border border-dashed rounded p-3">
                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i class="ri-map-pin-user-fill"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="mb-0 fs-12">Home Address :</p>
                                <h6 v-if="contacts.home_address.region" class="text-truncate fs-12 mb-0">{{ contacts.home_address.street }},  {{ contacts.home_address.barangay }},  {{ contacts.home_address.municipality }},  {{ contacts.home_address.province }},  {{ contacts.home_address.region }}</h6>
                                <h6 v-else class="text-truncate fw-normal text-muted fs-12 mb-0">Permanent address not set. Please update</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex border border-dashed rounded p-3">
                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary"><i class="ri-map-pin-fill"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="mb-0 fs-12">Permanent Address :</p>
                                <h6 v-if="contacts.permanent_address.region" class="text-truncate fs-12 mb-0">{{ contacts.permanent_address.street }},  {{ contacts.permanent_address.barangay }},  {{ contacts.permanent_address.municipality }},  {{ contacts.permanent_address.province }},  {{ contacts.permanent_address.region }}</h6>
                                <h6 v-else class="text-truncate fw-normal text-muted fs-12 mb-0">Permanent address not set. Please update</h6>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <Persons :marital="marital" ref="persons"/>
    <Account ref="account"/>
</template>
<script>
import simplebar from "simplebar-vue";
import Account from './Modals/Accounts.vue';
import Persons from './Modals/Persons.vue';
export default {
    components: { simplebar, Persons, Account },
    props: ['id','dropdowns','information','marital'],
    data(){
        return {
            filter: {
                keyword: null
            },
            icons: ['ri-home-heart-fill','ri-hotel-fill','ri-sun-foggy-fill','ri-heart-2-fill','ri-hand-heart-fill','ri-bank-fill']
        }
    },
    computed: {
        accounts() {
            return JSON.parse(this.information.accounts || '[]');
        },
        backgrounds() {
            return JSON.parse(this.information.backgrounds || '{}');
        },
        contacts() {
            return JSON.parse(this.information.contacts || '{}');
        },
    },
   methods: {
        openCreate(){
            this.$refs.create.show(this.id);
        },
        openCertification(data,id,course){
            if(data.length > 0){
                
            }else{
                this.$refs.certification.show(id,course);
            }
        },
        openBackground(){
                this.$refs.persons.show(this.id,this.backgrounds);
        },
        openAccount(){
                this.$refs.account.show(this.id,this.accounts);
        }
   }
}
</script>