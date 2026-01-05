<template lang="">
    <Head title="Customer Profile"/>
    <Top :customer="customer"/>
    <b-row class="g-3">
        <Sidebar :wallet="customer.data.wallet"/>
        <b-col lg="8">
            <b-row>
                <b-col lg="12 ">
                    <div class="card bg-light-subtle shadow-none border">
                        <div class="card-header bg-light-subtle">
                            <div class="d-flex mb-n3">
                                <div class="flex-shrink-0 me-3">
                                    <div style="height:2.5rem;width:2.5rem;">
                                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                            <i class="ri-file-text-line text-primary fs-24"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-0 fs-14"><span class="text-body">TSR and Conforme Records</span></h5>
                                    <p class="text-muted text-truncate-two-lines fs-12">A comprehensive list of all TSRs (Test Service Requests) and Conformes, including their statuses and associated details.</p>
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
                                                    <Lists :id="customer.data.id" v-if="menu == 'TSRs'"/>
                                                    <Conforme :lists="customer.data.conformes" v-if="menu == 'Conformes'"/>
                                                    <Logs :id="customer.data.id" v-if="menu == 'Logs'"/>
                                                </div>
                                            </transition>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </b-col>
            </b-row>
        </b-col>
    </b-row>
</template>
<script>
import Top from './Top.vue';
import Count from './Count.vue';
import Sidebar from './Sidebar.vue';
import Logs from './Components/Logs.vue';
import Lists from './Components/Lists.vue';
import Conforme from './Components/Conforme.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    props:['customer'],
    components: { PageHeader, Top, Count, Sidebar, Lists, Conforme, Logs },
    data(){
        return {
            menus: [
                'TSRs','Conformes','Logs'
            ],
            index: null,
        }
    }
}
</script>