<template>
    <Head title="Activation"/>
    <div id="layout-wrapper" class="auth-page-wrapper pt-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content">
            <BContainer>

                <BRow class="justify-content-center">
                    <BCol md="9" lg="7" xl="6">
                        <div class="card bg-light-subtle shadow-none border">
                            <div class="card-header bg-primary">
                                <div class="d-flex mb-n2">
                                    <div class="flex-shrink-0 me-3">
                                        <div style="height:2.5rem;width:2.5rem;">
                                        <img src="@assets/images/logo-sm.png" alt="" class="avatar-sm">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0 mt-2 fs-14"><span class="text-white fw-semibold text-uppercase fs-13">Department Of Science and Technology</span></h5>
                                        <p class="text-white fs-11">Laboratory Information Management System</p>
                                    </div>
                                </div>
                            </div>
                            <div class="car-body bg-white shadow-none" style="padding: 33px;">
                                <form class="customform" @submit.prevent="submit">
                                    <div id="custom-progress-bar" class="progress-nav mb-4 position-relative">
                                        <div class="progress step-progress progress-back" style="height: 6px; width: 106%; margin-left: -12px;">
                                            <div class="progress-bar" role="progressbar" :style="`width: ${progressbarvalue}%;`"></div>
                                        </div>

                                        <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <div class="step-wrapper">
                                                    <BButton variant="link" class="nav-link rounded-pill" :class="{ active: activeTab == 1, done: activeTab > 1 }" @click="toggleTab(1, 0);">1</BButton>
                                                    <div class="step-title">Email Verification</div>
                                                </div>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <div class="step-wrapper">
                                                    <BButton variant="link" class="nav-link rounded-pill" :class="{ active: activeTab == 2, done: activeTab > 2 }" @click="toggleTab(2,34);">2</BButton>
                                                    <div class="step-title">Set Password</div>
                                                </div>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <div class="step-wrapper">
                                                    <BButton variant="link" class="nav-link rounded-pill" :class="{ active: activeTab == 3, done: activeTab > 3 }" @click="toggleTab(3, 65);">3</BButton>
                                                    <div class="step-title">Upload Photo</div>
                                                </div>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <div class="step-wrapper">
                                                    <BButton variant="link" class="nav-link rounded-pill" :class="{ active: activeTab == 4, done: activeTab > 4 }" @click="toggleTab(4, 100);">4</BButton>
                                                    <div class="step-title">Finish Activation</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content" style="height: 240px;">
                                        <div class="tab-pane fade" :class="activeTab == 1 && 'show active'" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
                                            <div>
                                                <hr class="text-muted mt-n2"/>
                                                <div class="mb-4 mt-0">
                                                    <div>
                                                        <h5 class="fs-12 mb-3 text-primary fw-semibold"><i class="bx bxs-key"></i> Enter Activation Code</h5>
                                                        <div class="alert alert-warning alert-border-left alert-dismissible fade show material-shadow fs-10" role="alert">
                                                            The <b>activation code</b> is used to verify your identity and confirm that your registered email address is <b>valid and accessible</b>.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2 mt-n1">
                                                    <template v-for="(digit, index) in digits" :key="index">
                                                        <input  ref="otpInputs" type="text"
                                                        class="form-control text-center flex-fill" maxlength="1"
                                                        :value="digits[index]" @input="onInput($event, index)"
                                                        @keydown="onKeydown($event, index)" @paste="onPaste($event, index)"
                                                        inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" 
                                                        style="padding: 0; height: 35px; background-color: #f5f6f7;"/>
                                                        <span v-if="(index + 1) % 3 === 0 && index !== digits.length - 1" class="mt-2 text-muted fw-bold">-</span>
                                                    </template>
                                                </div>
                                                <p class="fs-10 text-muted">Please enter the 9-digit activation code sent to your registered email address.</p>
                                                <h5 v-if="remainingTime > 0" class="fs-13 mt-4 text-primary text-center fw-semibold"><i class="ri-mail-send-fill me-2"></i>Resend available in {{ formattedTime }}</h5>
                                                <h5 v-else-if="codeValid == false" class="fs-11 mt-4 text-danger text-center"><i class="ri-error-warning-line fs-14 me-1"></i>Invalid activation code. Please check your email and try again.</h5>
                                                <h5 v-else class="fs-13 mt-4 text-primary text-center fw-semibold"><i class="ri-mail-send-fill me-2"></i>Resend Verification Code</h5>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" :class="activeTab == 2 && 'show active'" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
                                            <div>
                                                <hr class="text-muted mt-n2"/>
                                                <div class="mb-4 mt-0">
                                                    <div>
                                                        <h5 class="fs-12 mb-1 text-primary fw-semibold"><i class="ri-lock-2-fill me-1"></i> Set Secure Password</h5>
                                                        <p class="fs-10 text-muted">
                                                          Passwords are required to be a minimum of eight (8) characters and must include uppercase and lowercase letters, numbers, and special characters.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mb-0 mt-n3">
                                                    <label><i class="ri-key-2-fill me-1"></i>New Password</label>
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
                                                    <div class="mb-2 mt-n2">
                                                        <div class="progress" style="height: 4px;">
                                                            <div
                                                                class="progress-bar"
                                                                role="progressbar"
                                                                :style="{ width: passwordStrength.percent + '%' }"
                                                                :class="passwordStrength.class"
                                                            ></div>
                                                        </div>

                                                        <small class="text-muted d-block mt-1 fs-10"> Password strength:
                                                            <span :class="passwordStrength.textClass">
                                                                {{ passwordStrength.label }}
                                                            </span>
                                                        </small>
                                                    </div>
                                                    
                                                </div>
                                                <div class="mb-0">
                                                    <label><i class="ri-key-2-fill me-1"></i>Confirm Password</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <div class="form-icon">
                                                            <input :type="togglePassword ? 'text' : 'password'" 
                                                            v-model="form.password_confirmation" class="form-control form-control-icon" 
                                                            id="password-input" placeholder="Please enter password" 
                                                            @input="handleInput('password_confirmation')"
                                                            :class="[
                                                                'form-control',
                                                                form.errors.password_confirmation ? 'is-invalid' : '',
                                                                passwordMatches ? 'is-valid' : (this.form.password && this.form.password_confirmation) ? 'is-invalid' : ''
                                                            ]"
                                                            style="background-color: #f5f6f7;">
                                                            <i class="ri-lock-2-fill text-muted" :class="passwordMatches ? 'mt-n3' : (this.form.password && this.form.password_confirmation) ? 'mt-n3' : ''"></i>
                                                            <div class="valid-feedback mt-n1"><span class="fs-10">Passwords match </span></div>
                                                            <div class="invalid-feedback mt-n1"><span class="fs-10">Password doesn't match</span></div>
                                                        </div>
                                                        <!-- <BButton v-if="!form.errors.password_confirmation" variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon" @click="togglePassword = !togglePassword">
                                                            <i class="ri-eye-fill align-middle"></i>
                                                        </BButton> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" :class="activeTab == 3 && 'show active'" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
                                            <div>
                                                <hr class="text-muted mt-n2"/>
                                                <div class="mb-4 mt-0">
                                                    <div>
                                                        <h5 class="fs-12 mb-1 text-primary fw-semibold"><i class="ri-camera-fill me-1"></i>Upload Identification Photo</h5>
                                                        <p class="fs-10 text-muted">
                                                          Submission of a clear and recent photograph is required to establish identity and comply with official account verification procedures.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-n2">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                                            <img :src="$page.props.user.data.avatar" class="rounded-circle avatar-lg img-thumbnail user-profile-image" alt="user-profile-image">
                                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit position-absolute end-0 bottom-0">
                                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input d-none" accept="image/png, image/jpeg" @change="previewImage">
                                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs cursor-pointer">
                                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                                        <i class="ri-camera-fill"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <ul style="margin-left: 20px; margin-top: 5px; font-size: 11px; color: #666;">
                                                            <li>Recent photo (taken within last 6 months)</li>
                                                            <li>Clear face view with neutral expression</li>
                                                            <li>Plain background preferred</li>
                                                            <li>File size: Maximum 2MB</li>
                                                            <li>Formats: JPG or PNG</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" :class="activeTab == 4 && 'show active'" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
                                            <div>
                                                <hr class="text-muted mt-n2"/>
                                                 <div class="mb-2 mt-2">
                                                    <div>
                                                        <h5 class="fs-12 mb-1 text-primary fw-semibold"><i class="ri-checkbox-circle-line me-1"></i>Review and Activate</h5>
                                                        <!-- <p class="fs-10 text-muted">
                                                          By activating your account, you agree to use it solely for official government purposes, keep your login credentials secure and confidential, and comply with all applicable government security policies. You acknowledge that account activity may be monitored for security purposes and agree to report any suspicious activity immediately. Violation of these terms may result in account suspension and legal action.
                                                        </p> -->
                                                    </div>
                                                </div>
                                                <ul class="list-group fs-10">
                                                    <li class="list-group-item" v-if="form.errors.code"><i class="ri-close-circle-fill fs-13 text-danger align-middle lh-1 me-2"></i>The activation code you entered is invalid.</li>
                                                    <li class="list-group-item" v-else><i class="ri-checkbox-circle-fill fs-13 text-success align-middle lh-1 me-2"></i> Enter Activation Code</li>
                                                    <li class="list-group-item" v-if="form.errors.password"><i class="ri-close-circle-fill fs-13 text-danger  align-middle lh-1 me-2"></i>{{ form.errors.password }}</li>
                                                    <li class="list-group-item" v-else><i class="ri-checkbox-circle-fill fs-13 text-success  align-middle lh-1 me-2"></i> Set Secure Password</li>
                                                    <li class="list-group-item" v-if="hasAvatar"><i class="ri-checkbox-circle-fill fs-13 text-success  align-middle lh-1 me-2"></i> Upload Identification Photo</li>
                                                    <li class="list-group-item" v-else><i class="ri-close-circle-fill fs-13 text-danger  align-middle lh-1 me-2"></i>Please upload your identification photo.</li>
                                                </ul>
                                                <div class="mb-4 mt-2">
                                                    <div>
                                                        <h5 class="fs-10 mb-1 text-danger fw-semibold"><i class="ri-camera-fill me-1"></i>Terms and Condition</h5>
                                                        <!-- <p class="fs-10 text-muted">
                                                          By activating your account, you agree to use it solely for official government purposes, keep your login credentials secure and confidential, and comply with all applicable government security policies. You acknowledge that account activity may be monitored for security purposes and agree to report any suspicious activity immediately. Violation of these terms may result in account suspension and legal action.
                                                        </p> -->
                                                    </div>
                                                </div>
                                                <div class="form-group mt-n3">
                                                    <div style="border: 1px solid #ddd; border-radius: 5px; padding: 15px; max-height: 60px; overflow-y: auto; font-size: 9px;">
                                                        <p>By activating your government account, you agree to:</p>
                                                        <ul style="margin-left: 20px; margin-top: 10px;">
                                                            <li>Use the account only for official government purposes</li>
                                                            <li>Keep your login credentials secure and confidential</li>
                                                            <li>Comply with all government security policies</li>
                                                            <li>Accept that account activity is monitored for security</li>
                                                            <li>Report any suspicious activity immediately</li>
                                                        </ul>
                                                        <p style="margin-top: 10px;">Violation of these terms may result in account suspension and legal action.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light-subtle">
                                <div v-if="activeTab == 1" class="d-flex align-items-start gap-3 mt-0 me-3">
                                    <BButton variant="success" class="btn-label btn-sm right ms-auto nexttab nexttab" @click="toggleTab(2, 34);"><i class="ri-arrow-right-line label-icon align-middle fs-lg ms-2"></i>Go set password</BButton>
                                </div>
                                <div v-else-if="activeTab == 2" class="d-flex align-items-start gap-3 mt-0 me-3">
                                    <BButton variant="link" class="btn btn-sm btn-link text-decoration-none btn-label previestab" @click="toggleTab(1, 0);"><i class="ri-arrow-left-line label-icon align-middle fs-lg me-2"></i> 
                                        Back to Email Verification
                                    </BButton>

                                    <BButton v-if="passwordStrength.percent == 100 && passwordMatches" variant="success" class="btn-label btn-sm right ms-auto nexttab nexttab" @click="toggleTab(3, 65);"><i class="ri-arrow-right-line label-icon align-middle fs-lg ms-2"></i>Next
                                    </BButton>
                                </div> 
                                <div v-else-if="activeTab == 3" class="d-flex align-items-start gap-3 mt-0 me-3">
                                    <BButton variant="link" class="btn btn-sm btn-link text-decoration-none btn-label previestab" @click="toggleTab(2, 0);"><i class="ri-arrow-left-line label-icon align-middle fs-lg me-2"></i> 
                                        Back to Set Password
                                    </BButton>

                                    <BButton v-if="hasAvatar" variant="success" class="btn-label btn-sm right ms-auto nexttab nexttab" @click="toggleTab(4, 100);"><i class="ri-arrow-right-line label-icon align-middle fs-lg ms-2"></i>Next
                                    </BButton>
                                </div>
                                 <div v-else class="d-flex align-items-start gap-3 mt-0 me-3">
                                    <BButton variant="link" class="btn btn-sm btn-link text-decoration-none btn-label previestab" @click="toggleTab(3, 65);"><i class="ri-arrow-left-line label-icon align-middle fs-lg me-2"></i>
                                        Back to Upload Photo
                                    </BButton>
                                          <BButton variant="success" class="btn-label btn-sm right ms-auto nexttab nexttab" @click="submit()"><i class="ri-checkbox-circle-fill  label-icon align-middle fs-lg ms-2"></i>Agree and Activate
                                    </BButton>
                                </div>
                            </div>
                        </div>

                    </BCol>
                </BRow>
            </BContainer>
        </div>
    </div>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Shared/Components/Forms/InputError.vue';
