<template>
    <div class="card bg-light-subtle shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                            <i class="ri-community-fill text-primary fs-24"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14"><span class="text-body">Employee Management Tabs</span></h5>
                    <p class="text-muted text-truncate-two-lines fs-12">More Information for the employee</p>
                </div>
            </div>
        </div>
        
        <div class="card bg-white rounded-bottom shadow-none mb-0">
            <div class="step-arrow-nav mt-0">
                <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                    <li class="nav-item" role="presentation" v-for="(menu, index) in menus" v-bind:key="index">
                        <button class="nav-link fs-12 p-3" :class="(index == 0) ? 'active' : ''" 
                            :id="menu+'-tab'" data-bs-toggle="pill" :data-bs-target="'#'+menu" 
                            type="button" role="tab" :aria-controls="menu" aria-selected="true">
                            {{menu}}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body bg-white rounded-bottom">
            <div class="tab-content">
                <div class="tab-pane" :class="(index == 0) ? 'show active' : ''" :id="menu" role="tabpanel" :aria-labelledby="menu+'-tab'" v-for="(menu, index) in menus" v-bind:key="index">
                    
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <transition mode="out-in">
                                <div :key="index" class="tab-content">
                                    <!-- <Overview :dropdowns="dropdowns" :lists="employee.credentials" :id="employee.id" v-if="menu == 'Overview'" /> -->
                                    <!-- <Credits :dropdowns="dropdowns" :lists="employee.credentials" :id="employee.id" v-if="menu == 'Credits'" /> -->
                                    <Contracts :dropdowns="dropdowns" :lists="employee.contracts" :id="employee.id" v-if="menu == 'Contracts'" />
                                    <Deductions :type="employee.organization.type.name" :dropdowns="dropdowns" :lists="employee.deductions" :id="employee.id" v-if="menu == 'Deductions'" />
                                    <Eligibility :dropdowns="dropdowns" :lists="employee.credentials" :id="employee.id" v-if="menu == 'Credentials'" /> 
                                    <Academic :dropdowns="dropdowns" :lists="employee.academics" :id="employee.id" v-if="menu == 'Academics'"/> 
                                    <!--<Background :marital="employee.profile.marital.name" :dropdowns="dropdowns" :information="employee.information" :id="employee.id" v-if="menu == 'Informations'"/> -->
                                </div>
                            </transition>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import simplebar from "simplebar-vue";
import Contracts from './Pages/Contracts.vue';
import Credits from './Pages/Credits.vue';
import Deductions from './Pages/Deductions.vue';
import Overview from './Pages/Overview.vue';
import Academic from './Pages/Academic.vue';
import Background from "./Pages/Background.vue";
import Eligibility from './Pages/Eligibility.vue';
export default {
    components: { simplebar, Eligibility, Academic, Background, Overview, Credits, Contracts, Deductions },
    props: ['employee','dropdowns'],
    data(){
        return {
            menus: [
                'Overview','Informations','Credits','Deductions','Contracts','Academics','Credentials'
            ],
            index: null,
        }
    }
}
</script>