<template>
    <Head title="Log in"/>
    <div id="layout-wrapper" class="auth-page-wrapper pt-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content">
            <BContainer>

                <BRow class="justify-content-center">
                    <BCol md="9" lg="7" xl="5">
                        <div class="card bg-light-subtle shadow-none border">
                            <div class="card-header bg-primary">
                                <div class="d-flex mb-n2">
                                    <div class="flex-shrink-0 me-3">
                                        <div style="height:2.5rem;width:2.5rem;">
                                        <img src="@assets/images/logo-sm.png" alt="" class="avatar-sm">
                                        </div>
                                    </div>
                                    <!-- <div class="flex-grow-1">
                                        <h5 class="mb-0 mt-2 fs-14"><span class="text-white fw-semibold text-uppercase fs-13">Department Of Science and Technology</span></h5>
                                        <p class="text-white fs-11">Unified Information Management System</p>
                                    </div> -->
                                     <div class="flex-grow-1">
                                        <h5 class="mb-0 mt-2 fs-14 fw-semibold text-uppercase text-white" style="font-size: 10.7px"> DEPARTMENT OF SCIENCE AND TECHNOLOGY</h5>
                                        <p class="text-white fs-11"><span class="fw-semibold">One<span class="text-info">DOST</span>4U</span> : <span class="text-muted">Laboratory Information Management System</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="car-body bg-white shadow-none" style="padding: 33px;">
                                <form class="customform" @submit.prevent="submit">
                                    <div class="alert alert-warning alert-border-left alert-dismissible fade show material-shadow fs-11" role="alert">
                                        <span class="fs-10" style="line-height: 1.2; display: inline-block;"> <strong>Security Notice :</strong> This system is restricted to authorized government personnel only. Unauthorized access is prohibited.</span>
                                    </div>
                                    <div class="mb-2" v-if="type == 'OTP'">
                                        <label><i class="ri-cellphone-fill"></i> Mobile Number</label>
                                        <div class="form-icon">
                                            <input type="text" v-model="form.mobile" 
                                            class="form-control form-control-icon" 
                                            id="iconInput" placeholder="Please enter mobile number" 
                                            :class="['form-control', form.errors.mobile && 'is-invalid']" 
                                            @input="handleInput('mobile')"
                                            style="background-color: #f5f6f7;">
                                            <i class="ri-hashtag text-muted"></i>
                                            <InputError :message="form.errors.mobile" />
                                        </div>
                                    </div>
                                    <div class="mb-2" v-if="type == 'OTP'">
                                        <div class="text-muted text-center mt-3 mb-n2">
                                            <h4 class="fs-11 mb-0">Enter One-Time Password</h4>
                                            <p class="fs-10">Please enter the one-time Password (OTP) that we sent to your mobile no.<span
                                                    class="fw-semibold text-lowercase">{{ maskedEmail }}</span></p>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <input v-for="(digit, index) in digits" :key="index" ref="otpInputs" type="text"
                                                class="form-control text-center flex-fill" maxlength="1"
                                                :value="digits[index]" @input="onInput($event, index)"
                                                @kedown="onKeydown($event, index)" @paste="onPaste($event, index)"
                                                inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" style="padding: 0; background-color: #f5f6f7; height: 40px;"/>
                                        </div>
                                    </div>
                                    <div class="mb-2" v-if="type == 'Login'">
                                        <label><i class="ri-profile-line"></i> Government Employee ID</label>
                                        <div class="form-icon">
                                            <input type="text" v-model="form.email" 
                                            class="form-control form-control-icon" 
                                            id="iconInput" placeholder="Please enter email" 
                                            :class="['form-control', form.errors.email && 'is-invalid']" 
                                            @input="handleInput('email')"
                                            style="background-color: #f5f6f7;">
                                            <i class="ri-user-2-fill text-muted" :class="(form.errors.email) ? 'mt-n3' : ''"></i>
                                            <InputError :message="form.errors.email" />
                                        </div>
                                    </div>
                                    <div class="mb-3" v-if="type == 'Login'">
                                        <label><i class="ri-key-2-fill"></i> Secure Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <div class="form-icon">
                                                <input :type="togglePassword ? 'text' : 'password'" 
                                                v-model="form.password" class="form-control form-control-icon" 
                                                id="password-input" placeholder="Please enter password" 
                                                :class="['form-control', form.errors.password && 'is-invalid']"  
                                                @input="handleInput('password')"
                                                style="background-color: #f5f6f7;">
                                                <i class="ri-lock-2-fill text-muted"></i>
                                                <InputError :message="form.errors.password" />
                                            </div>
                                            <BButton v-if="!form.errors.password" variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon" @click="togglePassword = !togglePassword">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </BButton>
                                        </div>
                                    </div>
                                    <div class="form-check mt-n1" v-if="type == 'Login'">
                                        <Checkbox v-model:checked="form.remember" name="remember" class="form-check-input" id="auth-remember-check" />
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>
                                    <div class="mt-3" v-if="type == 'Login'">
                                        <BButton variant="primary" class="w-100" type="submit" :class="['some-class', form.processing && 'opacity-25']" :disabled="form.processing">Sign In</BButton>
                                    </div>
                                    <div class="mt-3" v-if="type === 'OTP'">
                                        <BButton
                                            v-if="!isOtpComplete"
                                            variant="primary"
                                            class="w-100"
                                            type="submit"
                                            :disabled="form.processing"
                                        >
                                            Send One-Time Password (OTP)
                                        </BButton>

                                        <BButton
                                            v-else
                                            variant="success"
                                            class="w-100"
                                            type="button"
                                            :disabled="form.processing"
                                            @click="verifyOtp"
                                        >
                                            Verify OTP
                                        </BButton>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-10 mb-4 title text-muted">Sign In with</h5>
                                        </div>
                                        <div class="mt-n2">
                                            <!-- <button type="button" class="btn btn-sm btn-light btn-icon waves-effect waves-light me-1"><i class="ri-facebook-fill fs-14"></i></button> -->
                                            <button type="button" @click="loginGoogle" class="btn btn-sm btn-danger btn-icon waves-effect waves-light me-1"><i class="ri-google-fill fs-14"></i></button>
                                            <button type="button" @click="type = 'OTP'" class="btn btn-sm  btn-dark btn-icon waves-effect waves-light me-1"><i class="bx bx-mobile fs-14"></i></button>
                                            <button type="button" @click="type = 'Login'" class="btn btn-sm  btn-info btn-icon waves-effect waves-light"><i class="ri-mac-line fs-14"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light-subtle">
                                 <div class="text-center p-1">
                                    <p class="mb-0 fs-11">Forgot your password? 
                                        <Link href="/forgot-password" class="fw-semibold text-primary text-decoration-underline"> Click here</Link>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </BCol>
                </BRow>
            </BContainer>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, nextTick } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Checkbox from '@/Shared/Components/Forms/Checkbox.vue';
