<template>
    <!-- {{ lists.accounts }} -->
    <div style="height: calc(100vh - 429px);">
        <div class="row g-3 mb-2" v-if="lists">
            <div class="col-sm-4" v-for="(list, index) in lists.accounts" v-bind:key="index">
                <div class="p-1 border border-dashed rounded">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm me-0">
                            <div class="avatar-title rounded bg-transparent text-primary fs-24"><i
                                    class="ri-file-copy-2-fill"></i></div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted fs-11 mb-0">{{ list.name }} :</p>
                            <span v-if="list.number">{{list.number}}</span>
                            <span v-else>Not Set</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import simplebar from "simplebar-vue";
export default {
    components: { simplebar },
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