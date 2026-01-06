<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 650px;" header-class="p-3 bg-light" title="Confirm Customer Details" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        
        <!-- <div class="alert alert-warning alert-border-left alert-dismissible fade show material-shadow fs-11 mt-3 mb-3" role="alert">
            <span class="fs-10" style="line-height: 1.2; display: inline-block;"> <strong>Security Notice :</strong> This system is restricted to authorized government personnel only. Unauthorized access is prohibited.</span>
        </div> -->
        <!-- Warning Alert -->
<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show material-shadow fs-10" role="alert">
    <i class="ri-alert-line label-icon"></i><strong>Important Reminder :</strong> - Please review and verify the customer’s <strong>name, address, email,</strong> and <strong>mobile number</strong>. 
        These details are used for sending online test reports and important notifications.
    <button type="button" class="btn-close" data-bs-dismiss=" alert" aria-label="Close"></button>
</div>

        <div class="card bg-light-subtle border-1 rounded-bottom shadow-none mb-0 p-3">
            <form class="customform">
                <div class="row g-2 mt-0 mb-1">
                    <div class="col-sm-12">
                        <div class="p-1 border border-dashed bg-white rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <div class="avatar-title rounded bg-transparent text-primary fs-20"><i class="ri-user-2-fill"></i></div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-0 fs-12">Customer Name :</p>
                                    <h5 class="mb-0 fs-12">{{summary.customer_name}} <span v-if="summary.branch_name"> - {{ summary.branch_name }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-1 border border-dashed bg-white rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <div class="avatar-title rounded bg-transparent text-primary fs-20"><i class="ri-mail-fill"></i></div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-0 fs-12">Email :</p>
                                    <h5 class="mb-0 fs-12">{{ summary.email }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-1 border border-dashed bg-white rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <div class="avatar-title rounded bg-transparent text-primary fs-20"><i class="ri-phone-fill"></i></div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-0 fs-12">Contact no. :</p>
                                    <h5 class="mb-0 fs-12">{{ summary.contact_no }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="p-1 border border-dashed bg-white rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <div class="avatar-title rounded bg-transparent text-primary fs-20"><i class="ri-map-pin-fill"></i></div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-0 fs-12">Address :</p>
                                    <h5 class="mb-0 fs-12">{{ summary.address }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- <div class="alert alert-warning alert-border-left alert-dismissible fade show material-shadow fs-11 mt-3 mb-3" role="alert">
            <span class="fs-10" style="line-height: 1.2; display: inline-block;"> <strong>Security Notice :</strong> This system is restricted to authorized government personnel only. Unauthorized access is prohibited.</span>
        </div> -->

        <div class="card bg-light-subtle border-1 rounded-bottom shadow-none mt-3 mb-0 p-3">
            <div class="row">
                <BCol lg="8" style="margin-top: 0px; margin-bottom: -12px;" class="fs-12">Is this a new Customer?</BCol>
                <BCol lg="4" style="margin-top: 0px; margin-bottom: -12px;">
                <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-radio mb-0">
                                <input type="radio" id="customRadio1" class="custom-control-input me-2" :value="true" v-model="is_new">
                                <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio mb-0">
                                <input type="radio" id="customRadio2" class="custom-control-input me-2" :value="false" v-model="is_new">
                                <label class="custom-control-label fw-normal fs-12" for="customRadio2">No</label>
                            </div>
                        </div>
                    </div>
                </BCol>
            </div>
        </div>
    
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button v-if="is_new" @click="submit('ok')" variant="primary" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import _ from 'lodash';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: { InputLabel, TextInput },
    data(){
        return {
            showModal: false,
            is_new : null,
            summary: {}
        }
    },
    methods: { 
        show(data){
            this.summary = data;
            this.is_new = null;
            this.showModal = true;
        },
        submit() {
            if (this.is_new === null) {
                return;
            }
            this.$emit('confirm', this.is_new);
        },
        hide(){
            this.showModal = false;
        }
    }
}
</script>