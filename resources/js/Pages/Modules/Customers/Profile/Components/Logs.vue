<template>
    <div class="table-responsive table-card" style="height: calc(100vh - 443px);">
        <table class="table table-nowrap align-middle mb-0">
           <thead class="bg-primary text-white thead-fixed">
                <tr class="fs-11">
                    <th style="width: 4%;"></th>
                    <th>Logs</th>
                    <th style="width: 17%;" class="text-center">User</th>
                    <th style="width: 25%;" class="text-center">Date</th>
                    <th style="width: 5%;"></th>
                </tr>
            </thead>
            <tbody v-if="lists.length > 0">
                <tr v-for="(list,index) in lists" v-bind:key="index" class="fs-12">
                    <td>
                        {{ (meta.current_page - 1) * meta.per_page + index + 1 }}.
                    </td>
                    <td>
                       <span class="text-capitalize">{{ list.event }}</span> {{list.log_name}}
                        <!-- <p class="fs-12 text-muted mb-0">{{ list.description }}</p> -->
                    </td>
                    <td class="text-center">{{list.causer.profile.fullname}} </td>
                    <td class="text-center">{{formatDate(list.created_at)}}</td>
                    <td>
                        <b-button @click="openLog(list)" variant="soft-info" class="me-1" v-b-tooltip.hover title="View" size="sm">
                            <i class="ri-eye-fill align-bottom"></i>
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
    </div>
    <div class="card-footer" style="margin-left: -15px; margin-right: -15px;">
        <Pagination class="ms-2 me-2 mt-n1 mb-n3" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
    </div>
    <Log ref="log"/>
</template>
<script>
import _ from 'lodash';
import Log from './Modals/Log.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, Log },
    props: ['id'],
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            filter : {
                keyword: null,
            }
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        fetch(page_url) {
            page_url = page_url || '/customers';
            axios.get(page_url,{
                params : {
                    id: this.id,
                    option: 'logs',
                    count: 10
                }
            })
            .then(response => {
                if(response){
                    this.lists = response.data.data;                    
                    this.meta = response.data.meta;
                    this.links = response.data.links;
                }
            })
            .catch(err => console.log(err));
        },
        openLog(data){
            this.$refs.log.show(data);
        },
        formatDate(dateString) {
            const date = new Date(dateString)

            return date.toLocaleString('en-PH', {
                year: 'numeric',
                month: 'long',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
            })
        }
    }
}
</script>