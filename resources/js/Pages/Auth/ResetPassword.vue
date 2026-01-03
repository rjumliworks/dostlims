<script setup>
import { Link, Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Shared/Components/Forms/InputError.vue';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/reset-password', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<script>
export default {
    layout: null,
    data() {
        return {
            togglePassword: false,
            togglePassword_conf: false,
        }
    }
}
</script>

<template>
    <Head title="Reset Password" />

    <div class="auth-page-wrapper pt-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content">
            <BContainer>
                <BRow class="justify-content-center">
                    <BCol md="8" lg="6" xl="5">
                        <div class="card bg-light-subtle shadow-none border">
                           
                            <div class="car-body bg-white shadow-none" style="padding: 30px;">
                                <img src="@assets/images/auth/new-password.png" alt="" class="avatar-sm d-block mx-auto mb-3">
                                <form class="customform" @submit.prevent="submit">
                                    <div class="text-center mt-n1">
                                    <h5 class="text-primary fs-15">Create new password</h5>
                                    <!-- <p class="text-muted fs-11">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p> -->
                                    
                                </div>
                                    <BAlert :model-value="true" variant="danger" class="mb-3 fs-11 border-0 text-center">Please choose a new password that you haven’t used before.</BAlert>
                                    <div class="mb-3">
                                        <InputLabel for="email" value="Email Address" style="margin-bottom: 0px;"/>
                                        <TextInput id="email" v-model="form.email" type="email" class="form-control" autofocus placeholder="Please enter your registered email" :class="['form-control', form.errors.email && 'is-invalid']" @input="handleInput('email')"/>
                                        <InputError :message="form.errors.email" />
                                    </div>
                                    <div class="mb-0">
                                        <InputLabel for="password-input" value="Password" :message="form.errors.password"/>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input :type="togglePassword ? 'text' : 'password'" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" v-model="form.password" :class="{ 'is-invalid' : form.errors.password}">
                                            <BButton v-if="!form.errors.password" variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon" @click="togglePassword = !togglePassword"><i class="ri-eye-fill align-middle"></i>
                                            </BButton>
                                            <!-- <InputError :message="form.errors.password" class="mt-n1"/> -->
                                        </div>
                                    </div>

                                    <div>
                                        <InputLabel for="password_confirmation" value="Confirm Password" />
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input :type="togglePassword_conf ? 'text' : 'password'" class="form-control pe-5 password-input" placeholder="Confirm password" id="confirm-password-input" v-model="form.password_confirmation" :class="{ 'is-invalid' : form.errors.password_confirmation}">
                                            <BButton variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input" @click="togglePassword_conf = !togglePassword_conf"><i class="ri-eye-fill align-middle"></i>
                                            </BButton>
                                            <InputError :message="form.errors.password_confirmation"/>
                                        </div>
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

                            <BCardBody class="p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create new password</h5>
                                    <p class="text-muted">Your new password must be different from previous used
                                        password.</p>
                                </div>

                                <div class="p-2">
                                    <form @submit.prevent="submit" class="customform">
                                        <div class="mb-3">
                                            <InputLabel for="email" value="Email" />
                                            <TextInput id="email" v-model="form.email" type="email" required autofocus autocomplete="email" :class="{ 'is-invalid' : form.errors.email}" />
                                            <InputError :message="form.errors.email" />
                                        </div>
                                        <div class="mb-3">
                                            <InputLabel for="password-input" value="Password" />
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input :type="togglePassword ? 'text' : 'password'" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" v-model="form.password" required :class="{ 'is-invalid' : form.errors.password}">
                                                <BButton variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon" @click="togglePassword = !togglePassword"><i class="ri-eye-fill align-middle"></i>
                                                </BButton>
                                                <InputError :message="form.errors.password" />
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <InputLabel for="password_confirmation" value="Confirm Password" />
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input :type="togglePassword_conf ? 'text' : 'password'" class="form-control pe-5 password-input" placeholder="Confirm password" id="confirm-password-input" v-model="form.password_confirmation" required :class="{ 'is-invalid' : form.errors.password_confirmation}">
                                                <BButton variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input" @click="togglePassword_conf = !togglePassword_conf"><i class="ri-eye-fill align-middle"></i>
                                                </BButton>
                                                <InputError :message="form.errors.password_confirmation" />
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <BButton variant="primary" class="w-100" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit">Reset Password</BButton>
                                        </div>

                                    </form>
                                </div>
                            </BCardBody>
                        </BCard>

                        <div class="mt-4 text-center">
                            <p class="mb-0">Wait, I remember my password...
                                <Link href="/login" class="fw-semibold text-primary text-decoration-underline"> Click
                                here </Link>
                            </p>
                        </div>
                    </BCol>
                </BRow> -->
            </BContainer>
        </div>

       
    </div>
</template>
<style lang="css" scoped>
.customform {
  margin-top: -5px;
  margin-bottom: -5px;
}
.customform label {
  margin-bottom: -10px;
  font-size: 11px;
}
.customform input {
  margin-bottom: 5px;
}
</style>