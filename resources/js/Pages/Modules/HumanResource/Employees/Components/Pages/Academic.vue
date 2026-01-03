<template>
    <b-row class="g-2 mb-4" style="margin-top: -12px;">
       <b-col lg>
           <div class="input-group mb-1">
               <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
               <input type="text" v-model="filter.keyword" placeholder="Search Academic" class="form-control" style="width: 100px;">
               <span @click="refresh()" class="input-group-text" v-b-tooltip.hover title="Refresh" style="cursor: pointer;"> 
                   <i class="bx bx-refresh search-icon"></i>
               </span>
               <b-button type="button" variant="primary" @click="openCreate()">
                   <i class="ri-add-circle-fill align-bottom me-1"></i> Create
               </b-button>
           </div>
       </b-col>
   </b-row>
   <div class="table-responsive table-card">
       <simplebar data-simplebar style="height: calc(100vh - 460px);">
           <table class="table table-nowrap align-middle mb-0">
               <thead class="table-light thead-fixed">
                   <tr class="fs-11">
                       <th style="width: 4%;" class="text-center">#</th>
                       <th>School</th>
                       <th style="width: 15%;" class="text-center">Level</th>
                       <th style="width: 15%;" class="text-center">Graduted Year</th>
                       <th style="width: 15%;" class="text-center">Status</th>
                       <th style="width: 7%;"></th>
                   </tr>
               </thead>
               <tbody v-if="lists.length > 0">
                    <tr class="fs-12" v-for="(list,index) in lists" v-bind:key="index" :class="{'bg-success-subtle': list.is_main}">
                        <td class="text-center">{{ index+1 }}</td>
                        <td>
                            <h5 class="fs-13 mb-0 fw-semibold text-primary">{{list.school.name}}</h5>
                            <p class="fs-12 text-muted mb-0">{{list.course.name}}</p>
                        </td>
                        <td class="text-center">{{ list.level.name }}</td>
                        <td class="text-center">{{ list.graduated_at }}</td>
                        <td class="text-center">
                            <span v-if="list.is_ongoing" class="badge bg-warning">Ongoing</span>
                            <span v-else class="badge bg-success">Completed</span>
                        </td>
                        <td class="text-end">
                            <b-button @click="openEdit(list,index)" variant="soft-warning" v-b-tooltip.hover title="Edit" size="sm">
                                <i class="ri-pencil-fill align-bottom"></i>
                            </b-button>
                        </td>
                    </tr>
               </tbody>
               <tbody v-else>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No records found.</td>
                    </tr>
               </tbody>
           </table>
       </simplebar>
   </div>
   <Create :levels="dropdowns.levels" ref="create"/>
</template>
<script>
import simplebar from "simplebar-vue";
import Create from './Modals/Academic.vue';
export default {
    components: { simplebar, Create },
    props: ['id','dropdowns','lists'],
   data(){
       return {
           filter: {
               keyword: null
           }
       }
   },
   methods: {
       openCreate(){
           this.$refs.create.show(this.id);
       },
       openCertification(data,id,course){
           if(data.length > 0){
               
           }else{
               this.$refs.certification.show(id,course);
           }
       }   
   }
}
</script>