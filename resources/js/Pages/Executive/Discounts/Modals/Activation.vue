
<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Discount Activation" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <div v-if="discount">
            <div class="mt-1 mb-n3">
                <div class="avatar-md mx-auto">
                    <div class="avatar-title rounded-circle bg-light">
                        <i class="h1 mb-0" :class="(!discount.is_active) ? 'bx bxs-lock-open text-success' : 'bx bxs-lock text-danger'"></i>
                    </div>
                </div>
                <div class="p-2 mt-2 text-center">
                    <h6 class="mb-1" v-if="discount.is_active">"Deactivate discount access to the system."</h6>
                    <h6 class="mb-1" v-else>"Activate discount access to the system."</h6>
                    <p v-if="discount.is_active" class="font-size-12 text-muted"><span class="text-success fw-semibold">{{discount.name}}</span> will no longer have access to our system.</p>
                    <p v-else class="font-size-12 text-muted"><span class="text-success fw-semibold">{{discount.name}}</span> now have full access to our system</p>
                </div>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                is_active: null,
                option: 'status'
            }),
            discount: {},
            showModal: false,
        }
    },
    methods: { 
        show(data){
            this.discount = data;
            console.log(data);
            this.form.id = data.id,
            this.form.is_active = (this.discount.is_active == 1) ? 0 : 1,
            this.showModal = true;
        },
        submit(){
            this.form.put('/discounts/update', {
                preserveScroll: true,
                onSuccess: () => {
                    this.$emit('update',this.$page.props.flash.data.data);
                    this.hide();
                },
            });
        },
        hide(){
            this.discount = {};
            this.form.reset();
            this.form.clearErrors();
            this.showModal = false;
        }
    }
}
</script>