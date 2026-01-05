<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Update Conforme" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                    <InputLabel value="Name" :message="form.errors.name"/>
                    <TextInput v-model="form.name" type="text" class="form-control" placeholder="Please enter name" :light="true"/>
                </BCol>   
                <BCol lg="12">
                    <InputLabel value="Contact no." :message="form.errors.contact_no"/>
                    <TextInput v-model="form.contact_no" type="text" class="form-control" placeholder="Please enter contact" :light="true"/>
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
    components: { InputLabel, TextInput },
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                name: null,
                contact_no: null,
                customer_id: null,
                option: 'conforme'
            }),
            showModal: false
        }
    },
    methods: { 
        show(data){
            this.form.id = data.id;
            this.form.name = data.name;
            this.form.contact_no = data.contact_no;
            this.form.customer_id = data.customer_id;
            this.showModal = true;
        },
        submit(){
            this.form.put('/customers/update',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.form.id = null;
            this.form.customer_id = null;
            this.form.name = null;
            this.form.contact_no = null;
            this.showModal = false;
        }
    }
}
</script>