import InputError from '@/Shared/Components/Forms/InputError.vue';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
defineProps({
    canResetPassword: Boolean,
    status: String
});
const type = ref('Login');
const togglePassword = ref(false);
const digits = ref(Array(6).fill(''));
const form = useForm({
    mobile: null,
    code: null,
    email: '',
    password: '',
    remember: false,
});
const handleInput = (field) => {
    form.errors[field] = null; // or false
};
const submit = () => {
    if (type.value === 'OTP' && !form.code) {
        sendOtp();
        return;
    }
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post('/login', {
         onError: (errors) => {
        console.log('Validation Errors:', errors);
    },
        onFinish: () => form.reset('password'),
    });
};
const updateCode = () => {
    form.code = digits.value.join('');
};

const isOtpComplete = computed(() => form.code && form.code.length === 6);

// Focus input
const focusInput = (idx) => {
    const inputs = otpInputs.value;
    if (!inputs) return;
    const el = Array.isArray(inputs) ? inputs[idx] : inputs;
    if (el && el.focus) {
        el.focus();
        try { el.setSelectionRange(0, 1); } catch {}
    }
};

// References for v-for inputs
const otpInputs = ref([]);

// onInput
const onInput = (e, index) => {
    const raw = e.target.value || '';
    const cleaned = raw.replace(/\D/g, '');
    if (!cleaned) {
        digits.value[index] = '';
        updateCode();
        return;
    }

    const chars = cleaned.split('');
    for (let i = 0; i < chars.length && index + i < digits.value.length; i++) {
        digits.value[index + i] = chars[i];
    }

    const focusTo = Math.min(index + chars.length, digits.value.length - 1);
    nextTick(() => focusInput(focusTo));

    updateCode();
};

// onKeydown
const onKeydown = (e, index) => {
    if (e.key === 'Backspace') {
        e.preventDefault();
        if (digits.value[index]) {
            digits.value[index] = '';
            updateCode();
            return;
        }
        if (index > 0) {
            digits.value[index - 1] = '';
            nextTick(() => focusInput(index - 1));
            updateCode();
        }
    } else if (e.key === 'ArrowLeft' && index > 0) {
        e.preventDefault(); focusInput(index - 1);
    } else if (e.key === 'ArrowRight' && index < digits.value.length - 1) {
        e.preventDefault(); focusInput(index + 1);
    }
};

// onPaste
const onPaste = (e, index) => {
    e.preventDefault();
    const paste = (e.clipboardData || window.clipboardData).getData('text') || '';
    const chars = paste.replace(/\D/g, '').split('');
    for (let i = 0; i < chars.length && index + i < digits.value.length; i++) {
        digits.value[index + i] = chars[i];
    }
    const focusTo = Math.min(index + chars.length, digits.value.length - 1);
    nextTick(() => focusInput(focusTo));
    updateCode();
};
const sendOtp = () => {
    form.post('/otp/send', {
        preserveScroll: true,
        onError: (errors) => {
            console.log('OTP Errors:', errors);
        },
        onSuccess: () => {
            // optional: show OTP input step
            // type.value = 'OTP_VERIFY'
        }
    });
};
const verifyOtp = () => {
    form.post('/otp/verify', {
        preserveScroll: true,
        onError: (errors) => {
            console.log('Verify OTP Errors:', errors);
        }
    });
};
const loginGoogle = () => {
    window.location.href = '/auth/google';
}
</script>
<script>
export default {
    layout: null,
}
</script>
<style scoped>
    input::placeholder {
        font-size: 12px;
        color: #999;
    }
</style>