<template>
<div class="">
    <form @submit.prevent="submit()" class="customform">
        <BCard no-body>
            <BCardHeader>
                <BCardTitle>Profile Information</BCardTitle>
                <p class="text-muted mb-0">Update your account's profile information and email address.</p>
            </BCardHeader>
            <BCardBody class="p-4" style="height: calc(100vh - 300px); overflow: auto;">
                <form class="customform">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <TextInput id="email" v-model="form.username" type="text" class="form-control"  :readonly="true"/>                
                                <InputLabel for="username" value="Username" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <TextInput id="email" v-model="form.email" type="email" class="form-control" :readonly="true"/>                
                                <InputLabel for="email" value="Email" />
                            </div>
                        </div>
                        <div class="col-md-12 mb-1 mt-1">
                            <hr class="text-muted mt-0 mb-0"/>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <TextInput id="firstname" v-model="form.firstname" type="text" class="form-control" :readonly="false"/>                
                                <InputLabel for="firstname" value="Firstname" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <TextInput id="middlename" v-model="form.middlename" type="text" class="form-control" :readonly="false"/>                
                                <InputLabel for="middlename" value="Middlename" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <TextInput id="lastname" v-model="form.lastname" type="text" class="form-control" :readonly="false"/>                
                                <InputLabel for="lastname" value="Lastname" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <TextInput id="suffix" v-model="form.suffix" type="text" class="form-control" :readonly="false"/>                
                                <InputLabel for="suffix" value="Suffix" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mt-n1">
                                <TextInput id="mobile" v-model="form.mobile" type="text" class="form-control" :readonly="false"/>                
                                <InputLabel for="mobile" value="Mobile" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mt-n1">
                                <!-- <Multiselect :options="['Male','Female']" v-model="form.gender" :message="form.errors.gender" placeholder="Select Gender"/> -->
                                <select v-model="form.sex" class="form-select" id="floatingSelect">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <InputLabel for="gender" value="Gender" />
                                <!-- <InputError :message="form.errors.gender" class="mt-2" /> -->
                            </div>
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-end" style="bottom: 0;">
                    <BButton variant="primary w-lg float-end" type="submit" :disabled="form.processing">Save</BButton>
                </div>
            </BCardBody>
        </BCard>
    </form>
</div>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
export default {
    components: { InputLabel, TextInput },
    data(){
        return {
            form: useForm({
                username: this.$page.props.user.data.username,
                email: this.$page.props.user.data.email,
                firstname: this.$page.props.user.data.firstname,
                middlename: this.$page.props.user.data.middlename,
                lastname: this.$page.props.user.data.lastname,
                suffix: this.$page.props.user.data.suffix,
                sex: this.$page.props.user.data.sex,
                mobile: this.$page.props.user.data.mobile,
            }),
        }
    },
    methods: {
        submit(){
            this.form.put('/profile/updated', {
                errorBag: "submit",
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {},
            });
        }
    }
}
</script>