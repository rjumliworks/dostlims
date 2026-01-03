<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" :title="(form.type_id == 173) ? 'Add School' : 'Add Course'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                    <InputLabel value="Name" :message="form.errors.name"/>
                    <TextInput v-model="form.name" type="text" class="form-control" placeholder="Please enter name" :light="true"/>
                </BCol>   
                <BCol lg="12">
                    <InputLabel value="Short" :message="form.errors.short"/>
                    <TextInput v-model="form.short" type="text" class="form-control" placeholder="Please enter short" :light="true"/>
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
                name: null,
                short: null,
                type_id: null,
                option: 'listacademic'
            }),
            showModal: false
        }
    },
    methods: { 
        show(type){
            this.form.type_id = type;
            this.showModal = true;
        },
        submit(){
            this.form.post('/employees',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.$emit('selected',response.props.flash.data);
                    this.hide();
                },
            });
        },
        hide(){
            this.form.name = null;
            this.form.short = null;
            this.showModal = false;
        }
    }
}
</script>