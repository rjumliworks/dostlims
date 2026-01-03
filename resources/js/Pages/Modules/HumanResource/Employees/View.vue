<template>
    <Head title="Employee Profile" />
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="w-100 p-4 pb-0" ref="box">
            <BRow>
                <BCol lg="12">
                    <BCard no-body class="mt-n4 mx-n4">
                        <div class="bg-info-subtle">
                            <BCardBody class="pb-0 px-4">
                                <BRow class="mb-3">
                                    <BCol md>
                                        <BRow class="align-items-center g-3">
                                            <BCol md="auto">
                                                <div style="height: 3.5rem; width: 3.5rem;">
                                                    <div class="avatar-title bg-white rounded-circle">
                                                        <img :src="employee.avatar" alt="" class="avatar-sm rounded-circle">
                                                    </div>
                                                </div>
                                            </BCol>
                                            <BCol md>
                                                <div class="ms-2">
                                                    <h4 class="fw-bold text-uppercase">{{ employee.profile.lastname }}, {{ employee.profile.firstname }} {{ employee.profile.middlename }}. </h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div><i class="ri-qr-code-fill align-bottom me-1"></i> {{employee.username}}</div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Status :</span> <span class="fw-medium">{{employee.organization.type.name}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Sex :</span> <span class="fw-medium">{{employee.profile.sex.name}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Birthdate :</span> <span class="fw-medium">{{employee.profile.birthdate}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Marital :</span> <span class="fw-medium">{{employee.profile.marital.name}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Religion:</span> <span class="fw-medium">{{employee.profile.religion.name}}</span></div>
                                                        <div class="vr" style="width: 1px;"></div>
                                                        <div><span class="text-muted">Blood Type:</span> <span class="fw-medium">{{employee.profile.blood.name}}</span></div>
                                                        <div class="vr"></div>
                                                    </div>
                                                </div>
                                            </BCol>
                                        </BRow>
                                    </BCol>
                                    <BCol md="auto">
                                        <div class="hstack gap-1 flex-wrap mt-3">
                                            <button @click="back()" type="button" class="btn py-0 fs-16 text-body">
                                                <i class="ri-share-line"></i>
                                            </button>
                                        </div>
                                    </BCol>
                                </BRow>
                            </BCardBody>
                        </div>
                    </BCard>
                </BCol>
                <BCol lg="3">
                    <Sidebar :employee="employee"/>
                </BCol>
                <BCol lg="9">
                    <Main :dropdowns="dropdowns" :employee="employee_data.data"/>
                </BCol>
            </BRow>
        </div>
    </div>
</template>
<script>
import Main from './Components/Main.vue';
import Sidebar from './Components/Sidebar.vue';
export default {
    components: { Main, Sidebar },
    props:['employee_data','dropdowns'],
    data(){
        return {
            currentUrl: window.location.origin,
            employee: this.employee_data.data
        }
    },
    methods: {
        back(){
            this.$inertia.visit('/employees');
        }
    }
}
</script>