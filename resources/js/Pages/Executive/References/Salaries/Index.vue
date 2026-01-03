<template>
    <Head title="Salary"/>
    <PageHeader title="Salary Management" pageTitle="List" />
    <BRow>
        <div class="col-md-12">
            <div class="card bg-light-subtle shadow-none border">
                <div class="card-header bg-light-subtle">
                    <div class="d-flex mb-n3">
                        <div class="flex-shrink-0 me-3">
                            <div style="height:2.5rem;width:2.5rem;">
                                <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                    <i class="ri-bill-line text-primary fs-24"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fs-14"><span class="text-body">List of Salary</span></h5>
                            <p class="text-muted text-truncate-two-lines fs-12">A comprehensive list of campuses from various schools, providing location and institutional details</p>
                        </div>
                        <div class="flex-shrink-0" style="width: 45%;">
                           
                        </div>
                    </div>
                </div>
                <div class="car-body bg-white border-bottom shadow-none">
                    <b-row class="mb-2 ms-1 me-1" style="margin-top: 12px;">
                        <b-col lg>
                            <div class="input-group mb-1">
                                <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                                <input type="text" v-model="keyword" placeholder="Search Unit" class="form-control" style="width: 20%;">
                                <Multiselect class="white" style="width: 20%;" :options="divisions" v-model="division" label="name" :searchable="true" placeholder="Select Division" />
                                <span @click="refresh()" class="input-group-text" v-b-tooltip.hover title="Refresh" style="cursor: pointer;"> 
                                    <i class="bx bx-refresh search-icon"></i>
                                </span>
                                <b-button type="button" variant="primary" @click="openCreate">
                                    <i class="ri-add-circle-fill align-bottom me-1"></i> Create
                                </b-button>
                            </div>
                        </b-col>
                    </b-row>
                </div>
                <div class="card bg-white border-bottom shadow-none" no-body>
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <ul class="nav nav-tabs nav-tabs-custom nav-primary fs-12" role="tablist">
                                <li class="nav-item">
                                    <BLink @click="viewStatus(null,null)" class="nav-link py-3 active" data-bs-toggle="tab" role="tab" aria-selected="true">
                                    <i class="ri-apps-2-line me-1 align-bottom"></i> All Units
                                    </BLink>
                                </li>
                            </ul>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="d-flex flex-wrap gap-2 mt-3">
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-white rounded-bottom">
                    <div class="table-responsive table-card" style="margin-top: -39px; height: calc(100vh - 465px); overflow: auto;">
                        <table class="table align-middle table-striped table-centered mb-0">
                            <thead class="table-light thead-fixed">
                                <tr class="fs-11">
                                    <th style="width: 3%;" class="text-center">#</th>
                                    <th>Amount</th>
                                    <th style="width: 10%;" class="text-center">Grade</th>
                                    <th style="width: 10%;" class="text-center">Year</th>
                                    <th style="width: 10%;" class="text-center">Is Regular</th>
                                    <th style="width: 6%;"></th>
                                </tr>
                            </thead>
                            <tbody class="table-white fs-12">
                                <tr v-for="(list,index) in filteredLists" v-bind:key="index" @click="selectRow(index)">
                                    <td class="text-center">{{ index+1 }}</td>
                                    <td>
                                        <h5 class="fs-13 mb-0 fw-semibold text-primary">{{list.amount}}</h5>
                                        <!-- <p class="fs-12 text-muted mb-0">{{list.division.name}}</p> -->
                                    </td>
                                    <td class="text-center">{{ list.grade }}</td>
                                    <td class="text-center">{{ list.year }}</td>
                                    <td class="text-center">
                                        <span v-if="list.is_regular" class="badge bg-success">Regular</span>
                                        <span v-else class="badge bg-danger">Non-regular</span>
                                    </td>
                                    <td class="text-end">
                                        <b-button @click="openEdit(list,index)" variant="soft-warning" class="me-1" v-b-tooltip.hover title="Edit" size="sm">
                                            <i class="ri-pencil-fill align-bottom"></i>
                                        </b-button>
                                        <b-button  @click="openEdit(list,index)"  variant="soft-info" class="me-1" v-b-tooltip.hover title="View" size="sm">
                                            <i class="ri-eye-fill align-bottom"></i>
                                        </b-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </BRow>
    <Create ref="create"/>
</template>
<script>
import Create from './Modals/Create.vue';
import Multiselect from "@vueform/multiselect";
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    components: { PageHeader, Multiselect, Create },
    props: ['lists'],
    data(){
        return {
            keyword: null
        }
    },
    computed: {
        filteredLists() {
            let filtered = this.lists.filter(item => {
                const matchesKeyword = !this.keyword || item.grade.toLowerCase().includes(this.keyword.toLowerCase());
                return matchesKeyword;
            });
            filtered.sort((a, b) => a.grade - b.grade);
            return filtered;
        }
    },
    methods: {
        openCreate(){
            this.$refs.create.show();
        },
        openEdit(data,index){
            this.$refs.create.edit(data);
        }
    }
}
</script>