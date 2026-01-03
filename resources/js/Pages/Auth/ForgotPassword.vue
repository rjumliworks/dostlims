<template>
    <Head title="Forgot Password" />
    <div class="auth-page-wrapper pt-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content">
            <BContainer>
                <BRow class="justify-content-center">
                    <BCol md="8" lg="6" xl="5">
                        <div class="card bg-light-subtle shadow-none border">
                           
                            <div class="car-body bg-white shadow-none" style="padding: 30px;">
                                <img src="@assets/images/auth/reset-password.png" alt="" class="avatar-sm d-block mx-auto mb-3">
                                <form class="customform" @submit.prevent="submit">
                                    <div class="text-center mt-n1">
                                    <h5 class="text-primary fs-15">Forgot Password?</h5>
                                    <!-- <p class="text-muted fs-11">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p> -->
                                    
                                </div>
                                    <BAlert v-if="status" :model-value="true" variant="success" class="mb-3 fs-11 border-0 text-center">{{ status }}</BAlert>
                                    <BAlert v-else :model-value="true" variant="warning" class="mb-3 fs-11 border-0 text-center">Enter your email and instructions will be sent to you! </BAlert>
                                    <div class="mb-2">
                                        <InputLabel for="email" value="Email Address" style="margin-bottom: 0px;"/>
                                        <TextInput id="email" v-model="form.email" type="email" class="form-control" autofocus placeholder="Please enter your registered email" :class="['form-control', form.errors.email && 'is-invalid']" @input="handleInput('email')"/>
                                        <InputError :message="form.errors.email" />
                                    </div>
                                    <div class="mt-4 mb-2">
                                        <BButton variant="primary" class="w-100" type="submit" :class="['some-class', form.processing && 'opacity-25']" :disabled="form.processing">Send Reset Link</BButton>
                                    </div>

                                </form>
                            </div>
                            <div class="card-footer bg-light-subtle">
                                 <div class="text-center p-1">
                                    <p class="mb-0">Wait, I remember my password...
                                         <Link href="/login" class="fw-semibold text-primary text-decoration-underline"> Click here</Link>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </BCol>
                </BRow>
                <!-- <BRow class="justify-content-center">
                    <BCol md="8" lg="6" xl="5">
                        <BCard no-body class="mt-4">

                            <BCardBody class="p-5">
                                <div class="text-center mt-n3">
                                    <h5 class="text-primary fs-15">Forgot Password?</h5>
                                    <p class="text-muted fs-11">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                    
                                </div>

                                <BAlert v-if="status" :model-value="true" variant="warning" class="mb-2 mx-2 border-0 text-center">{{ status }}</BAlert>

                                <div class="p-2 mt-4">
                                    <form class="customform" @submit.prevent="submit">
                                        <div class="mb-3">
                                            <InputLabel for="email" value="Email" />
                                            <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" placeholder="Enter your registred email address" :class="{ 'is-invalid': form.errors.email }" />
                                            <InputError :message="form.errors.email" />
                                        </div>

                                        <div class="text-center mt-2">
                                            <b-button variant="primary" class="w-100" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Send Reset Link</b-button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <p class="mb-0 fs-12">Wait, I remember my password...
                                                <Link href="/login" class="fw-semibold text-primary text-decoration-underline"> Click here</Link>
                                            </p>
                                        </div>

                                    </form>
                                </div>
                            </BCardBody>
                        </BCard>   

                    </BCol>
                </BRow> -->
            </BContainer>
        </div>
    </div>
</template>
<script setup>
import { Link, Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Shared/Components/Forms/InputError.vue';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
defineProps({
    status: String,
});
const form = useForm({
    email: '',
});
const submit = () => {
    form.post('/forgot-password');
};
</script>
<script>
export default {
    layout: null,
    data() {
        return {
         
        };
    }
}
</script>