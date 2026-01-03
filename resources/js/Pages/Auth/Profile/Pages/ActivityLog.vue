<template>
<div class="">
    <form @submit.prevent="" class="customform">
        <BCard no-body>
            <BCardHeader>
                <BCardTitle>Activity Logs</BCardTitle>
                <p class="text-muted mb-0">Activity logs are records that document the actions and events occurring within a system or application over a period of time.</p>
            </BCardHeader>
            <BCardBody class="p-4" style="height: calc(100vh - 300px); overflow: auto;">
                <div class="profile-timeline">
                    <simplebar style="height: calc(100vh - 350px); overflow: auto;">
                        <div class="accordion accordion-flush" id="todayExample">
                            <div class="accordion-item border-0" v-for="(list,index) in lists" v-bind:key="index">
                                <div class="accordion-header" id="headingOne">
                                    <BLink class="accordion-button p-2 shadow-none" @click="toggleAccordion(index)" >
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-muted rounded-circle">
                                                <i v-if="list.event === 'updated'" class="ri-edit-circle-fill text-warning"></i>
                                                <i v-else-if="list.event === 'created'" class="ri-add-circle-fill text-success"></i>
                                                <i v-else class="ri-user-3-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">{{list.log_name}}</h6>
                                                <small class="text-muted" v-if="list.event === 'updated'">
                                                    You {{list.description}} on {{list.created_at}}
                                                </small>
                                            </div>
                                        </div>
                                    </BLink>
                                </div>

                                <BCollapse id="collapseOne" v-model="list.status">
                                    <div class="accordion-body ms-2 ps-5">
                                        <div v-if="list.event === 'updated'">
                                            Updated <span class="text-warning fst-italic" v-for="(old,key,index) in list.properties.old" v-bind:key="index">{{key}} : {{old}}, </span> to <span class="text-success fst-italic" v-for="(news,key,index) in list.properties.attributes" v-bind:key="index">{{key}} : {{news}}, </span>
                                        </div>
                                    </div>
                                </BCollapse>
                            </div>
                        </div>
                    </simplebar>
                </div>
            </BCardBody>
        </BCard>
    </form>
</div>
</template>
<script>
import simplebar from "simplebar-vue";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, simplebar },
    data(){
        return {
            lists: [],
            meta: {},
            links: {},
            accordions: {
                1: false,
                2: false
            }
        }
    },
    created(){
        this.fetch();
    },
    methods : {
        fetch(page_url){
            page_url = page_url || '/profile';
            return axios.get(page_url,{
                params : {
                    option: 'activity-logs',
                    count: ((window.innerHeight-490)/50),
                }
            })
            .then(response => {
                this.lists = response.data.data;
                this.meta = response.data.meta;
                this.links = response.data.links;      
            });
        },
        toggleAccordion(accordionNumber) {
            for (let key in this.lists) {
                if (key != accordionNumber) {
                this.lists[key].status = false;
                }
            }
            this.lists[accordionNumber].status = !this.lists[accordionNumber].status;
        }
    }
}
</script>