<template>
    <Head title="Profile" />
    <PageHeader title="Profile Information" pageTitle="User" />
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-none border">
                <div class="card-header bg-light-subtle">
                    <div class="d-flex mb-n3">
                        <div class="flex-shrink-0 me-3">
                            <div style="height:2.5rem;width:2.5rem;">
                                <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                    <i class="ri-spy-fill text-primary fs-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><span class="text-body">Request Monitoring & Alerts</span></h5>
                            <p class="text-muted text-truncate-two-lines fs-12">Highlights urgency and updates</p>
                        </div>
                        <div class="flex-shrink-0">
                            <!-- <div class="mt-1">
                                <button @click="openView()" class="btn btn-sm btn-soft-success me-1" type="button" data-original-title="View All">
                                    <i class="ri-eye-fill align-bottom"></i>
                                </button>
                                <button class="btn btn-sm btn-soft-info" type="button" data-original-title="View PDF">
                                    <i class="ri-printer-fill align-bottom"></i>
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card bg-white border-bottom shadow-none" no-body>
                  
                </div>
                <div class="card bg-white shadow-none" no-body style="height: calc(100vh - 762px)">

                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card bg-light-subtle shadow-none border">
                <div class="card-header bg-light-subtle">
                    <div class="d-flex mb-n3">
                        <div class="flex-shrink-0 me-3">
                            <div style="height:2.5rem;width:2.5rem;">
                                <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                    <i class="ri-flask-fill  text-primary fs-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><span class="text-body">List of Technical Service Requests</span></h5>
                            <p class="text-muted text-truncate-two-lines fs-12">A record of all submitted document requests, showing their status and details for easy tracking.</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="input-group mb-1">
                                <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                                <input type="text" placeholder="Search Request" class="form-control" style="width: 40%;">
                                <b-button type="button" variant="primary">
                                    <i class="ri-add-circle-fill align-bottom me-1"></i> Search
                                </b-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-white border-bottom shadow-none" no-body>
                    <div class="d-flex">
                        <div class="flex-grow-1">
                           
                        </div>
                        <div class="flex-shrink-0">
                         
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white rounded-bottom">
                    
                </div>
                <div class="card-footer">
             
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { useForm } from "@inertiajs/vue3"
import Overview from "./Pages/Overview.vue";
import Edit from "./Pages/Edit.vue";
import Security from './Pages/Security.vue';
import ActivityLog from './Pages/ActivityLog.vue';
import AuthenticationLog from "./Pages/AuthenticationLog.vue";
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    components: { PageHeader, Overview, Edit, AuthenticationLog, ActivityLog, Security },
    data() {
        return {
            currentUrl: window.location.origin,
            activeTab: 1, 
            form: useForm({
                image: null,
            }),
        };
    },
    methods: {
        show(tab){
            this.activeTab = tab;
        },
        previewImage(e) {
            var fileInput = document.querySelector(".profile-img-file-input");
            var preview = document.querySelector(".user-profile-image");
            var file = fileInput.files[0];
            this.form.image = file;
            var reader = new FileReader();

            reader.addEventListener("load", () => { 
                preview.src = reader.result;
                this.form.post('/profile', {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    onSuccess: () => '',
                });
            }, false);

            if (file) { 
                reader.readAsDataURL(file); 
            }
        },
    }
}
</script>