export default {
    layout: null,
    data() {
        return {
            form: useForm({
                code: null,
                password: '',
                password_confirmation: '',
                is_active: 1,
                option: 'activation'
            }),
            form2: useForm({
                image: null,
            }),
            hasAvatar: (this.$page.props.user.data.avatar_name == 'noavatar.jpg') ? false : true,
            uploaded: false,
            remainingTime: 0,
            timerInterval: null,
            progressbarvalue: 0,
            activeTab: 1,
            togglePassword: false,
            digits: Array.from({
                    length: 9
                }, () => ''),
            codeValid: null,
        }
    },
    computed: {
        code() {
            return this.digits.join("");
        },
        passwordStrength() {
            const password = this.form.password || '';

            if (!password.length) {
                return {
                    percent: 0,
                    label: 'None',
                    class: '',
                    textClass: ''
                };
            }

            let score = 0;

            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            const map = [
                { percent: 25, label: 'Weak', class: 'bg-danger', textClass: 'text-danger' },
                { percent: 50, label: 'Fair', class: 'bg-warning', textClass: 'text-warning' },
                { percent: 75, label: 'Good', class: 'bg-info', textClass: 'text-info' },
                { percent: 100, label: 'Strong', class: 'bg-success', textClass: 'text-success' }
            ];

            return map[Math.max(score - 1, 0)] || map[0];
        },
        passwordMatches() {
            return (
                this.form.password &&
                this.form.password_confirmation &&
                this.form.password === this.form.password_confirmation
            );
        },
        formattedTime() {
            const minutes = Math.floor(this.remainingTime / 60);
            const seconds = this.remainingTime % 60;
            return `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }
    },
    methods: {
        submit(){
            this.form.put('/activate',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
                onError: () => {
                    if (this.form.errors.password) {
                        this.form.reset('password', 'password_confirmation');
                    }
                    if (this.form.errors.current_password) {
                        this.form.reset('current_password');
                    }
                },
            });
        },
        previewImage(e) {
            var fileInput = document.querySelector(".profile-img-file-input");
            var preview = document.querySelector(".user-profile-image");
            var file = fileInput.files[0];

            if (!file) return;

             // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                alert("Only JPEG or PNG images are allowed.");
                fileInput.value = '';
                return;
            }

            // Validate file size (2MB max)
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes
            if (file.size > maxSize) {
                alert("The image must be less than 2MB.");
                fileInput.value = '';
                return;
            }


            this.form2.image = file;
            var reader = new FileReader();

            reader.addEventListener("load", () => { 
                preview.src = reader.result;
                this.form2.post('/photo', {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.uploaded = true;
                        this.hasAvatar = true;
                    },
                });
            }, false);

            if (file) { 
                reader.readAsDataURL(file); 
            }
        },
        toggleTab(tab, value) {
            this.activeTab = tab;
            this.progressbarvalue = value;
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        focusInput(idx) {
            const inputs = this.$refs.otpInputs;
            if (!inputs) return;
            const el = Array.isArray(inputs) ? inputs[idx] : inputs;
            if (el && el.focus) {
                el.focus();
                try {
                    el.setSelectionRange(0, 1);
                } catch (err) {
                    console.log(err);
                }
            }
        },
        onInput(e, index) {
            const raw = e.target.value || '';
            const cleaned = raw.replace(/\D/g, '');
            if (!cleaned) {
                this.digits[index] = '';
                this.updateCode();
                return;
            }

            const chars = cleaned.split('');
            for (let i = 0; i < chars.length && index + i < this.digits.length; i++) {
                this.digits[index + i] = chars[i];
            }

            const focusTo = Math.min(index + chars.length, this.digits.length - 1);
            this.$nextTick(() => this.focusInput(focusTo));
            this.updateCode();
        },
        onKeydown(e, index) {
            const key = e.key;
            const target = e.target;

            if (key === 'Backspace') {
                if ((target.value || '') === '' && index > 0) {
                    e.preventDefault();
                    this.digits[index - 1] = '';
                    this.$nextTick(() => this.focusInput(index - 1));
                    this.updateCode();
                } else {
                    setTimeout(() => {
                        const v = (this.$refs.otpInputs[index] && this.$refs.otpInputs[index].value || '')
                            .replace(/\D/g, '').slice(0, 1);
                        this.digits[index] = v || '';
                        this.updateCode();
                    }, 0);
                }
            } else if (key === 'ArrowLeft') {
                e.preventDefault();
                if (index > 0) this.focusInput(index - 1);
            } else if (key === 'ArrowRight') {
                e.preventDefault();
                if (index < this.digits.length - 1) this.focusInput(index + 1);
            }
        },
        onPaste(e, index) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text') || '';
            const chars = paste.replace(/\D/g, '').split('');
            if (chars.length === 0) return;
            for (let i = 0; i < chars.length && index + i < this.digits.length; i++) {
                this.digits[index + i] = chars[i];
            }
            const focusTo = Math.min(index + chars.length, this.digits.length - 1);
            this.$nextTick(() => this.focusInput(focusTo));
            this.updateCode();
        },
        updateCode() {
            this.form.code = this.code;
            if (this.code.length === 9) {
                this.checkCode();
            } else {
                this.codeValid = null; // reset if incomplete
            }
        },
        async checkCode() {
            try {
                const response = await axios.post('/activation-check', {
                    code: this.code
                });

                if (response.data.valid) {
                    this.codeValid = true;
                    // Automatically move to next step, optional
                    this.toggleTab(2, 34);
                } else {
                    this.codeValid = false;
                    // Optionally reset the digits
                    // this.digits = Array.from({ length: 9 }, () => '');
                    // this.form.code = '';
                }
            } catch (error) {
                console.error(error);
                this.codeValid = false;
            }
        },
        startTimer(endTime) {
            const now = Math.floor(Date.now() / 1000); // seconds
            this.remainingTime = Math.max(endTime - now, 0);

            if(this.timerInterval) clearInterval(this.timerInterval);

            this.timerInterval = setInterval(() => {
                this.remainingTime--;
                if(this.remainingTime <= 0) clearInterval(this.timerInterval);
            }, 1000);
        },

        async resendCode() {
            // Call Laravel API to resend code
            const response = await axios.post('/verification/resend');
            const endTime = response.data.available_at; // timestamp in seconds
            this.startTimer(endTime);
        }
    },
    mounted() {
        // const availableAt = parseInt(this.$el.dataset.availableAt); 
        // this.startTimer(availableAt);
    },
    beforeUnmount() {
        if(this.timerInterval) clearInterval(this.timerInterval);
    }
}
</script>
<style>
.step-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center; /* center horizontally */
}
.step-title {
    margin-top: 6px;
    font-size: 11px;
    text-align: center;
    color: #6c757d;
}.progress-back {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    z-index: 1;
    margin-top: -11px;
}
.progress-bar-tab {
    position: relative;
    z-index: 2; /* steps ABOVE progress */
}
 input::placeholder {
        font-size: 12px;
        color: #999;
    }
</style>
