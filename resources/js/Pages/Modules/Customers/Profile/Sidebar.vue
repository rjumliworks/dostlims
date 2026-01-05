<template>
    <b-col lg="4">
        <div class="card bg-light-subtle shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                            <i class="ri-information-fill text-primary fs-24"></i>
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14"><span class="text-body">Transaction & Wallet Overview</span></h5>
                    <p class="text-muted text-truncate-two-lines fs-12">Summary of wallet balance and transaction history.</p>
                </div>
            </div>
        </div>
        <div class="card-body bg-white rounded-bottom border-bottom">
            <p class="mb-0 text-primary fs-12 fw-semibold">My E-Wallet</p>
        </div>
        <div class="card bg-white rounded-bottom shadow-none mb-0" style="height: calc(100vh - 405px); overflow: auto;">
            <ul class="list-group list-group-flush border-dashed mb-n4 mt-n2 p-3">
                <li class="list-group-item px-0">
                    <div class="d-flex">
                        <div class="flex-shrink-0 avatar-xs">
                            <span class="avatar-title bg-light p-1 rounded-circle">
                                <i class="ri-wallet-3-fill text-primary"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 v-if="wallet" class="mb-0 fs-14">{{wallet.available}}</h6>
                            <h6 v-else class="mb-0 fs-14">0.00</h6>
                            <p class="fs-12 mb-0 text-muted">Available Balance</p>
                        </div>
                    </div>
                </li> 
            </ul>
            <hr class="text-muted"/>
                <p class="ms-3 mb-0 text-primary fs-12 fw-semibold">Transaction History</p>
            <hr class="text-muted mb-1"/>
            <simplebar v-if="wallet" data-simplebar style="max-height: 400px">
                <b-list-group class="mt-0" flush>
                    <b-list-group-item class="list-group-item" v-for="(list,index) in wallet.transactions" v-bind:key="index">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-xs">
                                        <div class="avatar-xs flex-shrink-0">
                                            <span class="avatar-title bg-light rounded-circle">
                                                <svg v-if="list.is_credit" xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-circle icon-dual-success icon-sm icon-dual-success icon-sm">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="16 12 12 8 8 12"></polyline>
                                                    <line x1="12" y1="16" x2="12" y2="8"></line>
                                                </svg>
                                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down-circle icon-dual-danger icon-sm icon-dual-danger icon-sm">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="8 12 12 16 16 12"></polyline>
                                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <h6 v-if="!list.transacable.code" class="fs-14 mb-0">OR# : {{list.transacable.number}}</h6>
                                        <h6 v-else class="fs-14 mb-0">{{list.transacable.code}}</h6>
                                        <small class="text-muted">{{list.created_at}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div v-if="list.is_credit">
                                    <span class="text-success float-end">+ {{list.amount}}</span>
                                    <br/><span class="text-muted float-end fs-11">Balance : {{list.balance}}</span>
                                </div>
                                <div v-else>
                                    <span class="text-danger float-end">- {{list.amount}}</span>
                                    <br/><span class="text-muted float-end fs-11">Balance : {{list.balance}}</span>
                                </div>
                            </div>
                        </div>
                    </b-list-group-item>
                </b-list-group>
            </simplebar>
            <div class="d-flex mb-n1" v-if="wallet">
                <div class="flex-grow-1">
                    <p class="text-muted text-center fs-12 mb-n2 mt-3"> Last Updated : {{wallet.updated_at}}</p>
                </div>
            </div>
            <div class="d-flex mb-n1" v-else>
                <div class="flex-grow-1">
                    <p class="text-muted text-center fs-12 mb-n2 mt-3"> No history of transaction</p>
                </div>
            </div>
        </div>
    </div>
    </b-col>
</template>
<script>
import simplebar from 'simplebar-vue';
export default {
    components : { simplebar },
    props: ['wallet'],
    data(){
        return {
            currentUrl: window.location.origin,
        }
    },
}
</script>